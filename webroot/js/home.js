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
        // LLamada a cargar lista
        this.loadLists();
    },
    // Eventos
    events: function () {},
    loadLists: function () {
        $.ajax({
            type: "GET",
            url: "/home/results",
            beforeSend: function (xhr) {
                xhr.setRequestHeader("X-CSRF-Token", $('[name="_csrfToken"]').val());
            },
            success: function (data) {
                $('.results').html(data);
            },
        });
    },
};
