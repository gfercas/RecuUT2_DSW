<?php
session_start();
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
        if(isset($_SESSION['binario']['resultado'])){
            echo $_SESSION['binario']['operacion'] . ' => ' . $_SESSION['binario']['resultado'];
        }elseif(isset($_SESSION['binario']['error'])){
            echo "<div class='error'>" . $_SESSION['binario']['error'] . "</div>";
        }
    ?>
    <h2>Calculadora de fechas pasadas</h2>
    <form action="funciones.php" method="post">
        <input type="date" name="fecha" placeholder="Introduce una fecha pasada">
        <input type="submit" name="enviarFec" value="Calcular"><br>
    </form>
    <?php
        if(isset($_SESSION['fecha']['resultado'])){
            echo $_SESSION['fecha']['resultado'];
        }elseif(isset($_SESSION['fecha']['error'])){
            echo "<div class='error'>" . $_SESSION['fecha']['error'] . "</div>";
        }
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