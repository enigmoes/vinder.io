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
        $(".results .fa-star").on("click", function () {
            if($(this).css("color") == "gold"){
                $(this).css("color","#213e03");
            }else{
                $(this).css("color","gold");
            }
        });
        $(".fa-trash-alt").on("click", function () {
            alert("hola");
            //Results.delete();
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
