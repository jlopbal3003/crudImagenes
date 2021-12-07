<?php
namespace Colegio;

use PDOException;
use PDO;
use Faker;

class Departamentos extends Conexion{
    private $id;
    private $nombre;
    private $img;

    public function __construct()
    {
        parent::__construct();
    }
    //---------------------CRUD---------------------
    public function create(){
        $q="insert into departamentos(nombre, img) values(:n, :i)";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute([
                ':n'=>$this->nombre,
                ':i'=>$this->img
            ]);
        }catch(PDOException $ex){
            die("Error al insertar: ".$ex->getMessage());
        }
        parent::$conexion=null;
    }
    public function read($id){
        $q="select * from departamentos where id=:i";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute([
                ':i'=>$id
            ]);
        }catch(PDOException $ex){
            die("Error al borrar el departamento: ".$ex->getMessage());
        }
        parent::$conexion=null;
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function update(){
        $q = "update departamentos set nombre=:n, img=:i where id=:id";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute([
                ':n'=>$this->nombre,
                ':i'=>$this->img,
                ':id'=>$id
            ]);
        }catch(PDOException $ex){
            die("Error al actualizar el departamento: ".$ex->getMessage());
        }
        parent::$conexion=null;
    }
    public function delete($id){
        $q="delete from departamentos where id=:i";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute([
                ':i'=>$id
            ]);
        }catch(PDOException $ex){
            die("Error al borrar el departamento: ".$ex->getMessage());
        }
        parent::$conexion=null;
    }
    //devolveremos todos los registros
    public function readAll(){
        $q="select * from departamentos order by id";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute();
        }catch(PDOException $ex){
            die("Error al recuperar todos los departamentos: ".$ex->getMessage());
        }
        parent::$conexion=null;
        return $stmt;
    }

    //_______________  OTROS METODOS _______________________
    public function generarDepartamentos($cant){
        $URL_APP="http://127.0.0.1/~jose/pdo/colegio/public/";
        if(!$this->hayDepartamentos()){
            $faker=Faker\Factory::create('es_ES');
            for($i=0; $i<$cant; $i++){
                $n=ucfirst($faker->word());
                $p=$faker->country();
                (new Departamentos)
                ->setNombre($n)
                ->setImg($URL_APP."img/departamentos/default.png")
                ->create();
            }
        }

    }
    public function hayDepartamentos(){
        $q="select * from departamentos";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute();
        }catch(PDOException $ex){
            die("Error en hay departamentos: ".$ex->getMessage());
        }
        parent::$conexion=null;
        return $stmt->rowCount();
    }

    public function devolverId(){
        $q="select id from departamentos order by id";
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

    public function devolverDepartamentos($id){
        $q="select * from departamentos where id=:i";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute([
                ':i'=>$id
            ]);
        }catch(PDOException $ex){
            die("Error al devolver artículo: ".$ex->getMessage());
        }
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function generarAleatorio(){
        $faker= Faker\Factory::create('es_ES');
        $URL_APP="http://127.0.0.1/~jose/pdo/colegio/public/";
        (new Departamentos)->setNombre(ucfirst($faker->word()))
        ->setImg($URL_APP."img/departamentos/default.png")
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
}
