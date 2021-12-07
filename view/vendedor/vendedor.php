<!DOCTYPE html>
<?php
require_once '../../vendor/autoload.php';
$vendedorModel = new \App\Model\Vendedor();
$vendedores = $vendedorModel->listar();
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
    <script src="../../js/vendedor.js"></script>
    <link href="../../css/index.css" rel="stylesheet">
    <link rel="shortcut icon" type="imagex/png" href="../../img/icon/icone.ico">
    <title>Loja Variedas</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light menu">
        <div class="container-fluid">
            <a class="navbar-brand" style="margin-left: 10px;" href="../../index.php">
                <h4><strong>Loja variedades</strong></h4>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../../index.php">Página Inicial</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Cadastros
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="vendedor.php">Vendedores</a></li>
                            <li><a class="dropdown-item" href="../produtos/produtos.php">Produtos</a></li>
                            <li><a class="dropdown-item" href="../vendas/vendas.php">Vendas</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-outline-dark me-2 mt-1 mx-2" type="button" onclick="abrirModalCheckout()"><i class="fa fa-shopping-cart"></i> Ver carrinho <span class="rounded bg-danger text-white px-2 mx-auto my-auto" id="cont"></span></button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- <nav class="navbar navbar-light menu">
        <a class="navbar-brand" style="margin-left: 10px;"><strong>Loja variedades</strong></a>
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <a class="nav-link active itens-nav" href="../../index.php">Página Inicial</a>
            </li>
            <li class="nav-item">
                <a class="nav-link itens-nav" href="vendedor.php">Vendedores</a>
            </li>
            <li class="nav-item">
                <a class="nav-link itens-nav" href="../produtos/produtos.php">Produtos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link itens-nav" href="../vendas/vendas.php">Vendas</a>
            </li>
        </ul>
    </nav> -->

    <div class="container conteudo">
        <div class="table-reponsive w-100">
            <table class="table table-bordered" style="margin-top: 10px;">
                <thead style="background-color: #e3f2fd;">
                    <tr>
                        <th colspan=5>
                            <span class="text-center" style="font-size: 1.5rem;">Lista de vendedores</span>
                            <button type="button" class="btn btn-outline-dark" style="float: right;" onClick="abrirModalCreate()"><i class="fa fa-plus"></i> Adicionar</button>
                        </th>
                    </tr>
                    <tr>
                        <th style="background-color: #e3f2fd;">Cod.</th>
                        <th style="background-color: #e3f2fd;">Nome</th>
                        <th style="background-color: #e3f2fd;">Cpf</th>
                        <th style="background-color: #e3f2fd;">Data de Nascimento</th>
                        <th style="background-color: #e3f2fd;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($vendedores as $vendedor) : ?>
                        <tr>
                            <td><?= $vendedor['id'] ?></td>
                            <td><?= $vendedor['nome'] ?></td>
                            <td class='cpf'><?= $vendedor['cpf'] ?></td>
                            <td class='data'><?= $vendedor['data_nasc'] ?></td>
                            <td>
                                <div>
                                    <button type="button" class="btn btn-outline-warning" onClick="abrirModalEdit(<?= $vendedor['id'] ?>)"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-outline-primary" onClick="abrirModalView(<?= $vendedor['id'] ?>)"><i class="fa fa-eye"></i></button>
                                    <button type="button" class="btn btn-outline-danger" onClick="apagar(<?= $vendedor['id'] ?>)"><i class="fa fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div id="modal_vendedor_edit" class="modal fade" tabindex="-1" role="dialog">
        <form id="form-cadastro-edit" method="post">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar cadastro</h5>
                        <button type="button" class="close btn btn-outline-danger" onClick="$('#modal_vendedor_edit').modal('hide')" aria-label="Close">
                            <span aria-hidden="true"><i class="fa fa-close"></i></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="row">
                                <input type="hidden" id="id-edit" name="id">
                                <div class="col-md-12">
                                    <label for="nome-edit">Nome: </label>
                                    <input type="text" id="nome-edit" name="nome" class="form-control" required />
                                </div>
                                <div class="col-md-6">
                                    <label for="cpf-edit">CPF: </label>
                                    <input type="text" id="cpf-edit" name="cpf" class="form-control" required />
                                </div>
                                <div class="col-md-6">
                                    <label for="data-nasc-edit">Data de nascimento: </label>
                                    <input type="date" id="data-nasc-edit" name="data_nasc" class="form-control" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-primary"><i class="fa fa-save"></i> Salvar</button>
                        <button type="button" class="btn btn-outline-danger" onClick="$('#modal_vendedor_edit').modal('hide')"><i class="fa fa-close"></i> Fechar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div id="modal_vendedor_view" class="modal fade" tabindex="-1" role="dialog">
        <form id="form-cadastro-view" method="post">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cadastro</h5>
                        <button type="button" class="close btn btn-outline-danger" onClick="$('#modal_vendedor_view').modal('hide')" aria-label="Close">
                            <span aria-hidden="true"><i class="fa fa-close"></i></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="row">
                                <input type="hidden" id="id-view" name="id">
                                <div class="col-md-12">
                                    <label for="nome-view">Nome: </label>
                                    <input type="text" id="nome-view" name="nome" class="form-control" disabled />
                                </div>
                                <div class="col-md-6">
                                    <label for="cpf-view">CPF: </label>
                                    <input type="text" id="cpf-view" name="cpf" class="form-control" disabled />
                                </div>
                                <div class="col-md-6">
                                    <label for="data-nasc-view">Data de nascimento: </label>
                                    <input type="date" id="data-nasc-view" name="data_nasc" class="form-control" disabled />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="submit" class="btn btn-outline-primary"><i class="fa fa-save"></i> Salvar</button> -->
                        <button type="button" class="btn btn-outline-danger" onClick="$('#modal_vendedor_view').modal('hide')"><i class="fa fa-close"></i> Fechar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div id="modal_vendedor_create" class="modal fade" tabindex="-1" role="dialog">
        <form id="form-cadastro-create" method="post">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Criar cadastro</h5>
                        <button type="button" class="close btn btn-outline-danger" onClick="$('#modal_vendedor_create').modal('hide')" aria-label="Close">
                            <span aria-hidden="true"><i class="fa fa-close"></i></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="nome-create">Nome: </label>
                                    <input type="text" id="nome-create" name="nome" class="form-control" required />
                                </div>
                                <div class="col-md-6">
                                    <label for="cpf-create">CPF: </label>
                                    <input type="text" id="cpf-create" name="cpf" class="form-control" required />
                                </div>
                                <div class="col-md-6">
                                    <label for="data-nasc-create">Data de nascimento: </label>
                                    <input type="date" id="data-nasc-create" name="data_nasc" class="form-control" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-primary"><i class="fa fa-save"></i> Salvar</button>
                        <button type="button" class="btn btn-outline-danger" onClick="$('#modal_vendedor_create').modal('hide')"><i class="fa fa-close"></i> Fechar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</body>

</html>