<?php


namespace  Source\Database;


use \PDO;
use \PDOException;

class Conn
{
    private const HOST = 'localhost';
    private const DBNAME = 'project_store';
    private const USER = 'root';
    private const PASSWD = '';
    private const OPTIONS = 
    [
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE           => PDO::CASE_NATURAL,
        PDO::ATTR_ERRMODE        => PDO::ERRMODE_EXCEPTION,
    ];

    private static $instance;

    /** @return PDO */
    public static function getInstance(): PDO
    {
        if (empty(self::$instance)) {
            try {
                self::$instance = new PDO
                (
                    'mysql:host=' . self::HOST . ';dbname='. self::DBNAME,
                    self::USER , self::PASSWD , self::OPTIONS
                );
            } catch (PDOException $exception) {
                die("Erro ao se conectar ao banco, tente mais tarde");
            }
        }

        return self::$instance;
    }

    final private function __construct() {}
    final private function __clone() {}
}
