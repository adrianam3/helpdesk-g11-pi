<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];
if($method == "OPTIONS") {
    die();
}
//TODO: Controlador de BaseConocimientos
require_once('revisarsesion.controller.php');
require_once('../models/BaseConocimientos.model.php');
error_reporting(0); //DESHABILITAR ERROR, DEJAR COMENTADO si se desea que se muestre el error
$baseConocimientos = new BaseConocimientos;

switch ($_GET["op"]) {
    //TODO: Operaciones de BaseConocimientos

    case 'todos': //TODO: Procedimiento para cargar todos los datos de BaseConocimientos
        $datos = array();
        $datos = $baseConocimientos->todos();
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'uno': //TODO: Procedimiento para obtener un registro de la base de datos
        $idArticulo = $_POST["idArticulo"];
        $datos = array();
        $datos = $baseConocimientos->uno($idArticulo);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;

    case 'insertar': //TODO: Procedimiento para insertar un registro en la base de datos
        $titulo = $_POST["titulo"];
        $contenido = $_POST["contenido"];
        $idCategoria = $_POST["idCategoria"] ? $_POST["idCategoria"] : NULL;
        $idAutor = $_POST["idAutor"];
        $estado = $_POST["estado"];

        $datos = array();
        $datos = $baseConocimientos->insertar($titulo, $contenido, $idCategoria, $idAutor, $estado);
        echo json_encode($datos);
        break;

    case 'actualizar': //TODO: Procedimiento para actualizar un registro en la base de datos
        $idArticulo = $_POST["idArticulo"];
        $titulo = $_POST["titulo"];
        $contenido = $_POST["contenido"];
        $idCategoria = $_POST["idCategoria"] ? $_POST["idCategoria"] : NULL;
        $idAutor = $_POST["idAutor"];
        $estado = $_POST["estado"];
        $datos = array();
        $datos = $baseConocimientos->actualizar($idArticulo, $titulo, $contenido, $idCategoria, $idAutor, $estado);
        echo json_encode($datos);
        break;

    case 'eliminar': //TODO: Procedimiento para eliminar un registro en la base de datos
        $idArticulo = $_POST["idArticulo"];
        $datos = array();
        $datos = $baseConocimientos->eliminar($idArticulo);
        echo json_encode($datos);
        break;
}
