$(document).ready(function () {
    // Use Strict
    "use strict";

    // Iniciamos objeto Favourites
    Favourites.init();
});

// Objeto Favourites
let Favourites = {
    // Constructor
    init: function () {
        // LLamada a inicializacion atributos
        this.attributes();
        // LLamada a eventos
        this.events();
        // LLamada a cargar favoritos
        this.loadFavourites();
    },
    attributes: function () {
        this.toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        });
    },
    // Eventos
    events: function () {
        //Evento para favoritos
        $(document).on("click", ".fav-item", function () {
            let url = $(this).data("url");
            Favourites.isFav(url);
        });

        //Evento para eliminar favoritos
        $(document).on("click", ".delete-item", function () {
            let url = $(this).data("url");
            let message = $(this).data("message");
            let ok = $(this).data("ok");
            let cancel = $(this).data("cancel");
            let data = { url: url, message: message, ok: ok, cancel: cancel };
            Favourites.delete(data);
        });

        //Copiar enlace al portapapeles
        $(document).on("click", ".copy-link", function () {
            let url = $(this).data("url");
            let $temp = $("<input>");
            $temp.attr("value", url);
            $("body").append($temp);
            $temp.select();
            document.execCommand("copy");
            $temp.remove();
            Favourites.toast.fire({
                icon: "success",
                title: "Enlace copiado",
            });
        });

        // Eliminar texto del input desplegable al pulsar cancelar
        $(document).on("click", ".btn-cancel", function () {
            $(".input-custom").val("");
            Favourites.loadFavourites();
        });

        // Buscar items con el buscador desplegable
        $(document).on("click", ".btn-search", function () {
            let valorBusqueda = $(".input-custom").val();
            Favourites.searchItems(valorBusqueda);
        });

        // Evento para ocultar botón guardar al añadir un item
        $(document).on("click", ".btn-add", function () {
            $("#input-custom").addClass("d-none");
            $(".navbar-icons").removeClass("d-none");
        });

        // Evento para ordenar items
        $(document).on("change", ".order-items .select2", function () {
            let valor = $(this).val();
            Favourites.orderItems(valor);
        });
    },
    // Cargar favoritos
    loadFavourites: function () {
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
                $(".results").html(data);
            },
        });
    },
    // Eliminar Favourites
    delete: function (data) {
        Swal.fire({
            title: data.message,
            icon: "question",
            showCancelButton: true,
            cancelButtonColor: "#d33",
            confirmButtonText: data.ok,
            cancelButtonText: data.cancel,
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "GET",
                    url: data.url,
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader(
                            "X-CSRF-Token",
                            $('[name="_csrfToken"]').val()
                        );
                    },
                    success: function (data) {
                        if (data.deleted) {
                            Favourites.loadFavourites();
                            Favourites.toast.fire({
                                icon: "success",
                                title: data.message,
                            });
                        } else {
                            Favourites.toast.fire({
                                icon: "error",
                                title: data.message,
                            });
                        }
                    },
                });
            }
        });
    },
    // Añadir a favoritos
    isFav: function (url) {
        $.ajax({
            type: "GET",
            url: url,
            beforeSend: function (xhr) {
                xhr.setRequestHeader(
                    "X-CSRF-Token",
                    $('[name="_csrfToken"]').val()
                );
            },
            success: function (data) {
                if (data.success) {
                    Favourites.loadFavourites();
                    Favourites.toast.fire({
                        icon: "success",
                        title: data.message,
                    });
                } else {
                    Favourites.toast.fire({
                        icon: "error",
                        title: data.message,
                    });
                }
            },
        });
    },
    // Buscar items por título
    searchItems: function (search) {
        $.ajax({
            url: "/favourites/results/",
            type: "GET",
            data: { search: search },
            beforeSend: function (xhr) {
                xhr.setRequestHeader(
                    "X-CSRF-Token",
                    $('[name="_csrfToken"]').val()
                );
            },
            success: function (response) {
                $(".results").html(response);
            }
        });
    },
    // Ordenar items
    orderItems: function (order) {
        $.ajax({
            url: "/favourites/results/",
            type: "GET",
            data: { order: order },
            beforeSend: function (xhr) {
                xhr.setRequestHeader(
                    "X-CSRF-Token",
                    $('[name="_csrfToken"]').val()
                );
            },
            success: function (response) {
                $(".results").html(response);
            }
        });
    },
};
