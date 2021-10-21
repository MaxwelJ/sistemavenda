$(document).ready(function() {
    $(".cpf").mask("000.000.000-00")
    $(".data").each(function() {
        var data = new Date($(this).html()).toLocaleDateString();
        $(this).html(data)
    });
    $(".data-dismiss").each(function() {
        $(this).modal("hide")
    })
});

