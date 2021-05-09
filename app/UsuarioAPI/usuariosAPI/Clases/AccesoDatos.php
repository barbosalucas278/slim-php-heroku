<?php
//Variables para uso local
// define("MYSQL_HOST", "remotemysql.com");
// define("MYSQL_USER", "0bnIdYwns5");
// define("MYSQL_PASS", "KwadraP0eq");
// define("MYSQL_DB", "0bnIdYwns5");
class AccesoDatos
{
    private static $_ObjetoAccesoDatos;
    private $_PDO;

    private function __construct()
    {
        try {
            $this->_PDO = new PDO(
                'mysql:host=' . getenv('MYSQL_HOST') . ';dbname=clase4;charset=utf8',
                'root',
                '',
                array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
            );
            // $this->_PDO = new PDO(
            //     'mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB . ';charset=utf8',
            //     MYSQL_USER,
            //     MYSQL_PASS,
            //     array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
            // );
        } catch (PDOException $ex) {
            print "Error!:" . $ex->getMessage();
            die();
        }
    }

    public function RetornarConsulta($sql)
    {
        return $this->_PDO->prepare($sql);
    }

    public static function GetAccesoDatos()
    {
        if (!isset(self::$_ObjetoAccesoDatos)) {
            self::$_ObjetoAccesoDatos = new AccesoDatos();
        }
        return self::$_ObjetoAccesoDatos;
    }

    public function __clone()
    {
        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);
    }
}
