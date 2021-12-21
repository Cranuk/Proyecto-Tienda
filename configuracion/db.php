<?php
class BaseDatos{
    public static function conectar(){
        $db = new mysqli("localhost", "root", "", "tienda_master");
        $db->query("SET NAMES 'utf-8'");
        return $db;
    }
}