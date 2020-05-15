<?php


namespace Source\Core;


/**
 * Message: responsável por gerenciar uma camada de erros, sucesso, alertas...
 * @package Source\Core
 */
class Message
{
    private $text;
    private $type;
    
    public function __toString(): string
    {
        return $this->render();
    }
    
    public function getText(): string
    {
        return $this->text;
    }
    
    public function getType(): string
    {
        return $this->type;
    }
    
    public function success(string $message): Message
    {
        $this->type = CONF_MESSAGE_SUCCESS;
        $this->text = $this->filter($message);
        return $this;
    }
    
    public function info(string $message): Message
    {
        $this->type = CONF_MESSAGE_INFO;
        $this->text = $this->filter($message);
        return $this;
    }
    
    public function warning(string $message): Message
    {
        $this->type = CONF_MESSAGE_WARNING;
        $this->text = $this->filter($message);
        return $this;
    }
    
    public function error(string $message): Message
    {
        $this->type = CONF_MESSAGE_ERROR;
        $this->text = $this->filter($message);
        return $this;
    }
    
    public function render(): string
    {
        return "<div class='" . CONF_MESSAGE_CLASS . " {$this->getType()}'>{$this->getText()}</div>";
    }
    
    public function flash(): void
    {
        (new \Source\Core\Session())->set("flash", $this);
    }
    
    public function json(): string
    {
        return json_encode(["error" => $this->getText()]);
    }
    
    private function filter(string $message): string 
    {
        return filter_var($message, FILTER_SANITIZE_SPECIAL_CHARS);
    }
}
