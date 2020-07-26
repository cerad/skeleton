<?php declare(strict_types=1);

namespace App\User\Login;

use App\Shared\Action\ActionInterface;
use App\Shared\Action\EscapeTrait;
use App\Shared\Action\RenderTwigTrait;
use App\Shared\Action\RouterTrait;
use App\Shared\Security\CsrfTokenTrait;
use App\Shared\Security\SecurityTrait;
use App\Shared\Template\PageTemplateInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserLoginAction implements ActionInterface
{
    //use RenderTwigTrait;
    use EscapeTrait;
    use RouterTrait;
    use SecurityTrait;
    use CsrfTokenTrait;

    public function __invoke(PageTemplateInterface $pageTemplate, AuthenticationUtils $authenticationUtils) : Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return new Response($this->render($pageTemplate,$lastUsername,$error));
    }
    private function render(PageTemplateInterface $pageTemplate, string $lastUsername, ?AuthenticationException $error) : string
    {
        $stylesheet = <<<EOT
  <link rel="stylesheet" type="text/css" href="../assets/login.css">
EOT;
        $pageTemplate->addStyleSheet($stylesheet);

        $lastUsername = $this->escape($lastUsername);

        $content = <<<EOT
<form method="POST" class="form-signin text-center">
  {$this->renderUser()}
  {$this->renderError($error)}

  <img class="mb-4" src="../assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
  <h1 class="h3 mb-3 font-weight-normal">Please Log In</h1>

  <label for="inputEmail" class="sr-only">Email address</label>
  <input type="text" id="inputEmail" name="slug" class="form-control" placeholder="User name or email" required autofocus value="{$lastUsername}">

  <label for="inputPassword" class="sr-only">Password</label>
  <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>

  <div class="checkbox mb-3">
    <label><input type="checkbox" name="remember_me" value="remember-me"> Remember me</label>
  </div>
  
  <input type="hidden" name="_csrf_token" value="{$this->getCsrfToken('authenticate')}">
  <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
  <p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p>
</form>
EOT;
        return $pageTemplate->render($content);
    }
    private function renderError(?AuthenticationException $error) : string
    {
        if (!$error) return '';

        $message = $this->escape($error->getMessage());

        return <<<EOT
  <div class="alert alert-danger">{$message}</div>
EOT;
    }
    private function renderUser() : string
    {
        $user = $this->getUser();
        if (!$user) return '';
        return <<<EOT
  <div class="mb-3">
    You are logged in as {$user->getUsername()}, <a href="{$this->generateUrl('user_logout')}">Logout</a>
  </div>
EOT;

    }
}