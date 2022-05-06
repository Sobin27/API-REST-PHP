<?php

namespace App\Models;

use Exception;
use PDO;
use PDOException;

class User
{
    public static function getUser($id)
    {
        try {
            $db = new PDO('mysql:host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);
            
        } catch (PDOException $e) {
            echo 'Erro ao se conectar' . $e->getMessage();
        }

         $sql = 'SELECT * FROM user WHERE id = :id';
        //$stmt = $db->query('SELECT * FROM user WHERE id = :id');
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            throw new Exception("Nenhum usuário encontrado");
        }
    }

    public static function getUsersALL()
    {
        try {
            $db = new PDO('mysql:host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);
        } catch (PDOException $e) {
            echo 'Erro ao se conectar' . $e->getMessage();
        }

        $sql = 'SELECT * FROM user';
        $stmt = $db->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            throw new Exception("Nenhum usuário encontrado");
        }
    }

    public static function Insert($infos)
    {
        try {
            $db = new PDO('mysql:host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);
        } catch (PDOException $e) {
            echo 'Erro ao se conectar' . $e->getMessage();
        }

        $sql = 'INSERT INTO user (nome,email,telefone) VALUES (:nom,:em,:tel)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':nom', $infos['nome']);
        $stmt->bindValue(':em', $infos['email']);
        $stmt->bindValue(':tel', $infos['telefone']);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return 'Usuário inserido com sucesso';
        } else {
            throw new Exception("Falha ao inserir o usuário");
        }
    }
}
