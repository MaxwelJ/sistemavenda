<?php

namespace App\Model;

include 'Conexao.php';

class Categoria
{
    public function listar()
    {
        $sql = 
            'SELECT
                *
            FROM categoria
            order by id ASC
        ';

        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $resultado;
        } else {
            return [];
        }
    }

}