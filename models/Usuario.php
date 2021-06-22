<?php
    require '../config/conexion.php';

    Class Usuario
    {
        //Implementación del constructor
        public function __construct()
        {
            
        }

        public function insertar($nombre, $email, $usr, $pwd, $rol, $imagen)
        {
            $sql = "INSERT INTO usuario(nombre, email, usr, pwd, rol, imagen, activo)
                    VALUES ('$nombre', '$email', '$usr', '$pwd', '$rol', '$imagen', '1')";
            
            return ejecutarConsulta($sql);
        }

        public function editar($idusuario, $nombre, $email, $usr, $pwd, $rol, $imagen)
        {
            $sql = "UPDATE usuario
                    SET nombre = '$nombre', email = '$email', usr = '$usr', pwd = '$pwd', rol = '$rol', imagen = '$imagen'
                    WHERE idusuario = $idusuario";
            
            return ejecutarConsulta($sql);
        }

        public function desactivar($idusuario)
        {
            $sql = "UPDATE usuario
                    SET activo = 0
                    WHERE idusuario = '$idusuario'";
            
            return ejecutarConsulta($sql);
        }

        public function activar($idusuario)
        {
            $sql = "UPDATE usuario
                    SET activo = 1
                    WHERE idusuario = '$idusuario'";
            
            return ejecutarConsulta($sql);
        }

        public function mostrar($idusuario)
        {
            $sql = "SELECT * 
                    FROM usuario
                    WHERE idusuario = '$idusuario'";
            
            return ejecutarConsultaSimpleFila($sql);
        }

        public function listar()
        {
            $sql = "SELECT *
                    FROM usuario";

            return ejecutarConsulta($sql);
        }
    }
?>