<?php

namespace Source\App\Controllers;

use Source\Core\Controller;
use \Source\Core\View;
use CoffeeCode\Paginator\Paginator;
use Source\Core\Conn;
use \Source\Models\User;

/**
 * Class UserController 
 * @package Source\App\Controllers
 */
class UserController extends Controller
{
    private $template;
    
    public function __construct() 
    {
        $this->template = new View();
        $this->template->path("", ""); // substituir "" pelo template do controlador
    }
    
    /**
     * home(): renderiza página home para o usuário
     */
    public function home()
    {
        $get_page = filter_input(INPUT_GET, "page", FILTER_VALIDATE_INT);
        $total = Conn::getInstance()->query("SELECT count(id_users) as total FROM users")->fetch()->total;
        $pager = new Paginator("?page=");
        $pager->page($total, 3, $get_page, 2);

        /*
         * Personalizar este trecho...
        echo $this->template->render("test::list", [
            "title" => "Usuários do sistema",
            "list" => (new User())->all($pager->limit(), $pager->offset()),
            "pager" => $pager->render()
        ]);
         * 
         */
    }
    
    /**
     * edit(): renderiza página de editar para o usuário
     */
    public function edit()
    {
        $get_user = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
        $user = ($get_user ? (new User())->search_by_id($get_user) : null);

        if (!$user) {
            message()->error("Usuário não encontrado!")->flash();
            header("Location ./");
            exit;
        }

        /*
         * Personalizar este trecho...
        echo $this->template->render("test::user", [
            "user" => $user
        ]);*/
    }
}
