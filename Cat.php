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
        $this->cat_id = intval($_number_of_lines / sin($_color . ob_get_length()));
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

Class CatDataMapper{
    protected $pdo;

    public function __construct($dsn, $host, $pass) {
        $this->pdo = connect($dsn, $host, $pass);
    }

    public function save(Cat $cat) : bool
    {
        $sameCat="";
        $res = false;
        foreach($this->pdo->query("SELECT * FROM cat WHERE id = :cat_id", PDO::FETCH_ASSOC) as $someCat)
        {
            $sameCat = $someCat;
        }
        $cat_id = $cat->getCatId();
        $cat_name = $cat->getName();
        $cat_color = $cat->getColor();
        $cat_number_of_lines = $cat->getNumberOfLines();
        $cat_sex = $cat->getSex();
        if ($sameCat==""){
            $stmt = $this->pdo->prepare("INSERT INTO cat (name, color, number_of_lines, sex) 
                               VALUES(:name, :color, :number_of_lines, :sex)");
            $stmt->bindParam(":cat_id", $cat_id);
            $stmt->bindParam(":name",            $cat_name);
            $stmt->bindParam(":color",           $cat_color);
            $stmt->bindParam(":number_of_lines", $cat_number_of_lines);
            $stmt->bindParam(":sex",             $cat_sex);
            $res = $stmt->execute();
        } else {
            echo "Cat with same id: ".$cat_id." already exists.";
        }
        return $res;
    }

    public function remove(Cat $cat): bool
    {
        $cat_id = $cat->getCatId();
        $stmt = $this->pdo->prepare("DELETE FROM cat WHERE id = :cat_id");
        $stmt->bindParam(":cat_id",          $cat_id);
        return $stmt->execute();
    }

    public function getById($id): Cat
    {
        $stmt = $this->pdo->prepare("SELECT * FROM cat WHERE id = :cat_id ", PDO::FETCH_ASSOC);
        $stmt->bindParam(":cat_id", $id);
        $stmt->execute();
        $cat_name =            $stmt[name];
        $cat_color =           $stmt[color];
        $cat_number_of_lines = $stmt[number_of_lines];
        $cat_sex =             $stmt[sex];
        return new Cat($cat_name, $cat_color, $cat_number_of_lines, $cat_sex);
    }

    public function all(): array
    {
        $catList = array();
        foreach($this->pdo->query("SELECT * FROM cat", PDO::FETCH_ASSOC) as $someCat)
        {
            array_push($catList, $someCat);
        }
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