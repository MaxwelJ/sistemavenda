async function abrirModalEdit(id) {
    $("#nome-edit").val('')
    $("#preco-edit").val('')
    $("#quantidade-edit").val('')
    $("#imagem-edit").prop('src', '')
    $('#descricao-edit').val('')

    await $.ajax({
        url: '../../backend/produtos/categoriaController.php',
        type: 'get',
        dataType: 'json',
        success: function (data) {
            $('#categoria-edit').html('');

            let html = `<option>- SELECIONE -</option>`;
            $(data).each(function (index, categoria) {
                html += `<option value="${categoria.id}">${categoria.nome}</option>`
            })
            
            $('#categoria-edit').append(html)
        },
        error: function () {
            alert("Deu erro ao salvar.")
        }
    })

    await $.ajax({
        url: '../../backend/produtos/produtosController.php',
        type: 'get',
        dataType: 'json',
        data: {
            id: id
        },
        success: function (data) {
            $("#id-edit").val(data.id)
            $("#nome-edit").val(data.nome)
            $("#preco-edit").val(data.preco.includes(".") ? data.preco : data.preco + ",00")
            $("#quantidade-edit").val(data.quantidade)
            $("#categoria-edit").val(data.id_categoria)
            $("#imagem-preview-edit").prop('src', '../../' + data.imagem)
            $('#descricao-edit').val(data.descricao)
        },
        error: function () {
            alert("Deu erro ao salvar.")
        }
    }).done(function (){
        $('#preco-edit').mask('#.##0,00', { reverse: true });
    })

    $('#modal_produtos_edit').modal("show")
}

function atualizarImagem(tipo) {
    let preview = ''
    let imagem = ''

    if (tipo === 1) {
        imagem = $("#imagem-create").get(0).files[0]
        preview = $("#imagem-preview-create")
    } else {
        imagem = $("#imagem-edit").get(0).files[0]
        preview = $("#imagem-preview-edit")
    }

    let reader = new FileReader()

    reader.onloadend = function () {
        preview.prop('src', reader.result)
    }

    if (imagem) {
        reader.readAsDataURL(imagem)
    } else {
        preview.prop('src', '')
    }
}

// Botão Salvar

$(function () {
    $("#form-cadastro-edit").on('submit', function (event) {
        event.preventDefault();
        salvar('edit');
    })

    $("#form-cadastro-create").on('submit', function (event) {
        event.preventDefault();
        salvar('create');
    })
})

function salvar(tipo) {
    var form = [];

    if (tipo == "create") {
        form = new FormData($("#form-cadastro-create")[0])
        console.log(form)
    } else if (tipo == 'edit') {
        form = new FormData($("#form-cadastro-edit")[0])
    } else {
        alert('Erro ao executar ação')
    }

    $.ajax({
        url: '../../backend/produtos/salvarController.php',
        type: 'post',
        processData: false,
        contentType: false,
        dataType: 'json',
        data: form,
        success: function (data) {
            // console.log(data);

            if (data.cod == 1) {
                alert(data.msg)
            } else {
                if (data.status == true) {
                    location.reload();
                }
            }
        },
        error: function () {
            alert("Deu erro ao salvar.")
        }
    })
}

function abrirModalCreate() {
    $("#nome-create").val('')
    $("#preco-create").val('')
    $("#quantidade-create").val('')
    $("#imagem-create").val('')
    $("#imagem-preview-create").prop('src', '')
    $("#descricao-create").val('')

    $.ajax({
        url: '../../backend/produtos/categoriaController.php',
        type: 'get',
        dataType: 'json',
        success: function (data) {
            $('#categoria-create').html('');

            let html = `<option>- SELECIONE -</option>`;
            $(data).each(function (index, categoria) {
                html += `<option value="${categoria.id}">${categoria.nome}</option>`
            })

            $('#categoria-create').append(html)
        },
        error: function () {
            alert("Deu erro ao salvar.")
        }
    })

    $('#preco-create').mask('#.##0,00', { reverse: true });
    $('#modal_produtos_create').modal("show")
}

function abrirModalView(id) {
    $("#nome-view").val('')
    $("#preco-view").val('')
    $("#quantidade-view").val('')
    $("#imagem-preview-view").prop('src', '')
    $("#descricao-view").val('')

    $.ajax({
        url: '../../backend/produtos/produtosController.php/',
        type: 'get',
        dataType: 'json',
        data: {
            id: id
        },
        success: function (data) {
            // console.log(data);
            $("#id-view").val(data.id)
            $("#nome-view").val(data.nome)
            $("#preco-view").val(data.preco.includes(".") ? data.preco : data.preco + ",00")
            $("#quantidade-view").val(data.quantidade)
            $("#categoria-view").val(data.nome_cat)
            $("#imagem-preview-view").prop('src', '../../' + data.imagem)
            $("#descricao-view").val(data.descricao)
        },
        error: function () {
            alert("Deu erro ao salvar.")
        }
    }).done(function () {
        $("#preco-view").mask('#.##0,00', { reverse: true })
    })

    $('#modal_produtos_view').modal("show")
}



function apagar(id) {
    if (confirm('Deseja realmente apagar esse cadastro?')) {
        $.getJSON("../../backend/produtos/apagarController.php", {
            id: id
        }, function (data) {
            console.log(data)
            if (data.status == true) {
                location.reload()
            } else {
                alert('Ocorreu um erro ao apagar.')
            }
        });
    }
}