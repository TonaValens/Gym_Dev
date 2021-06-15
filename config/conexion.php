<?php
    //Utilizar una vez el archivo global
    require_once "global.php";

    //COnfiguración de cadena de conexión
    $conexion = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

    //Establecer utf8 como encode
    mysqli_query($conexion, 'SET NAMES "' .DB_ENCODE. '"');

    if(mysqli_connect_errno())
    {
        printf("Falló la conexión a la base de datos: %s\n", mysqli_connect_error());
        exit();
    }

    if(!function_exists('ejecutarConsulta'))
    {
        function ejecutarConsulta($sql)
        {
            global $conexion;
            $query = $conexion->query($sql);
            return $query;
        }

        function ejecutarConsultaSimpleFila($sql)
        {
            global $conexion;
            $query = $conexion->query($sql);
            $row = $query->fetch_assoc();
            return $row;
        }

        function ejecutarConsulta_RetornarId($sql)
        {
            global $conexion;
            $query = $conexion->query($sql);
            return $conexion->insert_id;
        }

        function limpiarCadena($str)
        {
            global $conexion;
            $str = mysqli_real_escape_string($conexion, trim($str));
            return htmlspecialchars($str);
        }
    }
?>