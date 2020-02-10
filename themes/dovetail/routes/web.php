<?php

include core_path('routes/assets.php');
include core_path('routes/web.php');

Route::get('admin/dashboard', 'Spa\ShowAppPage')->name('dashboard');
Route::prefix('{lang?}')->middleware(['locale'])->group(function () {
    Route::get('/{any?}', 'Spa\ShowAppPage')->where('any', '.*');
});
