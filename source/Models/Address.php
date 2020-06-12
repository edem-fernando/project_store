<?php

namespace Source\Models;

use Source\Core\Model;

/**
 * Class Address Active Record Pattern
 * 
 * @author Edem Fernando Bastos <edem.fbc@gmail.com>
 * @package Source\Models
 */
class Address extends Model 
{
    /** @var array $safe no update or create */
    protected static $safe = ["idAddress", "created_at", "updated_at"];
    
    /** @var array $required table fields */
    protected static $required = ["city", "state", "neighborhood", "number"];
    
    /** @var string $table database table */
    private static $table = "address";

    /**
     * @param string $city
     * @param string $state
     * @param string $neighborhood
     * @param string $number
     * @param string $complement
     * @return Address|null
     */
    public function bootstrap(string $city, string $state, string $neighborhood, string $number, string $complement = null): ?Address 
    {
        $this->city = $city;
        $this->state = $state;
        $this->neighborhood = $neighborhood;
        $this->number = $number;
        $this->complement = $complement;
        return $this;
    }
    
    /**
     * @param string $terms
     * @param string $params
     * @param string $columns
     * @return Address|null
     */
    public function search(string $terms, string $params, string $columns = "*"): ?Address 
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
     * @return Address | null
     */
    public function searchById(int $id, string $columns = "*"): ?Address 
    {
        return $this->search("idAddress = :idAddress", "idAddress={$id}", $columns);
    }

    /**
     * @param string $city
     * @param string $columns
     * @return Address|null
     */
    public function searchByCity(string $city, string $columns = "*"): ?Address 
    {
        return $this->search("city = :city", "city={$city}", $columns);
    }

    /**
     * @param string $state
     * @param string $columns
     * @return Address|null
     */
    public function searchByState(string $state, string $columns = "*"): ?Address 
    {
        return $this->search("state = :state", "state={$state}", $columns);
    }

    /**
     * @param string $neighborhood
     * @param string $columns
     * @return Address|null
     */
    public function searchByNeighborhood(string $neighborhood, string $columns = "*") 
    {
        return $this->search("neighborhood = :neighborhood", "neighborhood={$neighborhood}", $columns);
    }
    
    /**
     * @param int $limit
     * @param int $offset
     * @param string $columns
     * @return array|null
     */
    public function all(int $limit = 30, int $offset = 0, string $columns = "*"): ?array
    {
        $all = $this->read("SELECT {$columns} FROM " . self::$table . " LIMIT :l OFFSET : o", "l={$limit}&o={$offset}");
        if ($this->fail() || !$all->rowCount()) {
            return null;
        }
        return $all->fetchAll(\PDO::FETCH_OBJ, __CLASS__);
    }

    /**
     * @return Address|null
     */
    public function save(): ?Address
    {
        if (!$this->required()) {
            $this->message()->warning("Cidade, Estado, bairro e número são obrigatórios");
            return null;
        }
        
        // ADDRESS UPDATE
        if (!empty($this->idAddress)) {
            $idAddress = $this->idAddress;
            
            if ($this->search("number = :n AND idAddress != :i", "n={$this->number}&i={$idAddress}")) {
                $this->message()->warning("O endereço informado já está cadastrado");
                return null;
            }
            
            $this->updated(self::$table, $this->safe(),"idAddress = :i", "i={$idAddress}");
            
            if ($this->fail()) {
                $this->message()->error("Error ao atualizar, por favor verifique os dados!");
                return null;
            }
        }
        
        // ADDRESS INSERT
        if (empty($this->idAddress)) {
            $idAddress = $this->insert(self::$table, $this->safe());
            
            if ($this->fail()) {
                $this->message()->error("Erro ao cadastrar endereço, verifique os dados");
                return null;
            }
        }
        
        $this->data = ($this->searchById($idAddress))->data();
        return $this;
    }

    /**
     * @return Address|null
     */
    public function destroy(): ?Address
    {
        if (!empty($this->idAddress)) {
            $this->delete(self::$table, "idAddress = :idAddress", "idAddress={$this->idAddress}");
        }
        
        if ($this->fail()) {
            $this->message()->error("Não foi possível remover o usuário, verifique os dados!");
            return null;
        }
        
        $this->message = "Usuário removido com sucesso";
        $this->data = null;
        return $this;
    }
}
