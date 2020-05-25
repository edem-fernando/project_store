<?php

namespace Source\Support;

use CoffeeCode\Paginator\Paginator;

/**
 * Class Pager: gerar paginação através do componente CoffeeCode\Paginator\Paginator
 * @package Source\Support
 */
class Pager extends Paginator
{
    /**
     * @param mixed $link
     * @param string | null $title
     * @param array  | null $first
     * @param array  | null $last
     */
    public function __construct($link = null, ?string $title = null, ?array $first = null, ?array $last = null) 
    {
        parent::__construct($link, $title, $first, $last);
    }
}
