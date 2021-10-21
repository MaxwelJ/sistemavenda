<?php 

require_once '../../vendor/autoload.php';
use App\Model\Produtos;

$vendedor = new Produtos();
// var_dump($_GET['id']);die;
$resultado = $vendedor->getProdutos($_GET['id']);

echo json_encode($resultado);