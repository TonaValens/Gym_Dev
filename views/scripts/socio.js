var tabla;

function init() {
    mostrarForm(false);
    listar();

    $("#formulario").on("submit", function (e) {
        guardar(e);
    });
}

function limpiar() {
    $("#nombre").val("");
    $("#tipoSocio").val("");
    $("#fecNac").val("");
    $("#domicilio").val("");
    $("#telefono").val("");
    $("#email").val("");   
    $("#idSocio").val("");    
}

function mostrarForm(flag) {
    limpiar();

    if (flag) {
        $("#listRegistros").hide();
        $("#formRegistros").show();
        $("#btnGuardar").prop("disabled", false);
        $("#btnagregar").hide();
    }
    else {
        $("#listRegistros").show();
        $("#formRegistros").hide();
        $("#btnagregar").show();
    }
}

function ocultarForm() {
    limpiar();
    mostrarForm(false);
}

function listar() {
    tabla = $('#tblListado').DataTable(
        {
            "aProcessing": true, //Activamos procesamiento de dataTables
            "aServerSide": true, //Paginación y filtrado de parte del servidor
            dom: 'Bfrtip', //Definir elementos de control de la tabla
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdf'
            ],
            "ajax":
            {
                url: '../ajax/socio.php?accion=listar',
                type: "GET",
                dataType: "json",
                error: function (e) {
                    console.log(e.responseText);
                }
            },
            "bDestroy": true,
            "iDisplayLength": 5,
            "order": [[0, "desc"]]
        }
    );
}

function guardar(e) {
    e.preventDefault();
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/socio.php?accion=guardar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function (datos) {
            swal({
                title: "Éxito",
                text: "Socio agregado",
                icon: "success",
            });
            mostrarForm(false);
            tabla.ajax.reload();
        }
    });
    limpiar();
}

function mostrar(idsocio) {
    $.post("../ajax/socio.php?accion=mostrar", { idsocio: idsocio }, function (data, estatus) {
        data = JSON.parse(data);
        mostrarForm(true);

        $("#idSocio").val(data.idsocio);
        $("#tipoSocio").val(data.id_tipo_socio);
        $("#nombre").val(data.nombre);
        $("#fecNac").val(data.fecha_nacimiento);
        $("#domicilio").val(data.domicilio);
        $("#telefono").val(data.telefono);
        $("#email").val(data.email);
    });
}

function desactivar(idsocio) {

    swal({
        title: "¿Desactivar socio?",
        text: "",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then(function (result) {
            if (result) {
                $.post("../ajax/socio.php?accion=desactivar", { idsocio: idsocio }, function (e) {
                    swal(e, {
                        icon: "success",
                    });
                    tabla.ajax.reload();
                });

            }
        });
}

function activar(idsocio) {

    swal({
        title: "¿Activar socio?",
        text: "",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then(function (result) {
            if (result) {
                $.post("../ajax/socio.php?accion=activar", { idsocio: idsocio }, function (e) {
                    swal(e, {
                        icon: "success",
                    });
                    tabla.ajax.reload();
                });

            }
        });
}

init();