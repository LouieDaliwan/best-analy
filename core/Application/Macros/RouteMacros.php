<?php

namespace Core\Application\Macros;

use Illuminate\Support\Facades\Route;

abstract class RouteMacros
{
    /**
     * Register the route macros.
     *
     * @return void
     */
    public static function register(): void
    {
        static::registerPublicResource();
        static::registerSoftDeletes();
        static::registerPortResource();
        static::registerResetResource();
    }

    /**
     * Register soft-delete routes.
     *
     * @return void
     */
    protected static function registerSoftDeletes()
    {
        Route::macro('softDeletes', function ($name, $controller) {
            $singular = str_singular($name);

            Route::get(sprintf("%s/trashed", $name), "$controller@trashed")->name("$name.trashed");
            Route::delete(sprintf("%s/delete/{%s?}", $name, $singular), "$controller@delete")->name("$name.delete");
            Route::patch(sprintf("%s/restore/{%s?}", $name, $singular), "$controller@restore")->name("$name.restore");
        });
    }

    /**
     * Register import/export routes.
     *
     * @return void
     */
    protected static function registerPortResource()
    {
        Route::macro('portResource', function ($name, $controller) {
            Route::put(sprintf("%s/import", $name), "$controller@import")->name("$name.import");
            Route::post(sprintf("%s/export", $name), "$controller@export")->name("$name.export");
        });
    }

    /**
     * Register reset/refresh routes.
     *
     * @return void
     */
    protected static function registerResetResource()
    {
        Route::macro('resetResource', function ($name, $controller) {
            Route::post(sprintf("%s/reset", $name), "$controller@reset")->name("$name.reset");
            Route::post(sprintf("%s/refresh", $name), "$controller@refresh")->name("$name.refresh");
        });
    }

    /**
     * Register all/single routes.
     *
     * @return void
     */
    protected static function registerPublicResource()
    {
        Route::macro('publicResource', function ($name, $controller) {
            $singular = str_singular($name);
            Route::get($name, "$controller@all")->name("$name.all");
            Route::get(sprintf("%s/{%s?}", $name, $singular), "$controller@single")->name("$name.single");
        });
    }
}
