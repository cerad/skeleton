<?php declare(strict_types=1);

use App\User\Login\UserLoginFormAuthenticator;
use App\User\User;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Security\Http\Firewall\AccessListener;

/** @var ContainerBuilder $container */
$container = isset($container) ? $container : null;

$container->loadFromExtension('security', [

    'enable_authenticator_manager' => true,

    'encoders' => [
        User::class => [
            'algorithm' => 'auto',
            'cost' => 12,
        ]
    ],
    'providers' => [
        'user_provider' => [
            'entity' => [
                'class' => User::class,
            ],
        ],
    ],
    'firewalls' => [
        'dev' => [
            'pattern' => '^/(_(profiler|wdt)|css|images|js)/',
            'security' => false,
        ],
        'main' => [
            'lazy' => true,
            'provider' => 'user_provider',
            'guard' => [
                'authenticators' => [
                    UserLoginFormAuthenticator::class,
                ]
            ],
            'logout' => [
                'path'   => 'user_logout',
                'target' => 'home_index'
            ],
        ],
    ],
    // Don't want to go to far down this rabbit hole
    'access_control' => [
        ['path' => '^/admin',      'roles' => 'ROLE_ADMIN'],
        //['path' => '^/home',       'roles' => AccessListener::PUBLIC_ACCESS],
        ['path' => '^/user/login', 'roles' => AccessListener::PUBLIC_ACCESS],
    ],
]);
