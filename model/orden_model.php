<?php

include('../model/connection.php');

class orden_model
{

  function get_cliente_model()
  {
    $connection = new connection();
    $sql = "select * from clientes";
    $result = $connection->get_data($sql);
    return json_encode($result);
  }

  function insert_orden($numero, $diagnostico, $cliente, $estado, $detalle, $valor)
  {
    $connection = new connection();
    $sql = "INSERT INTO orden (clientes_id, numero, diagnostico, estado)
     VALUES ('" . $cliente . "','" . $numero . "','" . $diagnostico . "','" . $estado . "')";
    //return json_encode($sql);
    $last_id = $connection->insert_data2($sql);
    $result="";
    for ($i = 0; $i < count($detalle); $i++) {
      $sql = "INSERT INTO orden_detalle (orden_id, detalle, valor)
     VALUES ('" . $last_id . "','" . $detalle[$i] . "','" . $valor[$i]. "')";
     $result = $connection->insert_data($sql);
    }
    return json_encode($result);
  }
}

//$adsf = new signup_model();
//echo $adsf->get_user();
