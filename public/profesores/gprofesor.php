<?php
use Colegio\Profesores;
require dirname(__DIR__, 2)."/vendor/autoload.php";
(new Profesores)->generarAleatorio();
header("Location:index.php");