<?php 

require_once '../../vendor/autoload.php';
use App\Model\Vendedor;

$vendedor = new Vendedor();
// var_dump($_POST);die;
$vendedor->salvar($_POST);

echo json_encode([
    'status'=> true
]);