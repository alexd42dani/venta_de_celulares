<?php

include('../model/signup_model.php');

if ($_GET['request'] == "signup") {
    insert_user_model();
}
if ($_GET['request'] == "usertest") {
    usertest();
}

function insert_user_model()
{
    $nameErr = null;
    $userErr = null;
    $emailErr = null;
    $passErr = null;
    $pass1Err = null;

    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed in name";
        }
    }

    if (empty($_POST["user"])) {
        $userErr = "User is required";
    } else {
        $user = test_input($_POST["user"]);
        if (!preg_match("/^[a-zA-Z0-9]*$/", $user)) {
            $userErr = "Only letters and numbers allowed in user";
        }
    }

    $user = new signup_model();
    $result = $user->user_test($_POST['user']);
    $user_array = json_decode($result);
    //echo $user_array[0]->id_user;
    //echo json_encode($user_array);

    if (!is_null($user_array)) {
        $userErr = "Username is already in use";
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    if (empty($_POST["pass"])) {
        $passErr = "Password is required";
    } else {
        $pass = test_input($_POST["pass"]);
        if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(\W|_)).{8,}$/", $pass)) {
            $passErr = "La contraseña debe tener como minimo ocho caracteres, una letra, mayuscula, minuscula y un caracter";
        }
    }

    if (empty($_POST["pass1"])) {
        $pass1Err = "Second password is required";
    } else {
        $pass1 = test_input($_POST["pass1"]);
        if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(\W|_)).{8,}$/", $pass1)) {
            $pass1Err = "La contraseña debe tener como minimo ocho caracteres, una letra, mayuscula, minuscula y un caracter";
        }
    }

    if ($_POST["pass"] !== $_POST["pass1"]) {
        $passErr = "Passwords do not match";
        $pass1Err = "Passwords do not match";
    }

    $array = array(
        array(
            "name" => $nameErr
        ),

        array(
            "user" => $userErr
        ),

        array(
            "email" => $emailErr
        ),

        array(
            "pass" => $passErr
        ),

        array(
            "pass1" => $pass1Err
        ),

    );
    if ($nameErr != null || $userErr != null || $emailErr != null || $passErr != null || $pass1Err != null) {
        echo json_encode($array);
    }

    if ($nameErr == null && $userErr == null && $emailErr == null && $passErr == null && $pass1Err == null) {
        $user = new signup_model();
        $result = $user->insert_user($_POST['user'], $_POST['pass'], $_POST['name'], $_POST['email']);
        $array[] = array('message' => str_replace('"', "", $result));
        echo json_encode($array);
        //echo $result;
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function usertest()
{
    $user = new signup_model();
    $result = $user->user_test($_POST['user']);
    echo $result;
}
