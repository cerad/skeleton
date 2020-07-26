<?php declare(strict_types=1);

namespace App\User\Register;

class NavBarComponent
{
    protected function escape(string $value) : string
    {
        return htmlspecialchars($value, ENT_COMPAT);
    }
    public function render(string $title, array $links = [])
    {
        $html = <<<EOT
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <a class="navbar-brand"><i class="fas fa-code"></i>{$this->escape($title)}</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" 
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home</a>
      </li>
      {$this->renderLinks($links)}
    </ul>
  </div>
</nav>
EOT;
        return $html;
    }
    private function renderLinks(array $links)
    {
        $html = '';
        foreach($links as $key => $value)
        {
            $html .= <<<EOT
<li class="nav-item active">
  <a class="nav-link" href="{$value}">{$this->escape($key)}</a>
</li>
EOT;
        }
        return $html;
    }
}