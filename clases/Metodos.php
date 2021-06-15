<?php

namespace App;

require '../php/database.php';

class Metodos
{
    public $id;
    public $nombre;
    public $empresa;
    public $salario;
    public $imagen;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->empresa = $args['empresa'] ?? '';
        $this->salario = $args['salario'] ?? ''; 
        $this->id = $args['id'] ?? '';
        $this->imagen = $args['imagen'] ?? 'img.jpg';
        
    }

    public function guardar($nombreImagen)
    {
        $db = conectarBD();
        //insertar en la BD
        $query = "INSERT INTO empleados (nombre, empresa, salario, imagen) 
        VALUES('$this->nombre', '$this->empresa', '$this->salario', '$nombreImagen');";
        mysqli_query($db, $query);
        header('location: ../index.php');
    }

    public function actualizar($nombreImagen)
    {
        $db = conectarBD();
        //actualizar en la BD
        $query = "UPDATE empleados SET nombre = '$this->nombre', salario = '$this->salario', imagen = '$nombreImagen' WHERE id ='$this->id';";

        mysqli_query($db, $query);
        header('location: ../index.php');
    }
}
