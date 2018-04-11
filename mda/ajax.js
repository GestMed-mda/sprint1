jQuery(document).ready(function ($) {
    var x = $("#page").val();

    if (x === "") {
        $("#page").load("historial.php");
    }

    $(".noReload").click(function () {

        $.ajax({
            url: $(this).attr("href")
        })

            .done(function(php) {
                $("#page").empty().append(php);
            })

            .fail(function() {
                console.log("Error");
            })

            .always(function() {
                console.log("Completado");
            });

        return false;
    });
});