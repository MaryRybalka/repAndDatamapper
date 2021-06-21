<?php

class Cat
{
    private $cat_id;
    private $name;
    private $color;
    private $number_of_lines;
    private $sex;

    public function __construct($_name, $_color, $_number_of_lines, $_sex = "kot")
    {
        $this->cat_id = $_number_of_lines / sin($_color . ob_get_length());
        $this->name = $_name;
        $this->color = $_color;
        $this->number_of_lines = $_number_of_lines;
        $this->sex = $_sex;
    }

    public function getCatId()
    {
        return $this->cat_id;
    }

    public function getSex()
    {
        return $this->sex;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function getNumberOfLines()
    {
        return $this->number_of_lines;
    }
}

Class Datamapper{
    protected $pdo;

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