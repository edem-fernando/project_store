<?php

namespace Source\App;

use \Source\Core\Controller;
use \Source\Support\Pager;
use Source\Core\Conn;
use \Source\Models\Course;
use \Source\Models\Tutor;
use \Source\Models\Ceo;


/**
 * Web Controller
 * @author edem
 */
class Web extends Controller
{
    public function __construct() 
    {
        parent::__construct(__DIR__ . "/../../themes/" . CONF_VIEW_THEME . "/");
    }
    public function home(): void
    {
        $courses = (new Course())->all(4);
        $tutor = (new Tutor())->searchById("1");
        $ceo = (new Ceo())->searchById("1");
        $head = $this->seo->render(
                CONF_SITE_NAME . " - " . CONF_SITE_TITLE,
                CONF_SITE_DESC,
                url(),
                theme("/assets/images/shared.jpg")
        );
        
        echo $this->view->render("home", [
            "head" => $head,
            "courses" => $courses,
            "tutor" => $tutor,
            "ceo" => $ceo
        ]);
    }
    
    public function error(array $data): void
    {
        
    }
}
