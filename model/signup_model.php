<?php

include('../model/connection.php');

class signup_model
{
  function insert_user($user, $pass, $nombre, $email)
  {
    $connection = new connection();
    // $sql = "INSERT INTO user (user, password, nombre)
    // VALUES ('".$user."','". hash('sha256', $pass)."','". $nombre ."')";
    $sql = "INSERT INTO user (user, password, nombre, email)
    VALUES (?, ?, ?, ?)";
    // return json_encode($sql);
    $params = array($user, hash('sha256', $pass), $nombre, $email);
    //$result = $connection->insert_data($sql);
    $result = $connection->insert_data1($sql, $params);
    return json_encode($result);
  }
  function user_test($user)
  {
    $connection = new connection();
    $sql = "Select * from user where user = '".$user."'";
    //$params = array($user);
    $result = $connection->get_data($sql);
    return json_encode($result);
  }
}

//$adsf = new signup_model();
//echo $adsf->get_user();
