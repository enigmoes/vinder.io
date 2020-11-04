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
        $(".delete-link").on("click", function (event) {
            event.stopPropagation();
            let url = $(this).data("url");
            let msg = $(this).data("msg");
            Swal.fire({
                title: msg,
                icon: "warning",
                showCancelButton: true,
                cancelButtonColor: "#d33",
                confirmButtonText: "Aceptar",
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.value) {
                    location.href = url;
                }
            });
        });
        // Preguntar al volver
        $(".back-alert").on("click", function (event) {
            event.preventDefault();
            let url = $(this).attr("href");
            let saved = $(this).parents(".container").find(".alert-success");
            if (saved.length == 0) {
                Swal.fire({
                    title: "¿Desea salir sin guardar?",
                    icon: "question",
                    showCancelButton: true,
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Aceptar",
                    cancelButtonText: "Cancelar",
                }).then((result) => {
                    if (result.value) {
                        location.href = url;
                    }
                });
            } else {
                location.href = url;
            }
        });
        // Evento mostrar contraseña
        $(".show-password, .show-password-label").on("click", function () {
            let $input = $(this).siblings().find("input");
            if ($input.attr("type") === "password") {
                $input.attr("type", "text");
                $(this).removeClass("fas fa-eye");
                $(this).addClass("fas fa-eye-slash");
            } else {
                $input.attr("type", "password");
                $(this).removeClass("fas fa-eye-slash");
                $(this).addClass("fas fa-eye");
            }
        });
        // Evento compartir enlaces
        $(document).on("click", ".share-link", function () {
            let url = $(this).data("url");
            window.open(url);
        });
    },
    navbarEvents: function () {
        // Evento desplegar input buscar
        $(".search-navbar").on("click", function () {
            $("#input-custom").removeClass("d-none");
            $(".navbar-icons").addClass("d-none");
            $(".input-custom").attr("placeholder", "Buscar...");
            $(".btn-input-custom1").text("Buscar");
        });
        // Evento desplegar input guardar
        $(".fa-plus").on("click", function () {
            $("#input-custom").removeClass("d-none");
            $(".navbar-icons").addClass("d-none");
            $(".input-custom").attr(
                "placeholder",
                "Guardar una URL https//..."
            );
            $(".btn-input-custom1").text("Guardar");
        });
        $(".btn-input-custom1").on("click", function () {
            $("#input-custom").addClass("d-none");
            $(".navbar-icons").removeClass("d-none");
        });
        $(".btn-input-custom2").on("click", function () {
            $("#input-custom").addClass("d-none");
            $(".navbar-icons").removeClass("d-none");
        });
    },
};
