<?php 

require_once '../../vendor/autoload.php';

use App\Model\ItensVenda;
use App\Model\Vendas;

$vendasModel = new Vendas();
$itensVendaModel = new ItensVenda();
// var_dump($_GET['id']);die;

$venda = $vendasModel->getVendas($_GET['id']);
$itens_venda = $itensVendaModel->getItens($_GET['id']);

$venda['itens_venda'] = $itens_venda;
// var_dump(json_encode($venda));die;

echo json_encode($venda);