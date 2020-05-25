<?php


namespace Source\Models;


use Source\Core\Model;

/**
 * Class Ceo
 * @package Source\Models
 */
class Ceo extends Model 
{
    /**
     * $safe: dados que não podem ser manipulados 
     * @var static $safe
     */
    protected static $safe = ["idCeo", "created_at", "updated_at"];
    
    /**
     * $required: dados obrigatórios para a tabela no banco 
     * @var static $required
     */
    protected static $required = ["name", "document", "email"];
    
    /**
     * $table: nome da tabela no banco
     * @var static $table
     */
    private static $table = "ceo";

    /**
     * @param string $name
     * @param string $document
     * @param string $email
     * @param int $idAddress
     * @return Ceo | null
     */
    public function bootstrap(string $name, string $document, string $email, int $idAddress = null): ?Ceo 
    {
        $this->idAddress = $idAddress;
        $this->name = $name;
        $this->document = $document;
        $this->email = $email;
        return $this;
    }
    
    /**
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
     * @param int $id
     * @param string $columns
     * @return Ceo | null
     */
    public function searchById(int $id, string $columns = "*"): ?Ceo 
    {
        return $this->search("idCeo = :idCeo", "idCeo={$id}", $columns);
    }

    /**
     * @param string $email
     * @param string $columns
     * @return Ceo | null
     */
    public function searchByEmail(string $email, string $columns = "*"): ?Ceo 
    {
        return $this->search("email = :email", "email={$email}", $columns);
    }

    /**
     * @param string $document
     * @param string $columns
     * @return Ceo | null
     */
    public function searchByDocument(string $document, string $columns = "*"): ?Ceo 
    {
        return $this->read("document = :document", "document={$document}", $columns);
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
            $this->message()->error("Não foi possível realizar a busca, tente mais tarde");
            return null;
        }
        return $all->fetchAll(\PDO::FETCH_CLASS, __CLASS__);
    }

    /**
     * @return Ceo | null
     */
    public function save(): ?Ceo
    {
        if (!$this->required()) {
            $this->message()->error("Nome, CPF e email são obrigatórios!");
            return null;
        }

        if (!is_cpf($this->document)) {
            $this->message()->error("CPF inválido!");
            return null;
        }

        if (!is_email($this->email)) {
            $this->message()->error("Email inválido!");
            return null;
        }

        // CEO UPDATE
        if (!empty($this->idCeo)) {
            $idCeo = $this->idCeo;
            if ($this->search("email = :e AND idCeo != :idCeo", "e={$this->email}&idCeo={$idCeo}")) {
                $this->message()->warning("O e-mail informado já está cadastrado!");
                return null;
            }

            if ($this->search("document = :document AND idCeo != :idCeo", "document={$this->document}&idCeo={$idCeo}")) {
                $this->message()->warning("O CPF informado já está cadastrado!");
                return null;
            }

            $this->updated(self::$table, $this->safe(), "idCeo = :idCeo", "idCeo={$idCeo}");
            if ($this->fail()) {
                $this->message()->error("Error ao atualizar, por favor verifique os dados!");
                return null;
            }
        }

        // CEO INSERT
        if (empty($this->idCeo)) {
            if ($this->searchByEmail($this->email)) {
                $this->message()->warning("O e-mail informado já está cadastrado!");
                return null;
            }

            if ($this->searchByDocument($this->document)) {
                $this->message()->warning("O CPF informado já está cadastrado!");
                return null;
            }

            $idCeo = $this->insert(self::$table, $this->safe());
            if ($this->fail()) {
                $this->message()->error("Error ao cadastrar, por favor verifique os dados!");
                return null;
            }
        }
        $this->data = ($this->searchById($idCeo))->data();
        return $this;
    }

    /**
     * @return Ceo | null
     */
    public function destroy(): ?Ceo
    {
        if (!empty($this->idCeo)) {
            $this->delete(self::$table, "idCeo = :idCeo", "idCeo={$this->idCeo}");
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
