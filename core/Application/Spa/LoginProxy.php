<?php

namespace Core\Application\Spa;

use Core\Application\Application;
use User\Services\UserServiceInterface;

class LoginProxy
{
    const REFRESH_TOKEN = 'refreshToken';

    /**
     * Bootstrap the Application and UserService classes.
     *
     * @param \Core\Application\Application       $app
     * @param \User\Services\UserServiceInterface $user
     */
    public function __construct(Application $app, UserServiceInterface $user) {
        $this->user = $user;
        $this->app = $app;
    }

    public function proxy($grant, )
    {
        # code...
    }
}
