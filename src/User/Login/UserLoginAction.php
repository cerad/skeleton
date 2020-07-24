<?php declare(strict_types=1);

namespace App\User\Login;

use App\Shared\Action\ActionInterface;
use App\Shared\Action\RenderTwigTrait;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserLoginAction implements ActionInterface
{
    use RenderTwigTrait;

    public function __invoke(AuthenticationUtils $authenticationUtils) : Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('@User/Login/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }
}