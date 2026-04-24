<?php
    try {
        $pdo = new PDO("mysql:host=192.168.68.59;dbname=sys;port=3306", "Noe", "root", [
        //$pdo = new PDO("mysql:host=10.10.31.122;dbname=sys;port=3306", "Noe", "root", [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ]);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }