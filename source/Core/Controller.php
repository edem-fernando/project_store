<?php

namespace Source\Core;

use Source\Core\View;
use Source\Support\Seo;

/**
 * Class Controller
 * 
 * @author Edem Fernando Bastos <edem.fbc@gmail.com>
 * @package Source\Core
 */
class Controller 
{
    /** @var View */
    protected $view;

    /** @var Seo */
    protected $seo;

    /**
     * Controller Constructor
     * @param string|null $pathToView
     */
    public function __construct(string $pathToView = null)
    {
        $this->view = new View($pathToView);
        $this->seo = new Seo();
    }
}
