<?php
    //incluyendo librerias
    include_once(dirname(__DIR__)."/config/config.php");
    require_once(MODELS."model.php");
    require_once(REQUESTS."request.php");

    //para hacer uso del modulo debe tener rol admin
    session_start();
    if (!isset($_SESSION["logged_ok"])) {
        header("Location: /Laboratorio1/login");
    }

    //Definimos la codificación de caracteres en la cabecera.
    header('Content-Type: text/html; charset=utf-8');
    
    //configuracion de tabla
    $table = "mascotas"; //nombre tabla
    
    //columnas
    $columnas = [
        'id' => 'NULL',
        'id_cliente' => 'NULL',
        'nombre' => 'NULL',
        'tipo' => 'NULL',
        'raza' => 'NULL',
        'especie' => 'NULL',
        'fecha_nacimietno' => 'NULL',
    ];

    //validaciones
    $filter = [
        "id" => FILTER_SANITIZE_ENCODED,
        "id_cliente" => FILTER_SANITIZE_ENCODED,
        "nombre" => [
            'filter' => FILTER_SANITIZE_STRING,
            'flags'  => FILTER_FLAG_STRIP_LOW,
        ],
        "tipo" => [
            'filter' => FILTER_SANITIZE_STRING,
            'flags'  => FILTER_FLAG_STRIP_LOW,
        ],
        "raza" => [
            'filter' => FILTER_SANITIZE_STRING,
            'flags'  => FILTER_FLAG_STRIP_LOW,
        ],
        "especie" => [
            'filter' => FILTER_SANITIZE_STRING,
            'flags'  => FILTER_FLAG_STRIP_LOW,
        ],
        "fecha_nacimiento" => [
            'filter' => FILTER_SANITIZE_STRING,
            'flags'  => FILTER_FLAG_STRIP_LOW,
        ]
    ]; 

    //guardar datos
    if (isPost() and getParam("action") == "save") {
        //cargado datos a modelo
        $columnas["id_cliente"] = getParam("cliente");
        $columnas["nombre"] = getParam('nombre');
        $columnas["tipo"] = getParam('tipo');
        $columnas["raza"] = getParam('raza');
        $columnas["especie"] = getParam('especie');
        $columnas["fecha_nacimiento"] = getParam('fecha');

        //creamos un nuevo array con las entradas filtradas
        $data = filter_var_array($columnas, $filter);
        if (insert($table, $data) > 0) {
            header('Location: /Laboratorio1/mascotas');
        }else {
            header('Location: /Laboratorio1/mascotas');
        }
    }

    //Actualizar datos
    if (isPost() and getParam("action") == "update") {
        //cargado datos a modelo
        $columnas["id"] = getParam("id");
        $columnas["id_cliente"] = getParam("cliente");
        $columnas["nombre"] = getParam('nombre');
        $columnas["tipo"] = getParam('tipo');
        $columnas["raza"] = getParam('raza');
        $columnas["especie"] = getParam('especie');
        $columnas["fecha_nacimiento"] = getParam('fecha');

        //creamos un nuevo array con las entradas filtradas
        $data = filter_var_array($columnas, $filter);

        if (update($table, $data) > 0) {
            header('Location: /Laboratorio1/mascotas');
        }else {
            header('Location: /Laboratorio1/mascotas');
        }
    }

    //Eliminar datos
    if (isGet() && getParam("action") == "delete") {   

        if (delete($table, getParam("id")) > 0) {
            echo json_encode(array('token_delete'=>true));
        }else {
            echo json_encode(array('token_delete'=>false));
        }
    }
?>