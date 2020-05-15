<?php


namespace Source\Models;


use Source\Core\Model;

/**
 * Company
 * @package Company
 */
class Company extends Model 
{
    /**
     * $safe: dados que não podem ser manipulados 
     * @var static $safe
     */
    protected static $safe = ["id_empresa", "criado_em", "editado_em"];
    
    /**
     * $required: dados obrigatórios para a tabela no banco 
     * @var static $required
     */
    protected static $required = ["id_ceo", "id_endereco", "nome_fantasia", "razao_social", "cnpj"];
    
    /**
     * $table: nome da tabela no banco
     * @var static $table
     */
    private static $table = "empresa";
    
    /**
     * BOOTSTRAP(): monta o objeto para persistir
     * @param int $id_ceo
     * @param int $id_endereco
     * @param string $fantasy_name
     * @param string $social_reason
     * @param string $cnpj
     * @return Company | null
     */
    public function bootstrap(int $id_ceo, int $id_endereco, string $fantasy_name, string $social_reason, string $cnpj): ?Company 
    {
        $this->id_ceo = $id_ceo;
        $this->id_endereco = $id_endereco;
        $this->nome_fantasia = $fantasy_name;
        $this->razao_social = $social_reason;
        $this->cnpj = $cnpj;
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
    public function search(string $terms, string $params, string $columns = "*"): ?Company
    {
        $search = $this->read("SELECT {$columns} FROM " . self::$table . " WHERE {$terms}", $params);
        if ($this->fail() || !$search->rowCount()) {
            return null;
        }
        return $search->fetchObject(__CLASS__);
    }
    
    /**
     * SEARCH_BY_ID(): Faz um select no banco de dados através do id
     * @param int $id_company
     * @param string $columns
     * @return Company | null
     */
    public function search_by_id(int $id_company, string $columns = "*"): ?Company
    {
        return $this->search("id_empresa = :id", "id={$id_company}", $columns);
    }

    /**
     * SEARCH_BY_FANTASY_NAME(): Faz um select no banco de dados através do nome fantasia
     * @param string $fantasy_name
     * @param string $columns
     * @return Company | null
     */
    public function search_by_fantasy_name(string $fantasy_name, string $columns = "*"): ?Company
    {
        return $this->search("nome_fantasia = :nF", "nF={$fantasy_name}", $columns);
    }

    /**
     * SEARCH_BY_SOCIAL_REASON(): Faz um select no banco de dados através da razão social
     * @param string $social_reason
     * @param string $columns
     * @return Company | null
     */
    public function search_by_social_reason(string $social_reason, string $columns = "*") 
    {
        return $this->search("razao_social = :sR", "sR={$social_reason}", $columns);
    }
    
    /**
     * SEARCH_BY_CNPJ(): Faz um select no banco de dados através do CNPJ
     * @param string $cnpj
     * @param string $columns
     * @return Company | null
     */
    public function search_by_cnpj(string $cnpj, string $columns = "*"): ?Company
    {
        return $this->search("cnpj = :cnpj", "cnpj={$cnpj}", $columns);
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
     * @return Company | null
     */
    public function save(): ?Company
    {
        if (!$this->required()) {
            $this->message()->warning("Código do CEO, Código do endereço, Razão Social, Nome Fantasia e CNPJ são obrigatórios!");
            return null;
        }

        if (!is_cnpj($this->cnpj)) {
            $this->message()->error("CNPJ inválido!");
            return null;
        }

        // COMPANY UPDATE
        if (!empty($this->id_empresa)) {
            $company_id = $this->id_empresa;
            if ($this->search("razao_social = :rS AND id_empresa != :id", "rS={$this->razao_social}&id={$company_id}")) {
                $this->message()->warning("A Razão Social já está cadastrada!");
                return null;
            }

            if ($this->search("nome_fantasia = :nF AND id_empresa != :id", "nome_fantasia={$this->nome_fantasia}&id={$company_id}")) {
                $this->message()->warning("O Nome Fantasia já está cadastrado!");
                return null;
            }

            $this->updated(self::$table, $this->safe(), "id_empresa = :id", "id={$company_id}");
            if ($this->fail()) {
                $this->message()->error("Error ao atualizar, por favor verifique os dados!");
                return null;
            }
        }

        // COMPANY INSERT
        if (empty($this->id_empresa)) {
            if ($this->search_by_cnpj($this->cnpj)) {
                $this->message()->warning("O CNPJ já está cadastrado!");
                return null;
            }

            if ($this->search_by_fantasy_name($this->fantasy_name)) {
                $this->message()->warning("O Nome Fantasia já está cadastrado!");
                return null;
            }

            if ($this->search_by_social_reason($this->social_reason)) {
                $this->message()->warning("A Razão Social já está cadastrada!");
                return null;
            }

            $company_id = $this->insert(self::$table, $this->safe());
            if ($this->fail()) {
                $this->message()->error("Não foi possível cadastrar a empresa!");
                return null;
            }

            $this->data = ($this->search_by_id($company_id))->data();
            return $this;
        }
    }

    /**
     * DESTROY(): Verifica se o id existe no banco de dados, e depois,
     * o apaga do banco de dados
     * @return Company | null
     */
    public function destroy(): ?Company 
    {
        if (!empty($this->id_empresa)) {
            $this->delete(self::$table, "id_empresa = :id", "id={$this->id_empresa}");
        }

        if ($this->fail()) {
            $this->message()->error("Não foi possível remover a empresa, verifique os dados!");
            return null;
        }

        $this->message()->success("Empresa removida com sucesso!");
        $this->data = null;
        return $this;
    }
}
