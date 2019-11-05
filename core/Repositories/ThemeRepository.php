<?php

namespace Core\Repositories;

use Core\Application\Repository\Repository;
use Core\Exceptions\RestrictedResourceException;
use Core\Manifests\ThemeManifest;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;

class ThemeRepository extends Repository implements Contracts\ThemeRepositoryInterface
{
    /**
     * The ThemeManifest instance.
     *
     * @var \Core\Manifests\ThemeManifest
     */
    protected $manifest;

    /**
     * The active theme.
     *
     * @var array
     */
    protected $theme;

    /**
     * Constructor to bind model to a repository.
     *
     * @param \Core\Manifests\ThemeManifest $manifest
     */
    public function __construct(ThemeManifest $manifest)
    {
        $this->manifest = $manifest;
        $this->theme = $manifest->active();
    }

    /**
     * Retrieve a metadata of theme from it's manifest.
     *
     * @param string $key
     * @param string $default
     * @return string
     */
    public function detail($key, $default = null)
    {
        return data_get($this->theme, $key, $default);
    }

    /**
     * Retrieve the theme's version.
     *
     * @return string
     */
    public function version()
    {
        // If the application is in development mode,
        // return a timestamp. This will force a refresh
        // on the browsers' cached assets.
        if (app()->environment() == 'development') {
            return 'dev-'.date('YmdH');
        }

        return $this->detail('version', app()->version());
    }

    /**
     * Retrieve the file from theme and
     * return the url string.
     *
     * @param string $file
     * @return string
     */
    public function fetch($file = null)
    {
        $path = $this->theme($file);
        $extension = pathinfo($path, PATHINFO_EXTENSION);

        /**
         * Check if the file is allowed to be downloaded.
         * If not, throw the RestrictedResourceException
         *
         * @see \Core\Exceptions\RestrictedResourceException
         */
        if (in_array($extension, config('downloads.restricted', []))) {
            throw new RestrictedResourceException('The requested resource is restricted.');
        }

        if (file_exists($path)) {
            $contentType = config('downloads.mimetypes.'.$extension, 'txt');

            return response()->file($path, array('Content-Type' => $contentType));
        }

        return abort(404);
    }

    /**
     * Retrieve and print the critical.css file
     * for faster page loads.
     *
     * @return string
     */
    public function inlined()
    {
        $path = $this->theme('dist/css/critical.css');

        if (file_exists($path)) {
            return file_get_contents($path);
        }

        return '';
    }

    /**
     * Retrieve the styleloader.js file.
     * This file will help in fetching preloaded files.
     *
     * @return string
     */
    public function styleloader()
    {
        if (! file_exists($this->theme('dist/js/styleloader.js'))) {
            return '';
        }

        $script = file_get_contents($this->theme('dist/js/styleloader.js'));

        return '<script>'.$script.'</script>';
    }

    /**
     * Retrieve the app's logo.
     *
     * @return string
     */
    public function logo()
    {
        return settings('site_logo', theme('dist/logos/logo.svg'));
    }

    /**
     * Retrieve the theme path.
     *
     * @param string $path
     * @return string
     */
    protected function theme($path = '')
    {
        return $this->theme['path'].DIRECTORY_SEPARATOR.urldecode($path);
    }
}
