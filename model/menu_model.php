<?php

include('../model/connection.php');

class menu_model
{
  function get_cliente()
  {
    $connection = new connection();
    $sql = "Select count(*) as cliente from clientes";
    //$params = array($user);
    $result = $connection->get_data($sql);
    return json_encode($result);
  }

  function get_orden()
  {
    $connection = new connection();
    $sql = "Select count(*) as orden from orden";
    //$params = array($user);
    $result = $connection->get_data($sql);
    return json_encode($result);
  }

  function get_recibos()
  {
    $connection = new connection();
    $sql = "Select count(*) as recibos from recibos";
    //$params = array($user);
    $result = $connection->get_data($sql);
    return json_encode($result);
  }

  function get_telefonos()
  {
    $connection = new connection();
    $sql = "Select count(*) as telefonos from telefono";
    //$params = array($user);
    $result = $connection->get_data($sql);
    return json_encode($result);
  }
}


