<?php declare(strict_types=1);

namespace App\Home\Index;

use App\Shared\Action\ActionInterface;
use App\Shared\Action\RenderTwigTrait;
use App\Shared\Template\PageTemplate;
use App\Shared\Template\PageTemplateInterface;
use Symfony\Component\HttpFoundation\Response;

class HomeIndexAction implements ActionInterface
{
    //use RenderTwigTrait;

    public function __invoke(PageTemplateInterface $pageTemplate) : Response
    {
        return new Response($this->render($pageTemplate));

        //return $this->render('@Home/Index/index.html.twig', [
        //    'controller_name' => get_class($this),
        //]);
    }
    private function render(PageTemplateInterface $pageTemplate) : string
    {
        $content = 'Some Content';
        return $pageTemplate->render($content);
    }
}