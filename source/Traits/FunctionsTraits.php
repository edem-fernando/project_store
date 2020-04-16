<?php


namespace Source\Traits;


trait FunctionsTraits
{
    public function toBrl($value)
    {
        return "R$ " . number_format($value, '2', ',', '.');
    }
}
