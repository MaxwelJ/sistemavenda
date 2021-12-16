$(document).ready(function () {
    $(".cpf").mask('000.000.000-00')
    $(".data").each(function (index, data) {
        let parts = $(data).html().split('-');

        let newData = parts[2] + '/' + parts[1] + '/' + parts[0]

        $(data).html(newData)
    });
    
    $('.preco').mask('#.##0,00', {reverse: true});   

    $(".data-dismiss").each(function () {
        $(this).modal('hide')
    })

    $(".fechar_compra").on("click", function () {
        location.reload()
    });
    contCarrinho()
});

function abrirModalDetalhes(id) {
    $("#nome-detalhes").html('')
    $("#preco-detalhes").html('')
    $("#quantidade-detalhes").html('')
    $("#imagem-preview-detalhes").prop('src', '')
    $("#descricao-detalhes").html('')

    $("#id-detalhes").val('') // id do produto
    $("input[name=id_tipo_pag]").prop('checked', false)
    $("#id-vendedor").val('')

    $.ajax({
        url: 'backend/produtos/produtosController.php/',
        type: 'get',
        dataType: 'json',
        data: {
            id: id
        },
        success: function (data) {
            console.log(data);
            $("#id-detalhes").val(data.id)
            $("#nome-detalhes").html(data.nome)
            $("#preco-detalhes").html(data.preco.includes(".") ? data.preco : data.preco + ",00")
            $("#quantidade-detalhes").html(data.quantidade)
            $("#categoria-detalhes").html(data.nome_cat)
            $("#imagem-preview-detalhes").prop('src', data.imagem)
            $("#descricao-detalhes").html(data.descricao)
        },
        error: function () {
            alert("Deu erro ao salvar.")
        }
    }).done(function () {
        $("#preco-detalhes").mask('#.##0,00', { reverse: true });
    })
    $("#modal_detalhes").modal("show")
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

    alert("Produto foi adicionado ao carrinho com sucesso!")
    $('#modal_detalhes').modal('hide')
    contCarrinho()
}

function abrirModalCheckout() {
    contCarrinho()

    let carrinho = sessionStorage.getItem("carrinho")
    carrinho = JSON.parse(carrinho)

    if (!carrinho || carrinho.length <= 0) {
        alert("Adicione algum produto ao carrinho!")
        return
    }

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
                            <span class="preco-carrinho">R$ ${produto.preco.includes(".") ? produto.preco : produto.preco + ",00"}</span>
                        </div>
                        <div class="col-md-5 div-qtd my-auto">
                            <input type="hidden" class="id-produto" value="${produto.id}" />
                            <button class="btn btn-sm btn-outline-danger mx-2 float-end remover-item" type="button"><i class="fa fa-times"></i> Remover</button>
                            <button class="btn btn-sm btn-outline-dark float-end diminuir-qtd" type="button"><i class="fa fa-minus"></i></button>
                            <div class="float-end mx-2 num-qtd">1</div>
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
            alert('Erro ao abrir o modal.')
        }
    }).done(function () {
        valorFinal()

        $(".preco-carrinho").each( function () {
            let html = $(this).html()
            html = html.replace(".", ",")

            $(this).html(html)
        })

    })
    $("#modal_checkout").modal("show")
}

$(document).on("click", "#adicionar-carrinho-modal", function (event) {
    event.preventDefault();
    let id_produto = parseInt($("#id-detalhes").val())
    adicionarCarrinho(id_produto)
})

function contCarrinho() {
    let carrinho = sessionStorage.getItem("carrinho")
    let cont = carrinho ? JSON.parse(carrinho).length : 0

    $("#cont").html(cont)
    // console.log(cont)
}

