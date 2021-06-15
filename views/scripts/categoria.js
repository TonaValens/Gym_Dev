var tabla;

function init() {
    mostrarForm(false);
    listar();

    $("#formulario").on("submit", function (e) {
        guardar(e);
    });
}

function limpiar() {
    $("#idcategoria").val("");
    $("#nombre").val("");
    $("#descripcion").val("");
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
                url: '../ajax/categoria.php?accion=listar',
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
        url: "../ajax/categoria.php?accion=guardar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function (datos) {
            swal({
                title: "Éxito",
                text: "Categoría agregada",
                icon: "success",
            });
            mostrarForm(false);
            tabla.ajax.reload();
        }
    });
    limpiar();
}

function mostrar(idcategoria) {
    $.post("../ajax/categoria.php?accion=mostrar", { idcategoria: idcategoria }, function (data, estatus) {
        data = JSON.parse(data);
        mostrarForm(true);

        $("#nombre").val(data.nombre);
        $("#descripcion").val(data.descripcion);
        $("#idcategoria").val(data.idcategoria);
    });
}

function desactivar(idcategoria) {

    swal({
        title: "¿Desactivar categoría?",
        text: "",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then(function (result) {
            if (result) {
                $.post("../ajax/categoria.php?accion=desactivar", { idcategoria: idcategoria }, function (e) {
                    swal(e, {
                        icon: "success",
                    });
                    tabla.ajax.reload();
                });

            }
        });
}

function activar(idcategoria) {

    swal({
        title: "¿Activar categoría?",
        text: "",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then(function (result) {
            if (result) {
                $.post("../ajax/categoria.php?accion=activar", { idcategoria: idcategoria }, function (e) {
                    swal(e, {
                        icon: "success",
                    });
                    tabla.ajax.reload();
                });

            }
        });
}

init();