<?php
    require '../config/conexion.php';

    Class Articulo
    {
        //Implementación del constructor
        public function __construct()
        {
            
        }

        public function insertar($idcategoria, $codigo, $nombre, $descripcion, $imagen, $stock)
        {
            $sql = "INSERT INTO articulo(idcategoria, codigo, nombre, descripcion, imagen, stock, activo)
                    VALUES ('$idcategoria', '$codigo', '$nombre', '$descripcion', '$imagen', '$stock', '1')";
            
            return ejecutarConsulta($sql);
        }

        public function editar($idarticulo, $idcategoria, $codigo, $nombre, $descripcion, $imagen, $stock)
        {
            $sql = "UPDATE articulo
                    SET idcategoria = '$idcategoria', codigo = '$codigo', nombre = '$nombre', 
                        descripcion = '$descripcion', imagen = '$imagen', stock = '$stock'
                    WHERE idarticulo = $idarticulo";
            
            return ejecutarConsulta($sql);
        }

        public function desactivar($idarticulo)
        {
            $sql = "UPDATE articulo
                    SET activo = 0
                    WHERE idarticulo = '$idarticulo'";
            
            return ejecutarConsulta($sql);
        }

        public function activar($idarticulo)
        {
            $sql = "UPDATE articulo
                    SET activo = 1
                    WHERE idarticulo = '$idarticulo'";
            
            return ejecutarConsulta($sql);
        }

        public function mostrar($idarticulo)
        {
            $sql = "SELECT * 
                    FROM articulo
                    WHERE idarticulo = '$idarticulo'";
            
            return ejecutarConsultaSimpleFila($sql);
        }

        public function listar()
        {
            $sql = "SELECT T0.idarticulo, 
                           T0.idcategoria, 
                           T1.nombre as categoria,
                           T0.codigo,
                           T0.nombre,
                           T0.stock,
                           T0.descripcion,
                           T0.imagen,
                           T0.activo
                    FROM articulo T0
                    INNER JOIN categoria T1 ON T0.idcategoria = T1.idcategoria";

            return ejecutarConsulta($sql);
        }
    }
?>