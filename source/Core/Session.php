<?php


namespace Source\Core;


use Source\Support\Message;

/**
 * Session
 * @package Session
 */
class Session 
{
    /**
     * Session Construct
     */
    public function __construct()
    {
        if (!session_id()) {
            session_save_path(CONF_SESS_PATH);
            session_start();
        }
    }
    
    /**
     * @param string $name
     * @return array | null
     */
    public function __get(string $name): ?array
    {
        return (!empty($_SESSION[$name]) ? $_SESSION[$name] : null);
    }
    
    /**
     * @param string $name
     * @return bool
     */
    public function __isset($name): bool
    {
        return $this->has($name);
    }
    
    /**
     * all(): converte uma sessão para objeto
     * @return object | null
     */
    public function all(): ?object
    {
        return (object) $_SESSION;
    }
    
    /**
     * set(): cria uma sessão
     * @param string $key
     * @param string $value
     * @return Session
     */
    public function set(string $key, string $value): Session
    {
        $_SESSION[$key] = (is_array($value) ? (object) $value : $value);
        return $this;
    }
    
    /**
     * unset(): Remove uma sessão
     * @param string $key
     * @return Session
     */
    public function unset(string $key): Session
    {
        unset($_SESSION[$key]);
        return $this;
    }
    
    /**
     * has(): verifica se há uma sessão
     * @return bool
     */
    public function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }
    
    /** 
     * @return Session 
     */
    public function regenerate(): Session
    {
        session_regenerate_id(true);
        return $this;
    }
    
    /**
     * destroy(): destrói uma sessão
     * @return Session
     */
    public function destroy(): Session
    {
        session_destroy();
        return $this;
    }
    
    /**
     * flash(): verifica se há uma sessão flash
     * depois a remove
     * @return Message | null
     */
    public function flash(): ?Message
    {
        if ($this->has("flash")) {
            $flash = $this->flash;
            $this->unset($flash);
            return $flash;
        }
        return null;
    }
    
    /**
     * csrf(): cria uma sessão contra ataques csrf
     * @return void
     */
    public function csrf(): void
    {
        $_SESSION["csrf_token"] = base64_encode(random_bytes(20));
    }
}
