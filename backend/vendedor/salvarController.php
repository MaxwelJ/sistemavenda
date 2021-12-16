<?php 

require_once '../../vendor/autoload.php';
use App\Model\Vendedor;

$vendedor = new Vendedor();
// var_dump($_POST);die;
$padrao = '/[^0-9]/i';
$_POST['cpf'] = (int)preg_replace($padrao, '', $_POST['cpf']);

// var_dump($_POST['cpf']);die;
$vendedor->salvar($_POST);

echo json_encode([
    'status'=> true
]);