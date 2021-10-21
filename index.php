<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.11.2/jquery.mask.min.js" integrity="sha512-Y/GIYsd+LaQm6bGysIClyez2HGCIN1yrs94wUrHoRAD5RSURkqqVQEU6mM51O90hqS80ABFTGtiDpSXd2O05nw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/index.js"></script>
    <link href="css/index.css" rel="stylesheet"></link>
    <title>Loja Variedas</title>
</head>

<body>

    <header>
        <h1>Loja de Variedades</h1>
        <hr>
    </header>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th colspan=3>
                    <h4 class="text-center">Vendedor</h4>
                </th>
            </tr>
            <tr>
                <th>Nome</th>
                <th>Cpf</th>
                <th>Data de Nascimento</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once 'vendor/autoload.php';

            $vendedorDao = new \App\Model\VendedorDao();

            foreach ($vendedorDao->read() as $vendedor) {
                echo
                "<tr>
                    <td>" . $vendedor['nome'] . "</td>
                    <td class='cpf'>" . $vendedor['cpf'] . "</td>
                    <td id='data_nasc' class='data'>" . $vendedor['data_nasc'] . "</td>
                </tr>";
            }
            ?>
        </tbody>
    </table>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th colspan=3>
                    <h4 class="text-center">Produtos</h4>
                </th>
            </tr>
            <tr>
                <th>Nome</th>
                <th>Quantidade</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once 'vendor/autoload.php';

            $produtosDao = new \App\Model\ProdutosDao();

            foreach ($produtosDao->read() as $produto) {
                echo
                "<tr>
                    <td>" . $produto['nome'] . "</td>
                    <td>" . $produto['quantidade'] . "</td>
                </tr>";
            }
            ?>
        </tbody>
    </table>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th colspan=3>
                    <h4 class="text-center">Tipo de Pagamento</h4>
                </th>
            </tr>
            <tr>
                <th>Tipo</th>
                <th>Descrição</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once 'vendor/autoload.php';

            $tipo_pagDao = new \App\Model\TipoPagDao();

            foreach ($tipo_pagDao->read() as $tipo_pag) {
                echo
                "<tr>
                    <td>" . $tipo_pag['nome'] . "</td>
                    <td>" . $tipo_pag['descricao'] . "</td>
                </tr>";
            }
            ?>
        </tbody>
    </table>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th colspan=3>
                    <h4 class="text-center">Vendas</h4>
                </th>
            </tr>
            <tr>
                <th>Vendedor</th>
                <th>Data da Venda</th>
                <th>Tipo de Pagamento</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once 'vendor/autoload.php';

            $vendasDao = new \App\Model\TipoPagDao();

            foreach ($vendasDao->read() as $vendas) {
                echo
                "<tr>
                    <td>" . $vendas['nome'] . "</td>
                    <td>" . $vendas['descricao'] . "</td>
                </tr>";
            }
            ?>
        </tbody>
    </table>

</body>

</html>