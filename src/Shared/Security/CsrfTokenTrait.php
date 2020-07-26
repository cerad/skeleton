<?php declare(strict_types=1);

namespace App\Shared\Security;

use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

trait CsrfTokenTrait
{
    protected CsrfTokenManagerInterface $csrfTokenManager;

    /** @required */
    public function injectCsrfTokenManager(CsrfTokenManagerInterface $csrfTokenManager)
    {
        $this->csrfTokenManager = isset($this->csrfTokenManager) ? $this->csrfTokenManager: $csrfTokenManager;
    }
    protected function isCsrfTokenValid(string $id, ?string $token): bool
    {
        return $this->csrfTokenManager->isTokenValid(new CsrfToken($id, $token));
    }
    // Return string or token?
    protected function getCsrfToken(string $id = 'something'): CsrfToken
    {
        return $this->csrfTokenManager->getToken($id);
    }

}