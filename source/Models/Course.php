<?php

namespace Source\Models;

use Source\Core\Model;

/**
 * Class Course Active Record Pattern
 * 
 * @author Edem Fernando Bastos <edem.fbc@gmail.com>
 * @package Source\Models
 */
class Course extends Model 
{

    /** @var array $safe no update or create */
    protected static $safe = ["idCourses", "created_at", "updated_at"];

    /** @var array $required table fields */
    protected static $required = ["name", "description", "price", "idTutor"];

    /** @var string $table database table */
    protected static $table = "courses";

    /**
     * @param string $name
     * @param string $description
     * @param float $price
     * @param int $idTutor
     * @return Company|null
     */
    public function bootstrap(
            string $name,
            string $description,
            float $price,
            int $idTutor,
            string $imagePath = null
    ): ?Course {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->idTutor = $idTutor;
        $this->imagePath = $imagePath;
        return $this;
    }

    /**
     * @param string $terms
     * @param string $params
     * @param string $columns
     * @return Course|null
     */
    public function search(string $terms, string $params, string $columns = "*"): ?Course 
    {
        $search = $this->read("SELECT {$columns} FROM " . self::$table . " WHERE {$terms}", $params);
        
        if ($this->fail() || !$search->rowCount()) {
            return null;
        }
        
        return $search->fetchObject(__CLASS__);
    }

    /**
     * @param int $idCourses
     * @param string $columns
     * @return Course|null
     */
    public function searchById(int $idCourses, string $columns = "*"): ?Course 
    {
        return $this->search("idCourses = :idCourses", "idCourses={$idCourses}", $columns);
    }

    /**
     * @param string $name
     * @param string $columns
     * @return Course|null
     */
    public function searchByName(string $name, string $columns = "*"): ?Course 
    {
        return $this->search("name = :name", "name={$name}", $columns);
    }

    /**
     * @param int $limit
     * @param int $offset
     * @param string $columns
     * @return array|null
     */
    public function all(int $limit = 30, int $offset = 0, string $columns = "*"): ?array 
    {
        $all = $this->read("SELECT {$columns} FROM " . self::$table . " LIMIT :limit OFFSET :offset", "limit={$limit}&offset={$offset}");
        
        if ($this->fail() || !$all->rowCount()) {
            return null;
        }

        return $all->fetchAll(\PDO::FETCH_CLASS, __CLASS__);
    }

    /**
     * @return Course|null
     */
    public function save(): ?Course 
    {
        if (!$this->required()) {
            $this->message()->warning("Nome, descrição, preço e o código do tutor são obrigatórios!");
            return null;
        }

        // COUSE UPDATE
        if (!empty($this->idCourses)) {
            $idCourses = $this->idCourses;
            
            if ($this->search("name = :name AND idCourses != :idCourses", "name={$this->name}&idCourses={$idCourses}")) {
                $this->message()->warning("O curso informado já está cadastrado!");
                return null;
            }

            $this->updated(self::$table, $this->safe(), "idCourses = :idCourses", "idCourses={$idCourses}");
            
            if ($this->fail()) {
                $this->message()->error("Não foi possível atualizar o curso!");
                return null;
            }
        }

        // COURSE INSERT
        if (empty($this->idCourses)) {
            if ($this->searchByName($this->name)) {
                $this->message()->warning("Curso já cadastrado!");
                return null;
            }

            $idCourses = $this->insert(self::$table, $this->safe());
            $this->data = ($this->searchById($idCourses))->data();
            return $this;
        }
    }

    /**
     * @return Ceo|null
     */
    public function destroy(): ?Course 
    {
        if (!empty($this->idCourses)) {
            $this->delete(self::$table, "idCourses = :idCourses", "idCourses={$this->idCourses}");
        }

        if ($this->fail()) {
            $this->message()->error("Não foi possível remover o curso!");
            return null;
        }

        $this->data = null;
        $this->message()->success("Curso removido com sucesso!");
        return $this;
    }

}
