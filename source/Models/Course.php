<?php


namespace Source\Models;


class Course extends Model
{
    protected static $safe = ["id_cursos", "criado_em", "editado_em"];
    private static $table = "cursos";

    public function bootstrap(string $name, string $description, float $price, int $id_tutor): ?Course {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->id_tutor = $id_tutor;
        return $this;
    }

    public function search_by_name(string $name, string $columns = "*") {
        
    }

    public function save() {
        
    }

    public function destroy() {
        
    }

    public function required(): ?bool {
        if (empty($this->name) || empty($this->description) || empty($this->price) || empty($this->id_tutor)) {
            $this->message = "Nome, descrição, preço e código do tutor são campos obrigatórios";
            return false;
        } else {
            $this->name = filter_var($this->name, FILTER_SANITIZE_SPECIAL_CHARS);
            $this->description = filter_var($this->description, FILTER_SANITIZE_SPECIAL_CHARS);
            $this->price = filter_var($this->price, FILTER_SANITIZE_SPECIAL_CHARS);
            $this->id_tutor = filter_var($this->id_tutor, FILTER_SANITIZE_SPECIAL_CHARS);
            return true;
        }
    }

}
