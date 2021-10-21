<?php 

require_once '../../vendor/autoload.php';
use App\Model\Vendedor;

$vendedor = new Vendedor();
$resultado = $vendedor->apagar($_GET['id']);

echo json_encode([
    'status'=> true
]);