<?php 

require_once '../../vendor/autoload.php';
use App\Model\Produtos;

$produtos = new Produtos();
$resultado = $produtos->apagar($_GET['id']);

echo json_encode([
    'status'=> true
]);