<!DOCTYPE html>

<!-- Controller do produto -->
<?php
require_once 'vendor/autoload.php';

$produtosModel = new \App\Model\Produtos();
$produtos = $produtosModel->listar();
?>

<!-- Controller do tipo_pag -->
<?php
require_once 'vendor/autoload.php';

$tipopagsModel = new \App\Model\TipoPag();
$tipopags = $tipopagsModel->listar();

?>

<!-- Controller do vendedor -->
<?php
require_once 'vendor/autoload.php';

$vendedoresModel = new \App\Model\Vendedor();
$vendedores = $vendedoresModel->listar();
?>

<!-- Controller do categoria -->
<?php
require_once 'vendor/autoload.php';

$categoriasModel = new \App\Model\Categoria();
$categorias = $categoriasModel->listar();

$produtosCat = [];
$i = 0;

foreach ($categorias as $categoria) {
    foreach ($produtos as $produto) {
        if ($produto['id_categoria'] == $categoria['id']) {
            $produtosCat[$i][] = $produto;
        }
    }
    $i++;
}

$i = 0;

// echo json_encode($produtosCat[0]);
// die;
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
    <script src="js/vendedor.js"></script>
    <script src="js/venda.js"></script>
    <link href="css/index.css" rel="stylesheet">
    <link rel="shortcut icon" type="imagex/png" href="./img/icon/icone.ico">
    <title>Loja Variedas</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light menu">
        <div class="container-fluid">
            <a class="navbar-brand" style="margin-left: 10px;" href="index.php">
                <h4><strong>Loja variedades</strong></h4>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Página Inicial</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Cadastros
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="view/vendedor/vendedor.php">Vendedores</a></li>
                            <li><a class="dropdown-item" href="view/produtos/produtos.php">Produtos</a></li>
                            <li><a class="dropdown-item" href="view/vendas/vendas.php"> Ver vendas</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Categorias
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="#sapatos">Sapatos</a></li>
                            <li><a class="dropdown-item" href="#roupas">Roupas</a></li>
                            <li><a class="dropdown-item" href="#acessorios">Acessórios</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-outline-dark me-2 mt-1 mx-2" type="button" onclick="abrirModalCheckout()"><i class="fa fa-shopping-cart"></i> Ver carrinho <span class="rounded bg-danger text-white px-2 mx-auto my-auto" id="cont"></span></button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid conteudo">
        <div class="row">
            <div class="col-md-12">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="img/carrosel/slide1.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="img/carrosel/slide2.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="img/carrosel/slide3.jpg" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid conteudoCarouselProd">
        <div class="col-md-12">
            <div class="row">
                <?php foreach ($produtosCat as $produtoCat) : ?>
                    <div class="col-12 py-4 px-0 mx-0">
                        <hr>
                        <div class="row">
                            <div class="col-11">
                                <h2 id="calcados" style="margin-left: 20px;"><?= $produtoCat[0]['nome_cat'] ?><a name="sapatos"></a></h2>
                            </div>
                            <div class="col-1">
                                <button type="button" class="btn btn-sm btn-outline-dark" onclick="verTodos( <?= $produtoCat[0]['id_categoria'] ?> )">Ver todos</button>
                            </div>
                        </div>

                        <div class="container mt-2 mx-auto px-0">
                            <div id="carousel<?= $produtoCat[0]['nome_cat'] ?>" class="carousel carousel-dark" data-bs-interval="false">
                                <div class="row carrosel-produto">
                                    <div class="col-md-1 mx-0 px-1 control-prev">

                                    </div>
                                    <div class="col-md-10 mx-0 px-0">
                                        <div class="carousel-inner">
                                            <?php
                                            foreach ($produtoCat as $produto)
                                            $i = 0;
                                            $counter = 0;
                                            while ($i < count($produtoCat)) :
                                            ?>
                                                <div class="carousel-item <?php if ($counter == 0) echo 'active'; ?>">
                                                    <div class="row">
                                                        <div class="col-md-4" id="sapato">
                                                            <div class="card h-100">
                                                                <img src="<?= $produtoCat[$i]['imagem'] ?>" class="card-img-top" alt="..." onClick="abrirModalDetalhes(<?= $produtoCat[$i]['id'] ?>)">
                                                                <div class="card-body">
                                                                    <h5 class="card-title"> <?= $produtoCat[$i]['nome'] ?> </h5>
                                                                    <p class="card-text">R$ <span class="preco"><?= mb_strpos($produtoCat[$i]['preco'], ".") ? $produtoCat[$i]['preco'] : $produtoCat[$i]['preco'] . ",00" ?></span> </p>
                                                                </div>
                                                                <div class="card-footer bg-white">
                                                                    <div class="d-grid gap-2 col-10 mx-auto">
                                                                        <button type="submit" class="btn btn-outline-dark botaoCarrinho" onClick="adicionarCarrinho(<?= $produtoCat[$i]['id'] ?>)"><i class="fa fa-cart-plus"></i> Adicionar ao carrinho</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php if (isset($produtoCat[$i + 1])) : ?>
                                                            <div class="col-md-4">
                                                                <div class="card h-100">
                                                                    <img src="<?= $produtoCat[$i + 1]['imagem'] ?>" class="card-img-top" alt="..." onClick="abrirModalDetalhes(<?= $produtoCat[$i + 1]['id'] ?>)">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title"> <?= $produtoCat[$i + 1]['nome'] ?> </h5>
                                                                        <p class="card-text">R$ <span class="preco"><?= mb_strpos($produtoCat[$i + 1]['preco'], ".") ? $produtoCat[$i + 1]['preco'] : $produtoCat[$i + 1]['preco'] . ",00" ?></span> </p>
                                                                    </div>
                                                                    <div class="card-footer bg-white">
                                                                        <div class="d-grid gap-2 col-10 mx-auto">
                                                                            <button type="submit" class="btn btn-outline-dark botaoCarrinho" onClick="adicionarCarrinho(<?= $produtoCat[$i + 1]['id'] ?>)"><i class="fa fa-cart-plus"></i> Adicionar ao carrinho</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if (isset($produtoCat[$i + 2])) : ?>
                                                            <div class="col-md-4">
                                                                <div class="card h-100">
                                                                    <img src="<?= $produtoCat[$i + 2]['imagem'] ?>" class="card-img-top" alt="..." onClick="abrirModalDetalhes(<?= $produtoCat[$i + 2]['id'] ?>)">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title"> <?= $produtoCat[$i + 2]['nome'] ?> </h5>
                                                                        <p class="card-text">R$ <span class="preco"><?= mb_strpos($produtoCat[$i + 2]['preco'], ".") ? $produtoCat[$i + 2]['preco'] : $produtoCat[$i + 2]['preco'] . ",00" ?></span> </p>
                                                                    </div>
                                                                    <div class="card-footer bg-white">
                                                                        <div class="d-grid gap-2 col-10 mx-auto">
                                                                            <button type="submit" class="btn btn-outline-dark botaoCarrinho" onClick="adicionarCarrinho(<?= $produtoCat[$i + 2]['id'] ?>)"><i class="fa fa-cart-plus"></i> Adicionar ao carrinho</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            <?php
                                                $i += 3;
                                                $counter++;
                                            endwhile;
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-1 mx-0 px-1">
                                        <?php
                                        if ($i > 2) :
                                        ?>
                                            <button class="carousel-control-next buttonControl control-next" type="button" data-bs-target="#carousel<?= $produtoCat[0]['nome_cat'] ?>" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        <?php
                                        endif;
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>


    </div>

    <div id="modal_detalhes" class="modal fade" tabindex="-1" role="dialog">
        <form id="form-detalhes" method="post">
            <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detalhes do produto:</h5>
                        <button type="button" class="close btn btn-outline-danger" data-dismiss="modal" aria-label="Close" onClick="$('#modal_detalhes').modal('hide')">
                            <span aria-hidden="true"><i class="fa fa-close"></i></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id_produto" id="id-detalhes">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <img class="img-fluid" id="imagem-preview-detalhes" src="" alt="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                    <h4 class="card-title" id="nome-detalhes"></h4>
                                    <span>R$ </span><span class="card-text" id="preco-detalhes"></span>
                                    <p style="font-size: 13px; color: red;">Parcelado em até 12x sem juros.</p>

                                    <hr>

                                    <div class="col-md-12">
                                        <h5>Descrição:</h5>
                                        <p id="descricao-detalhes"></p>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <!-- <button type="submit" class="btn btn-outline-primary"><i class="fa fa-shopping-cart"></i> Comprar</button> -->
                        <button id="adicionar-carrinho-modal" type="button" class="btn btn-outline-dark"><i class="fa fa-cart-plus"></i> Adicionar ao carrinho</button>
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal" onClick="$('#modal_detalhes').modal('hide')"><i class="fa fa-close"></i> Fechar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div id="modal_checkout" class="modal fade" tabindex="-1">
        <form id="form-checkout" method="post">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Carrinho</h5>
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
                    </div>

                    <div class="modal-body">

                        <div class="col-md-12">
                            <label for="">Produtos adicionados:</label>
                            <div class="mt-3 justify-content-center" id="produto-adicionado">

                            </div>
                            <div>
                                <label for="">Valor final:</label>
                                <h4>R$ <span class="preco" id="valor-final"></span></h4>
                            </div>
                            <hr class="mt-4 mb-2">
                        </div>

                        <div class="alert alert-secondary" role="alert">
                            Precisamos de seus dados para finalizar a compra.
                        </div>
                        <div class="input-group">
                            <div class="col-md-12">
                                <label for="">Formas de pagamento:</label>
                                <?php foreach ($tipopags as $tipopag) : ?>
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <input type="radio" name="id_tipo_pag" id="<?= $tipopag['id'] ?>-tipo-pag" value="<?= $tipopag['id'] ?>" />
                                            <label for="<?= $tipopag['id'] ?>-tipo-pag"> <?= $tipopag['nome'] ?> </label>
                                        </li>
                                    </ul>
                                <?php endforeach; ?>
                            </div>
                        </div> <br>

                        <div class="col-md-12">
                            <label for="id-vendedor">Escolha seu vendedor:</label>
                            <select name="id_vendedor" id="id-vendedor" class="form-control" required>
                                <option value="">- SELECIONE -</option>
                                <?php foreach ($vendedores as $vendedor) : ?>
                                    <option value="<?= $vendedor['id'] ?>"><?= $vendedor['nome'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"><i class="fa fa-close"></i> Fechar</button>
                        <button type="submit" class="btn btn-outline-dark" onclick="$('#modal_checkout').modal('hide')"><i class="fa fa-shopping-cart"></i> Finalizar Compra</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div id="modal_compra_finalizada" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Compra Finalizada</h5>
                </div>
                <div class="modal-body">
                    <p id="msg-compra-finalizada"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger fechar_compra" data-dismiss="modal"><i class="fa fa-close"></i> Fechar</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>