<!DOCTYPE html>
<?php
require_once 'vendor/autoload.php';

$produtosModel = new \App\Model\Produtos();
$produtos = $produtosModel->listar();

$sapatos = [];
$roupas = [];
$acessorios = [];

foreach ($produtos as $produto) {
    if ($produto['id_categoria'] == 1) {
        $sapatos[] = $produto;
    }
    if ($produto['id_categoria'] == 2) {
        $roupas[] = $produto;
    }
    if ($produto['id_categoria'] == 3) {
        $acessorios[] = $produto;
    }
}

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

    <nav class="navbar navbar-light shadow-lg menu">
        <a class="navbar-brand" style="margin-left: 10px;">
            <h4><strong>Loja variedades</strong></h4>
        </a>
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <a class="nav-link active" href="index.php">Página Inicial</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="view/vendedor/vendedor.php">Vendedores</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="view/produtos/produtos.php">Produtos</a>
            </li>
        </ul>
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

    <div class="container">
        <div class="row">
            <div class="col-3" style="margin-top: 20px;">
                <h2>Menu</h2>
                <ul>
                    <li>Sapatos</li>
                    <li>Roupas</li>
                    <li>Acessórios</li>
                </ul>
            </div>

            <div class="col-9">
                <br>
                <hr>
                <h2 style="margin-left: 20px;">SAPATOS</h2>
                <br>

                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php foreach ($sapatos as $sapato) : ?>
                        <div class="col-md-4">
                            <div class="card h-100">
                                <img src="<?= $sapato['imagem'] ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"> <?= $sapato['nome'] ?> </h5>
                                    <p class="card-text">R$ <?= $sapato['preco'] ?> </p>
                                    <button type="button" class="btn btn-primary detalhes"><i class="fa fa-eye"></i> Ver detalhes</a></button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <br>
                <hr>
                <h2 style="margin-left: 20px;">ROUPAS</h2>
                <br>

                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php foreach ($roupas as $roupa) : ?>
                        <div class="col-md-4">
                            <div class="card h-100">
                                <img src="<?= $roupa['imagem'] ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"> <?= $roupa['nome'] ?> </h5>
                                    <p class="card-text">R$ <?= $roupa['preco'] ?> </p>
                                    <button type="button" class="btn btn-primary detalhes"><i class="fa fa-eye"></i> Ver detalhes</a></button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <br>
                <hr>
                <h2 style="margin-left: 20px;">ACESSÓRIOS</h2>
                <br>

                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php foreach ($acessorios as $acessorio) : ?>
                        <div class="col-md-4">
                            <div class="card h-100">
                                <img src="<?= $acessorio['imagem'] ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"> <?= $acessorio['nome'] ?> </h5>
                                    <p class="card-text">R$ <?= $acessorio['preco'] ?> </p>
                                    <button type="button" class="btn btn-primary detalhes"><i class="fa fa-eye"></i> Ver detalhes</a></button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </div>

</body>

</html>