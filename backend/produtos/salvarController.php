<?php

require_once '../../vendor/autoload.php';

use App\Model\Produtos;

$produtos = new Produtos();

// var_dump($_FILES);die;

$caminho = '';
$msg = '';

// var_dump($_FILES['imagem']);die;

if ($_FILES['imagem']['error']) {
    echo json_encode([
        'cod' => 1,
        'msg' => 'Erro ao enviar imagem.'
    ]);
    die;

    // } else if (!in_array($_FILES['imagem']['type'], ['.png', '.jpeg', '.jpg'])) {
    //     echo json_encode([
    //         'cod' => 1,
    //         'msg' => 'Formato não aceito.'
    //     ]);
    //     die;

} else if ($_FILES['imagem']['size'] > (1024 * 1024 * 2)) {
    echo json_encode([
        'cod' => 1,
        'msg' => 'Tamanho do arquivo não aceito.'
    ]);
    die;
} else {
    $nomeFinal = $_FILES['imagem']['name'];
    $caminho = 'img/cards/' . $nomeFinal;

    if (move_uploaded_file($_FILES['imagem']['tmp_name'], '../../' . $caminho)) {
        $msg = "Arquivo salvo com sucesso!";
        $_POST['imagem'] = $caminho;
    }
}

$produtos->salvar($_POST);

echo json_encode([
    'cod' => 0,
    'status' => true
]);
