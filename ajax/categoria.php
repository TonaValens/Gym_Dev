<?php
require_once '../models/Categoria.php';

$categoria = new Categoria();

$idcategoria = isset($_POST["idcategoria"]) ? limpiarCadena($_POST["idcategoria"]) : "";
$nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";
$descripcion = isset($_POST["descripcion"]) ? limpiarCadena($_POST["descripcion"]) : "";

switch ($_GET["accion"]) {

    case 'guardar':
        if (empty($idcategoria)) {
            $response = $categoria->insertar($nombre, $descripcion);
            echo $response ? "Categoría creada" : "Error al crear categoría";
        } else {
            $response = $categoria->editar($idcategoria, $nombre, $descripcion);
            echo $response ? "Categoría actualizada" : "Error al actualizar categoría";
        }
        break;

    case 'desactivar':
        $response = $categoria->desactivar($idcategoria);
        echo $response ? "Categoría desactivada" : "Error al desactivar categoría";
        break;

    case 'activar':
        $response = $categoria->activar($idcategoria);
        echo $response ? "Categoría activada" : "Error al activar categoría";
        break;

    case 'mostrar':
        $response = $categoria->mostrar($idcategoria);
        echo json_encode($response);
        break;

    case 'listar':
        $response = $categoria->listar();
        $data = Array();

        while ($reg = $response->fetch_object()) {
            $data[] = array(
                "0" => ($reg->activo) ? '<button class="btn btn-warning" onclick="mostrar(' . $reg->idcategoria . ')">
                                            <i class="fa fa-pencil"></i></button>' .
                                        ' <button class="btn btn-danger" onclick="desactivar(' . $reg->idcategoria . ')">
                                            <i class="fa fa-close"></i></button>' :
                                        '<button class="btn btn-warning" onclick="mostrar(' . $reg->idcategoria . ')">
                                             <i class="fa fa-pencil"></i></button>' .
                                        ' <button class="btn btn-primary" onclick="activar(' . $reg->idcategoria . ')">
                                            <i class="fa fa-check"></i></button>',
                "1" => $reg->nombre,
                "2" => $reg->descripcion,
                "3" => ($reg->activo) ? '<span class="label bg-green">Activada</span>' : 
                                        '<span class="label bg-red">Desactivada</span>'
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
