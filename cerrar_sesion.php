<?php

if ($_GET['cerrar_sesion'] == "1") {
    session_start();
    session_destroy();
    header("Location:signin.html");
}