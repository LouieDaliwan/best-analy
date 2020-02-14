<?php

use Barryvdh\DomPDF\Facade as PDF;
use Index\Models\Index;

Route::get('best/test', function () {
    return view('best::reports.pindex')->withIndices(Index::all());
});
