<?php

include('../model/signin_model.php');

if ($_GET['request'] == "signin") {
    insert_user_model();
}

function insert_user_model()
{
    $userErr = null;
    $passErr = null;

    if (empty($_POST["user"])) {
        $userErr = "User is required";
    } else {
        $user = test_input($_POST["user"]);
        if (!preg_match("/^[a-zA-Z0-9]*$/", $user)) {
            $userErr = "Only letters and numbers allowed in user";
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

    $array = array(
        array(
            "user" => $userErr
        ),

        array(
            "pass" => $passErr
        ),
    );
    if ($userErr != null || $passErr != null) {
        echo json_encode($array);
    }

    if ($userErr == null && $passErr == null) {
        $user = new signin_model();
        $result = $user->signin($_POST['user'], $_POST['pass']);
        if ($result == "null") {
            $array[] = array('message' => "Contraseña o usuario incorrectas");
            echo json_encode($array);
        } else {
            session_start();
            $_SESSION["usuario"] = array(
                "Cedula" => $result[0]["id"],
                "Nombre" => $result[0]["usuario"],
                "Email" => $result[0]["email"],
            );   
            $array[] = array('message' => str_replace('"', "", json_encode($result)));
            echo json_encode($array);
        }
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
