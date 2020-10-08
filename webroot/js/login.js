$(document).ready(function () {
    // Use Strict
    "use strict";

    // Iniciamos objeto login
    Login.init();
});

// Objeto login
let Login = {
    // Constructor
    init: function () {
        // LLamada a eventos
        this.events();
    },
    // Eventos
    events: function () {
        // Evento mostrar contraseña
        $('.input-icon').on('click',function (event){
            let $input = $(this).siblings().find("input");
            if($input.attr("type") === "password"){
                $input.attr("type","text");
                $(this).removeClass("fas fa-eye");
                $(this).addClass("fas fa-eye-slash");
            }else{
                $input.attr("type","password");
                $(this).removeClass("fas fa-eye-slash");
                $(this).addClass("fas fa-eye");
            }
        });
    }
    //     // Evento seleccionar albaran
    //     $('.data-checkbox').on('click', function (event) {
    //         event.stopPropagation();
    //         if ($('.data-checkbox input').length == $('.data-checkbox input:checked').length) {
    //             $('.all-checkbox input').prop('checked', true);
    //         } else {  
    //             $('.all-checkbox input').prop('checked', false);
    //         }
    //     });
    //     $('.all-checkbox input').on('click', function () {
    //         $('.data-checkbox input').prop('checked', this.checked);
    //     });
    //     // Calcular al cambiar
    //     $('.change').bind('change keyup', function () {
    //         let id = $(this).data('id');
    //         Albaranes.calc(id);
    //     });
    //     // Click ver pdf
    //     $('.pdf').on('click', function (event) {
    //         event.stopPropagation();
    //         let _this = $(this);
    //         Swal.fire({
    //             title: '¿Generar albarán?',
    //             icon: "question",
    //             showCancelButton: true,
    //             cancelButtonColor: "#d33",
    //             confirmButtonText: "<i class='fas fa-coins'></i> Con precio",
    //             cancelButtonText: "Sin precio",
    //         }).then(result => {
    //             let url;
    //             if (result.value) { // Albaran con precios
    //                 url = _this.data('url');
    //             } else if (result.dismiss == 'cancel') { // Albaran sin precios
    //                 url = _this.data('wp');
    //             }
    //             if (result.value || result.dismiss == 'cancel') 
    //                 window.open(url, 'PDF', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=1000px,height=800px');
    //             return false; // Para prevenir apertura de pdf en ventana actual
    //         });
    //     });
    //     // Evento generar factura
    //     $('.factura').on('click', function () {
    //         Albaranes.loadingGenButton();
    //         // Mostramos modal seleccionar cuenta bancaria
    //         Login.showModalCuenta();
    //     });
    //     // Evento seleccionar cuenta y crear factura
    //     $(document).on('click', '#save_factura', function () {
    //         // Llamamos a control botton
    //         Albaranes.loadingSaveButton();
    //         let selected = false;
    //         // Recorremos radios y comprobamos los seleccionados
    //         $('[name="cuenta"]').each(function () {
    //             if ($(this).prop('checked')) {
    //                 selected = true;
    //             }
    //         });
    //         // Si se selecciono alguna cuenta
    //         if (selected) {
    //             Albaranes.showAlert('success', 'Generando factura...');
    //             // Generamos datos factura
    //             Albaranes.createFactura($('#form_cuentas').serialize());
    //         } else {
    //             Albaranes.loadingSaveButton();
    //             Albaranes.showAlert('danger', 'Seleccione una cuenta');
    //         }
    //     });
    // },
    // showModalCuenta: function () {
    //     let marcados = $('.data-checkbox input:checked');
    //     let iguales = true;
    //     // Si hay marcados
    //     if (marcados.length > 0) {
    //         // Comprobar iguales
    //         marcados.each(function () {
    //             if ($(this).data('id_cliente') != $(marcados[0]).data('id_cliente')) {
    //                 iguales = false;
    //             }
    //         });
    //         // Si no son todos iguales
    //         if (iguales) {
    //             let form = new FormData(document.querySelector('#albaranes_form'));
    //             form.append('id_cliente', $(marcados[0]).data('id_cliente'));
    //             // Buscamos cuentas del cliente
    //             $.ajax({
    //                 type: 'POST', url: '/albaranes/modalcuentas', data: form,
    //                 processData: false,
    //                 contentType: false,
    //                 beforeSend: function (xhr) {
    //                     xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
    //                 },
    //                 success: function (data) {
    //                     $('#modal_cuentas .modal-dialog').html(data);
    //                     // Comprobamos que tenga cuentas
    //                     if (parseInt($('#cuentas').val()) > 0) {
    //                         // Abrir modal
    //                         $('#modal_cuentas').modal('show');
    //                     } else {
    //                         Albaranes.createFactura($('#form_cuentas').serialize());
    //                     }
    //                     Albaranes.loadingGenButton();
    //                 }
    //             });
    //         } else {
    //             Albaranes.loadingGenButton();
    //             Swal.fire({
    //                 icon: "error",
    //                 title: 'Error',
    //                 text: 'solo puedes convertir albaranes en facturas del mismo cliente',
    //                 confirmButtonText: "Aceptar",
    //             });
    //         }
    //     } else {
    //         Albaranes.loadingGenButton();
    //     }
    // },
    // createFactura: function (albaranes) {
    //     $.ajax({
    //         type: 'POST', url: '/facturas/albaran2factura', data: albaranes,
    //         beforeSend: function (xhr) {
    //             xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
    //         },
    //         success: function (response) {
    //             let base_url = $('.factura').data('uri');
    //             document.cookie = 'back=' + base_url + '/facturas';
    //             if (!response.errors) {
    //                 window.location = '/facturas/edit/'+response.factura.id;
    //             } else {
    //                 Albaranes.loadingSaveButton();
    //                 Swal.fire({
    //                     icon: "error",
    //                     title: 'Error',
    //                     text: response.message,
    //                     confirmButtonText: "Aceptar",
    //                 });
    //             }
    //         }
    //     });
    // },
    // calc: function (id) {
    //     // Calcula el total de cada linea
    //     let line_total = parseFloat($('#unidades-'+id).val()) * parseFloat($('#precio_unidad-'+id).val());
    //     // Redondeo total de cada linea
    //     line_total = Math.round(line_total * 100) / 100;
    //     if (line_total >= 0) {
    //         $('#total-'+id).val(line_total);
    //     }
    //     // Calcula total final
    //     let total = 0;
    //     $('.total').each(function () {
    //         total += parseFloat($(this).val());
    //     });
    //     // Redondeo total
    //     total = Math.round(total * 100) / 100;
    //     if (total >= 0) {
    //         $('#total').val(total);
    //     }
    // },
    // // Mostrar alert
    // showAlert: function (type, text) {
    //     let alert = $('.alert-'+type);
    //     // Ocultamos todos los alert y paramos time out
    //     $('[class*=alert-]').fadeOut(); clearTimeout(this.timeout);
    //     // Establecemos texto
    //     alert.html(text);
    //     // Mostramos
    //     alert.fadeIn();
    //     // Auto ocultar
    //     this.timeout = setTimeout(function (alert) {
    //         alert.fadeOut();
    //     }, 5000, alert);
    // },
    // // Boton cargando
    // loadingSaveButton: function () {
    //     // Ocultamos boton guardar
    //     $('#save_factura').toggle();
    //     // Mostramos boton cargando
    //     $('#save_factura_loading').toggle();
    // },
    // // Boton cargando
    // loadingGenButton: function () {
    //     // Ocultamos boton guardar
    //     $('.factura').toggle();
    //     // Mostramos boton cargando
    //     $('.factura_loading').toggle();
    // }
}