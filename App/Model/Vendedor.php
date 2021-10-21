<?php

namespace App\Model;

include 'Conexao.php';

class Vendedor
{
    public function getVendedor($id)
    {
        $sql = "SELECT * FROM vendedor WHERE id={$id}";

        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->execute();

        $resultado = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function listar()
    {
        $sql = 'SELECT * FROM vendedor';

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
            $sql = "
                update vendedor
                set 
                    nome='{$dados['nome']}',
                    cpf='{$dados['cpf']}',
                    data_nasc='{$dados['data_nasc']}'
                where id={$dados['id']}
            ";
        }
        // criar
        else {
            $sql = "
                insert into vendedor (nome, cpf, data_nasc)
                values ('{$dados['nome']}', '{$dados['cpf']}', '{$dados['data_nasc']}')
            ";
        }

        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->execute();
    }

    public function apagar($id) {
        $sql = "delete from vendedor where id={$id}";

        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->execute();
    }
}
