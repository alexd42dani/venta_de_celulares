<?php

include('../model/menu_model.php');

if ($_GET['request'] == "cliente") {
    get_cliente();
}

if ($_GET['request'] == "orden") {
    get_orden();
}

if ($_GET['request'] == "recibos") {
    get_recibos();
}

if ($_GET['request'] == "telefonos") {
    get_telefonos();
}

function get_cliente()
{
    $cliente = new menu_model();
    $result = $cliente->get_cliente();
    echo $result;
}   

function get_orden()
{
    $orden = new menu_model();
    $result = $orden->get_orden();
    echo $result;
}   

function get_recibos()
{
    $model = new menu_model();
    $result = $model->get_recibos();
    echo $result;
}   

function get_telefonos()
{
    $model = new menu_model();
    $result = $model->get_telefonos();
    echo $result;
}   