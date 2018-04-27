<?php

/**
 *  Conn.class [ CONEXAO ]
 * conexão
 * @copyright (c) 2017, Boot
 */
abstract class Conn {

    private static $Host = HOST;
    private static $User = USER;
    private static $Pass = PASS;
    private static $Db = DB;

    /** @var PDO */
    private static $Connect = null;

    /**
     * Conecta com o bando de dados
     */
    private static function Conectar() {
        try {
            if (self::$Connect == null):
                $dsn = 'mysql::host=' . self::$Host . ';dbname=' . self::$Db;
                $options = [ PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'];
                self::$Connect = new PDO($dsn, self::$User, self::$Pass, $options);
            endif;
        } catch (PDOException $e) {
            PHPErro($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            die;
        }
        
        self::$Connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$Connect;
    }

    /** Retorna um objeto PDO */
    public static function getConn() {
        return self::Conectar();
    }

}
