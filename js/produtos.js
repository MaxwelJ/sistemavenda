async function abrirModalEdit(id) {
    $("#nome-edit").val('')
    $("#preco-edit").val('')
    $("#quantidade-edit").val('')

    await $.ajax({
        url: '../../backend/produtos/categoria.php',
        type: 'get',
        dataType: 'json',
        success: function (data) {
            $('#categoria-edit').html('');

            let html = `<option>- SELECIONE -</option>`;
            $(data).each(function (index, categoria){ 
                html += `<option value="${categoria.id}">${categoria.nome}</option>`
            })
        
            $('#categoria-edit').append(html)
        },
        error: function () {
            alert("Deu erro ao salvar.")
        }
    })

    await $.ajax({
        url: '../../backend/produtos/produtos.php',
        type: 'get',
        dataType: 'json',
        data: {
            id: id
        },
        success: function (data) {
            $("#id-edit").val(data.id)
            $("#nome-edit").val(data.nome)
            $("#preco-edit").val(data.preco)
            $("#quantidade-edit").val(data.quantidade)
            $("#categoria-edit").val(data.id_categoria)
        },
        error: function () {
            alert("Deu erro ao salvar.")
        }
    })

    $('#preco-edit').mask('#.##0,00', {reverse: true});
    $('#modal_produtos_edit').modal("show")
}

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
    var form = '';

    if (tipo == "create") {
        form = $("#form-cadastro-create").serialize()
    } else if (tipo == 'edit') {
        form = $("#form-cadastro-edit").serialize()
    } else {
        alert('Erro ao executar ação')
    }

    $.ajax({
        url: '../../backend/produtos/salvar.php',
        type: 'post',
        dataType: 'json',
        data: form,
        success: function (data) {
            console.log(data);
            if (data.status == true) {
                location.reload();
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

    $.ajax({
        url: '../../backend/produtos/categoria.php',
        type: 'get',
        dataType: 'json',
        success: function (data) {
            $('#categoria-create').html('');

            let html = `<option>- SELECIONE -</option>`;
            $(data).each(function (index, categoria){ 
                html += `<option value="${categoria.id}">${categoria.nome}</option>`
            })
        
            $('#categoria-create').append(html)
        },
        error: function () {
            alert("Deu erro ao salvar.")
        }
    })

    $('#preco-create').mask('#.##0,00', {reverse: true});
    $("#quantidade-create").val('')
    $('#modal_produtos_create').modal("show")
}

function abrirModalView(id) {
    $("#nome-view").val('')
    $("#preco-view").val('')
    $("#quantidade-view").val('')

    $.ajax({
        url: '../../backend/produtos/produtos.php/',
        type: 'get',
        dataType: 'json',
        data: {
            id: id
        },
        success: function (data) {
            console.log(data);
            $("#id-view").val(data.id)
            $("#nome-view").val(data.nome)
            $("#preco-view").val(data.preco)
            $("#quantidade-view").val(data.quantidade)
            $("#categoria-view").val(data.nome_cat)
        },
        error: function () {
            alert("Deu erro ao salvar.")
        }
    })
    $('#preco-view').mask('#.##0,00', {reverse: true});
    $('#modal_produtos_view').modal("show")
}



function apagar(id) {
    if (confirm('Deseja realmente apagar esse cadastro?')) {
        $.getJSON("../../backend/produtos/apagar.php", {
            id: id
        }, function (data) {
            if (data.status == true) {
                location.reload()
            } else {
                alert('Ocorreu um erro ao apagar.')
            }
        });
    }
}