<?php declare(strict_types=1);

// config/routes.php

use App\Home\Index\HomeIndexAction;

# use App\Person\Edit\PersonEditAction;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes) {

    $routes->add('home_index', "/")->controller(HomeIndexAction::class);
/*
    $blogRoutes = $routes->collection('blog_')->prefix('blog');
    $blogRoutes->add('edit','/edit')->controller(HomeIndexAction::class);
    $blogRoutes->add('list','/list')->controller(HomeIndexAction::class);

    $personRoutes = $routes->collection('person_')->prefix('person');
    $personRoutes->add('edit','/edit')->controller(PersonEditAction::class);
*/
};