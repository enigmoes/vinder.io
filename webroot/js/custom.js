$(document).ready(function () {
    // Use Strict
    "use strict";

    // Iniciamos objeto Custom
    Custom.init();
});

// Objeto custom
let Custom = {
    // Constructor
    init: function () {
        // LLamada a eventos
        this.events();
    },
    // Eventos
    events: function () {
        // Llamada a eventos generales
        this.generalEvents();
        // Llamada a eventos de navbar
        this.navbarEvents();
        // Llamada a eventos de navbar
        this.sidebarEvents();
        // Llamada a eventos de acción comunes
        this.actionEvents();
        // Eliminar búsqueda
        this.deleteSearch();
    },
    generalEvents: function () {
        // Acción eliminar
        $(".delete-link").on("click", function (event) {
            event.stopPropagation();
            let url = $(this).data("url");
            let msg = $(this).data("msg");
            Swal.fire({
                title: msg,
                icon: "warning",
                showCancelButton: true,
                cancelButtonColor: "#d33",
                confirmButtonText: "Aceptar",
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.value) {
                    location.href = url;
                }
            });
        });
        // Preguntar al volver
        $(".back-alert").on("click", function (event) {
            event.preventDefault();
            let url = $(this).attr("href");
            let saved = $(this).parents(".container").find(".alert-success");
            if (saved.length == 0) {
                Swal.fire({
                    title: "¿Desea salir sin guardar?",
                    icon: "question",
                    showCancelButton: true,
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Aceptar",
                    cancelButtonText: "Cancelar",
                }).then((result) => {
                    if (result.value) {
                        location.href = url;
                    }
                });
            } else {
                location.href = url;
            }
        });
        // Evento mostrar contraseña
        $(".show-password, .show-password-label").on("click", function () {
            let $input = $(this).siblings().find("input");
            if ($input.attr("type") === "password") {
                $input.attr("type", "text");
                $(this).removeClass("fas fa-eye");
                $(this).addClass("fas fa-eye-slash");
            } else {
                $input.attr("type", "password");
                $(this).removeClass("fas fa-eye-slash");
                $(this).addClass("fas fa-eye");
            }
        });
        // Evento compartir enlaces
        $(document).on("click", ".share-link", function () {
            let url = $(this).data("url");
            window.open(url, "ventanaEnlaces", "top=500,left=500,width=500,height=400");
        });
        // Abrir enlace de los items en una pestaña nueva
        $(document).on("click", ".window-link", function () {
            let url = $(this).data("url");
            window.open(url);
        });
        // Evento para ocultar y mostrar los iconos de editar y eliminar de las tags
        $(document).on("mouseenter", ".results-tags li", function () {
            $(".tag-edit,.tag-delete").css("display","none");
            $(".results-tags li").css("background","white");
            $(this).css("background","#ebf0c7");
            let icons = $(this).find("a");
            icons.css("display","inline");
        });
        $(document).on("mouseleave", ".results-tags li", function () {
            $(".tag-edit,.tag-delete").css("display","none");
            $(".results-tags li").css("background","white");
        });
    },
    navbarEvents: function () {
        // Evento desplegar input buscar
        $(".search-navbar").on("click", function () {
            $("#input-custom").removeClass("d-none");
            $(".navbar-icons").addClass("d-none");
            $(".input-custom").attr("placeholder", "Buscar...");
            $("#button-input span").text("Buscar");
            $("#button-input i").addClass("fa-search");
            $("#button-input i").removeClass("fa-plus");
            $("#button-input").removeClass("btn-add");
            $("#button-input").addClass("btn-search");
        });
        // Evento desplegar input guardar
        $(".add-navbar").on("click", function () {
            $("#input-custom").removeClass("d-none");
            $(".navbar-icons").addClass("d-none");
            $(".input-custom").attr(
                "placeholder",
                "Guardar una URL https//..."
            );
            $("#button-input span").text("Guardar");
            $("#button-input i").addClass("fa-plus");
            $("#button-input i").removeClass("fa-search");
            $("#button-input").removeClass("btn-search");
            $("#button-input").addClass("btn-add");
        });
        // Evento mostrar iconos navbar
        $(".btn-input-custom2").on("click", function () {
            $("#input-custom").addClass("d-none");
            $(".navbar-icons").removeClass("d-none");
        });
    },
    sidebarEvents: function(){
        // Evento ocultar sidebar
        $(document).on('click', '.overlay', function () {
            // hide sidebar
            $('.div-sidebar').removeClass('.sidebar-active');
            $('.div-sidebar').addClass('d-none');
            // hide overlay
            $('.overlay').removeClass('d-block');
        });
        // Evento mostrar sidebar
        $(document).on('click', '.sidebar-button', function () {
            // open sidebar
            $('.div-sidebar').addClass('.sidebar-active');
            $('.div-sidebar').removeClass('d-none');
            // fade in the overlay
            $('.overlay').addClass('d-block');
        });
    },
    actionEvents: function () {
        //Evento para introducir el formulario y desplegar el modal add
        $(document).on("click", ".add-tag", function () {
            // Recoger id item
            let idItem = $(this).data("id");
            Custom.openAddTag(idItem);
        });

        // Añadir etiqueta a un item
        $(document).on("click", ".btn-modal-add", function () {
            // Recoger id item
            let idItem = $(this).data("id");
            Custom.addTag(idItem);
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
                $("#modal-tag-add .modal-body").html(response);
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
                $("#modal-tag-add .modal-body").html(response);
                setTimeout(function () {
                    $("#modal-tag-add").modal("hide");
                }, 1000);
            },
        });
    },
    deleteSearch: function(){
        sessionStorage.removeItem('search');
    }
};
