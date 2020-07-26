<?php declare(strict_types=1);

namespace App\Shared\Template;

interface PageTemplateInterface
{
    public function setTitle(string $title) : void;

    public function addStyleSheet(string $link) : void;

    public function addJavaScript(string $link) : void;

    public function render(string $content) : string;
}