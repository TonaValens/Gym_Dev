var tabla;

function init() {
    mostrarForm(false);
    listar();

    $("#formulario").on("submit", function (e) {
        guardar(e);
    });

    $("#imagenmuestra").hide();
}

function limpiar() {
    $("#idusuario").val("");
    $("#nombre").val("");
    $("#email").val("");
    $("#usr").val("");
    $("#pwd").val("");
    $("#rol").val("");
    $("#imagenmuestra").attr("src", "");
    $("#imagenactual").val("");    
}

function mostrarForm(flag) {
    limpiar();

    if (flag) {
        $("#listRegistros").hide();
        $("#formRegistros").show();
        $("#btnGuardar").prop("disabled", false);
        $("#btnAgregar").hide();
    }
    else {
        $("#listRegistros").show();
        $("#formRegistros").hide();
        $("#btnAgregar").show();
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
                url: '../ajax/usuario.php?accion=listar',
                type: "GET",
                dataType: "json",
                error: function (e) {
                    console.log(e.responseText);
                }
            },
            "bDestroy": true,
            "iDisplayLength": 15,
            "order": [[0, "desc"]]
        }
    );
}

function guardar(e) {
    e.preventDefault();
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/usuario.php?accion=guardar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function (datos) {
            swal({
                title: "Éxito",
                text: "Usuario agregado",
                icon: "success",
            });
            mostrarForm(false);
            tabla.ajax.reload();
        }
    });
    limpiar();
}

function mostrar(idusuario) {
    $.post("../ajax/usuario.php?accion=mostrar", { idusuario: idusuario }, function (data, estatus) {
        data = JSON.parse(data);
        mostrarForm(true);

        $("#idusuario").val(data.idusuario);
        $("#nombre").val(data.nombre);        
        $("#usr").val(data.usr);
        $("#pwd").val(data.pwd);
        $("#rol").val(data.rol);
        $("#imagenmuestra").show();
        $("#imagenmuestra").attr("src", "../files/articulos/" + data.imagen);
        $("#imagenactual").val(data.imagen);                
    });
}

function desactivar(idarticulo) {

    swal({
        title: "¿Desactivar usuario?",
        text: "",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then(function (result) {
            if (result) {
                $.post("../ajax/usuario.php?accion=desactivar", { idarticulo: idarticulo }, function (e) {
                    swal(e, {
                        icon: "success",
                    });
                    tabla.ajax.reload();
                });

            }
        });
}

function activar(idarticulo) {

    swal({
        title: "¿Activar usuario?",
        text: "",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then(function (result) {
            if (result) {
                $.post("../ajax/usuario.php?accion=activar", { idarticulo: idarticulo }, function (e) {
                    swal(e, {
                        icon: "success",
                    });
                    tabla.ajax.reload();
                });

            }
        });
}

init();