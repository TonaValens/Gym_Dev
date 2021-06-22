<?php
require_once '../models/Usuario.php';

$usuario = new Usuario();

$idusuario = isset($_POST["idcategoria"]) ? limpiarCadena($_POST["idcategoria"]) : "";
$nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";
$email = isset($_POST["email"]) ? limpiarCadena($_POST["email"]) : "";
$usr = isset($_POST["usr"]) ? limpiarCadena($_POST["usr"]) : "";
$pwd = isset($_POST["pwd"]) ? limpiarCadena($_POST["pwd"]) : "";
$rol = isset($_POST["rol"]) ? limpiarCadena($_POST["rol"]) : "";
$imagen = isset($_POST["imagen"]) ? limpiarCadena($_POST["imagen"]) : "";

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
                move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/usuarios/" . $imagen);
            }
        }

        if (empty($idarticulo)) {
            $response = $usuario->insertar($nombre, $email, $usr, $pwd, $rol, $imagen);
            echo $response ? "Usuario creado" : "Error al crear el usuario";
        } else {
            $response = $usuario->editar($idusuario, $nombre, $email, $usr, $pwd, $rol, $imagen);
            echo $response ? "Usuario actualizado" : "Error al actualizar el usuario";
        }
        break;

    case 'desactivar':
        $response = $usuario->desactivar($idusuario);
        echo $response ? "Usuario desactivado" : "Error al desactivar el usuario";
        break;

    case 'activar':
        $response = $usuario->activar($idusuario);
        echo $response ? "Usuario activado" : "Error al activar el usuario";
        break;

    case 'mostrar':
        $response = $usuario->mostrar($idusuario);
        echo json_encode($response);
        break;

    case 'listar':
        $response = $usuario->listar();
        $data = Array();

        while ($reg = $response->fetch_object()) {
            $data[] = array(
                "0" => ($reg->activo) ? '<button class="btn btn-warning" onclick="mostrar(' . $reg->idusuario . ')">
                                            <i class="fa fa-pencil"></i></button>' .
                                        ' <button class="btn btn-danger" onclick="desactivar(' . $reg->idusuario . ')">
                                            <i class="fa fa-close"></i></button>' :
                                        '<button class="btn btn-warning" onclick="mostrar(' . $reg->idusuario . ')">
                                             <i class="fa fa-pencil"></i></button>' .
                                        ' <button class="btn btn-primary" onclick="activar(' . $reg->idusuario . ')">
                                            <i class="fa fa-check"></i></button>',
                "1" => $reg->nombre,
                "2" => $reg->email,
                "3" => $reg->usr,
                "4" => $reg->rol,                
                "5" => "<img src='../files/usuarios/". $reg->imagen ."' height='50px' width='50px'>",
                "6" => ($reg->activo) ? '<span class="label bg-green">Activado</span>' : 
                                        '<span class="label bg-red">Desactivado</span>'
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
