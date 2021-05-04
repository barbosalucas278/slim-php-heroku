<?php
class AccesoDatos
{
    private static $_ObjetoAccesoDatos;
    private $_PDO;

    private function __construct()
    {
        try {
            $this->_PDO = new PDO(
                'mysql:host=' . getenv('MYSQL_HOST') . ';dbname=' . getenv('MYSQL_DB') . ';charset=utf8',
                getenv('MYSQL_USER'),
                getenv('MYSQL_PASS'),
                array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
            );
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
