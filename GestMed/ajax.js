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

function myAlert(value) {
    switch (value) {
        case 1:
            swal({
                type: "success",
                title: "Usuario creado con éxito",
                confirmButtonText: "Aceptar"
            }).then(function () {

                window.location = 'index.php';
            });
            break;
        case 2:
            swal({
                type: "success",
                title: "Usuario modificado con éxito",
                confirmButtonText: "Aceptar"
            }).then(function () {
                window.location = 'index.php';
            });
            break;
        case 3:
            swal({
                type: "success",
                title: "Usuario eliminado con éxito",
                confirmButtonText: "Aceptar"
            });
            break;
        case 4:
            swal({
                type: "error",
                title: "Usuario modificado con éxito",
                confirmButtonText: "Aceptar"
            });
    }

    //window.location = 'proto.php';
}

/**$(document).ready(function() {
    $("#editConfirm").click(function (event) {
        if (!confirm('¿Desea guardar los cambios?')) {
            event.preventDefault();
        }
    });
});*/

$(document).ready(function() {

    $('#editForm').on('submit', function(e) {
        var url = "edit.php";

        swal({
            title: "¿Desea guardar los cambios?",
            type: "question",
            showCancelButton: true,
            confirmButtonText: "Sí",
            cancelButtonText: "No",
            confirmButtonClass: 'btn btn-info',
            cancelButtonClass: 'btn btn-default',
            reverseButtons: true
        }).then(function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: $("#editForm").serialize()
                });
            }
        });
    });
});

$(document).on('click', '.delete', function() {
    var id = $(this).attr('id');

    swal({
        title: "¿Está seguro de que desea eliminar este usuario?",
        text: "Esta acción es irreversible. Esto eliminará completamente al usuario y todos sus datos.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DB524B",
        confirmButtonText: "Sí, deseo eliminarlo",
        cancelButtonText: "Cancelar",
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        reverseButtons: true
    }).then(function(result) {
        if (result.value) {
            $.ajax({
                type: "GET",
                url: "delete.php",
                data: "NColegiado=" + id,
                dataType: "html",
                cache: false,
                success: function () {
                    $('#' + id).closest('tr').remove();
                }
            });
        }
    })
});