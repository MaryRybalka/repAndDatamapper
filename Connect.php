<?php

function connect($dsn, $host, $pass): PDO{
    try {
        $dbh = new PDO($dsn, $host, $pass);
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
    return $dbh;
}