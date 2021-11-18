<!DOCTYPE html>
<?php
require_once '../../vendor/autoload.php';
$vendasModel = new \App\Model\Vendas();
$vendas = $vendasModel->listar();
?>

<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.11.2/jquery.mask.min.js" integrity="sha512-Y/GIYsd+LaQm6bGysIClyez2HGCIN1yrs94wUrHoRAD5RSURkqqVQEU6mM51O90hqS80ABFTGtiDpSXd2O05nw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
    <script src="https://kit.fontawesome.com/d560921102.js" crossorigin="anonymous"></script>
    <script src="../../js/index.js"></script>
    <script src="../../js/venda.js"></script>
    <link href="../../css/index.css" rel="stylesheet">
    <title>Loja Variedas</title>
</head>

<body>

    <nav class="navbar navbar-light menu">
        <a class="navbar-brand" style="margin-left: 10px;"><strong>Loja variedades</strong></a>
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <a class="nav-link active itens-nav" href="../../index.php">Página Inicial</a>
            </li>
            <li class="nav-item">
                <a class="nav-link itens-nav" href="../vendedor/vendedor.php" style="color: black;">Vendedores</a>
            </li>
            <li class="nav-item">
                <a class="nav-link itens-nav" href="../produtos/produtos.php">Produtos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link itens-nav" href="vendas.php">Vendas</a>
            </li>
        </ul>
    </nav>

    <div class="container conteudo">
        <div class="table-reponsive w-100">
            <table class="table table-bordered" style="margin-top: 10px;">
                <thead style="background-color: #e3f2fd;">
                    <tr>
                        <th colspan=5>
                            <span class="text-center" style="font-size: 1.5rem;">Lista de vendas</span>
                            <button type="button" class="btn btn-outline-dark" style="float: right;" onClick="abrirModalCreate()"><i class="fa fa-plus"></i> Adicionar</button>
                        </th>
                    </tr>
                    <tr>
                        <th class="text-center" width="5%" style="background-color: #e3f2fd;">Código</th>
                        <th style="background-color: #e3f2fd;">Vendedor</th>
                        <th class="text-center" width="15%" style="background-color: #e3f2fd;">Tipo de pagamento</th>
                        <th class="text-center" width="10%" style="background-color: #e3f2fd;">Data da venda</th>
                        <th class="text-center" width="10%" style="background-color: #e3f2fd;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($vendas as $venda) : ?>
                        <tr>
                            <td class="text-center vendaId"><?= $venda['id'] ?></td>
                            <td><?= $venda['nome_vendedor'] ?></td>
                            <td><?= $venda['tipo_pag_nome'] ?></td>
                            <td class="text-center data"><?= $venda['data_venda'] ?></td>
                            <td>
                                <div class="justify-content-center d-flex">
                                    <!-- <button type="button" class="btn btn-outline-warning mx-1" onClick="abrirModalEdit(<?= $venda['id'] ?>)"><i class="fa fa-edit"></i></button> -->
                                    <button type="button" class="btn btn-outline-primary mx-1" onClick="abrirModalView(<?= $venda['id'] ?>)"><i class="fa fa-eye"></i></button>
                                    <button type="button" class="btn btn-outline-danger mx-1" onClick="apagar(<?= $venda['id'] ?>)"><i class="fa fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div id="modal_vendas_view" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detalhes da venda</h5>
                    <button type="button" class="close btn btn-outline-danger" onClick="$('#modal_vendas_view').modal('hide')" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-close"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="row">
                            <input type="hidden" id="id-view">
                            <div class="col-md-12">
                                <label for="nome-view">Nome do vendedor: </label>
                                <input type="text" id="nome-view" class="form-control" disabled />
                            </div>
                            <div class="col-md-6">
                                <label for="tipo-pag-view" style="margin-top: 8px;">Tipo de pagamento: </label>
                                <input type="text" id="tipo-pag-view" class="form-control" disabled />
                            </div>
                            <div class="col-md-6">
                                <label for="data-view" style="margin-top: 8px;">Data da venda: </label>
                                <input type="date" id="data-view" class="form-control" disabled />
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-reponsive w-100">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="table-secondary" style="font-size: 1.2rem;">
                                                <th colspan="6" style="text-align: center;">Produtos dessa venda</th>
                                            </tr>
                                            <tr class="table-secondary">
                                                <th scope="col" class="text-center" width="10%">Cód Item</th>
                                                <th scope="col" class="text-center" width="11%">Cód Produto</th>
                                                <th scope="col">Produto</th>
                                                <th scope="col" class="text-center" width="15%">Preço</th>
                                                <th scope="col" class="text-center" width="10%">Categoria</th>
                                                <th scope="col" class="text-center" width="10%">Quantidade</th>
                                            </tr>
                                        </thead>
                                        <tbody id="produtos-view">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" onClick="$('#modal_vendas_view').modal('hide')"><i class="fa fa-close"></i> Fechar</button>
                </div>
            </div>
        </div>
    </div>
    </div>

</body>

</html>