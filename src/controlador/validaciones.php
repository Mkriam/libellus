<?php

function validarCadena($valor){
    if (is_null($valor)) {
        $valor = false;
    } else {
        $valor = trim($valor);
        $valor = strip_tags($valor);
        $valor = htmlspecialchars($valor, ENT_QUOTES);

        if (empty($valor)) {
            $valor = false;
        }
    }

    return $valor;
}

function validarUsu($valor){

    $valor = validarCadena($valor);
    $patron = "/^[A-Za-z0-9_-]{1,50}$/";
    if (!preg_match($patron, $valor)) {
        $valor = false;
    }

    return $valor;
}

function validarContr($valor)
{
    $valor = validarCadena($valor);

    $patron = "/^[A-Za-z0-9._-]{1,200}$/";

    if (!preg_match($patron, $valor)) {
        $valor = false;
    }

    return $valor;
}

function validarEmail($valor)
{
    $valor = validarCadena($valor);

    $patron = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

    if (!preg_match($patron, $valor)) {
        $valor = false;
    }

    return $valor;
}

function validarFecha($fecha) {
    $fechaValidada = validarCadena($fecha);

    if ($fechaValidada) {
        $formato = 'Y-m-d';
        $d = DateTime::createFromFormat($formato, $fechaValidada);
        if (!($d && $d->format($formato) == $fechaValidada)) {
            $fechaValidada = false;
        }
    }
    return $fechaValidada;
}

function validarUrl($valor){
    $valor = validarCadena($valor);

    $patron = "/^(https?:\/\/)?(www\.)?[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}(\/[^\s]*)?$/";

    if (!preg_match($patron, $valor)) {
        $valor = false;
    }

    return $valor;
}
