<?php
session_start();

function mostrarResultado($tipo) {
    if(isset($_SESSION[$tipo]['resultado'])){
        echo $_SESSION[$tipo]['resultado'];
    } elseif(isset($_SESSION[$tipo]['error'])) {
        echo "<div class='error'>" . $_SESSION[$tipo]['error'] . "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funciones varias</title>
</head>
<body>
    <h1>Bienvenido a mi página de funciones</h1>

    <h2>Calculadora de números decimales</h2>
    <form action="funciones.php" method="post">
        <input type="number" name="binario" placeholder="Introduce un número binario">
        <input type="submit" name="enviarBin" value="Calcular"><br>
    </form>
    <?php
        mostrarResultado('binario');
    ?>
    <h2>Calculadora de fechas pasadas</h2>
    <form action="funciones.php" method="post">
        <input type="date" name="fecha" placeholder="Introduce una fecha pasada">
        <input type="submit" name="enviarFec" value="Calcular"><br>
    </form>
    <?php
        mostrarResultado('fecha');
    ?>
    <h2>Ordena mayor a menor</h2>
    <form action="funciones.php" method="post">
        <input type="text" name="formato" placeholder="Jaime:89;Manolo:45;Paola:105;Merlina:6">
        <input type="submit" name="enviarFor" value="Calcular"><br>
    </form>
    <?php
        mostrarResultado('formato');
    ?>
    <h2>Guardar notas</h2>
    <form action="funciones.php" method="post">
        <textarea name="nota" placeholder="Introduzca su nota aquí..."></textarea>
        <input type="submit" name="enviarGNot" value="Guardar"><br>
    </form>
    <?php
        mostrarResultado('notas');
    ?>
    <h2>Ver notas</h2>
    <form action="funciones.php" method="post">
        <input type="submit" name="verNotas" value="Ver notas"><br>
    </form>
    <?php
        mostrarResultado('verNotas');
    ?>
    <h2>Comprobar Fibonacci</h2>
    <form action="funciones.php" method="post">
        <input type="number" name="fibonacci">
        <input type="submit" name="enviarFib" value="Comprobar"><br>
    </form>
    <?php
        mostrarResultado('fibonacci');
    ?>
</body>
</html>

<style>
    .error {
        color: red;
    }
</style>

<?php
session_unset();
?>