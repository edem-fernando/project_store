<?php

namespace Source\Models;

use Source\Core\Model;

/**
 * Class Course
 * @package Source\Models
 */
class Course extends Model 
{

    /**
     * $safe: dados que não podem ser manipulados 
     * @var static $safe
     */
    protected static $safe = ["id_cursos", "criado_em", "editado_em"];

    /**
     * $required: dados obrigatórios para a tabela no banco 
     * @var static $required
     */
    protected static $required = ["nome", "descricao", "preco", "id_tutor"];

    /**
     * $table: nome da tabela no banco
     * @var static $table
     */
    private static $table = "cursos";

    /**
     * BOOTSTRAP():monta o objeto para persistir
     * @param string $name
     * @param string $description
     * @param float $price
     * @param int $id_tutor
     * @return Company | null
     */
    public function bootstrap(string $name, string $description, float $price, int $id_tutor): ?Course 
    {
        $this->nome = $name;
        $this->descricao = $description;
        $this->preco = $price;
        $this->id_tutor = $id_tutor;
        return $this;
    }

    /**
     * SEARCH(): busca genêrica na base de dados
     * @param string $terms
     * @param string $params
     * @param string $columns
     * @return Course | null
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
     * SEARCH_BY_ID(): faz uma busca através do id
     * @param int $id_cursos
     * @param string $columns
     * @return Course | null
     */
    public function search_by_id(int $id_cursos, string $columns = "*"): ?Course 
    {
        return $this->search("id_cursos = :id_cursos", "id_cursos={$id_cursos}", $columns);
    }

    /**
     * SEARCH_BY_NAME(): faz uma busca através do nome
     * @param string $name
     * @param string $columns
     * @return Course | null
     */
    public function search_by_name(string $name, string $columns = "*"): ?Course 
    {
        return $this->search("nome = :name", "name={$name}", $columns);
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
        $all = $this->read("SELECT {$columns} FROM " . self::$safe . " LIMIT :l OFFSET :o", "l={$limit}&o={$offset}");
        if ($this->fail() || !$all->rowCount()) {
            $this->message()->error("Não foi possível realizar a busca, tente mais tarde!");
            return null;
        }

        return $all->fetchAll(\PDO::FETCH_CLASS, __CLASS__);
    }

    /**
     * SAVE(): Persiste dados no banco
     * @return Course | null
     */
    public function save(): ?Course 
    {
        if (!$this->required()) {
            $this->message()->warning("Nome, descrição, preço e o código do tutor são obrigatórios!");
            return null;
        }

        // COUSE UPDATE
        if (!empty($this->id_cursos)) {
            $course_id = $this->id_cursos;
            if ($this->search("nome = :nome AND id_cursos != id_cursos", "nome={$this->nome}&id_cursos={$course_id}")) {
                $this->message()->warning("O curso informado já está cadastrado!");
                return null;
            }

            $this->updated(self::$table, $this->safe(), "id_cursos = :id", "id={$course_id}");
            if ($this->fail()) {
                $this->message()->error("Não foi possível atualizar o curso!");
                return null;
            }
        }

        // COURSE INSERT
        if (empty($this->id_cursos)) {
            if ($this->search_by_name($this->nome)) {
                $this->message()->warning("Curso já cadastrado!");
                return null;
            }

            $course_id = $this->insert(self::$table, $this->safe());
            $this->data = ($this->search_by_id($course_id))->data();
            return $this;
        }
    }

    /**
     * DESTROY(): Verifica se o id existe no banco de dados, e depois,
     * o apaga do banco de dados
     * @return Ceo | null
     */
    public function destroy(): ?Course 
    {
        if (!empty($this->id_cursos)) {
            $this->delete(self::$table, "id_cursos = :id", "id={$this->id_cursos}");
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
