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
        $("#perfil").on("click", function (event) {
            $("#lista li").removeClass("active");
            $(this).addClass("active");
            $("#form-correo").addClass("d-none");
            $("#form-pass").addClass("d-none");
            $("#form-perfil").removeClass("d-none");
        });
        // Evento mostrar formulario correo
        $("#correo").on("click", function (event) {
            $("#lista li").removeClass("active");
            $(this).addClass("active");
            $("#form-perfil").addClass("d-none");
            $("#form-pass").addClass("d-none");
            $("#form-correo").removeClass("d-none");
        });
        // Evento mostrar formulario contraseña
        $("#pass").on("click", function (event) {
            $("#lista li").removeClass("active");
            $(this).addClass("active");
            $("#form-correo").addClass("d-none");
            $("#form-perfil").addClass("d-none");
            $("#form-pass").removeClass("d-none");
        });
    }
};