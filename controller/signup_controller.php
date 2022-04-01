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
    $telefonoErr = null;
    $direccionErr = null;
    $userErr = null;
    $emailErr = null;
    $passErr = null;
    $pass1Err = null;

    if (empty($_POST["telefono"])) {
        $telefonoErr = "telefono is required";
    } else {
        $telefono = test_input($_POST["telefono"]);
        if (!preg_match("/^[a-zA-Z0-9]*$/", $telefono)) {
            $telefonoErr = "Only letters and numbers allowed in telefono";
        }
    }

    if (empty($_POST["direccion"])) {
        $direccionErr = "direccion is required";
    } else {
        $direccion = test_input($_POST["direccion"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $direccion)) {
            $direccionErr = "Only letters and white space allowed in direccion";
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
            "telefono" => $telefonoErr
        ),
        array(
            "direccion" => $direccionErr
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

    if ($telefonoErr != null || $direccionErr != null || $userErr != null || $emailErr != null || $passErr != null || $pass1Err != null) {
        echo json_encode($array);
    }

    if ($telefonoErr == null && $direccionErr == null && $userErr == null && $emailErr == null && $passErr == null && $pass1Err == null) {
        $upload_image = $_FILES["foto"]["name"];
        $folder = "../img/";
        move_uploaded_file($_FILES["foto"]["tmp_name"], "$folder" . $_FILES["foto"]["name"]);

        $user = new signup_model();
        $result = $user->insert_user($_POST['user'], $_POST['pass'], $_POST['telefono'], $_POST['direccion'], $_POST['email'], $upload_image);
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
