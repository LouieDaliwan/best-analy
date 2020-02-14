<?php

use Anam\PhantomMagick\Converter;
use Index\Models\Index;

Route::get('best/test', function () {
    return view('best::reports.fmpi.index')->withIndices(Index::all());
});

Route::get('best/test/phantom', function () {
    $c = new Converter;

    $c->setBinary(base_path('bin/phantomjs'));
    $c->source(url('best/test'))
      ->format('Legal')
      ->toPdf();

    return $c->serve();
});
