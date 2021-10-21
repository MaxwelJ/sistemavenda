<?php

namespace App\Model;


class Conexao {
    
// function connect(string $host, string $db, string $user, string $password): \PDO
// {
//     try {
//         $dsn = "pgsql:host=$host;port=5432;dbname=$db;";

//         // make a database connection
//         return new \PDO(
//             $dsn,
//             $user,
//             $password,
//             [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]
//         );
//     } catch (\PDOException $e) {
//         die($e->getMessage());
//     }
// }

// return connect($host, $db, $user, $password);

private static $instance;

    public static function getConn() {
        $host = "localhost";
        $user = "postgres";
        $password = "123";
        $db = "sistemavenda";
        $dsn = "pgsql:host=$host;port=5432;dbname=$db;";

        if(!isset(self::$instance)){
            self::$instance = new \PDO(
            $dsn,
            $user,
            $password,
            [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
        }

        return self::$instance;
    }
}