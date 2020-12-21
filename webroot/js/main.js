$(document).ready(function () {
    // Use Strict
    "use strict";

    // INIT Tiny MCE
    tinymce.init({
        selector: "textarea.editor",
        height: 500,
        menubar: false,
        automatic_uploads: true,
        plugins: [
            "advlist autolink lists link image charmap print preview anchor textcolor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table paste code help wordcount"
        ],
        //toolbar: 'undo redo | formatselect | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
        toolbar:
            "code | undo redo | link image | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help",
        file_picker_types: "image",
        /* custom image picker*/
        file_picker_callback: function(cb, value, meta) {
            let input = document.createElement("input");
            input.setAttribute("type", "file");
            input.setAttribute("accept", "image/*");
            input.onchange = function() {
                let file = this.files[0];
                let reader = new FileReader();
                reader.onload = function() {
                    let id = "blobid" + new Date().getTime();
                    let blobCache = tinymce.activeEditor.editorUpload.blobCache;
                    let base64 = reader.result.split(",")[1];
                    let blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);

                    /* call the callback and populate the Title field with the file name */
                    cb(blobInfo.blobUri(), { title: file.name });
                };
                reader.readAsDataURL(file);
            };
            input.click();
        }
    });

    try {
        $('[data-toggle="tooltip"]').tooltip();
    } catch (error) {
        console.log(error);
    }

    // INIT Select2
    $('.select2').select2({
        width: 'resolve'
    });
    $('.select2-multiple').select2({
        maximumSelectionLength: 1
    });

    // INIT Date range picker
    let $date_range = $('.date-range');
    $date_range.daterangepicker({
        autoUpdateInput: false,
        showDropdowns: true,
        linkedCalendars: false,
        opens: "left",
        locale: {
            applyLabel: "Aplicar",
            cancelLabel: "Limpiar",
            format: "DD/MM/YYYY",
            firstDay: 1,
            "daysOfWeek": [
                "Do",
                "Lu",
                "Ma",
                "Mi",
                "Ju",
                "Vi",
                "Sá"
            ],
            "monthNames": [
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Septiembre",
                "Octubre",
                "Noviembre",
                "Diciembre"
            ],
        }
    });

    $date_range.on("apply.daterangepicker", function(ev, picker) {
        $(this).val(
            picker.startDate.format("DD/MM/YYYY") + " - " + picker.endDate.format("DD/MM/YYYY")
        );
    });

    $date_range.on("cancel.daterangepicker", function(ev, picker) {
        $(this).val("");
    });

    // INIT Date picker
    $('.date-picker').daterangepicker({
        autoUpdateInput: false,
        singleDatePicker: true,
        showDropdowns: true,
        drops: "up",
        locale: {
            applyLabel: "Aplicar",
            format: "DD/MM/YYYY",
            firstDay: 1,
            "daysOfWeek": [
                "Do",
                "Lu",
                "Ma",
                "Mi",
                "Ju",
                "Vi",
                "Sá"
            ],
            "monthNames": [
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Septiembre",
                "Octubre",
                "Noviembre",
                "Diciembre"
            ],
        }
    });

    $('.date-picker').on("apply.daterangepicker", function(ev, picker) {
        $(this).val(picker.startDate.format("DD/MM/YYYY"));
    });

    // INIT Data link
    $("button[data-link]").on("click", function() {
        window.location.href = $(this).data("link");
    });

    // INIT Resizable table
    let table = document.querySelector('table');
    if (table !== null) {
        resizableGrid(table);
    }

    // INIT Scroll controll
    $(window).scroll(function() {
        //Si el scroll es mayor de 100 aparece icono de subir
        if ($(window).scrollTop() > 100) {
            $('.scroll').removeClass('d-none fadeOut fadeOutDown').addClass('fadeInUp');
        } else {
            $('.scroll').removeClass('fadeOut fadeInUp').addClass('fadeOutDown');
        }
    });

    // INIT Scroll to top
    $('.scroll').click(function () {
        $('html,body').animate({
            scrollTop: 0
        }, 500)
    });

    // INIT short icon on link
    $('th a.asc i').attr('class', 'fas fa-sort-up');
    $('th a.desc i').attr('class', 'fas fa-sort-down');
});
