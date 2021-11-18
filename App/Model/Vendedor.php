<?php

namespace App\Model;

include_once 'Conexao.php';

class Vendedor
{
    public function getVendedor($id)
    {
        $sql = "SELECT * FROM vendedor WHERE id=?";

        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();

        $resultado = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function listar()
    {
        $sql = 'SELECT * FROM vendedor order by id ASC';

        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $resultado;
        } else {
            return [];
        }
    }

    public function salvar($dados)
    {
        // var_dump($dados);
        // editar
        if (isset($dados['id']) && !empty($dados['id'])) {
            $sql = 
            "UPDATE vendedor
                SET 
                    nome='{$dados['nome']}',
                    cpf='{$dados['cpf']}',
                    data_nasc='{$dados['data_nasc']}'
                WHERE id={$dados['id']}
            ";
        }
        // criar
        else {
            $sql = 
            "INSERT INTO vendedor (nome, cpf, data_nasc)
                VALUES ('{$dados['nome']}', '{$dados['cpf']}', '{$dados['data_nasc']}')
            ";
        }

        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->execute();
    }

    public function apagar($id) {
        $sql = "DELETE FROM vendedor WHERE id=?";

        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();
    }
}
