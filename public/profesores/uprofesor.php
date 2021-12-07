<?php
session_start();
use Colegio\Profesores;
require dirname (__DIR__, 2)."/vendor/autoload.php";
$id=$_GET['id'];
$datosProfesores=(new Profesores)->devolverProfesores($id);

if(isset($_POST['btnUpdate'])){
    $nomb=trim(ucfirst($_POST['nombre']));
    $apellidos=trim($_POST['apellidos']);
    (new Profesores)->setId($id)
    ->setNombre($nomb)
    ->setApellidos($apellidos)
    ->update();
    $_SESSION['mensaje']="Profesor actualizado con éxito";
    header("Location:index.php");
}
else{
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- BootStrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <!-- FONTAWESOME -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>Colegio</title>
    </head>

    <body style="background-color:#FFE87C">
        <h3 class="text-center">Actualizar profesor (<?php echo $datosProfesores->id ?>)</h3>
        <div class="container mt-2">
            <div class="bg-warning p-4 text-white rounded shadow-lg m-auto" style="width:35rem">
                <form name="uarticulo" action="<?php echo $_SERVER['PHP_SELF']."?id=$id"; ?>" method='POST'>
                    <div class="mb-3">
                        <a href="index.php" class="btn btn-success my-2">&nbsp;<i class="fas fa-arrow-circle-left"></i>&nbsp;</a>
                    </div>
                    <div class="mb-3">
                        <label for="n" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="n" name="nombre" value="<?php echo $datosProfesores->nombre ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="n" class="form-label">Apellidos:</label>
                        <input type="text" class="form-control" id="p" name="apellidos" value="<?php echo $datosProfesores->apellidos ?>" required>
                    </div>
                    <div>
                        <button type='submit' name="btnUpdate" class="btn btn-info"><i class="fas fa-edit"></i> Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
<?php } ?>