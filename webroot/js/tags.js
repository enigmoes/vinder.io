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
            sessionStorage.setItem('idTag', id_tag);
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
            Tags.deleteTag(data);
        });

        //Evento para introducir el formulario y desplegar el modal edit
        $(document).on('click', '.tag-edit', function () {
            // Recoger id tag
            let tagId = $(this).data('id');
            Tags.openEditTag(tagId);
        });

        //Evento para editar tags
        $(document).on('click', '.btn-modal-edit', function () {
            // Recoger id tag
            let tagId = $(this).data('id');
            Tags.editTag(tagId);
        });

        //Evento para cargar etiquetas al cerrar el modal edit
        $(document).on('hide.bs.modal', '#modal-tag-edit' , function () {
            Tags.loadTags();
        });

        //Evento para introducir el formulario y desplegar el modal add
        $(document).on('click', '.add-tag', function () {
            // Recoger id item
            let idItem = $(this).data('id');
            Tags.openAddTag(idItem);
        });

        // Añadir etiqueta a un item
        $(document).on('click', '.btn-modal-add', function () {
            Tags.openCreateTag();
        });

        //Evento para desplegar el modal create
        $(document).on('click', '.create-tag', function () {
            $('#modal-tag-create').modal('show')
            Tags.openCreateTag();
        });

        // Crear etiqueta
        $(document).on('click', '.btn-modal-create', function () {
            Tags.create();
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
        (id_tag === null) ? url = "/tags/items" : url = "/tags/items/" + id_tag;
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
                            Tags.loadItems(sessionStorage.getItem('idTag'));
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
            }
        });
    },
    // Eliminar tag
    deleteTag: function (data) {
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
                $(".modal-body-edit").html(response);
                $('#modal-tag-edit').modal('show');
            }
        });
    },
    // Editar tags
    editTag: function (id) {
        let form = new FormData(document.querySelector('#form-tag-'+id));
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
                $(".modal-body-edit").html(data);
                setTimeout(function () {
                    $("#modal-tag-edit").modal("hide");
                }, 1000);
            },
        });
    },
    // Abrir modal add
    openAddTag: function (id) {
        $.ajax({
            url: "/items/addTag/" + id,
            type: "GET",
            beforeSend: function (xhr) {
                xhr.setRequestHeader(
                    "X-CSRF-Token",
                    $('[name="_csrfToken"]').val()
                );
            },
            success: function (response) {
                $(".modal-body-add").html(response);
                $("#modal-tag-add").modal("show");
            }
        });
    },
    // Añadir etiqueta a un item
    addTag: function (idItem) {
        let form = new FormData(document.querySelector('#form-item-'+idItem));
        $.ajax({
            type: "POST",
            url: "/items/add-tag/" + idItem,
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
                $(".modal-body-add").html(response);
                setTimeout(function () {
                    $("#modal-tag-add").modal("hide");
                    Tags.loadItems(sessionStorage.getItem('idTag'));
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
                $(".modal-body-create").html(response);
                $("#modal-tag-create").modal("show");
            }
        });
    },
    // Añadir etiqueta a un item
    create: function () {
        let form = new FormData(document.querySelector('#form-create'));
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
                $(".modal-body-create").html(response);
                setTimeout(function () {
                    $("#modal-tag-create").modal("hide");
                    Tags.loadTags();
                }, 1000);
            },
        });
    },
};
