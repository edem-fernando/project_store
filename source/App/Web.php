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
    
    /**
     * Site home
     */
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
    
    /**
     * Site blog
     * @param array|null
     */
    public function blog(?array $data): void
    {
        $pager = new Pager(url("/blog/page"));
        $pager->pager(100, 10, ($data["page"] ?? 1));
        $head = $this->seo->render(
                "Blog  - " . CONF_SITE_NAME,
                CONF_SITE_DESC,
                url("/blog"),
                theme("/assets/images/shared.jpg")
        );

        echo $this->view->render("blog", [
            "head" => $head,
            "paginator" => $pager->render()
        ]);
    }
    
    public function blogPost(): void
    {
        
    }
    
    /**
     * Site school
     */
    public function school(): void
    {
        $ceo = (new Ceo())->searchById(1);
        $head = $this->seo->render(
                CONF_SITE_NAME . " - " . CONF_SITE_TITLE,
                CONF_SITE_DESC,
                url("/escola"),
                theme("/assets/images/shared.jpg")
        );

        echo $this->view->render("school", [
            "head" => $head,
            "ceo" => $ceo
        ]);
    }
    
    /**
     * Site Login
     */
    public function login(): void
    {
        $head = $this->seo->render(
                "Entrar " . CONF_SITE_NAME,
                CONF_SITE_NAME,
                url("/entrar"),
                theme("/assets/images/shared.jpg")
        );
        
        echo $this->view->render("auth-login", [
            "head" => $head
        ]);
    }
    
    /**
     * Site Optin Register
     */
    public function optinRegister(): void
    {
        $head = $this->seo->render(
                CONF_SITE_NAME . " - " . CONF_SITE_TITLE,
                CONF_SITE_DESC,
                url("/receber-noticias"),
                theme("/assets/images/shared.jpg")
        );

        echo $this->view->render("optin-register", [
            "head" => $head
        ]);
    }
    
    /**
     * Site Optin Vip
     */
    public function optinVip(): void
    {
        $head = $this->seo->render(
                "Lista vip da " . CONF_SITE_NAME,
                CONF_SITE_DESC,
                url("/lista-vip"),
                theme("/assets/images/shared.jpg")
        );

        echo $this->view->render("optin-vip", [
            "head" => $head
        ]);
    }
    
    /**
     * Site Optin Vip Success
     */
    public function optinVipSuccess(): void
    {
        $head = $this->seo->render(
                "Lista vip da " . CONF_SITE_NAME,
                CONF_SITE_DESC,
                url("/lista-vip/link"),
                theme("/assets/images/shared.jpg")
        );

        echo $this->view->render("optin-vip-success", [
            "head" => $head
        ]);
    }
    
    /**
     * Site Politcs
     */
    public function politcs(): void
    {
        $head = $this->seo->render(
                "Políticas de privacidade " . CONF_SITE_NAME,
                CONF_SITE_DESC,
                url("/politicas"),
                theme("/assets/images/shared.jpg"));

        echo $this->view->render("politcs", [
            "head" => $head
        ]);
    }
    
    /**
     * Site Warning
     */
    public function warning(): void
    {
        $head = $this->seo->render(
                "Aviso Legal " . CONF_SITE_NAME,
                CONF_SITE_DESC,
                url("/aviso"),
                theme("/assets/images/shared.jpg")
        );

        echo $this->view->render("warning", [
            "head" => $head
        ]);
    }
    
    /**
     * Site Terms
     */
    public function terms(): void
    {
        $head = $this->seo->render(
                "Termos de Uso " . CONF_SITE_NAME,
                CONF_SITE_DESC,
                url("/termos"),
                theme("/assets/images/shared.jpg")
        );

        echo $this->view->render("terms", [
            "head" => $head
        ]);
    }
    
    /**
     * Site error
     * @param array $data
     */
    public function error(array $data): void
    {
        $error = new \stdClass();

        switch ($data["errcode"]) {
            case "problemas":
                $error->code = "Ops";
                $error->title = "Estamos enfrantando problemas";
                $error->message = "Por hora nosso serviço está indisponível, caso necessite envie-nos um e-mail :)";
                $error->linkTitle = "Enviar e-mail";
                $error->link = "maito: " . CONF_MAIL_SUPPORT;
                break;

            case "manutencao":
                $error->code = "Ops";
                $error->title = "Estamos passando por manutenções";
                $error->message = "Voltamos logo! Por hora estamos trabalhando para melhorar nossso conteúdo :P";
                $error->linkTitle = null;
                $error->link = null;
                break;

            default :
                $error->code = $data["errcode"];
                $error->title = "Conteúdo indisponível :/";
                $error->message = "Desculpe, mas o conteúdo que você tentou acessar está indisponível, foi removido ou não existe :/";
                $error->linkTitle = "Continue navegando";
                $error->link = url_back();
                break;
        }

        $head = $this->seo->render(
                $error->code . " - " . $error->title,
                $error->message,
                url("/ops/{$error->code}"),
                theme("/assets/images/shared.jpg"),
                false
        );

        echo $this->view->render("error", [
            "head" => $head,
            "error" => $error
        ]);
    }
}
