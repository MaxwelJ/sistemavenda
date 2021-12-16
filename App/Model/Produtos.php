<?php

namespace App\Model;

include_once 'Conexao.php';

class Produtos
{
    public function getProdutos($id)
    {
        $sql =
            "SELECT
                p.*, 
                c.nome as nome_cat
            FROM produtos p
            INNER JOIN categoria c ON p.id_categoria = c.id 
            WHERE p.id={$id}
            order by id ASC
        ";

        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $resultado = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $resultado;
        } else {
            return [];
        }
    }

    public function getProdutosByCategoria($id_categoria)
    {
        $sql =
            "SELECT
                p.*, 
                c.nome as nome_cat
            FROM produtos p
            INNER JOIN categoria c ON p.id_categoria = c.id 
            WHERE p.id_categoria={$id_categoria}
            order by id ASC
        ";

        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $resultado;
        } else {
            return [];
        }
    }

    public function listar()
    {
        $sql =
            'SELECT
                p.*, 
                c.nome as nome_cat
            FROM produtos p
            INNER JOIN categoria c ON p.id_categoria = c.id 
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

    public function salvar($dados)
    {
        $sql = '';

        // var_dump($dados);die;

        // editar
        if (isset($dados['id']) && !empty($dados['id'])) {
            $sql .= 
            "UPDATE produtos
                SET 
                    nome='{$dados['nome']}',
                    quantidade='{$dados['quantidade']}',
                    preco='{$dados['preco']}',
                    id_categoria='{$dados['id_categoria']}',
                    descricao='{$dados['descricao']}'
            ";

            // echo json_encode($dados['imagem']);

            if (!empty($dados['imagem'])){
                $sql .= ", imagem='{$dados['imagem']}'";
            }

            $sql .= "WHERE id={$dados['id']}";

        }

        // criar
        else {
            $sql = 
            "INSERT INTO produtos 
                (nome, preco, quantidade, id_categoria, imagem, descricao)
                VALUES
                (
                    '{$dados['nome']}', 
                    {$dados['preco']}, 
                    {$dados['quantidade']}, 
                    {$dados['id_categoria']}, 
                    '{$dados['imagem']}', 
                    '{$dados['descricao']}'
                )
            ";
        }

        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->execute();
    }

    public function apagar($id)
    {
        $sql = "DELETE FROM produtos WHERE id=?";

        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();
    }

    public function getProdutosCarrinho($ids) 
    {
        $sql =
            "SELECT
                p.*, 
                c.nome as nome_cat
            FROM produtos p
            INNER JOIN categoria c ON p.id_categoria = c.id 
            WHERE p.id IN ({$ids})
            order by id ASC
        ";

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
