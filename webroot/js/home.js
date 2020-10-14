$(document).ready(function () {
    // Use Strict
    "use strict";

    // Iniciamos objeto home
    Home.init();
});

// Objeto home
let Home = {
    // Constructor
    init: function () {
        // LLamada a eventos
        this.events();
    },
    // Eventos
    events: function () {
        window.onload = function () {
            Cargar();    
        }
        // Evento desplegar input buscar
        $(".fa-search").on("click", function (event) {
            $("#input-custom").removeClass("d-none");
            $(".navbar-icons").addClass("d-none");
        });
        // Evento desplegar input guardar
        $(".fa-plus").on("click", function (event) {
            $("#input-custom").removeClass("d-none");
            $(".navbar-icons").addClass("d-none");
            $(".input-custom").attr("placeholder","Guardar una URL https//...");
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
    },
};