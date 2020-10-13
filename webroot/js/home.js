$(document).ready(function () {
    // Use Strict
    "use strict";

    // Iniciamos objeto login
    Login.init();
});

// Objeto login
let Login = {
    // Constructor
    init: function () {
        // LLamada a eventos
        this.events();
    },
    // Eventos
    events: function () {
        // Evento mostrar contraseña
        $(".input-icon").on("click", function (event) {
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
    }
};