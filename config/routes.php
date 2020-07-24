<?php declare(strict_types=1);

// config/routes.php

use App\Home\Index\HomeIndexAction;
use App\User\Login\UserLoginAction;

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes) {

    $routes->add('home_index', "/")->controller(HomeIndexAction::class);

    $userRoutes = $routes->collection('user_')->prefix('user');
    $userRoutes->add('login', '/login')->controller(UserLoginAction::class);
    //$userRoutes->add('check', '/login-check');
    $userRoutes->add('logout','/logout');
};