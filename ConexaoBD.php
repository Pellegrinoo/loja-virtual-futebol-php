<?php
class ConexaoBD {

    public static function getConexao() {

    $conn = new mysqli("localhost", "root", "", "loja_futebol");

    return $conn;
    }
}
?>