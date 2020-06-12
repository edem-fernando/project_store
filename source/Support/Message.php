<?php

namespace Source\Support;

/**
 * Class Message
 * 
 * @author Edem Fernando Bastos <edem.fbc@gmail.com>
 * @package Source\Support
 */
class Message
{
    /** @var string */
    private $text;
    
    /** @var string */
    private $type;
    
    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->render();
    }
    
    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }
    
    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
    
    /**
     * @param string $message
     * @return Message
     */
    public function success(string $message): Message
    {
        $this->type = CONF_MESSAGE_SUCCESS;
        $this->text = $this->filter($message);
        return $this;
    }
    
    /**
     * @param string $message
     * @return Message
     */
    public function info(string $message): Message
    {
        $this->type = CONF_MESSAGE_INFO;
        $this->text = $this->filter($message);
        return $this;
    }
    
    /**
     * @param string $message
     * @return Message
     */
    public function warning(string $message): Message
    {
        $this->type = CONF_MESSAGE_WARNING;
        $this->text = $this->filter($message);
        return $this;
    }
    
    /**
     * @param string $message
     * @return Message
     */
    public function error(string $message): Message
    {
        $this->type = CONF_MESSAGE_ERROR;
        $this->text = $this->filter($message);
        return $this;
    }
    
    /**
     * @return string
     */
    public function render(): string
    {
        return "<div class='" . CONF_MESSAGE_CLASS . " {$this->getType()}'>{$this->getText()}</div>";
    }
    
    /**
     * flash method
     */
    public function flash(): void
    {
        (new \Source\Core\Session())->set("flash", $this);
    }
    
    /**
     * @return string
     */
    public function json(): string
    {
        return json_encode(["error" => $this->getText()]);
    }
    
    /**
     * @return string
     */
    private function filter(string $message): string 
    {
        return filter_var($message, FILTER_SANITIZE_SPECIAL_CHARS);
    }
}
