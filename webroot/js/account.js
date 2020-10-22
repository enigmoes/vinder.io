$(document).ready(function () {
    // Use Strict
    "use strict";

    // Iniciamos objeto login
    Account.init();
});

// Objeto login
let Account = {
    // Constructor
    init: function () {
        // LLamada a eventos
        this.events();
    },
    // Eventos
    events: function () {
        // Evento mostrar formulario perfil
        $("#lista li").on("click", function (event) {
            $("#lista li").removeClass("active");
            $(this).addClass("active");
        });
        // Evento mostrar formulario correo
        /*$("#correo").on("click", function (event) {
            $("#lista li").removeClass("active");
            $(this).addClass("active");
        });
        // Evento mostrar formulario contraseña
        $("#pass").on("click", function (event) {
            $("#lista li").removeClass("active");
            $(this).addClass("active");
        });*/
    }
};