<?php
require_once '../models/Articulo.php';

$articulo = new Articulo();

$idarticulo = isset($_POST["idarticulo"]) ? limpiarCadena($_POST["idarticulo"]) : "";
$idcategoria = isset($_POST["idcategoria"]) ? limpiarCadena($_POST["idcategoria"]) : "";
$codigo = isset($_POST["codigo"]) ? limpiarCadena($_POST["codigo"]) : "";
$nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";
$descripcion = isset($_POST["descripcion"]) ? limpiarCadena($_POST["descripcion"]) : "";
$imagen = isset($_POST["imagen"]) ? limpiarCadena($_POST["imagen"]) : "";
$stock = isset($_POST["stock"]) ? limpiarCadena($_POST["stock"]) : "";

switch ($_GET["accion"]) {

    case 'guardar':

        if(!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name']))
        {
            $imagen = $_POST["imagenactual"];
        }
        else
        {
            $ext = explode(".", $_FILES['imagen']['name']);

            if($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png") 
            {               
                $imagen = round(microtime(true)) .  '.' . end($ext);
                move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/articulos/" . $imagen);
            }
        }

        if (empty($idarticulo)) {
            $response = $articulo->insertar($idcategoria, $codigo, $nombre, $descripcion, $imagen, $stock);
            echo $response ? "Artículo creado" : "Error al crear el artículo";
        } else {
            $response = $articulo->editar($idarticulo, $idcategoria, $codigo, $nombre, $descripcion, $imagen, $stock);
            echo $response ? "Artículo actualizado" : "Error al actualizar el artículo";
        }
        break;

    case 'desactivar':
        $response = $articulo->desactivar($idarticulo);
        echo $response ? "Artículo desactivado" : "Error al desactivar el artículo";
        break;

    case 'activar':
        $response = $articulo->activar($idarticulo);
        echo $response ? "Artículo activado" : "Error al activar el artículo";
        break;

    case 'mostrar':
        $response = $articulo->mostrar($idarticulo);
        echo json_encode($response);
        break;

    case 'listar':
        $response = $articulo->listar();
        $data = Array();

        while ($reg = $response->fetch_object()) {
            $data[] = array(
                "0" => ($reg->activo) ? '<button class="btn btn-warning" onclick="mostrar(' . $reg->idarticulo . ')">
                                            <i class="fa fa-pencil"></i></button>' .
                                        ' <button class="btn btn-danger" onclick="desactivar(' . $reg->idarticulo . ')">
                                            <i class="fa fa-close"></i></button>' :
                                        '<button class="btn btn-warning" onclick="mostrar(' . $reg->idarticulo . ')">
                                             <i class="fa fa-pencil"></i></button>' .
                                        ' <button class="btn btn-primary" onclick="activar(' . $reg->idarticulo . ')">
                                            <i class="fa fa-check"></i></button>',
                "1" => $reg->nombre,
                "2" => $reg->categoria,
                "3" => $reg->descripcion,
                "4" => $reg->codigo,
                "5" => $reg->stock,
                "6" => "<img src='../files/articulos/". $reg->imagen ."' height='50px' width='50px'>",
                "7" => ($reg->activo) ? '<span class="label bg-green">Activada</span>' : 
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

    case "categoria":
        require_once "../models/Categoria.php";
        $categoria = new Categoria();

        $response = $categoria->select();

        while($registros = $response->fetch_object())
        {
            echo '<option value=' . $registros->idcategoria . '> ' . $registros->nombre . '</option>';
        }
        break;

    default:
        break;
}