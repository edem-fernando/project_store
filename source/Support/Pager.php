<?php

namespace Source\Support;

use CoffeeCode\Paginator\Paginator;

/**
 * Class Pager
 * 
 * @author Edem Fernando Bastos <edem.fbc@gmail.com>
 * @package Source\Support
 */
class Pager extends Paginator
{
    /**
     * @param mixed $link
     * @param null|string $title
     * @param null|array $first
     * @param null|array $last
     */
    public function __construct($link = null, ?string $title = null, ?array $first = null, ?array $last = null) 
    {
        parent::__construct($link, $title, $first, $last);
    }
}
