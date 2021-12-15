<?php

/* 
 * Created by Eliézer Santos Nunes
*/
require_once dirname(__FILE__) . '/Config.php';
require_once dirname(__FILE__) . '/Response.php';

class DB {

    private static $instance;

    public static function getInstance() {
        if (!isset(self::$instance)){
            try {
                self::$instance = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            } catch (PDOException $ex) {
                $response = new Response(1, "Sem conexao com o banco de dados.");
                $response->show(Response::$ERROR);
            }
        }
        return self::$instance;
    }

    public static function prepare($sql) {
        return self::getInstance()->prepare($sql);
    }

}
