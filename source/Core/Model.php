<?php


namespace Source\Core;


use \Source\Core\Conn;
use Source\Support\Message;


abstract class Model 
{
    /** @var array */
    protected $data;
    
    /** @var Message */
    protected $message;
    
    /** @var PDOException */
    protected $fail;

    /** 
     * Model Construct 
     */
    public function __construct() 
    {
        $this->message = new Message();
    }
    
    /** 
     * @return object | null 
     */
    protected function data(): ?object 
    {
        return $this->data;
    }

    /** 
     * @return Message | null 
     */
    protected function message(): ?Message 
    {
        return $this->message;
    }

    /** 
     * @return PDOException | null 
     */
    protected function fail(): ?\PDOException 
    {
        return $this->fail;
    }

    /**
     * @param $name
     * @param $value 
     */
    public function __set($name, $value) 
    {
        if (empty($this->data)) {
            $this->data = new \stdClass();
        }

        $this->data->$name = $value;
    }

    /** @param $name */
    public function __get($name) 
    {
        return ($this->data->$name ?? null);
    }

    /** 
     * @param $name 
     */
    public function __isset($name) 
    {
        return isset($this->data->$name);
    }

    /**
     * read():Prepara a QUERY ler registros do banco
     * @param string $select
     * @param array $params
     * @return PDOStatement | null
     */
    protected function read(string $select, string $params = null): ?\PDOStatement 
    {
        try {
            $stmt = Conn::getInstance()->prepare($select);
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

    /**
     * insert():Prepara a QUERY para insere registros no banco
     * @param string $table
     * @param array $data
     * @return int | null
     */
    protected function insert(string $table, array $data): ?int 
    {
        try {
            $columns = implode(", ", array_keys($data));
            $values = ":" . implode(", :", array_keys($data));

            $stmt = Conn::getInstance()->prepare("INSERT INTO {$table} ($columns) VALUES ($values)");
            $stmt->execute($this->filter($data));
            return Conn::getInstance()->lastInsertId();
        } catch (\PDOException $exception) {
            $this->fail = $exception;
            return null;
        }
    }

    /**
     * updated():Prepara a QUERY para atualizar registros no banco
     * @param string $table
     * @param array $data
     * @param string $terms
     * @param string $params
     * @return int | null
     */
    protected function updated(string $table, array $data, string $terms, string $params): ?int
    {
        try {
            $data_set = [];
            foreach ($data as $bind => $value) {
                $data_set[] = "{$bind} = :{$bind}";
            }

            $data_set = implode(", ", $data_set);
            parse_str($params, $params);

            $stmt = Conn::getInstance()->prepare("UPDATE {$table} SET {$data_set} WHERE {$terms}");
            $stmt->execute($this->filter(array_merge($data, $params)));

            return ($stmt->rowCount() ?? 1);
        } catch (\PDOException $exception) {
            $this->fail = $exception;
            return null;
        }
    }

    /**
     * delete():Prepara a QUERY para excluir registros no banco
     * @param string $table
     * @param string $terms
     * @param string $params
     * @return int | null
     */
    protected function delete(string $table, string $terms, string $params): ?int 
    {
        try {
            parse_str($params, $params);

            $stmt = Conn::getInstance()->prepare("DELETE FROM {$table} WHERE {$terms}");
            $stmt->execute($params);
            return ($stmt->rowCount() ?? 1);
        } catch (\PDOException $exception) {
            $this->fail = $exception;
            return null;
        }
    }

    /**
     * filter(): Remove caracteres especiais, para evitar códigos maliciosos
     * @param array $data
     * @return array | null
     */
    protected function filter(array $data): ?array 
    {
        $filter = [];
        foreach ($data as $key => $value) {
            $filter[$key] = (is_null($value) ? null : filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS));
        }
        return $filter;
    }

    /**
     * safe(): Elimina campos que não podem ser manipulado no banco de dados
     * estes dados encontram-se em cada filha desta
     * @return array | null
     */
    protected function safe(): ?array 
    {
        $safe = (array) $this->data;
        foreach (static::$safe as $unset) {
            unset($safe[$unset]);
        }
        return $safe;
    }
    
    /**
     * required(): Verifica quais são os campos obrigatórios 
     * de cada, classe filha desta, 
     * @return bool
     */
    protected function required(): bool 
    {
        $data = (array) $this->data;
        foreach (static::$required as $fields) {
            if (empty($data[$fields])) {
                return false;
            }
        }
        return true;
    }
}
