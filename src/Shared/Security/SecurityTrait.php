<?php declare(strict_types=1);

namespace App\Shared\Security;

use App\User\User;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Core\Security;

trait SecurityTrait
{
    protected Security $security;

    /** @required */
    public function injectSecurity(Security $security)
    {
        $this->security = isset($this->security) ? $this->security: $security;
    }
    // Should probably make my own Shared UserInterface?
    protected function getUser() : ?User
    {
        /** @var User $user */
        $user = $this->security->getUser();
        return $user;
    }
    protected function isGranted($attributes, $subject = null): bool
    {
        return $this->security->isGranted($attributes, $subject);
    }
    // Maybe add deny access if not granted

}