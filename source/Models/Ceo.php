<?php

namespace Source\Models;

class Ceo extends Model {

    protected static $safe = ["id_ceo", "criado_em", "editado_em"];
    private static $table = "ceo";

    /**
     * @param int $id_endereco
     * @param string $name
     * @param string $cpf
     * @param string $email
     * @return Ceo
     */
    public function bootstrap(int $id_endereco, string $name, string $cpf, string $email): ?Ceo {
        $this->id_endereco = $id_endereco;
        $this->name = $name;
        $this->cpf = $cpf;
        $this->email = $email;
        return $this;
    }

    public function search_by_id(int $id, string $columns = "*"): ?Ceo {
        $search_id = $this->read("SELECT {$columns} FROM " . self::$table . " WHERE id = :id", "id={$id}");

        if ($this->fail() || !$search_id->rowCount()) {
            $this->message = "Id não encontrado, verifique os dados informados";
            return null;
        }

        return $search_id->fetchObject(__CLASS__);
    }

    public function search_by_email(string $email, string $columns = "*"): ?Ceo {
        $search_email = $this->read("SELECT {$columns} FROM " . self::$table . " WHERE email = :email", "email={$email}");

        if ($this->fail() || !$search_email->rowCount()) {
            $this->message = "E-mail não encontrado";
            return null;
        }

        return $search_email->fetchObject(__CLASS__);
    }

    public function search_by_cpf(string $cpf, string $columns = "*"): ?Ceo {
        $search_cpf = $this->read("SELECT {$columns} FROM " . self::$table . " WHERE cpf = :cpf", "cpf={$cpf}");

        if ($this->fail() || !$search_cpf->rowCount()) {
            $this->message = "Não foi possível buscar o CPF";
            return null;
        }

        return $search_cpf->fetchObject(__CLASS__);
    }

    public function search_by_all(int $limit = 30, int $offset = 0, string $columns = "*") {
        $search_all = $this->read("SELECT {$columns} FROM " . self::$table . " LIMIT :l OFFSET :o", "l={$limit}&o={$offset}");

        if ($this->fail() || !$search_all->rowCount()) {
            $this->message = "Não foi possível realizar a busca, tente mais tarde";
            return null;
        }

        return $search_all->fetchAll(\PDO::FETCH_CLASS, __CLASS__);
    }

    public function save() {
        
    }

    public function destroy() {
        
    }

    public function required(): ?bool {
        if (empty($this->id_endereco) || empty($this->name) || empty($this->cpf) || empty($this->email)) {
            $this->message = "Código do endereço, nome, CPF e e-mail são campos obrigatórios";
            return false;
        } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->message = "O e-mail informado não é válido";
            return false;
        } else {
            return true;
        }
    }

}
