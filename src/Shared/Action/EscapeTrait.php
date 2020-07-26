<?php
declare(strict_types=1);


namespace App\Shared\Action;


trait EscapeTrait
{
    protected function escape(string $value) : string
    {
        return htmlspecialchars($value, ENT_COMPAT);
    }
}