<?php
namespace Colegio;

use PDOException;
use PDO;
use Faker;

class Profesores extends Conexion{
    private $id;
    private $nombre;
    private $apellidos;

    public function __construct()
    {
        parent::__construct();
    }
    //---------------------CRUD---------------------
    public function create(){
        $q="insert into profesores(nombre, apellidos) values(:n, :a)";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute([
                ':n'=>$this->nombre,
                ':a'=>$this->apellidos
            ]);
        }catch(PDOException $ex){
            die("Error al insertar: ".$ex->getMessage());
        }
        parent::$conexion=null;
    }
    public function read($id){
        $q="select * from profesores where id=:i";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute([
                ':i'=>$id
            ]);
        }catch(PDOException $ex){
            die("Error al borrar el profesor: ".$ex->getMessage());
        }
        parent::$conexion=null;
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function update(){
        $q = "update profesores set nombre=:n, apellidos=:a where id=:id";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute([
                ':n'=>$this->nombre,
                ':a'=>$this->apellidos,
                ':id'=>$id
            ]);
        }catch(PDOException $ex){
            die("Error al actualizar el profesor: ".$ex->getMessage());
        }
        parent::$conexion=null;
    }
    public function delete($id){
        $q="delete from profesores where id=:i";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute([
                ':i'=>$id
            ]);
        }catch(PDOException $ex){
            die("Error al borrar el profesor: ".$ex->getMessage());
        }
        parent::$conexion=null;
    }
    //devolveremos todos los registros
    public function readAll(){
        $q="select * from profesores order by id";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute();
        }catch(PDOException $ex){
            die("Error al recuperar todos los profesores: ".$ex->getMessage());
        }
        parent::$conexion=null;
        return $stmt;
    }

    //_______________  OTROS METODOS _______________________
    public function generarProfesores($cant){
        $URL_APP="http://127.0.0.1/~jose/pdo/colegio/public/";
        if(!$this->hayProfesores()){
            $faker=Faker\Factory::create('es_ES');
            for($i=0; $i<$cant; $i++){
                $n=ucfirst($faker->word());
                $a=ucfirst($faker->word());
                (new Profesores)
                ->setNombre($n)
                ->setApellidos($a)
                ->create();
            }
        }

    }
    public function hayProfesores(){
        $q="select * from profesores";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute();
        }catch(PDOException $ex){
            die("Error en hay profesores: ".$ex->getMessage());
        }
        parent::$conexion=null; //cerramos la conexion
        return $stmt->rowCount(); //devuelve el numero de filas
    }

    public function devolverId(){
        $q="select id from profesores order by id";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute();
        }catch(PDOException $ex){
            die("Error en el método devolver id: ".$ex->getMessage());
        }
        $id=[];
        while($fila=$stmt->fetch(PDO::FETCH_OBJ)){
            $id[]=$fila->id;
        }
        parent::$conexion=null;
        return $id;
    }

    public function devolverProfesores($id){
        $q="select * from profesores where id=:i";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute([
                ':i'=>$id
            ]);
        }catch(PDOException $ex){
            die("Error al devolver profesor: ".$ex->getMessage());
        }
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function generarAleatorio(){
        $faker= Faker\Factory::create('es_ES');
        (new Profesores)->setNombre(ucfirst($faker->word()))
        ->setApellidos(ucfirst($faker->word()))
        ->create();
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of img
     */ 
    public function getImg()
    {
        return $this->img;
    }

    /**
     * Set the value of img
     *
     * @return  self
     */ 
    public function setImg($img)
    {
        $this->img = $img;

        return $this;
    }

    /**
     * Get the value of apellidos
     */ 
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set the value of apellidos
     *
     * @return  self
     */ 
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }
}
