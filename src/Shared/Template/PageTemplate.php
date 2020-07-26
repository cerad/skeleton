<?php declare(strict_types=1);

namespace App\Shared\Template;

use App\Shared\Action\EscapeTrait;

class PageTemplate implements PageTemplateInterface
{
    use EscapeTrait;

    protected string $title = 'SKEL';
    protected array $styleSheets = [];
    protected array $javaScripts = [];

    public function __construct()
    {
        $link = <<<EOT
  <link rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I"
        crossorigin="anonymous">

EOT;
        $this->addStyleSheet($link);

        $link = <<<EOT
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
          integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
          crossorigin="anonymous">
  </script>

EOT;
        $this->addJavaScript($link);

        $link = <<<EOT
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
          integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/"
          crossorigin="anonymous">
  </script>

EOT;
        $this->addJavaScript($link);
    }
    public function setTitle(string $title) : void
    {
        $this->title = $title;
    }
    public function addStyleSheet(string $link) : void
    {
        $this->styleSheets[] = $link;
    }
    public function addJavaScript(string $link) : void
    {
        $this->javaScripts[] = $link;
    }
    public function render(string $content) : string
    {
        return <<<EOT
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>{$this->escape($this->title)}</title>
  {$this->renderStyleSheets()}
</head>
<body>
  {$content}
  {$this->renderJavaScripts()}
</body>
</html>
EOT;
    }
    protected function renderStyleSheets() : string
    {
        $html = '';
        foreach($this->styleSheets as $link) {
            $html .= $link;
        }
        return $html;
    }
    protected function renderJavaScripts() : string
    {
        $html = '';
        foreach($this->javaScripts as $link) {
            $html .= $link;
        }
        return $html;
    }
}