<?php 

require_once '../../vendor/autoload.php';

use App\Model\ItensVenda;
use App\Model\Vendas;

$vendasModel = new Vendas();
$itensVendaModel = new ItensVenda;
// var_dump($_GET);die;

$itensVenda = $itensVendaModel->apagar($_GET['id']);
$vendas = $vendasModel->apagar($_GET['id']);  

echo json_encode([
    'status'=> true
]);