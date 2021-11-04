<?php 

require_once '../../vendor/autoload.php';
use App\Model\Categoria;

$categorias = new Categoria();
// var_dump($_GET['id']);die;

$categoria = $categorias->listar();

echo json_encode($categoria);