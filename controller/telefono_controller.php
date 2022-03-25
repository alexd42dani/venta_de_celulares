<?php

include('../model/telefono_model.php');

if ($_GET['request'] == "cliente") {
    get_cliente();
}
if ($_GET['request'] == "insert") {
    insert_telefono();
}

function get_cliente()
{   

        $cliente = new telefono_model();
        $result = $cliente->get_cliente_model();
       // $array[] = array('message' => str_replace('"', "", $result));
       // echo json_encode($array);
        echo $result;
    
}


function insert_telefono()
{
    $error=array();
    $error[]= validate_text_number($_POST["marca"], "marca");
    $error[]= validate_text_number($_POST["modelo"], "modelo");
    $error[]= validate_text_number($_POST["serie"], "serie");
    $error[]= validate_text_number($_POST["contrasena"], "contraseña");
    $error[]= validate_text_number($_POST["color"], "color");

    if ($error[0] != null || $error[1] != null || $error[2] != null || $error[3] != null 
    || $error[4] != null) {
        //echo json_encode($error);
       // echo "1";
        echo json_encode($error);
    }

    if ($error[0] == null && $error[1] == null && $error[2] == null && $error[3] == null 
    && $error[4] == null) {
        $telefono = new telefono_model();
        $result = $telefono->insert_telefono($_POST['marca'], $_POST['modelo'], $_POST['serie'], 
        $_POST['contrasena'], $_POST['color'], $_POST['cliente'], $_POST['memoria'], $_POST['sim']);
        //$array[] = array('message' => str_replace('"', "", $result));
        //echo json_encode($array);
        echo $result;
        //echo "2";
        //echo json_encode($result);
    }
}

function validate_text_number($var, $var1){
    if (empty($var)) {
        return $var1." es requerido";
    } else {
        if (!preg_match("/^[a-zA-Z0-9\s]*$/", $var)) {
            return "Solo letras y numeros son requeridos en ".$var1;
        }
        return null;
    }

}

