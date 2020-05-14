<?php


namespace Source\Models;


use Source\Core\Model;

class Tutor extends Model
{
    /**
     * $safe: dados que não podem ser manipulados 
     * @var static $safe
     */
    protected static $safe = ["id_tutor", "criado_em", "editado_em"];
    
    /**
     * $required: dados obrigatórios para a tabela no banco 
     * @var static $required
     */
    protected static $required = ["nome", "cpf", "email"];
    
    /**
     * $table: nome da tabela no banco
     * @var static $table
     */
    private static $table = "tutor";

    /**
     * BOOTSTRAP():
     * @param string $name
     * @param string $cpf
     * @param string $email
     * @param int $id_endereco
     * @return Ceo | null
     */
    public function bootstrap(int $id_endereco, string $name, string $cpf, string $email, string $description = null): ?Tutor 
    {
        $this->id_endereco = $id_endereco;
        $this->name = $name;
        $this->cpf = $cpf;
        $this->email = $email;
        $this->description = $description;
        return $this;
    }
    
    /**
     * SEARCH(): Faz um select no banco de dados através do dos termos e parâmetros
     * é genérico
     * @param string $terms
     * @param string $params
     * @param string $columns
     * @return Tutor | null
     */
    public function search(string $terms, string $params, string $columns = "*"): ?Tutor
    {
        $search = $this->read("SELECT {$columns} FROM " . self::$table . " WHERE {$terms}", $params);
        if ($this->fail() || !$search->rowCount()) {
            return null;
        }
        return $search->fetchObject(__CLASS__);
    }
    
    /**
     * SEARCH_BY_ID(): Faz um select no banco de dados através do id
     * @param int $id
     * @param string $columns
     * @return Tutor | null
     */
    public function search_by_id(int $id, string $columns = "*"): ?Tutor
    {
        return $this->search("id_tutor = :i", "i={$id}", $columns);
    }

    /**
     * SEARCH_BY_NAME(): Faz um select no banco de dados através do nome
     * @param string $name
     * @param string $columns
     * @return Tutor | null
     */
    public function search_by_name(string $name, string $columns = "*"): ?Tutor
    {
        return $this->search("nome = :n", "n={$name}", $columns);
    }
    
    /**
     * SEARCH_BY_CPF(): Faz um select no banco de dados através do CPF
     * @param string $cpf
     * @param string $columns
     * @return Tutor | null
     */
    public function search_by_cpf(string $cpf, string $columns = "*"): ?Tutor
    {
        return $this->search("cpf = :c", "c={$cpf}", $columns);
    }
    
    /**
     * SEARCH_BY_EMAIL(): Faz um select no banco de dados através do email
     * @param string $email
     * @param string $columns
     * @return Tutor | null
     */
    public function search_by_email(string $email, string $columns = "*"): ?Tutor
    {
        return $this->search("email = :e", "e={$email}", $columns);
    }
    
    /**
     * ALL(): Faz um select no banco de dados trazendo vários registros
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
        return $all->fetchAll(\PDO::FETCH_CLASS, __CLASS__);
    }
    
    /**
     * SAVE(): valida e persiste os dados no banco
     * @return Tutor | null
     */
    public function save(): ?Tutor
    {
        if (!$this->required()) {
            $this->message()->error("Nome, CPF e email são obrigatórios!");
            return null;
        }
        
        if (!is_cpf($this->cpf)) {
            $this->message()->error("CPF inválido!");
            return null;
        }
        
        if (!is_email($this->email)) {
            $this->message()->error("Email inválido!");
            return null;
        }
        
        // TUTOR UPDATE
        if (!empty($this->id_tutor)) {
            $tutor_id = $this->id_tutor;
            if ($this->search("nome = :n AND id_tutor != :i", "n={$this->nome}&i={$tutor_id}")) {
                $this->message()->warning("O tutor informado já está cadastrado!");
                return null;
            }
            
            if ($this->search("email = :e AND id_tutor != :i", "e={$this->email}&i={$tutor_id}")) {
                $this->message()->warning("O e-mail informado já está cadastrado!");
                return null;
            }
            
            if ($this->search("cpf = :c AND id_tutor != :i", "c={$this->cpf}&i={$tutor_id}")) {
                $this->message()->warning("O CPF informado já está cadastrado!");
                return null;
            }
            
            $this->updated(self::$table, $this->safe(), "id_tutor = :id", "id={$tutor_id}");
            if ($this->fail()) {
                $this->message()->error("Error ao atualizar, por favor verifique os dados!");
                return null;
            }
        }
        
        // TUTOR INSERT
        if (empty($this->id_tutor)) {
            if ($this->search_by_email($this->email)) {
                $this->message()->warning("O e-mail informado já está cadastrado!");
                return null;
            }
            
            if ($this->search_by_name($this->name)) {
                $this->message()->warning("O tutor informado já está cadastrado!");
                return null;
            }
            
            if ($this->search_by_cpf($this->cpf)) {
                $this->message()->warning("O CPF informado já está cadastrado!");
                return null;
            }
            
            $tutor_id = $this->insert(self::$table, $this->safe());
            if ($this->fail()) {
                $this->message()->error("Error ao cadastrar, por favor verifique os dados!");
                return null;
            }
        }
        $this->data = ($this->search_by_id($tutor_id))->data();
        return $this;
    }

    /**
     * DESTROY(): Verifica se o id existe no banco de dados, e depois,
     * o apaga do banco de dados
     * @return Tutor | null
     */
    public function destroy(): ?Tutor
    {
        if (!empty($this->id_tutor)) {
            $this->delete(self::$table, "id_tutor = :i", "i={$this->id_tutor}");
        }
        
        if ($this->fail()) {
            $this->message()->error("Não foi possível remover o usuário, verifique os dados!");
            return null;
        }
        $this->message()->success("Usuário removido com sucesso!");
        $this->data = null;
        return $this;
    }
}
