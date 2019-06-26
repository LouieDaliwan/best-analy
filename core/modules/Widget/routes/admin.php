<?php

Route::prefix('settings')->middleware(['breadcrumbs:widgets,name'])->group(function () {
    Route::resource('widgets', 'WidgetController', ['only' => ['index', 'show']]);
});
