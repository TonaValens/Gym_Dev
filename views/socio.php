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
                        <h1 class="box-title">Socio<button class="btn btn-success" onclick="mostrarForm(true)">
                                <i class="fa fa-plus-circle"></i> Agregar</button></h1>
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
                                <th>Tipo Socio</th>
                                <th>Domicilio</th>
                                <th>Teléfono</th>
                                <th>Email</th>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <th>Opciones</th>
                                <th>Nombre</th>
                                <th>Tipo Socio</th>
                                <th>Domicilio</th>
                                <th>Teléfono</th>
                                <th>Email</th>
                            </tfoot>
                        </table>
                    </div>

                    <div class="panel-body" style="height: 400px;" id="formRegistros">
                        <form name="formulario" id="formulario" method="POST">
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Tipo Socio(*)</label>
                                <select name="id_tipo_socio" id="id_tipo_socio" class="form-control selectpicker" 
                                    data-live-search="true" required></select>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Nombre</label>
                                <input type="hidden" name="idcategoria" id="idcategoria">
                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" 
                                    maxlength="50" required>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Fecha de nacimiento</label>
                                <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" 
                                    maxlength="256">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Domicilio</label>
                                <input type="text" class="form-control" name="domicilio" id="domicilio" 
                                    placeholder="Domicilio" maxlength="256">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Teléfono</label>
                                <input type="text" class="form-control" name="telefono" id="telefono" 
                                    placeholder="3323528578" maxlength="256">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email" id="email" 
                                    placeholder="ejemplo@gmail.com" maxlength="256">
                            </div>
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

<script type="text/javascript" src="scripts/socio.js"></script>