<?php

namespace Source\Models;

class Company extends Model {

    protected static $safe = ["id_empresa", "criado_em", "editado_em"];
    private static $table = "ceo";

    public function bootstrap(int $id_ceo, int $id_endereco, string $fantasy_name, string $social_reason, string $cnpj): ?Company {
        $this->id_ceo = $id_ceo;
        $this->id_endereco = $id_endereco;
        $this->fantasy_name = $fantasy_name;
        $this->social_reason = $social_reason;
        $this->cnpj = $cnpj;
        return $this;
    }

    public function search_by_fantasy_name(string $fantasy_name, string $columns = "*") {
        
    }

    public function search_by_social_reason(string $social_reason, string $columns = "*") {
        
    }

    public function search_by_cnpj(string $cnpj, string $columns = "*") {
        
    }

    public function save() {
        
    }

    public function destroy() {
        
    }

    public function required(): ?bool {
        if (empty($this->id_ceo) || empty($this->id_endereco) || empty($this->fantasy_name) || empty($this->social_reason) || empty($this->cnpj)) {
            $this->message = "Código do endereço, Código do CEO, nome fantasia, razão social e cnpj são campos obrigatórios";
            return false;
        } else {
            return true;
        }
    }

}
