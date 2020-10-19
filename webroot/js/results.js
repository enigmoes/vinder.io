$(document).ready(function () {
    // Use Strict
    "use strict";

    // Iniciamos objeto results
    Results.init();
});

// Objeto results
let Results = {
    // Constructor
    init: function () {
        // LLamada a eventos
        this.events();
    },
    // Eventos
    events: function () {
        $(".fa-star").on("click", function () {
            //Results.delete();
            alert("hola");
            //$(this).css("color","yellow");
        });
        $(".fa-trash-alt").on("click", function () {
            alert("hola");
            //$(this).css("color","yellow");
        });
    },
    delete: function () {
        $.ajax({
            type: "GET",
            url: "/home/delete",
            beforeSend: function (xhr) {
                xhr.setRequestHeader(
                    "X-CSRF-Token",
                    $('[name="_csrfToken"]').val()
                );
            },
            success: function (data) {
                $(".results").html(data);
            },
        });
    },
};
