<?php
require 'php/layout/header.php';
require 'php/database.php';

$db = conectarBD();

//Escribir el query
$query = "SELECT * FROM empleados";

//Consultar la BD
$resultadoConsulta = mysqli_query($db, $query);

?>

<header>
    <div class="contenedor">
        <div class="contenido">
            <p class="total-empleados"><span></span> Empleados en total</p>
        </div>
        <div class="contenido">
            <p> Buscar: <input type="text" id="buscar" placeholder="Ingresa nombre o empresa "> </p>
        </div>
        <div class="contenido">
            <p class="tipo-cambio"><span></span> </p>
        </div>
    </div>
</header>

<main>
    <div class="botones-principales">
        <span>
            <button class="btn-texto">
                <a href="../empleados/php/crear.php">Agregar nuevo empleado</a>
            </button>
        </span>
        <span>
            <input type="submit" name="" class="moneda-boton btn-texto" onclick="funcionBoton();">
        </span>
    </div>

    <div id="formulario">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Empresa</th>
                    <th>Salario</th>
                    <th>Imagen</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody>
                <!--.Mostrar los resultados-->
                <?php while ($valores = mysqli_fetch_assoc($resultadoConsulta)) : ?>
                    <tr>
                        <td><?php echo $valores['id'] ?></td>
                        <td><?php echo $valores['nombre'] ?></td>
                        <td><?php echo $valores['empresa'] ?></td>
                        <td class="salario"><?php
                                            echo number_format($valores['salario'], 2);
                                            ?></td>
                        <td><img src="imagenes/<?php echo $valores['imagen'] ?>" class="imagen-tabla" WIDTH=100 HEIGHT=100> </td>
                        <td>
                            <button class="btn-texto">
                                <a href="php/actualizar.php?id= <?php echo $valores['id']; ?>">Editar</a>
                            </button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</main>

<?php
//cerrar la conexion
mysqli_close($db);

include 'php/layout/footer.php';
?>