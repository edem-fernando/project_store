<?php


namespace Source\Models;


use Source\Core\Model;

/**
 * Ceo
 * @package Ceo
 */
class Ceo extends Model 
{
    /**
     * $safe: dados que não podem ser manipulados 
     * @var static $safe
     */
    protected static $safe = ["id_ceo", "criado_em", "editado_em"];
    
    /**
     * $required: dados obrigatórios para a tabela no banco 
     * @var static $required
     */
    protected static $required = ["nome", "cpf", "email"];
    
    /**
     * $table: nome da tabela no banco
     * @var static $table
     */
    private static $table = "ceo";

    /**
     * BOOTSTRAP(): monta o objeto para persistir
     * @param string $name
     * @param string $cpf
     * @param string $email
     * @param int $id_endereco
     * @return Ceo | null
     */
    public function bootstrap(string $name, string $cpf, string $email, int $id_endereco = null): ?Ceo 
    {
        $this->id_endereco = $id_endereco;
        $this->name = $name;
        $this->cpf = $cpf;
        $this->email = $email;
        return $this;
    }
    
    /**
     * SEARCH(): Faz um select no banco de dados através do dos termos e parâmetros
     * é genérico
     * @param string $terms
     * @param string $params
     * @param string $columns
     * @return Address | null
     */
    public function search(string $terms, string $params, string $columns = "*"): ?Ceo
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
     * @return Ceo | null
     */
    public function search_by_id(int $id, string $columns = "*"): ?Ceo 
    {
        return $this->search("id_ceo = :id_ceo", "id_ceo={$id}", $columns);
    }

    /**
     * SEARCH_BY_EMAIL(): Faz um select no banco de dados através do email
     * @param string $email
     * @param string $columns
     * @return Ceo | null
     */
    public function search_by_email(string $email, string $columns = "*"): ?Ceo 
    {
        return $this->search("email = :email", "email={$email}", $columns);
    }

    /**
     * SEARCH_BY_CPF(): Faz um select no banco de dados através do CPF
     * @param string $cpf
     * @param string $columns
     * @return Ceo | null
     */
    public function search_by_cpf(string $cpf, string $columns = "*"): ?Ceo 
    {
        return $this->read("cpf = :cpf", "cpf={$cpf}", $columns);
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
            $this->message()->error("Não foi possível realizar a busca, tente mais tarde");
            return null;
        }
        return $all->fetchAll(\PDO::FETCH_CLASS, __CLASS__);
    }

    /**
     * SAVE(): valida e persiste os dados no banco
     * @return Ceo | null
     */
    public function save(): ?Ceo
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

        // CEO UPDATE
        if (!empty($this->id_ceo)) {
            $ceo_id = $this->id_ceo;
            if ($this->search("email = :e AND id_ceo != :i", "e={$this->email}&i={$ceo_id}")) {
                $this->message()->warning("O e-mail informado já está cadastrado!");
                return null;
            }

            if ($this->search("cpf = :e AND id_ceo != :i", "cpf={$this->cpf}&i={$ceo_id}")) {
                $this->message()->warning("O CPF informado já está cadastrado!");
                return null;
            }

            $this->updated(self::$table, $this->safe(), "id_ceo = :id_ceo", "id_ceo={$ceo_id}");
            if ($this->fail()) {
                $this->message()->error("Error ao atualizar, por favor verifique os dados!");
                return null;
            }
        }

        // CEO INSERT
        if (empty($this->id_ceo)) {
            if ($this->search_by_email($this->email)) {
                $this->message()->warning("O e-mail informado já está cadastrado!");
                return null;
            }

            if ($this->search_by_cpf($this->cpf)) {
                $this->message()->warning("O CPF informado já está cadastrado!");
                return null;
            }

            $ceo_id = $this->insert(self::$table, $this->safe());
            if ($this->fail()) {
                $this->message()->error("Error ao cadastrar, por favor verifique os dados!");
                return null;
            }
        }
        $this->data = ($this->search_by_id($ceo_id))->data();
        return $this;
    }

    /**
     * DESTROY(): Verifica se o id existe no banco de dados, e depois,
     * o apaga do banco de dados
     * @return Ceo | null
     */
    public function destroy(): ?Ceo
    {
        if (!empty($this->id_ceo)) {
            $this->delete(self::$table, "id_ceo = :id_ceo", "id_ceo={$this->id_ceo}");
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
