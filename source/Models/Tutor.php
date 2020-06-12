<?php

namespace Source\Models;

use Source\Core\Model;

/**
 * Class Tutor Active Record Pattern
 * 
 * @author Edem Fernando Bastos <edem.fbc@gmail.com>
 * @package Source\Models
 */
class Tutor extends Model
{
    /** @var array $safe no update or create */
    protected static $safe = ["idTutor", "created_at", "updated_at"];
    
    /** @var array $required table fields */
    protected static $required = ["name", "document", "email"];
    
    /** @var string $table database table */
    private static $table = "tutor";

    /**
     * @param string $idAddress
     * @param string $name
     * @param string $document
     * @param string $email
     * @param string $descriptionTutor
     * @return Ceo|null
     */
    public function bootstrap(
            string $idAddress,
            string $name,
            string $document,
            string $email,
            string $descriptionTutor = null
    ): ?Tutor {
        $this->idAddress = $idAddress;
        $this->name = $name;
        $this->document = $document;
        $this->email = $email;
        $this->descriptionTutor = $descriptionTutor;
        return $this;
    }

    /**
     * @param string $terms
     * @param string $params
     * @param string $columns
     * @return Tutor|null
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
     * @param int $id
     * @param string $columns
     * @return Tutor|null
     */
    public function searchById(int $id, string $columns = "*"): ?Tutor
    {
        return $this->search("idTutor = :idTutor", "idTutor={$id}", $columns);
    }

    /**
     * @param string $name
     * @param string $columns
     * @return Tutor|null
     */
    public function searchByName(string $name, string $columns = "*"): ?Tutor
    {
        return $this->search("name = :name", "name={$name}", $columns);
    }
    
    /**
     * @param string $document
     * @param string $columns
     * @return Tutor|null
     */
    public function searchByDocument(string $document, string $columns = "*"): ?Tutor
    {
        return $this->search("document = :document", "document={$document}", $columns);
    }
    
    /**
     * @param string $email
     * @param string $columns
     * @return Tutor|null
     */
    public function searchByEmail(string $email, string $columns = "*"): ?Tutor
    {
        return $this->search("email = :email", "email={$email}", $columns);
    }
    
    /**
     * @param int $limit
     * @param int $offset
     * @param string $columns
     * @return array|null
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
     * @return Tutor|null
     */
    public function save(): ?Tutor
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
        
        // TUTOR UPDATE
        if (!empty($this->idTutor)) {
            $idTutor = $this->idTutor;
            
            if ($this->search("name = :name AND idTutor != :idTutor", "name={$this->name}&idTutor={$idTutor}")) {
                $this->message()->warning("O tutor informado já está cadastrado!");
                return null;
            }
            
            if ($this->search("email = :email AND idTutor != :idTutor", "email={$this->email}&i={$idTutor}")) {
                $this->message()->warning("O e-mail informado já está cadastrado!");
                return null;
            }
            
            if ($this->search("document = :document AND idTutor != :idTutor", "document={$this->document}&idTutor={$idTutor}")) {
                $this->message()->warning("O CPF informado já está cadastrado!");
                return null;
            }
            
            $this->updated(self::$table, $this->safe(), "idTutor = :idTutor", "idTutor={$idTutor}");
            if ($this->fail()) {
                $this->message()->error("Error ao atualizar, por favor verifique os dados!");
                return null;
            }
        }
        
        // TUTOR INSERT
        if (empty($this->idTutor)) {
            if ($this->searchByEmail($this->email)) {
                $this->message()->warning("O e-mail informado já está cadastrado!");
                return null;
            }
            
            if ($this->searchByName($this->name)) {
                $this->message()->warning("O tutor informado já está cadastrado!");
                return null;
            }
            
            if ($this->searchByDocument($this->document)) {
                $this->message()->warning("O CPF informado já está cadastrado!");
                return null;
            }
            
            $idTutor = $this->insert(self::$table, $this->safe());
            
            if ($this->fail()) {
                $this->message()->error("Error ao cadastrar, por favor verifique os dados!");
                return null;
            }
        }
        
        $this->data = ($this->searchById($idTutor))->data();
        return $this;
    }

    /**
     * @return Tutor|null
     */
    public function destroy(): ?Tutor
    {
        if (!empty($this->idTutor)) {
            $this->delete(self::$table, "idTutor = :idTutor", "idTutor={$this->idTutor}");
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
