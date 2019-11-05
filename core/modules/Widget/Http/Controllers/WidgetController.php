<?php

namespace Widget\Http\Controllers;

use Core\Application\Widget\Factories\WidgetFactory;
use Core\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Widget\Services\WidgetServiceInterface;

class WidgetController extends AdminController
{
    /**
     * Create a new controller instance.
     *
     * @param \Widget\Services\WidgetServiceInterface $service
     */
    public function __construct(WidgetServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resources = $this->service()->defaults();//->list();

        return view('widget::settings.index')->withResources($resources);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $alias
     * @return \Illuminate\Http\Response
     */
    public function show($alias)
    {
        $resource = $this->service()->alias($alias);

        return view('widget::admin.show')->withResource($resource);
    }
}
