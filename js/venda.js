function abrirModalView(id) {
    // resetando valor ao abrir modal;
    $("#nome-view").val('')
    $("#tipo-pag-view").val('')
    $("#data-view").val('')

    // requisão do front para o backend;
    $.ajax({
        url: '../../backend/venda/vendaController.php',
        type: 'get',
        dataType: 'json',
        data: {
            id: id
        },
        success: function (data) {
            // console.log(data);
            $("#nome-view").val(data.nome_vendedor)
            $("#tipo-pag-view").val(data.tipo_pag_nome)
            $("#data-view").val(data.data_venda)

            $("#produtos-view").html('')

            let html = ``

            $(data.itens_venda).each(function (index, produto) {
                html +=
                    `<tr>
                    <td>${produto.coditem}</td>
                    <td>${produto.codproduto}</td>
                    <td>${produto.nomeproduto}</td>
                    <td>R$ ${produto.precoproduto}</td>
                    <td>${produto.nomecategoria}</td>
                    <td>${produto.quantidade}</td>
                </tr>`
            })

            $("#produtos-view").append(html)
        },
        error: function () {
            alert("Deu erro ao salvar.")
        }
    })
    $('#modal_vendas_view').modal("show")
}

function apagar(id) {

    if (confirm('Deseja realmente apagar esse cadastro?')) {

        $.ajax({
            url: "../../backend/venda/apagarController.php",
            type: 'get',
            dataType: 'json',
            data: {
                id: id
            },
            success: function (data) {
                if (data.status == true) {
                    location.reload()
                } else {
                    alert('Ocorreu um erro ao apagar.')
                }
            },
            error: function () {
                alert("Deu erro ao salvar.")
            }
        })
    }
}

// Função para salvar os produtos no carrinho

function adicionarCarrinho(id_produto) {
    let aux = false

    let carrinho = JSON.parse(sessionStorage.getItem("carrinho")) ?? []

    $(carrinho).each(function (index, item) {
        if (item == id_produto) {
            aux = true;
        }
    })
    if (!aux) {
        carrinho.push(id_produto)
    } else {
        alert("Produto já adicionado!")
        return
    }

    // console.log(carrinho)
    sessionStorage.setItem("carrinho", JSON.stringify(carrinho))
}

function abrirModalCheckout() {
    let data = {
        produtos: sessionStorage.getItem("carrinho").replace("[", "").replace("]", "")
    }

    $.ajax({
        url: 'backend/venda/carrinhoController.php',
        type: 'get',
        dataType: 'json',
        data: data,
        success: function (data) {

            $("#produto-adicionado").html('')

            let html = ``

            $(data).each(function (index, produto) {
                html +=
                    `
                <div class="col-md-12 shadow-sm border rounded mb-2">
                    <div class="row justify-content-center">
                        <div class="col-md-2 my-auto">
                            <img class="img-fluid img-compra mx-4" src="${produto.imagem}">
                        </div>
                        <div class="col-md-5 my-auto">
                            <h6>${produto.nome}</h6>
                            <span >R$ ${produto.preco}</span>
                        </div>
                        <div class="col-md-5 div-qtd my-auto">
                            <button class="btn btn-sm btn-outline-danger mx-2 float-end" type="button"><i class="fa fa-times"></i> Remover</button>
                            <button class="btn btn-sm btn-outline-dark float-end diminuir-qtd" type="button"><i class="fa fa-minus"></i></button>
                            <div class="float-end mx-2 num-qtd"> 1 </div>
                            <button class="btn btn-sm btn-outline-dark float-end adicionar-qtd" type="button"><i class="fa fa-plus"></i></button>
                            <input type="hidden" class="preco-produto" value="${produto.preco}"/>
                            <input type="hidden" class="valor-produto" value="${produto.preco}"/>
                        </div>
                    </div>
                </div>
                `
            })
            $("#produto-adicionado").append(html)
        },
        error: function () {
            alert('Erro ao finalizar sua compra.')
        }
    }).done(function () {
        valorFinal()
    })
    
    $("#modal_checkout").modal("show")
}

$(document).on('click', ".diminuir-qtd", function (event) {
    event.preventDefault();
    let qtd = $(this).closest(".div-qtd").children(".num-qtd").html()
    const precoProduto = $(this).closest(".div-qtd").children(".preco-produto").val().replace(",", ".")
    let valorProduto = ''

    qtd = parseInt(qtd) - 1

    if (qtd > 0) {
        $(this).closest(".div-qtd").children(".num-qtd").html(qtd)

        valorProduto = parseFloat(precoProduto) * qtd

        $(this).closest(".div-qtd").children(".valor-produto").val(valorProduto)

        valorFinal()
    }
})

$(document).on('click', ".adicionar-qtd", function (event) {
    event.preventDefault();
    let qtd = $(this).closest(".div-qtd").children(".num-qtd").html()
    const precoProduto = $(this).closest(".div-qtd").children(".preco-produto").val().replace(",", ".")
    let valorProduto = ''

    qtd = parseInt(qtd) + 1
    valorProduto = parseFloat(precoProduto) * qtd

    $(this).closest(".div-qtd").children(".num-qtd").html(qtd)
    $(this).closest(".div-qtd").children(".valor-produto").val(valorProduto)

    valorFinal()
})

function valorFinal() {
    let valorFinal = 0

    $(".valor-produto").each(function (index, valorProduto) {
        valorFinal = valorFinal + parseFloat($(valorProduto).val().replace(",", ".")) 
    })

    $("#valor-final").html(valorFinal)
    // $("#valor-final").html().replace(".", ",")
}

$(function () {
    $("#form-checkout").on('submit', function (event) {
        event.preventDefault();
        comprar();
    })
})

function comprar() {

    let aux = false;

    $("input[name=id_tipo_pag]").each((index, element) => {
        if (element.checked) {
            aux = true;
        }
    });
    if (!aux) {
        alert("Selecione um tipo de pagamento.");
        return
    }

    let produtos = []

    // array

    const url = 'backend/venda/salvarController.php'

    let data = {
        id_tipo_pag: $("input[name=id_tipo_pag]:checked").val(),
        id_vendedor: $("#id-vendedor").val(),
        produtos: produtos
    }

    console.log(data)

    $.ajax({
        url: url,
        type: 'post',
        dataType: 'json',
        data: data,
        success: function (retorno) {
            console.log(retorno)
            if (retorno.cod === 0) {
                $("#msg-compra-finalizada").html(retorno.msg)
                $("#modal_compra_finalizada").modal("show")
            } else {
                alert(retorno.msg)
            }
        }
    })
}