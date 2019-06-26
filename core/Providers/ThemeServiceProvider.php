<?php

namespace Core\Providers;

use Core\Providers\BaseServiceProvider;
use Illuminate\Support\Facades\Blade;

class ThemeServiceProvider extends BaseServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var boolean
     */
    protected $defer = true;

    /**
     * The active theme instance.
     *
     * @var string
     */
    protected $theme;

    /**
     * The array of view composers.
     *
     * @var array
     */
    protected $composers;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCoreViewFiles();

        $this->registerViewDirectives();

        $this->bindThemeManifestFacade();

        $this->bindThemeRepository();
    }

    /**
     * Register the ThemeManifest Facade.
     *
     * @return void
     */
    protected function bindThemeManifestFacade()
    {
        $this->app->bind('theme', 'Core\Manifests\ThemeManifest');
    }

    /**
     * Register the ThemeRepository instance.
     *
     * @return void
     */
    protected function bindThemeRepository()
    {
        $this->app->bind('repository:theme', 'Core\Repositories\ThemeRepository');
    }

    /**
     * Load views from core theme folder,
     * found in core/themes/views.
     *
     * Namespace the view files with "Default" and
     * the specified namespace variable "Theme".
     *
     * @var    string $module
     * @return void
     */
    protected function registerCoreViewFiles()
    {
        if (is_dir(theme_path('views'))) {
            $this->loadViewsFrom(theme_path('views/layouts'), 'layouts');
            $this->loadViewsFrom(theme_path('views'), 'default');
            $this->loadViewsFrom(theme_path('views'), 'theme');
        }

        $this->loadViewsFrom(resource_path('views'), 'default');
        $this->loadViewsFrom(resource_path('views'), 'theme');
    }

    /**
     * Register useful blade file directives.
     *
     * @return void
     */
    protected function registerViewDirectives()
    {
        Blade::if('settings', function ($key, $default) {
            return settings($key, $default);
        });

        Blade::if('self', function ($user) {
            return user()->isSuperAdmin() || $user->getKey() === user()->getKey();
        });
    }
}
