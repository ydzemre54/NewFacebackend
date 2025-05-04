<?php

// la classe Database implémente le pattern singleton
// pour s'assurer qu'il n'y ai qu'une seule connection à la BDD
class Database extends PDO {
    
    private static $instance = null;
    private final function __construct() {
        try {
            $dsn = "mysql:dbname=" . $_ENV["BASE"] . ";host=" . $_ENV["SERVER"];
            $options = [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            ];
            parent::__construct($dsn, $_ENV["USER"], $_ENV["PASSWD"], $options);
        } catch (PDOException $exc) {
            exit($exc->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
    public function getConnection() {
        return $this;
    }
}