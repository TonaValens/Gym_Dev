var tabla;

function init() {
    mostrarForm(false);
    listar();

    $("#formulario").on("submit", function (e) {
        guardar(e);
    });

    $.post("../ajax/articulo.php?accion=categoria", function(response){
        $("#idcategoria").html(response);
        $('#idcategoria').selectpicker('refresh');
    });

    $("#imagenmuestra").hide();
}

function limpiar() {
    $("#idarticulo").val("");
    $("#codigo").val("");
    $("#nombre").val("");
    $("#descripcion").val("");
    $("#stock").val("");
    $("#imagenmuestra").attr("src", "");
    $("#imagenactual").val("");
    $("#print").hide();
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
                url: '../ajax/articulo.php?accion=listar',
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
        url: "../ajax/articulo.php?accion=guardar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function (datos) {
            swal({
                title: "Éxito",
                text: "Artículo agregado",
                icon: "success",
            });
            mostrarForm(false);
            tabla.ajax.reload();
        }
    });
    limpiar();
}

function mostrar(idarticulo) {
    $.post("../ajax/articulo.php?accion=mostrar", { idarticulo: idarticulo }, function (data, estatus) {
        data = JSON.parse(data);
        mostrarForm(true);

        $("#idarticulo").val(data.idarticulo);
        $("#idcategoria").val(data.idcategoria);
        $('#idcategoria').selectpicker('refresh');
        $("#codigo").val(data.codigo);
        $("#nombre").val(data.nombre);
        $("#descripcion").val(data.descripcion);
        $("#imagenmuestra").show();
        $("#imagenmuestra").attr("src", "../files/articulos/" + data.imagen);
        $("#imagenactual").val(data.imagen);
        $("#stock").val(data.stock);
        generarCodigo();
    });
}

function desactivar(idarticulo) {

    swal({
        title: "¿Desactivar artículo?",
        text: "",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then(function (result) {
            if (result) {
                $.post("../ajax/articulo.php?accion=desactivar", { idarticulo: idarticulo }, function (e) {
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
        title: "¿Activar artículo?",
        text: "",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then(function (result) {
            if (result) {
                $.post("../ajax/articulo.php?accion=activar", { idarticulo: idarticulo }, function (e) {
                    swal(e, {
                        icon: "success",
                    });
                    tabla.ajax.reload();
                });

            }
        });
}

function generarCodigo()
{
    codigo = $("#codigo").val();
    JsBarcode("#barCode", codigo);
    $("#print").show();
}

function imprimir()
{
    $("#print").printArea();
}

init();