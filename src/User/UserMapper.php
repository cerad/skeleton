<?php declare(strict_types=1);

namespace App\User;

use App\Shared\Doctrine\DoctrineMapper;
//use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use App\User\Init\UserInitCommand;
use Doctrine\ORM\Mapping\Builder\FieldBuilder;
//use Doctrine\ORM\Mapping\ClassMetadata;

class UserMapper extends DoctrineMapper
{
    public function __invoke() : void
    {
        $builder = $this->builder;

        $builder->setTable('users');
        $builder->setCustomRepositoryClass(UserRepository::class);

        $this->createUuidIdField()->build();

        $builder->createField('username', 'string')
            ->columnName('username')
            ->length(60)->option('fixed', true)->nullable(false)
            ->unique(true)
            ->build();

        $builder->createField('password', 'string')
            ->columnName('password')
            ->length(255)->option('fixed', true)->nullable(false)
            ->build();

        $builder->createField('roles', 'json')
            ->columnName('roles')
            ->nullable(false)
            ->build();
    }
}