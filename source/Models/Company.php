<?php

namespace Source\Models;

use Source\Core\Model;

/**
 * Class Company Active Record Pattern
 * 
 * @author Edem Fernando Bastos <edem.fbc@gmail.com>
 * @package Source\Models
 */
class Company extends Model 
{
     /** @var array $safe no update or create */
    protected static $safe = ["idCompany", "created_at", "updated_at"];
    
    /** @var array $required table fields */
    protected static $required = ["idCeo", "idAddress", "fantasyName", "socialReason", "cnpj"];
    
    /** @var string $table database table */
    private static $table = "company";
    
    /**
     * @param int $idCeo
     * @param int $idAddress
     * @param string $fantasyName
     * @param string $socialReason
     * @param string $cnpj
     * @return Company|null
     */
    public function bootstrap(
            int $idCeo,
            int $idAddress,
            string $fantasyName,
            string $socialReason,
            string $cnpj
    ): ?Company {
        $this->idCeo = $idCeo;
        $this->idAddress = $idAddress;
        $this->fantasyName = $fantasyName;
        $this->socialReason = $socialReason;
        $this->cnpj = $cnpj;
        return $this;
    }

    /**
     * @param string $terms
     * @param string $params
     * @param string $columns
     * @return Address|null
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
     * @param int $idCompany
     * @param string $columns
     * @return Company|null
     */
    public function searchById(int $idCompany, string $columns = "*"): ?Company
    {
        return $this->search("idCompany = :idCompany", "idCompany={$idCompany}", $columns);
    }

    /**
     * @param string $fantasyName
     * @param string $columns
     * @return Company|null
     */
    public function searchByFantasyName(string $fantasyName, string $columns = "*"): ?Company
    {
        return $this->search("fantasyName = :nF", "nF={$fantasyName}", $columns);
    }

    /**
     * @param string $socialReason
     * @param string $columns
     * @return Company|null
     */
    public function searchBySocialReason(string $socialReason, string $columns = "*") 
    {
        return $this->search("socialReason = :sR", "sR={$socialReason}", $columns);
    }
    
    /**
     * @param string $cnpj
     * @param string $columns
     * @return Company|null
     */
    public function searchByCnpj(string $cnpj, string $columns = "*"): ?Company
    {
        return $this->search("cnpj = :cnpj", "cnpj={$cnpj}", $columns);
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
     * @return Company|null
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
        if (!empty($this->idCompany)) {
            $idCompany = $this->idCompany;
            
            if ($this->search("socialReason = :rS AND idCompany != :idCompany", "rS={$this->socialReason}&id={$idCompany}")) {
                $this->message()->warning("A Razão Social já está cadastrada!");
                return null;
            }

            if ($this->search("fantasyName = :nF AND idCompany != :idCompany", "fantasyName={$this->fantasyName}&id={$idCompany}")) {
                $this->message()->warning("O Nome Fantasia já está cadastrado!");
                return null;
            }

            $this->updated(self::$table, $this->safe(), "idCompany = :idCompany", "idCompany={$idCompany}");
            
            if ($this->fail()) {
                $this->message()->error("Error ao atualizar, por favor verifique os dados!");
                return null;
            }
        }

        // COMPANY INSERT
        if (empty($this->idCompany)) {
            if ($this->searchByCnpj($this->cnpj)) {
                $this->message()->warning("O CNPJ já está cadastrado!");
                return null;
            }

            if ($this->searchByFantasyName($this->fantasyName)) {
                $this->message()->warning("O Nome Fantasia já está cadastrado!");
                return null;
            }

            if ($this->searchBySocialReason($this->socialReason)) {
                $this->message()->warning("A Razão Social já está cadastrada!");
                return null;
            }

            $idCompany = $this->insert(self::$table, $this->safe());
            
            if ($this->fail()) {
                $this->message()->error("Não foi possível cadastrar a empresa!");
                return null;
            }

            $this->data = ($this->searchByIdd($idCompany))->data();
            return $this;
        }
    }

    /**
     * @return Company|null
     */
    public function destroy(): ?Company 
    {
        if (!empty($this->idCompany)) {
            $this->delete(self::$table, "idCompany = :idCompany", "idCompany={$this->idCompany}");
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
