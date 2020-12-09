$(document).ready(function () {
    // Use Strict
    "use strict";

    // Iniciamos objeto tags
    Tags.init();
});

// Objeto results
let Tags = {
    // Constructor
    init: function () {
        // LLamada a inicializacion atributos
        this.attributes();
        // LLamada a eventos
        this.events();
        // LLamada a cargar etiquetas
        this.loadTags();
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
            Tags.isFav(url, $(this));
        });

        //Evento para eliminar items
        $(document).on("click", ".delete-item", function () {
            let url = $(this).data("url");
            let message = $(this).data("message");
            let ok = $(this).data("ok");
            let cancel = $(this).data("cancel");
            let data = { url: url, message: message, ok: ok, cancel: cancel };
            Tags.delete(data);
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
            Tags.toast.fire({
                icon: "success",
                title: "Enlace copiado",
            });
        });

        // Evento click ver items por etiqueta
        $(document).on("click", ".tag", function () {
            let id_tag = $(this).data("id");
            sessionStorage.setItem("idTag", id_tag);
            $(".tag").parent().removeClass("active");
            $(this).parent().addClass("active");
            $(".all-tags").removeClass("bg-active");
            Tags.loadItems(id_tag);
        });

        // Evento click ver todos los items
        $(document).on("click", ".all-tags", function () {
            sessionStorage.removeItem("idTag");
            $(".tag").parent().removeClass("active");
            $(this).addClass("bg-active");
            Tags.loadItems();
        });

        // Buscar tags con el buscador
        $(document).on("keyup", ".form-control-tags", function () {
            var valorBusqueda = $(this).val();
            Tags.searchTags(valorBusqueda);
        });

        //Evento para eliminar tags
        $(document).on("click", ".tag-delete", function () {
            let id = $(this).data("id");
            let url = $(this).data("url");
            let message = $(this).data("message");
            let message2 = $(this).data("message2");
            let ok = $(this).data("ok");
            let cancel = $(this).data("cancel");
            let dataContent = { id: id, url: url, message: message, message2: message2, ok: ok, cancel: cancel };
            Tags.deleteTag(dataContent);
        });

        //Evento para introducir el formulario y desplegar el modal edit
        $(document).on("click", ".tag-edit", function () {
            // Recoger id tag
            let tagId = $(this).data("id");
            let title = $(this).data("title");
            $("#modal-tag .h5-modal").text(title);
            Tags.openEditTag(tagId);
        });

        //Evento para editar tags
        $(document).on("click", ".btn-modal-edit", function () {
            // Recoger id tag
            let tagId = $(this).data("id");
            Tags.editTag(tagId);
        });

        //Evento para cargar etiquetas al cerrar el modal edit
        $(document).on("hide.bs.modal", "#modal-tag-edit", function () {
            Tags.loadTags();
        });

        //Evento para desplegar el modal create
        $(document).on("click", ".create-tag", function () {
            let title = $(this).data("title");
            $("#modal-tag .h5-modal").text(title);
            Tags.openCreateTag();
        });

        // Crear etiqueta
        $(document).on("click", ".btn-modal-create", function () {
            Tags.create();
        });

        // Buscar items con el buscador desplegable
        $(document).on("click", ".btn-search", function () {
            let valorBusqueda = $(".input-custom").val();
            sessionStorage.setItem("search", valorBusqueda);
            Tags.searchItems(valorBusqueda);
        });

        // Eliminar texto del input desplegable al pulsar cancelar
        $(document).on("click", ".btn-cancel", function () {
            sessionStorage.removeItem("search");
            $(".input-custom").val("");
            Tags.loadItems(sessionStorage.getItem("idTag"));
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
            Tags.orderItems(valor);
        });

        // Scroll infinito
        $(window).scroll(function () {
            let id_tag = sessionStorage.getItem("idTag");
            let pos = $(window).scrollTop() - 100;
            let bottom = ($(document).height() - $(window).height()) - 100;
            if (pos >= bottom) {
                Tags.infiniteScroll(id_tag);
            }
        });
    },
    // Cargar etiquetas
    loadTags: function () {
        $.ajax({
            type: "GET",
            url: "/tags/tags",
            beforeSend: function (xhr) {
                xhr.setRequestHeader(
                    "X-CSRF-Token",
                    $('[name="_csrfToken"]').val()
                );
            },
            success: function (data) {
                $(".results-tags").html(data);
                Tags.activeTag();
            },
        });
    },
    // Cargar items
    loadItems: function (id_tag = null) {
        let order = sessionStorage.getItem("order");
        (id_tag === null) ? url = "/tags/items" : url = "/tags/items/" + id_tag;
        $.ajax({
            type: "GET",
            url: url,
            data: { order: order },
            beforeSend: function (xhr) {
                xhr.setRequestHeader(
                    "X-CSRF-Token",
                    $('[name="_csrfToken"]').val()
                );
            },
            success: function (data) {
                $(".results-items").html(data);
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
                            Tags.loadItems(sessionStorage.getItem("idTag"));
                            Tags.toast.fire({
                                icon: "success",
                                title: data.message,
                            });
                        } else {
                            Tags.toast.fire({
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
                    Tags.toast.fire({
                        icon: "success",
                        title: data.message,
                    });
                    element.toggleClass("isFav");
                } else {
                    Tags.toast.fire({
                        icon: "error",
                        title: data.message,
                    });
                }
            },
        });
    },
    // Buscar tags
    searchTags: function (tag) {
        $.ajax({
            url: "/tags/tags/",
            type: "GET",
            data: { tag: tag },
            beforeSend: function (xhr) {
                xhr.setRequestHeader(
                    "X-CSRF-Token",
                    $('[name="_csrfToken"]').val()
                );
            },
            success: function (response) {
                $(".results-tags").html(response);
            },
        });
    },
    // Eliminar tag
    deleteTag: function (dataContent) {
        Swal.fire({
            title: dataContent.message,
            icon: "question",
            showCancelButton: true,
            confirmButtonText: dataContent.ok,
            cancelButtonText: dataContent.cancel,
            customClass: "custom-sweet-alert",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "GET",
                    url: "/tags/hasItems/" + dataContent.id,
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader(
                            "X-CSRF-Token",
                            $('[name="_csrfToken"]').val()
                        );
                    },
                    success: function (data) {
                        if (data.hasItems) {
                            Tags.showDeleteAlert(dataContent);
                        } else {
                            $.ajax({
                                type: "GET",
                                url: dataContent.url,
                                beforeSend: function (xhr) {
                                    xhr.setRequestHeader(
                                        "X-CSRF-Token",
                                        $('[name="_csrfToken"]').val()
                                    );
                                },
                                success: function (data) {
                                    if (data.deleted) {
                                        Tags.loadTags();
                                        Tags.activeTag();
                                        Tags.toast.fire({
                                            icon: "success",
                                            title: data.message,
                                        });
                                    } else {
                                        Tags.toast.fire({
                                            icon: "error",
                                            title: data.message,
                                        });
                                    }
                                },
                            });
                        }
                    },
                });
            }
        });
    },
    // Mostrar alert al borrar si una tag tiene items
    showDeleteAlert: function (dataContent){
        Swal.fire({
            title: dataContent.message2,
            icon: "question",
            showCancelButton: true,
            confirmButtonText: dataContent.ok,
            cancelButtonText: dataContent.cancel,
            customClass: "custom-sweet-alert",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "GET",
                    url: dataContent.url,
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader(
                            "X-CSRF-Token",
                            $('[name="_csrfToken"]').val()
                        );
                    },
                    success: function (data) {
                        if (data.deleted) {
                            Tags.loadTags();
                            Tags.activeTag();
                            Tags.toast.fire({
                                icon: "success",
                                title: data.message,
                            });
                        } else {
                            Tags.toast.fire({
                                icon: "error",
                                title: data.message,
                            });
                        }
                    },
                });
            }
        });
    },
    // Abrir modal edit
    openEditTag: function (id) {
        $.ajax({
            url: "/tags/edit/" + id,
            type: "GET",
            beforeSend: function (xhr) {
                xhr.setRequestHeader(
                    "X-CSRF-Token",
                    $('[name="_csrfToken"]').val()
                );
            },
            success: function (response) {
                $("#modal-tag .modal-body").html(response);
                $("#modal-tag").modal("show");
            },
        });
    },
    // Editar tags
    editTag: function (id) {
        let form = new FormData(document.querySelector("#form-tag-" + id));
        $.ajax({
            type: "POST",
            url: "/tags/edit/" + id,
            data: form,
            processData: false,
            contentType: false,
            beforeSend: function (xhr) {
                xhr.setRequestHeader(
                    "X-CSRF-Token",
                    $('[name="_csrfToken"]').val()
                );
            },
            success: function (data) {
                $("#modal-tag .modal-body").html(data);
                setTimeout(function () {
                    $("#modal-tag").modal("hide");
                    Tags.loadTags();
                }, 1000);
            },
        });
    },
    // Abrir modal create
    openCreateTag: function () {
        $.ajax({
            url: "/tags/create/",
            type: "GET",
            beforeSend: function (xhr) {
                xhr.setRequestHeader(
                    "X-CSRF-Token",
                    $('[name="_csrfToken"]').val()
                );
            },
            success: function (response) {
                $("#modal-tag .modal-body").html(response);
                $("#modal-tag").modal("show");
            },
        });
    },
    // Añadir etiqueta a un item
    create: function () {
        let form = new FormData(document.querySelector("#form-create"));
        $.ajax({
            type: "POST",
            url: "/tags/create/",
            data: form,
            processData: false,
            contentType: false,
            beforeSend: function (xhr) {
                xhr.setRequestHeader(
                    "X-CSRF-Token",
                    $('[name="_csrfToken"]').val()
                );
            },
            success: function (response) {
                $("#modal-tag .modal-body").html(response);
                setTimeout(function () {
                    $("#modal-tag").modal("hide");
                    Tags.loadTags();
                }, 1000);
            },
        });
    },
    // Buscar items por título
    searchItems: function (search) {
        let order = sessionStorage.getItem("order");
        let session = sessionStorage.getItem("idTag");
        session === null ? (url = "/tags/items/") : (url = "/tags/items/" + parseInt(session));
        $.ajax({
            url: url,
            type: "GET",
            data: { search: search, order: order},
            beforeSend: function (xhr) {
                xhr.setRequestHeader(
                    "X-CSRF-Token",
                    $('[name="_csrfToken"]').val()
                );
            },
            success: function (response) {
                $(".results-items").html(response);
            },
        });
    },
    // Ordenar items
    orderItems: function (order) {
        let search = sessionStorage.getItem("search");
        let session = sessionStorage.getItem("idTag");
        session === null ? (url = "/tags/items/") : (url = "/tags/items/" + parseInt(session));
        $.ajax({
            url: url,
            type: "GET",
            data: { order: order,  search: search},
            beforeSend: function (xhr) {
                xhr.setRequestHeader(
                    "X-CSRF-Token",
                    $('[name="_csrfToken"]').val()
                );
            },
            success: function (response) {
                $(".results-items").html(response);
            }
        });
    },
    // Añadir clase active a tags
    activeTag: function () {
        let tags = $("#tags .tag");
        let tagActive = sessionStorage.getItem("idTag");
        tags.each(function() {
            if($(this).data("id") == tagActive) {
                $(this).parent().addClass("active");
            }
        });
    },
    // Scroll infinito
    infiniteScroll: function (id_tag = null) {
        let search = sessionStorage.getItem("search");
        let order = sessionStorage.getItem("order");
        (id_tag === null) ? url = "/tags/items" : url = "/tags/items/" + id_tag;
        // Ultimo item
        let last = $('.item').last().data('number');
        let count = ($('.count').data('count') - 1);
        if (last < count) {
            $('.charge-img').addClass('d-block');
            $.ajax({
                url: url,
                type: "GET",
                data: {limit : limit, search: search, order: order},
                beforeSend: function (xhr) {
                    xhr.setRequestHeader(
                        "X-CSRF-Token",
                        $('[name="_csrfToken"]').val()
                    );
                },
                success: function (response) {
                    $(".results-items").html(response);
                    $('.charge-img').addClass('d-none');
                    $('.charge-img').removeClass('d-block');
                    limit = limit + 6;
                }
            });
        }
    },
};
