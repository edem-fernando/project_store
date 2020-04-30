<?php

namespace Source\Models;

class Tutor {

    protected static $safe = ["id_tutor", "criado_em", "editado_em"];
    private static $table = "tutor";

    public function bootstrap(int $id_endereco, string $name, string $description = null): ?Tutor {
        $this->id_endereco = $id_endereco;
        $this->name = $name;
        $this->description = $description;
        return $this;
    }

    public function search_by_name(string $name, string $columns = "*") {
        
    }

    public function save() {
        
    }

    public function destroy() {
        
    }

    public function required(): ?bool {
        if (empty($this->name) || empty($this->id_endereco)) {
            $this->message = "Nome, descrição, preço e código do tutor são campos obrigatórios";
            return false;
        } else {
            $this->name = filter_var($this->name, FILTER_SANITIZE_SPECIAL_CHARS);
            $this->description = filter_var($this->description, FILTER_SANITIZE_SPECIAL_CHARS);
            $this->id_endereco = filter_var($this->id_endereco, FILTER_SANITIZE_SPECIAL_CHARS);
            return true;
        }
    }

}
