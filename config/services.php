<?php declare(strict_types=1);

// config/services.php
namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use App\Home\Index\HomeIndexAction;
use App\Shared\Action\ActionInterface;
use App\User\Init\UserInitCommand;
use App\User\Login\UserLoginFormAuthenticator;
use App\User\Login\UserLoginAction;
use App\User\UserProvider;

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

    // User
    $services->set(UserProvider::class);
    $services->set(UserInitCommand::class);
    $services->set(UserLoginAction::class);
    $services->set(UserLoginFormAuthenticator::class);

    //$services->load('App\\Home\\', '../src/Home/*')
    //    ->exclude('../src/Home/{}');
};
