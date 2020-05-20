<?php

namespace Source\Core;

use League\Plates\Engine;

/**
 * Class View
 * @package Source\Core
 */
class View 
{
    /** @var Engine */
    private $engine;
    
    /**
     * View Constructor
     */
    public function __construct(string $path = CONF_VIEW_PATH, string $ext = CONF_VIEW_EXT) 
    {
        $this->engine = Engine::create($path, $ext);
    }
    
    /** 
     * @return Engine 
     */
    public function engine(): Engine
    {
        return $this->engine;
    }
    
    /**
     * @param string $name
     * @param string $path
     * @return View
     */
    public function path(string $name, string $path): View
    {
        $this->engine->addFolder($name, $path);
        return $this;
    }
    
    /**
     * @param string $template_name
     * @param array $data
     * @return string
     */
    public function render(string $template_name, array $data): string
    {
        return $this->engine->render($template_name, $data);
    }
}
