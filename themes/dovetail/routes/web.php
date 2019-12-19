<?php

include core_path('routes/assets.php');
include core_path('routes/web.php');

// Route::get('/', 'RedirectController@dashboard');

Route::get('/{any}', 'Spa\ShowAppPage')->where('any', '.*');
