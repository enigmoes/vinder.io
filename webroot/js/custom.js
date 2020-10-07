$(document).ready(function () {
    // Use Strict
    "use strict";
    
    // Al hacer click en una fila de la tabla abrir en pestaña
    $(".tr-edit").on("click", function() {
        let url = $(this).data("url");
        document.cookie = 'back=' + location.href;
        location.href = url;
    });

    // Al hacer click en una fila de la tabla (se abre en nueva ventana)
    $(".tr-edit-blank").on("click", function() {
        let url = $(this).data("url");
        window.open(url, '_blank');
    });

    // Acción eliminar
    $(".delete-link").on("click", function(event) {
        event.stopPropagation();
        let url = $(this).data("url");
        let msg = $(this).data("msg");
        Swal.fire({
            title: msg,
            icon: "warning",
            showCancelButton: true,
            //confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar",
        }).then(result => {
            if (result.value) {
                location.href = url;
            }
        });
    });

    // Preguntar al volver
    $('.back-alert').on('click', function (event) {
        event.preventDefault();
        let url = $(this).attr('href');
        let saved = $(this).parents('.container').find('.alert-success');
        if (saved.length == 0) {
            Swal.fire({
                title: '¿Desea salir sin guardar?',
                icon: "question",
                showCancelButton: true,
                cancelButtonColor: "#d33",
                confirmButtonText: "Aceptar",
                cancelButtonText: "Cancelar",
            }).then(result => {
                if (result.value) {
                    location.href = url;
                }
            });
        } else {
            location.href = url;
        }
    });
});
