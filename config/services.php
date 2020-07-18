<?php declare(strict_types=1);

// config/services.php
namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use App\Home\Index\HomeIndexAction;
use App\Shared\Action\ActionInterface;

//use App\Person\Command\PersonTestCommand;
//use App\Person\Edit\PersonEditAction;

return function (ContainerConfigurator $configurator) {
    $services = $configurator->services()->defaults()
        ->autowire()
        ->autoconfigure();

    $services->instanceof(ActionInterface::class)
        ->tag('controller.service_arguments');

    // Home
    $services->set(HomeIndexAction::class);

    //$services->load('App\\Home\\', '../src/Home/*')
    //    ->exclude('../src/Home/{}');
};