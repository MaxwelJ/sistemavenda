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

    $produtos = $_POST['produtos'];
    unset($_POST['produtos']);
    
    $quantidade = $_POST['quantidade'];
    unset($_POST['quantidade']);

    $id_venda = $vendaModel->salvar($_POST);
    // var_dump($id_venda);die;
    $itens_venda = $itensVendaModel->salvar($id_venda, $produtos, $quantidade);

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