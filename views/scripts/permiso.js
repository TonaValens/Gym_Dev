var tabla;

function init() {
    mostrarForm(false);
    listar();
}

function mostrarForm(flag) {

    if (flag) {
        $("#listRegistros").hide();
        $("#formRegistros").show();
        $("#btnGuardar").prop("disabled", false);
        $("#btnAgregar").hide();
    }
    else {
        $("#listRegistros").show();
        $("#formRegistros").hide();
        $("#btnAgregar").hide();
    }
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
                url: '../ajax/permiso.php?accion=listar',
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

init();