<?php

interface CatRepos
{
    public function save(Cat $cat) : bool;
    public function remove(Cat $cat): bool;
    public function getById($id): Cat;
    public function all(): array;
    public function getByField($fieldValue): array;

}

class Repository implements CatRepos
{
    private $pdo;

    public function __construct(PDO $db) {
        $this->pdo = $db;
    }

    public function save(Cat $cat) : bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO cat (id, name, color, number_of_lines, sex) 
                               VALUES(:cat_id, :name, :color, :number_of_lines, :sex)");
        $stmt->bindParam(":cat_id",          $this->cat_id);
        $stmt->bindParam(":name",            $this->name);
        $stmt->bindParam(":color",           $this->color);
        $stmt->bindParam(":number_of_lines", $this->number_of_lines);
        $stmt->bindParam(":sex",             $this->sex);
        return $stmt->execute();
    }

    public function remove(Cat $cat): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM cat WHERE id = :cat_id");
        $stmt->bindParam(":cat_id",          $this->cat_id);
        return $stmt->execute();
    }

    public function getById($id): Cat
    {
        $stmt = $this->pdo->prepare("SELECT * FROM cat WHERE id = :cat_id ", PDO::FETCH_ASSOC);
        $stmt->bindParam(":cat_id", $this->cat_id);
        $stmt->execute();
        return new Cat($stmt[name],$stmt[color], $stmt[number_of_lines], $stmt[sex]);
    }

    public function all(): array
    {
        $catList = array();
        return $catList;
    }

    public function getByField($fieldValue): array
    {
        $stmt = $this->pdo->prepare("SELECT :field FROM cat", PDO::FETCH_ASSOC);
        $stmt->bindParam(":field", $fieldValue);
        $stmt->execute();
        $catList = array();
        foreach($stmt as $anotherCat)
        {
            array_push($catList, $anotherCat);
        }
        return $catList;
    }
}