<?php
    require '../config/conexion.php';

    Class Categoria
    {
        //Implementación del constructor
        public function __construct()
        {
            
        }

        public function insertar($nombre, $descripcion)
        {
            $sql = "INSERT INTO categoria(nombre, descripcion, activo)
                    VALUES ('$nombre', '$descripcion', '1')";
            
            return ejecutarConsulta($sql);
        }

        public function editar($idcategoria, $nombre, $descripcion)
        {
            $sql = "UPDATE categoria
                    SET nombre = '$nombre', descripcion = '$descripcion'
                    WHERE idcategoria = $idcategoria";
            
            return ejecutarConsulta($sql);
        }

        public function desactivar($idcategoria)
        {
            $sql = "UPDATE categoria
                    SET activo = 0
                    WHERE idcategoria = '$idcategoria'";
            
            return ejecutarConsulta($sql);
        }

        public function activar($idcategoria)
        {
            $sql = "UPDATE categoria
                    SET activo = 1
                    WHERE idcategoria = '$idcategoria'";
            
            return ejecutarConsulta($sql);
        }

        public function mostrar($idcategoria)
        {
            $sql = "SELECT * 
                    FROM categoria
                    WHERE idcategoria = '$idcategoria'";
            
            return ejecutarConsultaSimpleFila($sql);
        }

        public function listar()
        {
            $sql = "SELECT *
                    FROM categoria";

            return ejecutarConsulta($sql);
        }

        //El resultado se carga en el select de la vista de artículo
        public function select()
        {
            $sql = "SELECT *
                    FROM categoria
                    WHERE activo = 1";

            return ejecutarConsulta($sql);
        }
    }
?>