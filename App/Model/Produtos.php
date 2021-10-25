<?php

namespace App\Model;

include 'Conexao.php';

class Produtos
{
    public function getProdutos($id)
    {
        $sql = "SELECT * FROM produtos WHERE id={$id}";

        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->execute();

        $resultado = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function listar()
    {
        $sql = 'SELECT * FROM produtos';

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
                update produtos
                set 
                    nome='{$dados['nome']}',
                    quantidade='{$dados['quantidade']}',
                    preco='{$dados['preco']}'
                where id={$dados['id']}
            ";
        }
        // criar
        else {
            $sql = "
                insert into produtos (nome, quantidade)
                values ('{$dados['nome']}', '{$dados['preco']}', '{$dados['quantidade']}')
            ";
        }

        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->execute();
    }

    public function apagar($id)
    {
        $sql = "delete from produtos where id={$id}";

        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->execute();
    }
}
