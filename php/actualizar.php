<?php
echo "<link rel='stylesheet' type='text/css' href='../css/style.css'>";
//Conexión a la Base de datos
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
    $propiedad->actualizar($nombreImagen);
}

?>

<main class="contenedor2 ">
    <h1>Actualizar Empleado</h1>

    <button class="btn-texto">
        <a href="../index.php">Volver</a>
    </button>

    <form method="POST" action="actualizar.php" enctype="multipart/form-data">
        <fieldset>
            <legend>Información General</legend>

            <label class="form-label" for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" placeholder="Nombre del empleado">

            <label class="form-label" for="salario">Salario:</label>
            <input type="float" id="salario" name="salario" placeholder="Salario del empleado">

            <label class="form-label" for="imagen">Imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
        </fieldset>

        <input type="submit" value="Actualizar datos del empleado" class="btn-texto">

    </form>
</main>