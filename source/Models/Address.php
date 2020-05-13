<?php


namespace Source\Models;


use Source\Core\Model;

class Address extends Model {

    protected static $safe = ["id_endereco", "criado_em", "editado_em"];
    protected static $required = ["cidade", "uf", "bairro", "numero"];
    private static $table = "endereco";

    /**
     * BOOTSTRAP():
     * @param string $city
     * @param string $uf
     * @param string $neighborhood
     * @param string $complement
     * @return Address | null
     */
    public function bootstrap(string $city, string $uf, string $neighborhood, string $complement = null): ?Address 
    {
        $this->cidade = $city;
        $this->uf = $uf;
        $this->bairro = $neighborhood;
        $this->complemento = $complement;
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
    public function search(string $terms, string $params, string $columns = "*"): ?Address 
    {
        $search = $this->read("SELECT {$columns} FROM " . self::$table . " WHERE {$terms}", $params);
        if ($this->fail() || !$search->rowCount()) {
            return null;
        }
        return $search->fetchObject(__CLASS__);
    }

    /**
     * SEARCH_BY_CITY(): Faz um select no banco de dados através da cidade
     * @param string $city
     * @param string $columns
     * @return Address | null
     */
    public function search_by_city(string $city, string $columns = "*"): ?Address 
    {
        return $this->search("cidade = :cidade", "cidade={$city}", $columns);
    }

    /**
     * SEARCH_BY_UF(): Faz um select no banco de dados através da cidade
     * @param string $uf
     * @param string $columns
     * @return Address | null
     */
    public function search_by_uf(string $uf, string $columns = "*"): ?Address 
    {
        return $this->search("uf = :uf", "uf={$uf}", $columns);
    }

    /**
     * SEARCH_BY_NEIGHBORHOOD(): Faz um select no banco de dados através do bairro
     * @param string $neighborhood
     * @param string $columns
     * @return Address | null
     */
    public function search_by_neighborhood(string $neighborhood, string $columns = "*") 
    {
        return $this->search("bairro = :bairro", "bairro={$neighborhood}", $neighborhood);
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
        $all = $this->read("SELECT FROM " . self::$table . " LIMIT :l OFFSET : o", "l={$limit}&o={$offset}");
        if ($this->fail() || !$all->rowCount()) {
            return null;
        }
        return $all->fetchAll(\PDO::FETCH_OBJ, __CLASS__);
    }

    /**
     * SAVE(): valida e persiste os dados no banco
     * @return Address | null
     */
    public function save(): ?Address
    {
        if (!$this->required()) {
            $this->message()->warning("Cidade, UF, bairro e número são obrigatórios");
            return null;
        }
        
        // ADDRESS UPDATE
        if (!empty($this->id_endereco)) {
            $address_number = $this->id_endereco;
            if ($this->search("numero = :n AND id_endereco != :i", "n={$this->numero}&i={$address_id}")) {
                $this->message()->warning("O endereço informado já está cadastrado");
                return null;
            }
            
            $this->updated(self::$table, "id_endereco = :i", "i={$address_id}");
            if ($this->fail()) {
                $this->message()->error("Error ao atualizar, por favor verifique os dados");
                return null;
            }
        }
        
        // ADDRESS INSERT
        
    }

    public function destroy() {
        
    }
}
