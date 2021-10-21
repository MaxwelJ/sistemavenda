<!DOCTYPE html>
<?php
require_once 'vendor/autoload.php';
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
    <script src="js/index.js"></script>
    <link href="css/index.css" rel="stylesheet">
    <script src="js/vendedor.js"></script>
    <title>Loja Variedas</title>
</head>

<body>

    <header>
        <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
            <a class="navbar-brand" style="margin-left: 10px;"><strong>Loja variedades</strong></a>
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Página Inicial</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="vendedor.php">Vendedores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="produtos.php">Produtos</a>
                </li>
            </ul>
        </nav>
    </header>

    <table class="table table-bordered" style="margin-top: 10px;">
        <thead>
            <tr>
                <th colspan=4>
                    <h4 class="text-center">Lista de vendedor</h4>
                </th>
            </tr>
            <tr>
                <th style="background-color: #e3f2fd;">Nome</th>
                <th style="background-color: #e3f2fd;">Cpf</th>
                <th style="background-color: #e3f2fd;">Data de Nascimento</th>
                <th style="background-color: #e3f2fd;">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vendedores as $vendedor) : ?>
                <tr>
                    <td><?= $vendedor['nome'] ?></td>
                    <td class='cpf'><?= $vendedor['cpf'] ?></td>
                    <td id='data_nasc' class='data'><?= $vendedor['data_nasc'] ?></td>
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

    <div id="modal_vendedor_edit" class="modal fade" tabindex="-1" role="dialog">
        <form id="form-cadastro-edit" method="post">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar cadastro</h5>
                        <button type="button" class="close" onClick="$('#modal_vendedor_edit').modal('hide')" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
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
                        <button type="button" class="close" onClick="$('#modal_vendedor_view').modal('hide')" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
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

    <div id="button-create" style="float: right; margin-right: 20px;">
        <button type="button" class="btn btn-outline-dark" onClick="abrirModalCreate()"><i class="fa fa-plus"></i> Adicionar</button>
    </div>

    <div id="modal_vendedor_create" class="modal fade" tabindex="-1" role="dialog">
        <form id="form-cadastro-create" method="post">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Criar cadastro</h5>
                        <button type="button" class="close" onClick="$('#modal_vendedor_create').modal('hide')" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
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