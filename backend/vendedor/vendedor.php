<?php 

require_once '../../vendor/autoload.php';
use App\Model\Vendedor;

$vendedor = new Vendedor();
// var_dump($_GET['id']);die;
$resultado = $vendedor->getVendedor($_GET['id']);

echo json_encode($resultado);