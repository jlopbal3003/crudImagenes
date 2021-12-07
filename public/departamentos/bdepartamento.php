<?php
session_start();
if (!isset($_POST['id'])) {
    header("Location: index.php");
    die();
}
require dirname(__DIR__, 2)."/vendor/autoload.php";
use Colegio\Departamentos;
(new Departamentos)->delete($_POST['id']);
$_SESSION['mensaje']="Departamento borrado con éxito";
header("Location:index.php");