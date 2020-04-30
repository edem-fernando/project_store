<?php


namespace Source\Models;


class Address extends Model
{
    protected static $safe = ["id_endereco", "criado_em", "editado_em"];
    private static $table = "endereco";
    
    public function bootstrap(int $id_endereco, string $city, string $uf, string $neighborhood, string $complement = null): ?Address {
        $this->id_endereco = $id_endereco;
        $this->city = $city;
        $this->uf = $uf;
        $this->neighborhood = $neighborhood;
        $this->complement = $complement;
        return $this;
    }

    public function search_by_city(string $city, string $columns = "*") {
        
    }

    public function search_by_uf(string $uf, string $columns = "*") {
        
    }

    public function search_by_neighborhood(string $neighborhood, string $columns = "*") {
        
    }

    public function save() {
        
    }

    public function destroy() {
        
    }

    public function required(): ?bool {
        if (empty($this->city) || empty($this->uf) || empty($this->neighborhood)) {
            $this->message = "Cidade, UF e bairro são campos obrigatórios";
            return false;
        } else {
            $this->city = filter_var($this->city, FILTER_SANITIZE_SPECIAL_CHARS);
            $this->uf = filter_var($this->uf, FILTER_SANITIZE_SPECIAL_CHARS);
            $this->neighborhood = filter_var($this->neighborhood, FILTER_SANITIZE_SPECIAL_CHARS);
            $this->complement = filter_var($this->complement, FILTER_SANITIZE_SPECIAL_CHARS);
            return true;
        }
    }

}
