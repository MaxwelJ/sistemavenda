<?php 

require_once '../../vendor/autoload.php';
use App\Model\Produtos;

$produtos = new Produtos();
// var_dump($_POST);die;
$produtos->salvar($_POST);

echo json_encode([
    'status'=> true
]);