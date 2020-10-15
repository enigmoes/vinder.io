$(document).ready(function () {
    // Use Strict
    "use strict";

    // Iniciamos objeto Custom
    Custom.init();
});

// Objeto custom
let Custom = {
    // Constructor
    init: function () {
        // LLamada a eventos
        this.events();
    },
    // Eventos
    events: function () {
        // Llamada a eventos generales
        this.generalEvents();
        // Llamada a eventos de navbar
        this.navbarEvents();
    },
    generalEvents: function () {
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
    },
    navbarEvents: function () {
        // Evento desplegar input buscar
        $(".fa-search").on("click", function (event) {
            $("#input-custom").removeClass("d-none");
            $(".navbar-icons").addClass("d-none");
        });
        // Evento desplegar input guardar
        $(".fa-plus").on("click", function (event) {
            $("#input-custom").removeClass("d-none");
            $(".navbar-icons").addClass("d-none");
            $(".input-custom").attr(
                "placeholder",
                "Guardar una URL https//..."
            );
            $(".btn-input-custom1").text("Guardar");
        });
        $(".btn-input-custom1").on("click", function (event) {
            $("#input-custom").addClass("d-none");
            $(".navbar-icons").removeClass("d-none");
        });
        $(".btn-input-custom2").on("click", function (event) {
            $("#input-custom").addClass("d-none");
            $(".navbar-icons").removeClass("d-none");
        });
    }
}
