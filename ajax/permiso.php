<?php
require_once '../models/Permiso.php';

$permiso = new Permiso();

switch ($_GET["accion"]) {

    case 'listar':
        $response = $permiso->listar();
        $data = Array();

        while ($reg = $response->fetch_object()) {
            $data[] = array(
                "0" => $reg->nombre
            );
        }

        $result = array(
            "sEcho" => 1, //información para el datatable
            "iTotalRecords" => count($data), //Total de registros
            "iTotalDisplayRecords" => count($data), //Total de registros a visualizar
            "aaData" => $data
        );

        echo json_encode($result);
        break;

    default:
        break;
}
