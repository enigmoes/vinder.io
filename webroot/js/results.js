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
        // LLamada a inicializacion atributos
        this.attributes();
        // LLamada a eventos
        this.events();
        // LLamada a cargar lista
        this.loadLists();
        // LLamada a favoritos
        this.favourites();
    },
    attributes: function () {
        this.toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        });
    },
    // Eventos
    events: function () {
        $(document).on("click", ".favItem", function () {
            if($(this).css("color","#213e03")){
                $(this).css("color","gold");
            }else{
                $(this).css("color","#213e03");
            }
        });
        $(document).on("click", ".deleteItem", function () {
            let url = $(this).data('url');
            let message = $(this).data('message');
            let ok = $(this).data('ok');
            let cancel = $(this).data('cancel');
            let data = {url: url, message: message, ok: ok, cancel: cancel};
            Results.delete(data);
        });
    },
    loadLists: function () {
        $.ajax({
            type: "GET",
            url: "/home/results",
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
    delete: function (data) {
        Swal.fire({
            title: data.message,
            icon: "question",
            showCancelButton: true,
            cancelButtonColor: "#d33",
            confirmButtonText: data.ok,
            cancelButtonText: data.cancel,
        }).then(result => {
            if (result.value) {
                $.ajax({
                    type: "GET",
                    url: data.url,
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader("X-CSRF-Token", $('[name="_csrfToken"]').val());
                    },
                    success: function (data) {
                        if (data.deleted) {
                            Results.loadLists();
                            Results.toast.fire({
                                icon: "success",
                                title: data.message
                            });
                        } else {
                            Results.toast.fire({
                                icon: "error",
                                title: data.message
                            });
                        }
                    },
                });
            }
        });
    },
    favourites: function () {
        $.ajax({
            type: "GET",
            url: "/favourites/results",
            beforeSend: function (xhr) {
                xhr.setRequestHeader(
                    "X-CSRF-Token",
                    $('[name="_csrfToken"]').val()
                );
            },
            success: function (data) {
                $(".resultsFavs").html(data);
            },
        });
    },
};
