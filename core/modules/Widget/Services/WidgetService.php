<?php

namespace Widget\Services;

use Core\Application\Service\Service;
use Core\Manifests\WidgetManifest;
use Illuminate\Http\Request;
use Widget\Models\Widget;

class WidgetService extends Service implements WidgetServiceInterface
{
    /**
     * The property on class instances.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * The Request instance.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * The WidgetManifest instance.
     *
     * @var \Core\Manifests\WidgetManifest
     */
    protected $manifest;

    /**
     * Constructor to bind model to a repository.
     *
     * @param  \Widget\Models\Widget          $model
     * @param  \Core\Manifests\WidgetManifest $manifest
     * @param  \Illuminate\Http\Request       $request
     * @return void
     */
    public function __construct(Widget $model, WidgetManifest $manifest, Request $request)
    {
        $this->model = $model;
        $this->manifest = $manifest;
        $this->request = $request;
    }

    /**
     * Retrieve the default widgets
     * from configuration files.
     *
     * @return \Illuminate\Support\Collection
     */
    public function defaults()
    {
        return $this->manifest->all();
    }

    /**
     * Retrieve the aliased widget from manifest.
     *
     * @param  string $alias
     * @return mixed
     */
    public function alias(string $alias)
    {
        return $this->manifest->find($alias);
    }
}
