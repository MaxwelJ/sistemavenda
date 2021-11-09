<?php 

require_once '../../vendor/autoload.php';
use App\Model\TipoPag;

$tipo_pags = new TipoPag();
// var_dump($_GET['id']);die;

$tipo_pag = $tipo_pags->listar();

echo json_encode($tipo_pag);