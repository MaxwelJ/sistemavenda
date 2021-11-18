<!DOCTYPE html>
<?php
require_once '../../vendor/autoload.php';
$produtosModel = new \App\Model\Produtos();
$produtos = $produtosModel->listar();
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
    <script src="../../js/produtos.js"></script>
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
                <a class="nav-link itens-nav" href="../vendedor/vendedor.php">Vendedores</a>
            </li>
            <li class="nav-item">
                <a class="nav-link itens-nav" href="produtos.php">Produtos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link itens-nav" href="../vendas/vendas.php">Vendas</a>
            </li>
        </ul>
    </nav>

    <div class="container conteudo">
        <div class="table-reponsive w-100">
            <table class="table table-bordered" style="margin-top: 10px;">
                <thead style="background-color: #e3f2fd;">
                    <tr>
                        <th colspan=6>
                            <span class="text-center" style="font-size: 1.5rem;">Lista de produtos</span>
                            <button type="button" class="btn btn-outline-dark" style="float: right;" onClick="abrirModalCreate()"><i class="fa fa-plus"></i> Adicionar</button>
                        </th>
                    </tr>
                    <tr>
                        <th class="text-center" width="5%" style="background-color: #e3f2fd;">Código</th>
                        <th width="" style="background-color: #e3f2fd;">Nome</th>
                        <th class="text-center" width="15%" style="background-color: #e3f2fd;">Preço</th>
                        <th class="text-center" width="10%" style="background-color: #e3f2fd;">Quantidade</th>
                        <th class="text-center" width="10%" style="background-color: #e3f2fd;">Categoria</th>
                        <th class="text-center" width="15%" style="background-color: #e3f2fd;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produtos as $produtos) : ?>
                        <tr>
                            <td class="text-center"><?= $produtos['id'] ?></td>
                            <td><?= $produtos['nome'] ?></td>
                            <td>R$ <?= $produtos['preco'] ?></td>
                            <td class="text-center"><?= $produtos['quantidade'] ?></td>
                            <td class="text-center"><?= $produtos['nome_cat'] ?></td>
                            <td>
                                <div class="justify-content-center d-flex">
                                    <button type="button" class="btn btn-outline-warning mx-1" onClick="abrirModalEdit(<?= $produtos['id'] ?>)"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-outline-primary mx-1" onClick="abrirModalView(<?= $produtos['id'] ?>)"><i class="fa fa-eye"></i></button>
                                    <button type="button" class="btn btn-outline-danger mx-1" onClick="apagar(<?= $produtos['id'] ?>)"><i class="fa fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div id="modal_produtos_edit" class="modal fade" tabindex="-1" role="dialog">
        <form id="form-cadastro-edit" method="post">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar cadastro</h5>
                        <button type="button" class="close btn btn-outline-danger" onClick="$('#modal_produtos_edit').modal('hide')" aria-label="Close">
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
                                <div class="col-md-4">
                                    <label for="preco-edit" style="margin-top: 8px;">Preço: </label>
                                    <input type="text" id="preco-edit" name="preco" class="form-control" required />
                                </div>
                                <div class="col-md-4">
                                    <label for="quantidade-edit" style="margin-top: 8px;">Quantidade: </label>
                                    <input type="text" id="quantidade-edit" name="quantidade" class="form-control" required />
                                </div>
                                <div class="col-md-4">
                                    <label for="categoria-edit" style="margin-top: 8px;">Categoria: </label> <br>
                                    <select id="categoria-edit" name="id_categoria" class="form-select" aria-label="Default select example"></select>
                                </div>
                                <div class="col-md-12">
                                    <label for="decricao-edit">Descrição: </label>
                                    <textarea id="descricao-edit" name="descricao" class="form-control" required></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label for="imagem-preview-edit" style="margin-top: 8px;">Imagem do produto: </label> <br>
                                    <img class="img-thumbnail" id="imagem-preview-edit" src="" alt="">
                                    <br>
                                </div>
                                <div class="col-md-12">
                                    <label for="imagem-edit" style="margin-top: 8px;">Editar imagem:</label>
                                    <input type="file" id="imagem-edit" name="imagem" class="form-control" onchange="atualizarImagem(2)" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-primary"><i class="fa fa-save"></i> Salvar</button>
                        <button type="button" class="btn btn-outline-danger" onClick="$('#modal_produtos_edit').modal('hide')"><i class="fa fa-close"></i> Fechar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div id="modal_produtos_view" class="modal fade" tabindex="-1" role="dialog">
        <form id="form-cadastro-view" method="post">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cadastro</h5>
                        <button type="button" class="close btn btn-outline-danger" onClick="$('#modal_produtos_view').modal('hide')" aria-label="Close">
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
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="preco-view" style="margin-top: 8px;">Preço: </label>
                                    <input type="text" id="preco-view" name="preco" class="form-control" disabled />
                                </div>
                                <div class="col-md-4">
                                    <label for="quantidade-view" style="margin-top: 8px;">Quantidade: </label>
                                    <input type="text" id="quantidade-view" name="quantidade" class="form-control" disabled />
                                </div>
                                <div class="col-md-4">
                                    <label for="categoria-view" style="margin-top: 8px;">Categoria: </label> <br>
                                    <input type="text" id="categoria-view" name="categoria" class="form-control" disabled />
                                </div>
                                <div class="col-md-12">
                                    <label for="decricao-view">Descrição: </label>
                                    <textarea id="descricao-view" name="descricao" class="form-control" disabled></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="imagem-view" style="margin-top: 8px;">Imagem do produto: </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <img class="img-thumbnail" id="imagem-preview-view" style="margin-top: 10px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="submit" class="btn btn-outline-primary"><i class="fa fa-save"></i> Salvar</button> -->
                        <button type="button" class="btn btn-outline-danger" onClick="$('#modal_produtos_view').modal('hide')"><i class="fa fa-close"></i> Fechar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div id="modal_produtos_create" class="modal fade" tabindex="-1" role="dialog">
        <form id="form-cadastro-create" method="post" enctype='multipart/form-data'>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Criar cadastro</h5>
                        <button type="button" class="close btn btn-outline-danger" onClick="$('#modal_produtos_create').modal('hide')" aria-label="Close">
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
                                <div class="col-md-4">
                                    <label for="preco-create" style="margin-top: 8px;">Preço: </label>
                                    <input type="text" id="preco-create" name="preco" class="form-control" required />
                                </div>
                                <div class="col-md-4">
                                    <label for="quantidade-create" style="margin-top: 8px;">Quantidade: </label>
                                    <input type="text" id="quantidade-create" name="quantidade" class="form-control" required />
                                </div>
                                <div class="col-md-4">
                                    <label for="categoria-create" style="margin-top: 8px;">Categoria: </label> <br>
                                    <select name="id_categoria" id="categoria-create" class="form-select" aria-label="Default select example"></select>
                                </div>
                                <div class="col-md-12">
                                    <label for="decricao-create">Descrição: </label>
                                    <textarea id="descricao-create" name="descricao" class="form-control" required></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label for="imagem-create" style="margin-top: 8px;">Imagem do produto: </label>
                                    <input type="file" id="imagem-create" name="imagem" class="form-control" onchange="atualizarImagem(1)" required />
                                </div>
                                <div class="col-md-12">
                                    <br>
                                    <img class="img-thumbnail" id="imagem-preview-create" src="" alt="">
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-primary"><i class="fa fa-save"></i> Salvar</button>
                        <button type="button" class="btn btn-outline-danger" onClick="$('#modal_produtos_create').modal('hide')"><i class="fa fa-close"></i> Fechar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</body>

</html>