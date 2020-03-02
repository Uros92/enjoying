<?php

class Connection {
    public static function connect($databases) {
        try {
            return new PDO('mysql:host=' . $databases["host"] . ';dbname=' . $databases["dbname"] . ';', $databases["user"], $databases["password"]);
        } catch (PDOException $e) {
            http_response_code(500);
            die('Something went wrong, please try later');
        }
    }
}