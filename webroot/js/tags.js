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
        $(document).on("click", ".favItem", function () {
            let url = $(this).data("url");
            Tags.isFav(url, $(this));
        });

        //Evento para eliminar items
        $(document).on("click", ".deleteItem", function () {
            let url = $(this).data("url");
            let message = $(this).data("message");
            let ok = $(this).data("ok");
            let cancel = $(this).data("cancel");
            let data = { url: url, message: message, ok: ok, cancel: cancel, id: id};
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
            $(".tag").parent().removeClass("active");
            $(this).parent().addClass("active");
            Tags.loadItems(id_tag);
        });

        // Buscar tags con el buscador
        $(document).on("keyup", ".form-control-tags", function () {
            var valorBusqueda = $(this).val();
            Tags.searchTags(valorBusqueda);
        });

        //Evento para eliminar tags
        $(document).on("click", ".tag-delete", function () {
            let url = $(this).data("url");
            let message = $(this).data("message");
            let ok = $(this).data("ok");
            let cancel = $(this).data("cancel");
            let data = { url: url, message: message, ok: ok, cancel: cancel };
            Tags.deleteTags(data);
        });

        //Evento para editar tags
        $(document).on("click", ".tag-edit", function () {
            let url = $(this).data("url");
            Tags.edit(url);
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
            },
        });
    },
    // Cargar items
    loadItems: function (id_tag = null) {
        id_tag === null
            ? (url = "/tags/items/")
            : (url = "/tags/items/" + id_tag);
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
                            Tags.loadItems(data.id);
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
            error: function () {
                alert("error");
            },
        });
    },
    // Eliminar tags
    deleteTags: function (data) {
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
                            Tags.loadTags();
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
    // Editar tags
    edit: function (data) {
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
                if (data.saved) {
                    Tags.loadTags();
                    Tags.loadItems
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
    },
};
