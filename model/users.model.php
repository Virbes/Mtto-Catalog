<?php

require_once 'conexion.php';

class ModelUsers {
    /*==============================
           MOSTRAR USUARIOS
    ================================ */

    static public function getUser($table, $item, $value) {
        
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $table WHERE $item = :$item");
        $stmt -> bindParam(':'.$item, $value, PDO::PARAM_STR);
        $stmt -> execute();

        return $stmt -> fetch();
    }

    public static function getUsers() {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM Users");
        $stmt -> execute();

        return $stmt -> fetchAll();
    }

    /*==============================
            GUARDAR USUARIOS
    ================================ */

    public static function addUser($data) {
        $sql = "INSERT INTO Users(Name, Username, Password, Profile, Photo) VALUES(:Name, :Username, :Password, :Profile, :Photo)";

        $stmt = Conexion::conectar()->prepare($sql);
        $stmt -> bindParam(':Name', $data['Name'], PDO::PARAM_STR);
        $stmt -> bindParam(':Username', $data['Username'], PDO::PARAM_STR);
        $stmt -> bindParam(':Password', $data['Password'], PDO::PARAM_STR);
        $stmt -> bindParam(':Profile', $data['Profile'], PDO::PARAM_STR);
        $stmt -> bindParam(':Photo', $data['Photo'], PDO::PARAM_STR);

        if ($stmt -> execute()) {
            return 'ok';
        } else {
            return 'error';
        }

        $stmt = null;
    }
}