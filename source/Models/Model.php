<?php

namespace Source\Models;

abstract class Model {

    protected $data;
    protected $message;
    protected $fail;

    /** @return object | null */
    protected function data(): ?object {
        return $this->data;
    }

    /** @return string | null */
    protected function message(): ?string {
        return $this->message;
    }

    /** @return PDOException | null */
    protected function fail(): ?\PDOException {
        return $this->fail;
    }

    public function __set($name, $value) {
        if (empty($this->data)) {
            $this->data = new \stdClass();
        }

        $this->data->$name = $value;
    }

    public function __get($name) {
        return ($this->data->$name ?? null);
    }

    public function __isset($name) {
        return isset($this->data->$name);
    }

    protected function read(string $select, string $params = null): ?\PDOStatement {
        try {
            $stmt = \Source\Database\Conn::getInstance()->prepare($select);
            if ($params) {
                parse_str($params, $params);
                foreach ($params as $key => $value) {
                    $type = (is_numeric($value) ? \PDO::PARAM_INT : \PDO::PARAM_STR);
                    $stmt->bindValue(":{$key}", $value, $type);
                }
            }

            $stmt->execute();
            return $stmt;
        } catch (\PDOException $exception) {
            $this->fail = $exception;
            return null;
        }
    }

    protected function insert() {
        try {
            
        } catch (\PDOException $exception) {
            $this->fail = $exception;
            return null;
        }
    }

    protected function updated() {
        try {
            
        } catch (\PDOException $exception) {
            $this->fail = $exception;
            return null;
        }
    }

    protected function delete() {
        try {
            
        } catch (\PDOException $exception) {
            $this->fail = $exception;
            return null;
        }
    }

    protected function filter() {
        
    }

    protected function safe() {
        
    }

}
