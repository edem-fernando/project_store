<?php

namespace Source\Models;

use \PDO;
use \Source\Core\Model;

/**
 * Class User
 * @package Source\Models
 */
class User extends Model
{
    /** @var array $safe no update or create */
    protected static $safe = ['idUser', 'criado_em', 'editado_em'];

    /** @var array $required table fields */
    protected static $required = ["name", "document", "email", "password"];

    /** @var string $table database table */
    private static $table = 'users';
    
    /**
     * @param string $name
     * @param string $document
     * @param string $email
     * @param string $password
     * @return User | null
     */
    public function bootstrap(string $name, string $document, string $email, string $password): ?User
    {
        $this->nome = $name;
        $this->document = $document;
        $this->email = $email;
        $this->password = $password;
        return $this;
    }
    
    /**
     * @param string $columns
     * @return User | null
     */
    public function search(string $terms, string $params, string $columns = "*"): ?User
    {
        $search = $this->read("SELECT {$columns} FROM " . self::$table . " WHERE {$terms}", $params);
        if ($this->fail() || !$search->rowCount()) {
            return null;
        }
        return $search->fetchObject(__CLASS__);
    }
    
    /**
     * @param int $id
     * @param string $columns
     * @return array | null
     */
    public function searchById(int $id, string $columns = "*"): ?User
    {
        return $this->search("idUser = :idUser", "idUser={$id}", $columns);
    }
    
    /**
     * @param string $name
     * @param string $columns
     * @return array | null
     */
    public function searchByName(string $name, string $columns = "*"): ?User
    {
        return $this->search("name = :name", "name={$name}", $columns);
    }
    
    /**
     * @param string $email
     * @param string $columns
     * @return array | null
     */
    public function searchByEmail(string $email, string $columns = "*"): ?User
    {
        return $this->search("email = :email", "email={$email}", $columns);
    }
    
    /**
     * @param string $document
     * @param string $columns
     * @return array | null
     */
    public function searchByDocument(string $document, string $columns): ?User
    {
        return $this->search("document = :document", "document={$document}", $columns);
    }

    /**
     * @param int $limit
     * @param int $offset
     * @param string $columns
     * @return array | null
     */
    public function all(int $limit = 30, int $offset = 0, string $columns = "*"): ?array
    {
        $all = $this->read("SELECT {$columns} FROM " . self::$table . " LIMIT :l OFFSET :o", "l={$limit}&o={$offset}");
        if ($this->fail() || !$all->rowCount()) {
            return null;
        }
        return $all->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }
    
    /**
     * @return User | null
     */
    public function save(): ?User
    {
        if (!$this->required()) {
            $this->message()->error("Nome, email, CPF e senha são obrigatórios!");
            return null;
        }

        if (!is_email($this->email)) {
            $this->message()->error("E-mail inválido!");
            return null;
        }

        if (!is_passwd($this->password)) {
            $min = CONF_PASSWD_MIN_LEN;
            $max = CONF_PASSWD_MAX_LEN;
            $this->message()->warning("A senha deve ter entre {$min} e {$max} caracteres!");
            return null;
        } else {
            $this->password = passwd($this->password);
        }

        // User Update
        if (!empty($this->idUser)) {
            $idUser = $this->idUser;
            if ($this->search("email = :email AND idUser != :idUser", "email={$this->email}&idUser={$idUser}")) {
                $this->message()->error("Email já cadastrado!");
                return null;
            }

            if ($this->search("document = :document AND idUser != :idUser", "document={$this->document}&id={$idUser}")) {
                $this->message()->error("CPF já cadastrado!");
                return null;
            }

            if (!is_cpf($this->document)) {
                $this->message()->error("CPF inválido!");
                return null;
            }

            $this->updated(self::$table, $this->safe(), "idUser = :idUser", "idUser={$idUser}");
            if ($this->fail()) {
                $this->message()->error("Não foi possível editar o usuário, verifique os dados!");
                return null;
            }
        }

        // User Insert
        if (empty($this->idUser)) {
            if ($this->searchByEmail(self::$table, $this->email)) {
                $this->message->error("E-mail já cadastrado!");
                return null;
            }

            if (!is_cpf($this->document)) {
                $this->message->error("CPF inválido!");
                return null;
            }

            if ($this->searchByDocument(self::$table, $this->document)) {
                $this->message->error("CPF já cadastrado!");
                return null;
            }

            $idUser = $this->insert(self::$table, $this->safe());
            if ($this->fail()) {
                $this->message->error("Não foi possível cadastrar o usuário, por favor verifique os dados!");
                return null;
            }
        }
        $this->data = ($this->searchById($idUser))->data();
        return $this;
    }
    
    /**
     * o apaga do banco de dados
     * @return User | null
     */
    public function destroy(): ?User
    {
        if (!empty($this->idUser)) {
            $this->delete(self::$table, "idUser = :idUser", "idUser={$this->idUser}");
        }

        if ($this->fail()) {
            $this->message->warning("Não foi possível remover o usuário!");
            return null;
        }

        $this->message->success("Usuário removido com sucesso!");
        $this->data = null;
        return $this;
    }
}
