
$(document).ready(function() {
    $(".cpf").mask("000.000.000-00")
    $(".data").each(function(index, data) {
        let parts = $(data).html().split('-');

        let newData = parts[2] + '/' + parts[1] + '/' + parts[0]

        $(data).html(newData)
    });
    $(".data-dismiss").each(function() {
        $(this).modal("hide")
    })
});

