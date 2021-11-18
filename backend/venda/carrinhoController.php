<?php 

require_once '../../vendor/autoload.php';

use App\Model\Produtos;

$produtosModel = new Produtos();
// var_dump($_GET);die;
$produtos = $produtosModel->getProdutosCarrinho($_GET['produtos']);

echo json_encode($produtos);

