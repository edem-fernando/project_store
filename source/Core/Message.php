<?php


namespace Source\Core;


/**
 * Message: Classe contida no namespace Source\Core
 * responsável por gerenciar uma camada de erros
 * @package Source\Core
 */
class Message 
{

    /** @var $text*/
    private $text;
    
    /** @var $type*/
    private $type;
    
    /** @return string */
    public function json(): string 
    {
        return json_encode(["error" => $this->getText()]);
    }

    /** @return void */
    public function flash(): void 
    {
        (new \Source\Core\Session())->set("flash", $this);
    }
    
    /** @return string */
    private function getText(): string 
    {
        return $this->text;
    }

    /** @return string */
    private function getType(): string 
    {
        return $this->type;
    }

    /** @return string */
    public function render(): string 
    {
        return "<div class='" . CONF_MESSAGE_CLASS . " {$this->getType()}'>{$this->getText()}</div>";
    }

    /** @return string */
    public function __toString(): string 
    {
        return $this->render();
    }

    /**
     * success: retorna mensagem no padrão de success
     * @param string $message
     * @return string
     */
    public function success(string $message): Message 
    {
        $this->type = CONF_MESSAGE_SUCCESS;
        $this->text = $this->filter($message);
        return $this;
    }
    
    /**
     * info: retorna mensagem no padrão de info
     * @param string $message
     * @return string
     */
    public function info(string $message): Message 
    {
        $this->type = CONF_MESSAGE_INFO;
        $this->text = $this->filter($message);
        return $this;
    }
    
    /**
     * warning: retorna mensagem no padrão de warning
     * @param string $message
     * @return string
     */
    public function warning(string $message): Message 
    {
        $this->type = CONF_MESSAGE_WARNING;
        $this->text = $this->filter($message);
        return $this;
    }
    
    /**
     * error: retorna mensagem no padrão de error
     * @param string $message
     * @return string
     */
    public function error(string $message): Message 
    {
        $this->type = CONF_MESSAGE_ERROR;
        $this->text = $this->filter($message);
        return $this;
    }
     
    /**
     * filter: filtra e previne caracteres especiais
     * @param string $message 
     * @return string
     */
    private function filter(string $message): string 
    {
        return filter_var($message, FILTER_SANITIZE_SPECIAL_CHARS);
    }
}
