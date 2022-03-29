<?php

include('../model/orden_model.php');

if ($_GET['request'] == "cliente") {
    get_cliente();
}
if ($_GET['request'] == "insert") {
    insert_orden();
}

function get_cliente()
{   

        $cliente = new orden_model();
        $result = $cliente->get_cliente_model();
       // $array[] = array('message' => str_replace('"', "", $result));
       // echo json_encode($array);
        echo $result;
    
}


function insert_orden()
{
    $error=array();
    $error[]= validate_number($_POST["numero"], "numero");
    $error[]= validate_text_number($_POST["diagnostico"], "deagnostico");
    $error[]= validate_text_number($_POST["cliente"], "cliente");

   // echo $_POST["detalle"][0];
    if (empty($_POST["detalle"]) || empty($_POST["valor"])){
        $error[]= "Detalle es requerido";
    }else{
        $error[]=null;
    }

    if ($error[0] != null || $error[1] != null || $error[2] != null || $error[3] != null) {
        //echo json_encode($error);
       // echo "1";
        echo json_encode($error);
    }

    if ($error[0] == null && $error[1] == null && $error[2] == null && $error[3] == null) {
        $telefono = new orden_model();
        $result = $telefono->insert_orden($_POST['numero'], $_POST['diagnostico'], $_POST['cliente'], 
        $_POST['estado'], $_POST['detalle'], $_POST['valor']);
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
        if (!preg_match("/^[a-zA-ZñÑ0-9\s]*$/", $var)) {
            return "Solo letras y numeros son requeridos en ".$var1;
        }
        return null;
    }
}

function validate_number($var, $var1){
    if (empty($var)) {
        return $var1." es requerido";
    } else {
        if (!preg_match("/^[0-9]*$/", $var)) {
            return "Solo numeros son requeridos en ".$var1;
        }
        return null;
    }

}

