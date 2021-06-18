<?php
require_once '../models/Socio.php';

$socio = new Socio();

$idSocio = isset($_POST["idsocio"]) ? limpiarCadena($_POST["idsocio"]) : "";
$tipoSocio = isset($_POST["id_tipo_socio"]) ? limpiarCadena($_POST["id_tipo_socio"]) : "";
$nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";
$fecNac = isset($_POST["fecha_nacimiento"]) ? limpiarCadena($_POST["fecha_nacimiento"]) : "";
$domicilio = isset($_POST["domicilio"]) ? limpiarCadena($_POST["domicilio"]) : "";
$telefono = isset($_POST["telefono"]) ? limpiarCadena($_POST["telefono"]) : "";
$email = isset($_POST["email"]) ? limpiarCadena($_POST["email"]) : "";

switch ($_GET["accion"]) {

    case 'guardar':
        if (empty($idSocio)) {
            $response = $socio->insertar($idTipoSocio, $nombre, $fecNac, $domicilio, $telefono, $email);
            echo $response ? "Socio creado" : "Error al crear socio";
        } else {
            $response = $socio->editar($idSocio, $idTipoSocio, $nombre, $fecNac, $domicilio, $telefono, $email);
            echo $response ? "Socio actualizado" : "Error al actualizar socio";
        }
        break;

    case 'desactivar':
        $response = $socio->desactivar($idSocio);
        echo $response ? "Socio desactivada" : "Error al desactivar socio";
        break;

    case 'activar':
        $response = $socio->activar($idSocio);
        echo $response ? "Socio activado" : "Error al activar socio";
        break;

    case 'mostrar':
        $response = $socio->mostrar($idSocio);
        echo json_encode($response);
        break;

    case 'listar':
        $response = $socio->listar();
        $data = Array();

        while ($reg = $response->fetch_object()) {
            $data[] = array(
                "0" => ($reg->activo) ? '<button class="btn btn-warning" onclick="mostrar(' . $reg->idSocio . ')">
                                            <i class="fa fa-pencil"></i></button>' .
                                        ' <button class="btn btn-danger" onclick="desactivar(' . $reg->idSocio . ')">
                                            <i class="fa fa-close"></i></button>' :
                                        '<button class="btn btn-warning" onclick="mostrar(' . $reg->idSocio . ')">
                                             <i class="fa fa-pencil"></i></button>' .
                                        ' <button class="btn btn-primary" onclick="activar(' . $reg->idSocio . ')">
                                            <i class="fa fa-check"></i></button>',
                "1" => $reg->nombre,
                "2" => $reg->$tipoSocio,
                "3" => $reg->$fecNac,
                "4" => $reg->$domicilio,
                "5" => $reg->$telefono,
                "6" => $reg->$email,
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

    default:
        break;
}
