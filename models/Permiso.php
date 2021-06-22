<?php
    require '../config/conexion.php';

    Class Permiso
    {
        //Implementación del constructor
        public function __construct()
        {
            
        }

        public function listar()
        {
            $sql = "SELECT *
                    FROM permiso";

            return ejecutarConsulta($sql);
        }
    }
?>