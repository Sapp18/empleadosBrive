<?php
echo "<link rel='stylesheet' type='text/css' href='../css/style.css'>";
require '../clases/Metodos.php';

use App\Metodos;


//Ejecutar el código después de que el usuaio envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_FILES['imagen']['name'])) {
        $nombreImagen = $_FILES['imagen']['name'];
        $nombreTemporal = $_FILES['imagen']['tmp_name'];

        //Crear carpeta y validar que ya este creada
        $carpetaImagenes = '../imagenes/';
        if (!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes);
        }
        //Guardar la imagen en la carpeta
        move_uploaded_file($nombreTemporal, $carpetaImagenes . $nombreImagen);
    }
    $propiedad = new Metodos($_POST);
    $propiedad->guardar($nombreImagen);
}

?>


<main class="contenedor2 ">
    <h1>Agregar nuevo empleado</h1>
    <button class="btn-texto">
        <a href="../index.php">Volver</a>
    </button>

    <form class="formulario" method="POST" action="crear.php" enctype="multipart/form-data">
        <fieldset>
            <legend>Información General</legend>

            <label class="form-label" for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" placeholder="Nombre del empleado">

            <label class="form-label" for="empresa">Empresa:</label>
            <input type="text" id="empresa" name="empresa" placeholder="Empresa a la que pertenece">

            <label class="form-label" for="salario">Salario en USD:</label>
            <input type="float" id="salario" name="salario" placeholder="Salario en USD">

            <label class="form-label" for="imagen">Imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

        </fieldset>

        <input type="submit" value="Crear Empleado" class="btn-texto">

    </form>
</main>