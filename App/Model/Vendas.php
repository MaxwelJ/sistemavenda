<?php

namespace App\Model;

include_once 'Conexao.php';

class Vendas
{
    public function getVendas($id)
    {
        $sql = 
        "SELECT
            v.*,
            vend.nome as nome_vendedor,
            tp.nome as tipo_pag_nome
        FROM vendas v
        INNER JOIN vendedor vend 
            ON v.id_vendedor = vend.id
        INNER JOIN tipo_pag tp
            ON v.id_tipo_pag = tp.id 
        WHERE v.id=?
        order by id asc";

        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();

        $resultado = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function salvar($dados)
    {

        $sql = "INSERT INTO vendas (id_vendedor, id_tipo_pag, data_venda) VALUES (?, ?, ?)";

        // var_dump($dados);die;
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindParam(1, $dados['id_vendedor']);
        $stmt->bindParam(2, $dados['id_tipo_pag']);
        $stmt->bindParam(3, $dados['data_venda']);
        $stmt->execute();
        
        // Retornando o ultimo id da venda
        return Conexao::getConn()->lastInsertId(); 
       
    }

    public function listar()
    {
        $sql = 
            'SELECT
                v.*,
                vend.nome as nome_vendedor,
                tp.nome as tipo_pag_nome
            FROM vendas v
            INNER JOIN vendedor vend 
                ON v.id_vendedor = vend.id
            INNER JOIN tipo_pag tp
                ON v.id_tipo_pag = tp.id 
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
        $sql = "DELETE FROM vendas WHERE id=?";

        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();
    }

}