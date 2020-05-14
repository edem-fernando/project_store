<?php


namespace Source\Models;


use Source\Core\Model;

class Address extends Model 
{
    /**
     * $safe: dados que não podem ser manipulados 
     * @var static $safe
     */
    protected static $safe = ["id_endereco", "criado_em", "editado_em"];
    
    /**
     * $required: dados obrigatórios para a tabela no banco 
     * @var static $required
     */
    protected static $required = ["cidade", "uf", "bairro", "numero"];
    
    /**
     * $table: nome da tabela no banco
     * @var static $table
     */
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
     * SEARCH_BY_ID(): Faz um select no banco de dados através do id
     * @param int $id
     * @param string $columns
     * @return Address | null
     */
    public function search_by_id(int $id, string $columns = "*"): ?Address 
    {
        return $this->search("id_endereco = :id_endereco", "id_endereco={$id}", $columns);
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
        return $this->search("bairro = :bairro", "bairro={$neighborhood}", $columns);
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
        $all = $this->read("SELECT {$columns} FROM " . self::$table . " LIMIT :l OFFSET : o", "l={$limit}&o={$offset}");
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
            $id_endereco = $this->id_endereco;
            if ($this->search("numero = :n AND id_endereco != :i", "n={$this->numero}&i={$id_endereco}")) {
                $this->message()->warning("O endereço informado já está cadastrado");
                return null;
            }
            
            $this->updated(self::$table, $this->safe(),"id_endereco = :i", "i={$id_endereco}");
            if ($this->fail()) {
                $this->message()->error("Error ao atualizar, por favor verifique os dados!");
                return null;
            }
        }
        
        // ADDRESS INSERT
        if (empty($this->id_endereco)) {
            $id_endereco = $this->insert(self::$table, $this->safe());
            if ($this->fail()) {
                $this->message()->error("Erro ao cadastrar endereço, verifique os dados");
                return null;
            }
        }
        $this->data = ($this->search_by_id($id_endereco))->data();
        return $this;
    }

    /**
     * DESTROY(): Verifica se o id existe no banco de dados, e depois,
     * o apaga do banco de dados
     * @return Address | null
     */
    public function destroy(): ?Address
    {
        if (!empty($this->id_endereco)) {
            $this->delete(self::$table, "id_endereco = :id_endereco", "id_endereco={$this->id_endereco}");
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
