<?php

include('../model/connection.php');

class signin_model
{
  function signin($user, $pass)
  {
    $connection = new connection();
    $sql = "SELECT * FROM user where user = '".$user."' and password = '".hash('sha256', $pass)."'";
    $result = $connection->get_data($sql);
    return json_encode($result);
  }
}
