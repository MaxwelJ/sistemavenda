<?php

namespace App\Model;

include_once 'Conexao.php';

class ItensVenda
{

    public function getItens($id) {

        $sql = 
        "SELECT 
            iv.id as codItem,
            p.id as codProduto,
            p.nome as nomeProduto,
            p.preco as precoProduto,
            c.nome as nomeCategoria,
            iv.quantidade as quantidade
        FROM itens_venda iv
        INNER JOIN produtos p ON iv.id_produto = p.id
        INNER JOIN categoria c ON p.id_categoria = c.id
        WHERE iv.id_venda=?
        ";

        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();

        $resultado = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function salvar($idVenda, $idProduto)
    {

        $sql = "INSERT INTO itens_venda (id_venda, id_produto, quantidade) VALUES (?, ?, 1)";
        
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindParam(1, $idVenda);
        $stmt->bindParam(2, $idProduto);
        $stmt->execute();
       
    }

    // public function salvar($idVenda, $produtos)
    // {

    //     $sql = "INSERT INTO itens_venda (id_venda, id_produto, quantidade) VALUES (?, ?, ?)";

    //     foreach ($produtos as $produto) {
    //         $stmt = Conexao::getConn()->prepare($sql);
    //         $stmt->bindParam(1, $idVenda);
    //         $stmt->bindParam(2, $produto['id_produto']);
    //         $stmt->bindParam(3, $produto['quantidade']);
    //         $stmt->execute();
    //     }
       
    // }

    public function listar()
    {
        $sql =
            'SELECT
                iv.*, 
                v.id as venda_id,
                p.id as produto_id
            FROM itens_venda iv
            INNER JOIN vendas v 
                ON iv.id_vendas = v.id 
            INNER JOIN produtos p 
                on iv.id_produto = p.id
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

    public function apagar($id) {
        $sql = "DELETE FROM itens_venda WHERE id_venda=?";

        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();
    }

}