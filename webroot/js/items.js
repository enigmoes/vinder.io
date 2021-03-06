$(document).ready(function () {
    // Use Strict
    "use strict";

    // Iniciamos objeto Items
    Items.init();
});

// Objeto Items
let Items = {
    // Constructor
    init: function () {
        // LLamada a inicializacion atributos
        this.attributes();
        // LLamada a eventos
        this.events();
        // LLamada a cargar items
        this.loadItems();
        limit = 6;
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
            Items.isFav(url, $(this));
        });

        //Evento para eliminar items
        $(document).on("click", ".delete-item", function () {
            let url = $(this).data("url");
            let message = $(this).data("message");
            let ok = $(this).data("ok");
            let cancel = $(this).data("cancel");
            let data = { url: url, message: message, ok: ok, cancel: cancel };
            Items.delete(data);
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
            Items.toast.fire({
                icon: "success",
                title: "Enlace copiado",
            });
        });

        // Añadir items con el input desplegable
        $(document).on("click", ".btn-add", function () {
            let url = $(".input-custom").val();
            Items.add(url);
            $(".input-custom").val("");
        });

        // Buscar items con el buscador desplegable
        $(document).on("click", ".btn-search", function () {
            let valorBusqueda = $(".input-custom").val();
            sessionStorage.setItem("search", valorBusqueda);
            Items.searchItems(valorBusqueda);
        });
        
        // Eliminar texto del input desplegable al pulsar cancelar
        $(document).on("click", ".btn-cancel", function () {
            sessionStorage.removeItem("search");
            $(".input-custom").val("");
            Items.loadItems();
        });

        // Evento para ocultar botón guardar al añadir un item
        $(document).on("click", ".btn-add", function () {
            $("#input-custom").addClass("d-none");
            $(".navbar-icons").removeClass("d-none");
        });

        // Evento para ordenar items
        $(document).on("change", ".order-items .select2", function () {
            let valor = $(this).val();
            sessionStorage.setItem("order", valor);
            Items.orderItems(valor);
        });

        // Scroll infinito
        $(window).scroll(function () {
            let pos = $(window).scrollTop() - 100;
            let bottom = ($(document).height() - $(window).height()) - 100;
            if (pos >= bottom) {
                Items.infiniteScroll();
            }
        });
    },
    // Cargar items
    loadItems: function () {
        let order = sessionStorage.getItem("order");
        $.ajax({
            type: "GET",
            url: "/items/results",
            data: { order: order },
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
    // Añadir items
    add: function (url) {
        $.ajax({
            type: "GET",
            url: "/items/add/",
            data: { url: url },
            beforeSend: function (xhr) {
                xhr.setRequestHeader(
                    "X-CSRF-Token",
                    $('[name="_csrfToken"]').val()
                );
                Items.toast.fire({
					icon: "info",
					title: " Cargando...",
					timer: false
				});
				Swal.showLoading();
            },
            success: function (data) {
                if (data.saved) {
                    Items.loadItems();
                    Items.toast.fire({
                        icon: "success",
                        title: data.message,
                    });
                } else {
                    Items.toast.fire({
                        icon: "error",
                        title: data.message,
                    });
                }
            },
        });
    },
    // Eliminar items
    delete: function (data) {
        Swal.fire({
            title: data.message,
            icon: "question",
            showCancelButton: true,
            confirmButtonText: data.ok,
            cancelButtonText: data.cancel,
            customClass: "custom-sweet-alert",
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
                            Items.loadItems();
                            Items.toast.fire({
                                icon: "success",
                                title: data.message,
                            });
                        } else {
                            Items.toast.fire({
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
    isFav: function (url, element) {
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
                    Items.toast.fire({
                        icon: "success",
                        title: data.message,
                    });
                    element.toggleClass("isFav");
                } else {
                    Items.toast.fire({
                        icon: "error",
                        title: data.message,
                    });
                }
            },
        });
    },
    // Buscar items por título
    searchItems: function (search) {
        let order = sessionStorage.getItem("order");
        $.ajax({
            url: "/items/results/",
            type: "GET",
            data: { search: search, order: order},
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
        let search = sessionStorage.getItem("search");
        $.ajax({
            url: "/items/results/",
            type: "GET",
            data: { order: order,  search: search},
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
    // Scroll infinito
    infiniteScroll: function () {
        let search = sessionStorage.getItem("search");
        let order = sessionStorage.getItem("order");
        // Ultimo item
        let last = $('.item').last().data('number');
        let count = ($('.count').data('count') - 1);
        if (last < count) {
            $('.charge-img').addClass('d-block');
            $.ajax({
                url: "/items/results/",
                type: "GET",
                data: {limit : limit, search: search, order: order},
                beforeSend: function (xhr) {
                    xhr.setRequestHeader(
                        "X-CSRF-Token",
                        $('[name="_csrfToken"]').val()
                    );
                },
                success: function (response) {
                    $(".results").html(response);
                    $('.charge-img').addClass('d-none');
                    $('.charge-img').removeClass('d-block');
                    limit = limit + 6;
                }
            });
        }
    },
};
