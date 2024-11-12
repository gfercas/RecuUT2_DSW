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
    <h2>Ordena mayor a menor</h2>
    <form action="funciones.php" method="post">
        <input type="text" name="formato" placeholder="Jaime:89;Manolo:45;Paola:105;Merlina:6">
        <input type="submit" name="enviarFor" value="Calcular"><br>
    </form>
    <?php
        if(isset($_SESSION['formato']['resultado'])){
            echo $_SESSION['formato']['resultado'];
        }elseif(isset($_SESSION['formato']['error'])){
            echo "<div class='error'>" . $_SESSION['formato']['error'] . "</div>";
        }
    ?>
    <h2>Guardar notas</h2>
    <form action="funciones.php" method="post">
        <textarea name="nota" placeholder="Introduzca su nota aquí..."></textarea>
        <input type="submit" name="enviarGNot" value="Guardar"><br>
    </form>
    <?php
        if(isset($_SESSION['notas']['resultado'])){
            echo $_SESSION['notas']['resultado'];
        }elseif(isset($_SESSION['notas']['error'])){
            echo "<div class='error'>" . $_SESSION['notas']['error'] . "</div>";
        }
    ?>
    <h2>Ver notas</h2>
    <form action="funciones.php" method="post">
        <input type="submit" name="verNotas" value="Ver notas"><br>
    </form>
    <?php
        if(isset($_SESSION['verNota']['resultado'])){
            echo $_SESSION['verNota']['resultado'];
        }elseif(isset($_SESSION['verNota']['error'])){
            echo "<div class='error'>" . $_SESSION['verNota']['error'] . "</div>";
        }
    ?>
    <h2>Comprobar Fibonacci</h2>
    <form action="funciones.php" method="post">
        <input type="number" name="fibonacci">
        <input type="submit" name="enviarFib" value="Comprobar"><br>
    </form>
    <?php
        if(isset($_SESSION['fibonacci']['resultado'])){
            echo $_SESSION['fibonacci']['resultado'];
        }elseif(isset($_SESSION['fibonacci']['error'])){
            echo "<div class='error'>" . $_SESSION['fibonacci']['error'] . "</div>";
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