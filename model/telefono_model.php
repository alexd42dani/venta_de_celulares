<?php

include('../model/connection.php');

class telefono_model
{

  function get_cliente_model()
  {
    $connection = new connection();
    $sql = "select * from clientes";
    $result = $connection->get_data($sql);
    return json_encode($result);
  }

  function insert_telefono($marca, $modelo, $serie, $contrasena, $color, $cliente, $memoria, $sim)
  {
    $connection = new connection();
     $sql = "INSERT INTO telefono (clientes_id, marca, modelo, serie, contrasena, color, memoria, sim)
     VALUES ('".$cliente."','".$marca."','". $modelo ."','". $serie ."','". $contrasena ."','". $color ."','". $memoria ."','". $sim ."')";
     //return json_encode($sql);
    $result = $connection->insert_data($sql);
    return json_encode($result);
  }
}

//$adsf = new signup_model();
//echo $adsf->get_user();
