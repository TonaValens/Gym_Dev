<?php
require 'header.php';
?>
<!--Contenido-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h1 class="box-title">Artículo
                            <button class="btn btn-success" onclick="mostrarForm(true)" id="btnAgregar">
                                <i class="fa fa-plus-circle"></i>
                                Agregar
                            </button>
                        </h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listRegistros">
                        <table id="tblListado" class="table table-striped table-bordered table-condensed table-hover">
                            <thead>
                                <th>Opciones</th>
                                <th>Nombre</th>
                                <th>Categoría</th>
                                <th>Descripción</th>
                                <th>Código</th>
                                <th>Stock</th>
                                <th>Imágen</th>
                                <th>Estado</th>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <th>Opciones</th>
                                <th>Nombre</th>
                                <th>Categoría</th>
                                <th>Descripción</th>
                                <th>Código</th>
                                <th>Stock</th>
                                <th>Imágen</th>
                                <th>Estado</th>
                            </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" id="formRegistros">
                        <form name="formulario" id="formulario" method="POST">

                            <!-- Input Nombre -->
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Nombre(*)</label>
                                <input type="hidden" name="idarticulo" id="idarticulo">
                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" maxlength="100" required>
                            </div>

                            <!-- Select Categoría -->
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Categoría(*)</label>
                                <select name="idcategoria" id="idcategoria" class="form-control selectpicker" data-live-search="true" required></select>
                            </div>

                            <!-- Input Stock -->
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Stock</label>
                                <input type="number" class="form-control" name="stock" id="stock" required>
                            </div>

                            <!-- Input Descripción -->
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Descripción</label>
                                <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripción" maxlength="256">
                            </div>

                            <!-- Input Imagen -->
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Imagen</label>
                                <input type="file" class="form-control" name="imagen" id="imagen">
                                <input type="hidden" name="imagenactual" id="imagenactual">
                                <img src="" width="150px" height="120px" id="imagenmuestra">
                            </div>

                            <!-- Input Código -->
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Código</label>
                                <input type="text" class="form-control" name="codigo" id="codigo" placeholder="Código de barras">
                                <button type="button" class="btn btn-success" onclick="generarCodigo()">
                                    Generar código de barras
                                </button>
                                <button type="button" class="btn btn-info" onclick="imprimir()">
                                    Imprimir
                                </button>
                                <div id="print">
                                    <svg id="barCode"></svg>
                                </div>
                            </div>

                            <!-- Guardar -->
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" type="submit" id="btnGuardar">
                                    <i class="fa fa-save"></i>
                                    Guardar
                                </button>

                                <button class="btn btn-danger" onclick="ocultarForm()" type="button">
                                    <i class="fa fa-arrow-circle-left"></i>
                                    Cancelar
                                </button>
                            </div>

                        </form>
                    </div>
                    <!--Fin centro -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->

</div><!-- /.content-wrapper -->
<!--Fin-Contenido-->
<?php
require 'footer.php'
?>

<!--Referencia a librería de códigos de barras-->
<script type="text/javascript" src="../public/js/JsBarcode.all.min.js"></script>
<script type="text/javascript" src="../public/js/jquery.PrintArea.js"></script>
<script type="text/javascript" src="scripts/articulo.js"></script>