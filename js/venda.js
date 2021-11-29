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
            // $("#preco-total-view").html(data.itens_venda.valor_venda)

            $("#produtos-view").html('')
            let html = ``

            $("#preco-total-view").html('')
            let precoTotalView = 0

            // console.log(data.itens_venda);
            $(data.itens_venda).each(function (index, produto) {
                html +=
                    `<tr>
                        <td>${produto.coditem}</td>
                        <td>${produto.codproduto}</td>
                        <td>${produto.nomeproduto}</td>
                        <td>R$ <span class="preco-view">${produto.valorvenda}</span></td>
                        <td>${produto.nomecategoria}</td>
                        <td>${produto.quantidade}</td>
                    </tr>`

                    precoTotalView += parseFloat(produto.valorvenda * produto.quantidade)
            })

            $("#produtos-view").append(html)

            $("#preco-total-view").html(precoTotalView.toFixed(2).toString().replace(".", ","))
        },
        error: function () {
            alert("Deu erro ao salvar.")
        }
    }).done(function (){
        $(".preco-view").each( function () {
            let html = parseFloat($(this).html()).toFixed(2)
            html = html.toString().replace(".", ",")
            
            $(this).html(html)
        })
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

$(document).on('click', ".remover-item", function (event) {
    event.preventDefault();
    let carrinho = sessionStorage.getItem("carrinho")
    let idProduto = $(this).closest(".div-qtd").children(".id-produto").val()
    let novoCarrinho = []

    if (carrinho) {
        carrinho = JSON.parse(carrinho)

        $(carrinho).each(function (index, item) {
            if (idProduto != item) {
                novoCarrinho.push(item)
            }
        })

        novoCarrinho = JSON.stringify(novoCarrinho)

        sessionStorage.setItem("carrinho", novoCarrinho)

        $(this).closest(".div-qtd").parent().parent().remove()

        contCarrinho()
        valorFinal()
    }
})

function valorFinal() {
    let valorFinal = 0

    $(".valor-produto").each(function (index, valorProduto) {
        valorFinal = valorFinal + parseFloat($(valorProduto).val().replace(",", ".")) 
    })

    valorFinal = valorFinal.toFixed(2).toString().replace(".", ",")
   
    $("#valor-final").html(valorFinal)
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

    let produtos = JSON.parse(sessionStorage.getItem("carrinho"))

    let quantidade = []

    $(".num-qtd").each(function (index, qtd){
        quantidade[index] = parseInt($(qtd).html())
    })

    let precoVenda = []

    $(".preco-produto").each(function (index, preco) {
        precoVenda[index] = parseFloat($(preco).val())
    })

    // console.log(quantidade); return

    const url = 'backend/venda/salvarController.php'

    let data = {
        id_tipo_pag: $("input[name=id_tipo_pag]:checked").val(),
        id_vendedor: $("#id-vendedor").val(),
        quantidade: quantidade,
        produtos: produtos,
        precoVenda: precoVenda
    }

    // console.log(data); return

    $.ajax({
        url: url,
        type: 'post',
        dataType: 'json',
        data: data,
        success: function (retorno) {
            // console.log(retorno)
            if (retorno.cod === 0) {
                $("#msg-compra-finalizada").html(retorno.msg)
                $("#modal_compra_finalizada").modal("show")
                
                sessionStorage.removeItem("carrinho")
            } else {
                alert(retorno.msg)
            }
        }
    })
}