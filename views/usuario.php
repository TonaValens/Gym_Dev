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
                        <h1 class="box-title">Usuario
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
                                <th>Email</th>
                                <th>Usuario</th>
                                <th>Rol</th>
                                <th>Imágen</th>
                                <th>Estado</th>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <th>Opciones</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Usuario</th>
                                <th>Rol</th>
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
                                <input type="hidden" name="idusuario" id="idusuario">
                                <input type="text" class="form-control" name="nombre" id="nombre" 
                                    placeholder="Nombre" maxlength="100" required>
                            </div>   

                            <!-- Input Email -->
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Email(*)</label>                                
                                <input type="text" class="form-control" name="email" id="email" 
                                    placeholder="ejemplo@gmail.com" maxlength="100" required>
                            </div>                          

                            <!-- Input Usuario -->
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Usuario(*)</label>                                
                                <input type="text" class="form-control" name="usuario" id="usuario" 
                                    maxlength="20" required>
                            </div>  

                            <!-- Input Password -->
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Contraseña(*)</label>                                
                                <input type="text" class="form-control" name="pwd" id="pwd" 
                                    maxlength="64" required>
                            </div> 

                            <!-- Select Rol -->
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Rol(*)</label>
                                <select name="idrol" id="idro" class="form-control selectpicker" data-live-search="true" required></select>
                            </div>

                            <!-- Input Imagen -->
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Imagen</label>
                                <input type="file" class="form-control" name="imagen" id="imagen">
                                <input type="hidden" name="imagenactual" id="imagenactual">
                                <img src="" width="150px" height="120px" id="imagenmuestra">
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

<script type="text/javascript" src="scripts/usuario.js"></script>