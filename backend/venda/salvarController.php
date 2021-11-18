<?php 

require_once '../../vendor/autoload.php';
use App\Model\Vendas;
use App\Model\Conexao;
use App\Model\ItensVenda;

$vendaModel = new Vendas();
$itensVendaModel = new ItensVenda();

Conexao::getConn()->beginTransaction();

try {

    // var_dump($_POST);die;
    
    $_POST['data_venda'] = date("Y-m-d");
    $id_produto = $_POST['id_produto'];

    // $produtos = [
        // "id_produto" => $_POST['id_produto'],
        // "nome_produto" => $_POST['nomeProduto'],
        // "preco_produto" => $_POST['precoProduto'],
        // "quantidade" => $_POST['quantidade']
    // ];

    // var_dump($produto);die;
    
    $id_venda = $vendaModel->salvar($_POST);
    $itens_venda = $itensVendaModel->salvar($id_venda, $id_produto);

    $json = [
        "cod" => 0,
        "msg" => "Sua compra foi realizada."
    ];

    Conexao::getConn()->commit();

} catch (\Exception $e) {
    
    $json = [
        "cod" => 1,
        "msg" => "Erro: " . $e->getMessage() . "\nLinha: " . $e->getLine()
    ];

    Conexao::getConn()->rollback();

}

echo json_encode($json);