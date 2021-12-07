<?php
use Colegio\Departamentos;
require dirname(__DIR__, 2)."/vendor/autoload.php";
(new Departamentos)->generarAleatorio();
header("Location:index.php");