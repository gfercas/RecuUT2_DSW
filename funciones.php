<?php
session_start();

/* Un función que reciba números binarios y nos devuelva su valor decimal y la operación realizada.
Debes hacer la operación como si la estuvieras haciendo a mano, sin usar funciones predefinidas de php como bindec(). */
function binarioToDecimal($binario){
    if (!preg_match('/^[01]+$/', $binario)) {
        $_SESSION['binario']['error'] = 'Debes introducir un número binario';
        return;
    }
    $operacion = '';
    $suma = 0;
    foreach(array_reverse(str_split($binario)) as $key => $value){
        if($value){
            $x = pow(2,$key);
            $operacion = "$x + " . $operacion;
            $suma += $x;
        }else{
            $operacion = "0 + " . $operacion;
        }
    }
    $_SESSION['binario']['resultado'] = $suma;
    $_SESSION['binario']['operacion'] = substr($operacion, 0, -2);
}

/* Una función que reciba una fecha pasada y nos devuelva un desglose de los años, meses y días que han pasado hasta el día de hoy. 
Ej: 9 años, 2 meses y 27 días. */
function calculadoraFecha($fecha){
    $fecha = date_create($fecha);
    if($fecha === false){
        $_SESSION['fecha']['error'] = 'Debes introducir una fecha válida. Ej: 30/05/2010';
        return;
    }
    $hoy = date_create('now');
    if($hoy<=$fecha){
        $_SESSION['fecha']['error'] = 'Debes introducir una fecha pasada. Ej: 30/05/2010';
        return;
    }
    $intervalo = date_diff($hoy, $fecha);
    $_SESSION['fecha']['resultado'] = $intervalo->format('Años: %y, meses: %m, días: %d');

}

if(isset($_POST['enviarBin'])){
    binarioToDecimal($_POST['binario']);
}elseif(isset($_POST['enviarFec'])){
    calculadoraFecha($_POST['fecha']);
}


header('Location: index.php');
die();
