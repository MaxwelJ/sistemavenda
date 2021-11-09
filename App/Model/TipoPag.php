<?php

namespace App\Model;

include_once 'Conexao.php';

class TipoPag
{
    public function listar()
    {
        $sql = 
            'SELECT
                *
            FROM tipo_pag
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