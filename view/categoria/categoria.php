<!DOCTYPE html>

<!-- Controller do produto  -->
<?php
require_once '../../vendor/autoload.php';

$produtosModel = new \App\Model\Produtos();
$produtos = $produtosModel->getProdutosByCategoria($_GET['id']);
?>

<html lang="en">

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
    <script src="../../js/venda.js"></script>
    <link href="../../css/index.css" rel="stylesheet">
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
                        <a class="nav-link active" aria-current="page" href="../../index.php">Página Inicial</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Cadastros
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="../vendedor/vendedor.php">Vendedores</a></li>
                            <li><a class="dropdown-item" href="../produtos/produtos.php">Produtos</a></li>
                            <li><a class="dropdown-item" href="../vendas/vendas.php"> Ver vendas</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-outline-dark me-2 mt-1 mx-2" type="button" onclick="abrirModalCheckout()"><i class="fa fa-shopping-cart"></i> Ver carrinho <span class="rounded bg-danger text-white px-2 mx-auto my-auto" id="cont"></span></button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid conteudoCarouselProd">
        <div class="col-md-12">
            <!-- CALÇADOS -->
            <?php
            if (count($sapatos) > 0) :
            ?>
                <div class="row">
                    <div class="col-12 py-4 px-0 mx-0">
                        <hr>
                        <div class="row">
                            <div class="col-11">
                                <h2 id="calcados" style="margin-left: 20px;">CALÇADOS<a name="sapatos"></a></h2>
                            </div>
                            <div class="col-1">
                                <button type="button" class="btn btn-sm btn-outline-dark" onclick="verTodos( <?= $sapatos[0]['id_categoria'] ?> )">Ver todos</button>
                            </div>
                        </div>

                        <div class="container mt-2 mx-auto px-0">
                            <div id="carouselCalcados" class="carousel carousel-dark" data-interval="false">
                                <div class="row carrosel-produto">
                                    <div class="col-md-1 mx-0 px-1 control-prev">

                                    </div>
                                    <div class="col-md-10 mx-0 px-0">
                                        <div class="carousel-inner">
                                            <?php
                                            $i = 0;
                                            $counter = 0;
                                            while ($i < count($sapatos)) :
                                            ?>
                                                <div class="carousel-item <?php if ($counter == 0) echo 'active'; ?>">
                                                    <div class="row">
                                                        <div class="col-md-4" id="sapato">
                                                            <div class="card h-100">
                                                                <img src="<?= $sapatos[$i]['imagem'] ?>" class="card-img-top" alt="..." onClick="abrirModalDetalhes(<?= $sapatos[$i]['id'] ?>)">
                                                                <div class="card-body">
                                                                    <h5 class="card-title"> <?= $sapatos[$i]['nome'] ?> </h5>
                                                                    <p class="card-text">R$ <span class="preco"><?= mb_strpos($sapatos[$i]['preco'], ".") ? $sapatos[$i]['preco'] : $sapatos[$i]['preco'] . ",00" ?></span> </p>
                                                                </div>
                                                                <div class="card-footer bg-white">
                                                                    <div class="d-grid gap-2 col-10 mx-auto">
                                                                        <button type="submit" class="btn btn-outline-dark botaoCarrinho" onClick="adicionarCarrinho(<?= $sapatos[$i]['id'] ?>)"><i class="fa fa-cart-plus"></i> Adicionar ao carrinho</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php if (isset($sapatos[$i + 1])) : ?>
                                                            <div class="col-md-4">
                                                                <div class="card h-100">
                                                                    <img src="<?= $sapatos[$i + 1]['imagem'] ?>" class="card-img-top" alt="..." onClick="abrirModalDetalhes(<?= $sapatos[$i + 1]['id'] ?>)">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title"> <?= $sapatos[$i + 1]['nome'] ?> </h5>
                                                                        <p class="card-text">R$ <span class="preco"><?= mb_strpos($sapatos[$i + 1]['preco'], ".") ? $sapatos[$i + 1]['preco'] : $sapatos[$i + 1]['preco'] . ",00" ?></span> </p>
                                                                    </div>
                                                                    <div class="card-footer bg-white">
                                                                        <div class="d-grid gap-2 col-10 mx-auto">
                                                                            <button type="submit" class="btn btn-outline-dark botaoCarrinho" onClick="adicionarCarrinho(<?= $sapatos[$i + 1]['id'] ?>)"><i class="fa fa-cart-plus"></i> Adicionar ao carrinho</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if (isset($sapatos[$i + 2])) : ?>
                                                            <div class="col-md-4">
                                                                <div class="card h-100">
                                                                    <img src="<?= $sapatos[$i + 2]['imagem'] ?>" class="card-img-top" alt="..." onClick="abrirModalDetalhes(<?= $sapatos[$i + 2]['id'] ?>)">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title"> <?= $sapatos[$i + 2]['nome'] ?> </h5>
                                                                        <p class="card-text">R$ <span class="preco"><?= mb_strpos($sapatos[$i + 2]['preco'], ".") ? $sapatos[$i + 2]['preco'] : $sapatos[$i + 2]['preco'] . ",00" ?></span> </p>
                                                                    </div>
                                                                    <div class="card-footer bg-white">
                                                                        <div class="d-grid gap-2 col-10 mx-auto">
                                                                            <button type="submit" class="btn btn-outline-dark botaoCarrinho" onClick="adicionarCarrinho(<?= $sapatos[$i + 2]['id'] ?>)"><i class="fa fa-cart-plus"></i> Adicionar ao carrinho</button>
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
                                            <button class="carousel-control-next buttonControl control-next" type="button" data-bs-target="#carouselCalcados" data-bs-slide="next">
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
                </div>
            <?php endif; ?>

</body>

</html>