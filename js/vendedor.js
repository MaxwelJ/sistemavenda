function abrirModalEdit(id) {
    $("#cpf-edit").mask("000.000.000-00")
    $("#nome-edit").val('')
    $("#cpf-edit").val('')
    $("#data-nasc-edit").val('')

    $.ajax({
        url: '../../backend/vendedor/vendedorController.php',
        type: 'get',
        dataType: 'json',
        data: {
            id: id
        },
        success: function (data) {
            console.log(data);
            $("#id-edit").val(data.id)
            $("#nome-edit").val(data.nome)
            $("#cpf-edit").val(data.cpf)
            $("#data-nasc-edit").val(data.data_nasc)
        },
        error: function () {
            alert("Deu erro ao salvar.")
        }
    })
    $('#modal_vendedor_edit').modal("show")
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
        url: '../../backend/vendedor/salvarController.php',
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
    $("#cpf-create").val('')
    $("#cpf-create").mask("000.000.000-00")
    $("#data-nasc-create").val('')
    $('#modal_vendedor_create').modal("show")
}

function abrirModalView(id) {
    $("#nome-view").val('')
    $("#cpf-view").val('')
    $("#data-nasc-view").val('')

    $.ajax({
        url: '../../backend/vendedor/vendedorController.php/',
        type: 'get',
        dataType: 'json',
        data: {
            id: id
        },
        success: function (data) {
            console.log(data);
            $("#id-view").val(data.id)
            $("#nome-view").val(data.nome)
            $("#cpf-view").val(data.cpf)
            $("#data-nasc-view").val(data.data_nasc)
        },
        error: function () {
            alert("Deu erro ao salvar.")
        }
    })
    $("#cpf-view").mask("000.000.000-00")
    $('#modal_vendedor_view').modal("show")
}



function apagar(id) {
    if (confirm('Deseja realmente apagar esse cadastro?')) {


        $.getJSON("../../backend/vendedor/apagarController.php", {
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
