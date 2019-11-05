<?php

namespace Core\Http\Controllers;

use Core\Application\Repository\WithRepository;
use Core\Application\Service\WithService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

abstract class AdminController extends Controller
{
    use WithRepository, WithService;
}
