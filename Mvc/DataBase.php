<?php

namespace Classe;

class DataBase 
{
    public $pdo;

    private static $_instance = null;

    public function __construct()
    {
        $this->pdo = new \PDO('mysql:host=localhost;dbname=framework','root','');
    }

    public static function getInstance()
    {
        if(is_null(self::$_instance))
        {
            self::$_instance = new static();
        }
        return self::$_instance;
    }
}