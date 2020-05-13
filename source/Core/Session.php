<?php


namespace Source\Core;


use \Source\Core\Message;


class Session 
{
    
    /** Session constructor.*/
    public function __construct() 
    {
        if (!session_id()) {
            session_save_path(CONF_SESS_PATH);
            session_start();
        }
    }
    
    /** @return object|null */
    public function all(): ?object 
    {
        return (object)$_SESSION;
    }
    
    /** @param $name */
    public function __get($name) 
    {
        if (!empty($_SESSION[$name])) {
            return $_SESSION[$name];
        }
        return null;
    }
    
    /** @return null | Message */
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
     * @param $name
     * @return bool
     */
    public function __isset($name): bool 
    {
        return $this->has($name);
    }
    
    /**
     * set(): Cria uma nova sessão
     * @param string $key
     * @param mixed $value
     * @return Session
     */
    public function set(string $key, $value): Session 
    {
        $_SESSION[$key] = (is_array($value) ? (object)$value : $value);
        return $this;
    }
    
    /**
     * has(): Verifica se há uma sessão
     * @return Session
     */
    public function has(string $key): bool 
    {
        return isset($_SESSION[$key]);
    }
    
    /** @return Session*/
    public function regerate(): Session 
    {
        session_regenerate_id(true);
        return $this;
    }
    
    /**
     * unset(): Remove uma sessão
     * @return Session
     */
    public function unset(string $key): Session 
    {
        unset($_SESSION[$key]);
        return $this;
    }
    
    /**
     * destroy(): Destrói uma sessão
     * @return Session
     */
    public function destroy(): Session 
    {
        session_destroy();
        return $this;
    }
    
    /**
     * csrf(): Evita ataques do tipo csrf
     * @return void
     */
    public function csrf(): void 
    {
        $_SESSION["csrf_token"] = base64_encode(random_bytes(20));
    }
}
