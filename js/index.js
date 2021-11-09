$(document).ready(function () {
    $(".cpf").mask("000.000.000-00")
    $(".data").each(function (index, data) {
        let parts = $(data).html().split('-');

        let newData = parts[2] + '/' + parts[1] + '/' + parts[0]

        $(data).html(newData)
    });
    $(".data-dismiss").each(function () {
        $(this).modal("hide")
    })
});

function abrirModalDetalhes(id) {
    $("#nome-detalhes").html('')
    $("#preco-detalhes").html('')
    $("#quantidade-detalhes").html('')
    $("#imagem-preview-detalhes").prop('src', '')
    $('#descricao-detalhes').html('')

    $.ajax({
        url: 'backend/produtos/produtosController.php/',
        type: 'get',
        dataType: 'json',
        data: {
            id: id
        },
        success: function (data) {
            console.log(data);
            $("#id-detalhes").html(data.id)
            $("#nome-detalhes").html(data.nome)
            $("#preco-detalhes").html(data.preco)
            $("#quantidade-detalhes").html(data.quantidade)
            $("#categoria-detalhes").html(data.nome_cat)
            $("#imagem-preview-detalhes").prop('src', data.imagem)
            $('#descricao-detalhes').html(data.descricao)
        },
        error: function () {
            alert("Deu erro ao salvar.")
        }
    })
    $('#preco-detalhes').mask('#.##0,00', { reverse: true });
    $('#modal_detalhes').modal("show")
}
