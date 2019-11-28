<?php

namespace Dashboard\Http\Controllers\Dashboard;

use Core\Http\Controllers\AdminController;
use Illuminate\Http\Request;

class ShowDashboardPage extends AdminController
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        return view('dashboard::admin.index');
    }
}
