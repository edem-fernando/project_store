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
    protected static $safe = ['id_usuarios', 'criado_em', 'editado_em'];

    /** @var array $required table fields */
    protected static $required = ["nome", "cpf", "email", "senha"];

    /** @var string $table database table */
    private static $table = 'usuarios';
    
    /**
     * bootstrap(): monta dados, em seu parâmetro, que podem ser utilizados
     * em outros métodos. Estes dados por exemplo serão inseridos na base de dados
     * se após o uso do método seja realizado um save()
     * @param string $name
     * @param string $cpf
     * @param string $email
     * @param string $senha
     * @return User | null
     */
    public function bootstrap(string $name, string $cpf, string $email, string $senha): ?User
    {
        $this->nome = $name;
        $this->cpf = $cpf;
        $this->email = $email;
        $this->senha = $senha;
        return $this;
    }
    
    /**
     * search(): Faz um select no banco de dados através do dos termos e parâmetros
     * é genérico
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
     * search_by_id(): Faz um select no banco de dados através do id
     * @param int $id
     * @param string $columns
     * @return array | null
     */
    public function search_by_id(int $id, string $columns = "*"): ?User
    {
        return $this->search("id_usuarios = :id", "id={$id}", $columns);
    }
    
    /**
     * search_by_name(): Faz um select no banco de dados através do nome
     * @param string $name
     * @param string $columns
     * @return array | null
     */
    public function search_by_name(string $name, string $columns = "*"): ?User
    {
        return $this->search("nome = :nome", "nome={$name}", $columns);
    }
    
    /**
     * search_by_email(): Faz um select no banco de dados através do email
     * @param string $email
     * @param string $columns
     * @return array | null
     */
    public function search_by_email(string $email, string $columns = "*"): ?User
    {
        return $this->search("email = :email", "email={$email}", $columns);
    }
    
    /**
     * search_by_cpf(): Faz um select no banco de dados através do CPF
     * @param string $cpf
     * @param string $columns
     * @return array | null
     */
    public function search_by_cpf(string $cpf, string $columns): ?User
    {
        return $this->search("cpf = :cpf", "cpf={$cpf}", $columns);
    }

    /**
     * all(): Faz um select no banco de dados trazendo vários registros
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
     * save(): Verifica se o id e o e-mail já estão cadastrados,
     * caso estejam realiza um update, e persiste os dados no banco
     * caso contrário realiza um insert, e persiste os dados no banco
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

        if (!is_passwd($this->senha)) {
            $min = CONF_PASSWD_MIN_LEN;
            $max = CONF_PASSWD_MAX_LEN;
            $this->message()->warning("A senha deve ter entre {$min} e {$max} caracteres!");
            return null;
        } else {
            $this->senha = passwd($this->senha);
        }

        // User Update
        if (!empty($this->id_usuarios)) {
            $user_id = $this->id_usuarios;
            if ($this->search("email = :e AND id_usuarios != :id", "e={$this->email}&id={$user_id}")) {
                $this->message()->error("Email já cadastrado!");
                return null;
            }

            if ($this->search("cpf = :cpf AND id_usuarios != :id", "cpf={$this->cpf}&id={$user_id}")) {
                $this->message()->error("CPF já cadastrado!");
                return null;
            }

            if (!is_cpf($this->cpf)) {
                $this->message()->error("CPF inválido!");
                return null;
            }

            $this->updated(self::$table, $this->safe(), "id_usuarios = :id", "id={$user_id}");
            if ($this->fail()) {
                $this->message()->error("Não foi possível editar o usuário, verifique os dados!");
                return null;
            }
        }

        // User Insert
        if (empty($this->id_usuarios)) {
            if ($this->search_by_email(self::$table, $this->email)) {
                $this->message->error("E-mail já cadastrado!");
                return null;
            }

            if (!is_cpf($this->cpf)) {
                $this->message->error("CPF inválido!");
                return null;
            }

            if ($this->search_by_cpf(self::$table, $this->cpf)) {
                $this->message->error("CPF já cadastrado!");
                return null;
            }

            $user_id = $this->insert(self::$table, $this->safe());
            if ($this->fail()) {
                $this->message->error("Não foi possível cadastrar o usuário, por favor verifique os dados!");
                return null;
            }
        }
        $this->data = ($this->search_by_id($user_id))->data();
        return $this;
    }
    
    /**
     * destroy(): Verifica se o id existe no banco de dados, e depois,
     * o apaga do banco de dados
     * @return User | null
     */
    public function destroy(): ?User
    {
        if (!empty($this->id_usuarios)) {
            $this->delete(self::$table, "id_usuarios = :id", "id={$this->id_usuarios}");
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
