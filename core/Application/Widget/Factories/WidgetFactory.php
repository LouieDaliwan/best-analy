<?php

namespace Core\Application\Widget\Factories;

use Core\Application\Application;
use Core\Manifests\WidgetManifest;
use Exception;

class WidgetFactory
{
    /**
     * The Application instance.
     *
     * @var \Core\Application\Application
     */
    protected $app;

    /**
     * The WidgetManifest instance.
     *
     * @var \Core\Manifests\WidgetManifest
     */
    protected $manifest;

    /**
     * The constructor method.
     *
     * @param \Core\Application\Application  $app
     * @param \Core\Manifests\WidgetManifest $manifest
     */
    public function __construct(Application $app, WidgetManifest $manifest)
    {
        $this->app = $app;
        $this->manifest = $manifest;
    }

    /**
     * Retrieve the widget from the manifest.
     *
     * @param  string $key
     * @return mixed
     */
    public function find($key)
    {
        return $this->manifest->find($key) ?? $key;
    }

    /**
     * Instantiate the widget class through the container
     * to resolve dependencies.
     *
     * @param  string     $widget
     * @param  array|null $attributes
     * @return string
     * @throws Exception Widget variable should be an array.
     * @throws Exception Widget class should exist.
     */
    public function make($widget, $attributes = [])
    {
        $widget = $this->find($widget);

        if (! is_array($widget)) {
            throw new Exception("Widget with alias '".$widget."' not found", 1);
        }

        if (array_key_exists('fullname', $widget) && ! class_exists($widget['fullname'])) {
            throw new Exception('Class "'.$widget.'" does not exist', 1);
        }

        return $this->app->make($widget['fullname'], $attributes)->render($attributes);
    }
}
