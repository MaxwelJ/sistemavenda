<?php 

require_once '../../vendor/autoload.php';
use App\Model\Produtos;


$produtos = new Produtos();
$produto = $produtos->getProdutos($_GET['id']);

echo json_encode($produto);