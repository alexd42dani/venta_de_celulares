<?php

include('../model/connection.php');

class signin_model
{
  function signin($user, $pass)
  {
    $connection = new connection();
    $sql = "SELECT * FROM usuario where usuario = '".$user."' and password = '".hash('sha256', $pass)."'";
   // return json_encode($sql);
    $result = $connection->get_data($sql);
    //return json_encode($result);
    //return $result[0]["id"];
    return $result;
  }
}
