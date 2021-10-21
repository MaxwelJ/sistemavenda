function abrirModalEdit(id) {
    $("#nome-edit").val('')
    $("#quantidade-edit").val('')

    $.ajax({
        url: 'backend/produtos/produtos.php',
        type: 'get',
        dataType: 'json',
        data: {
            id: id
        },
        success: function (data) {
            console.log(data);
            $("#id-edit").val(data.id)
            $("#nome-edit").val(data.nome)
            $("#quantidade-edit").val(data.quantidade)
        },
        error: function () {
            alert("Deu erro ao salvar.")
        }
    })
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
        url: 'backend/produtos/salvar.php',
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
    $("#quantidade-create").val('')
    $('#modal_produtos_create').modal("show")
}

function abrirModalView(id) {
    $("#nome-view").val('')
    $("#quantidade-view").val('')

    $.ajax({
        url: 'backend/produtos/produtos.php/',
        type: 'get',
        dataType: 'json',
        data: {
            id: id
        },
        success: function (data) {
            console.log(data);
            $("#id-view").val(data.id)
            $("#nome-view").val(data.nome)
            $("#quantidade-view").val(data.quantidade)
        },
        error: function () {
            alert("Deu erro ao salvar.")
        }
    })

    $('#modal_produtos_view').modal("show")
}



function apagar(id) {
    if (confirm('Deseja realmente apagar esse cadastro?')) {
        $.getJSON("backend/produtos/apagar.php", {
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
