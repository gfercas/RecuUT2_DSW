<?php
session_start();
define('RUTANOTAS', 'notas.json');

/* Un función que reciba números binarios y nos devuelva su valor decimal y la operación realizada.
Debes hacer la operación como si la estuvieras haciendo a mano, sin usar funciones predefinidas de php como bindec(). */
function binarioToDecimal($binario)
{
    if (!preg_match('/^[01]+$/', $binario)) {
        $_SESSION['binario']['error'] = 'Debes introducir un número binario';
        return;
    }
    $operacion = '';
    $suma = 0;
    foreach (array_reverse(str_split($binario)) as $key => $value) {
        if ($value) {
            $x = pow(2, $key);
            $operacion = "$x + " . $operacion;
            $suma += $x;
        } else {
            $operacion = "0 + " . $operacion;
        }
    }
    $_SESSION['binario']['resultado'] =  substr($operacion, 0, -2) . ' => ' . $suma;
}

/* Una función que reciba una fecha pasada y nos devuelva un desglose de los años, meses y días que han pasado hasta el día de hoy. 
Ej: 9 años, 2 meses y 27 días. */
function calculadoraFecha($fecha)
{
    $fecha = date_create($fecha);
    if ($fecha === false) {
        $_SESSION['fecha']['error'] = 'Debes introducir una fecha válida. Ej: 30/05/2010';
        return;
    }
    $hoy = date_create('now');
    if ($hoy <= $fecha) {
        $_SESSION['fecha']['error'] = 'Debes introducir una fecha pasada. Ej: 30/05/2010';
        return;
    }
    $intervalo = date_diff($hoy, $fecha);
    $_SESSION['fecha']['resultado'] = $intervalo->format('Años: %y, meses: %m, días: %d');
}

/* Una función que reciba un texto en formato:
      Jaime:89;Manolo:45;Paola:105;Merlina:6
Y pinte estos datos ordenados de mayor a menor. No tiene que devolverlos en el 	mismo formato, sino pintarlos en la web. */
function ordenaFormato($cadena)
{
    if (!is_string($cadena) || strpos($cadena, ':') === false) {
        $_SESSION['formato']['error'] = 'Debes introducir un formato válido. Ej: Jaime:89;Manolo:45;Paola:105;Merlina:6';
        return;
    }
    $formatoArray = [];
    foreach (explode(';', $cadena) as $persona) {
        $item = explode(':', $persona);
        $formatoArray[$item[1]] = $item[0];
    }
    krsort($formatoArray);
    $_SESSION['formato']['resultado'] = '';
    foreach ($formatoArray as $num => $nombre) {
        $_SESSION['formato']['resultado'] .= "$nombre => $num<br>";
    }
}

/* Una función que reciba un texto y nos los guarde en un JSON con la fecha y hora de inserción.*/
function guardarNota($nota)
{
    if (empty($nota)) {
        $_SESSION['notas']['error'] = 'Debes introducir una nota de texto';
        return;
    }
    if (file_exists(RUTANOTAS)) {
        $notas = json_decode(file_get_contents(RUTANOTAS), 1);
    }else{
        $notas = [];
    }
    $notas[date("Y-m-d H:i:s")] = $nota;
    if(!file_put_contents(RUTANOTAS, json_encode($notas))){
        $_SESSION['notas']['error'] = 'Ha surgido un error del servidor.';
        return;
    };
    $_SESSION['notas']['resultado'] = 'Nota guardada!';
}

/* Otra función que nos imprima todas esas notas guardadas en el JSON (con su fecha y hora, los mas recientes primero). */
function verNotas()
{
    try {
        $notas = [];
        if (file_exists(RUTANOTAS)) {
            $notas = json_decode(file_get_contents(RUTANOTAS), 1);
        } else {
            $_SESSION['verNotas']['error'] = 'No hay notas guardadas!';
            return;
        }
        if (empty($notas)) {
            $_SESSION['verNotas']['error'] = 'No hay notas guardadas!';
            return;
        }
        $_SESSION['verNotas']['resultado'] = '';
        foreach (array_reverse($notas) as $fecha => $nota) {
            $_SESSION['verNotas']['resultado'] .= "$fecha  =>  $nota <br><br>";
        }
    } catch (Exception $e) {
        $_SESSION['verNotas']['error'] = 'Ha surgido un error del servidor.';
        return;
    }
}

/* Una función que reciba un número y compruebe si pertenece a la serie de Fibonacci. */
function fibonacci(int $numero)
{
    if (!is_numeric($numero)) {
        $_SESSION['fibonacci']['error'] = 'Debes introducir un número.';
        return;
    }
    if ($numero < 0) {
        $_SESSION['fibonacci']['error'] = 'Debes introducir un número positivo.';
        return;
    }
    if ($numero === 0 || $numero === 1) {
        $_SESSION['fibonacci']['resultado'] = "El número $numero pertenece a la sucesión de Fibonacci.";
        return;
    }
    $valorA = 0;
    $valorB = 1;
    while ($valorA < $numero) {
        $aux = $valorA + $valorB;
        if ($aux === $numero) {
            $_SESSION['fibonacci']['resultado'] = "El número $numero pertenece a la sucesión de Fibonacci.";
            return;
        }
        $valorA = $valorB;
        $valorB = $aux;
    }
    $_SESSION['fibonacci']['resultado'] = "El número $numero NO pertenece a la sucesión de Fibonacci.";
    return;
}

if (isset($_POST['enviarBin'])) {
    binarioToDecimal($_POST['binario']);
} elseif (isset($_POST['enviarFec'])) {
    calculadoraFecha($_POST['fecha']);
} elseif (isset($_POST['enviarFor'])) {
    ordenaFormato($_POST['formato']);
} elseif (isset($_POST['enviarGNot'])) {
    guardarNota($_POST['nota']);
} elseif (isset($_POST['verNotas'])) {
    verNotas();
} elseif (isset($_POST['enviarFib'])) {
    fibonacci($_POST['fibonacci']);
}

header('Location: index.php');
die();