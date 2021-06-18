<?php
    require '../config/conexion.php';

    Class Socio
    {
        //Implementación del constructor
        public function __construct()
        {
            
        }

        public function insertar($idTipoSocio, $nombre, $fecNac, $domicilio, $telefono, $email)
        {
            $sql = "INSERT INTO socio(id_tipo_socio, activo, nombre, fecha_nacimiento, domicilio, telefono, email)
                    VALUES ('$idTipoSocio', '1', '$nombre', '$fecNac', '$domicilio', '$telefono', '$email')";
            
            return ejecutarConsulta($sql);
        }

        public function editar($idSocio, $idTipoSocio, $nombre, $fecNac, $domicilio, $telefono, $email)
        {
            $sql = "UPDATE socio
                    SET id_tipo_socio = '$idTipoSocio', nombre = '$nombre', fecha_nacimiento = '$fecNac',
                        domicilio = '$domicilio', telefono = '$telefono', email = '$email'
                    WHERE idsocio = $idSocio";
            
            return ejecutarConsulta($sql);
        }

        public function desactivar($idSocio)
        {
            $sql = "UPDATE socio
                    SET activo = 0
                    WHERE idsocio = '$idSocio'";
            
            return ejecutarConsulta($sql);
        }

        public function activar($idSocio)
        {
            $sql = "UPDATE socio
                    SET activo = 1
                    WHERE idsocio = '$idSocio'";
            
            return ejecutarConsulta($sql);
        }

        public function mostrar($idSocio)
        {
            $sql = "SELECT * 
                    FROM socio
                    WHERE idsocio = '$idSocio'";
            
            return ejecutarConsultaSimpleFila($sql);
        }

        public function listar()
        {
            $sql = "SELECT *
                    FROM socio";

            return ejecutarConsulta($sql);
        }

        //El resultado se carga en el select de la vista de socio
        public function select()
        {
            $sql = "SELECT *
                    FROM tipo_socio
                    WHERE activo = 1";

            return ejecutarConsulta($sql);
        }
    }
?>