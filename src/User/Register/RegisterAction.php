<?php declare(strict_types=1);

namespace App\User\Register;

use App\Shared\Action\ActionInterface;
use App\Shared\Action\FormFactoryTrait;

class RegisterAction implements ActionInterface
{
    use FormFactoryTrait;

    public function __invoke()
    {
        $data = [
            'username' => null,
            'email'    => null,
            'password' => null,
            'name'     => null,
        ];
        $form = $this->createNamedForm('',RegisterFormType::class, $data);
    }
}