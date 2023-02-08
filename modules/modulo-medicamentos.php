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
    $table = "medicamentos"; //nombre tabla
    
    //columnas
    $columnas = [
        'id' => 'NULL',
        'medicamento' => 'NULL',
        'proveedor' => 'NULL',
        'modos_aplicacion' => 'NULL',
        'fecha_vencimiento' => 'NULL',
        'dosis' => 'NULL',
    ];

    //validaciones
    $filter = [
        "id" => FILTER_SANITIZE_ENCODED,
        "medicamento" => [
            'filter' => FILTER_SANITIZE_STRING,
            'flags'  => FILTER_FLAG_STRIP_LOW,
        ],
        "proveedor" => [
            'filter' => FILTER_SANITIZE_STRING,
            'flags'  => FILTER_FLAG_STRIP_LOW,
        ],
        "modos_aplicacion" => [
            'filter' => FILTER_SANITIZE_STRING,
            'flags'  => FILTER_FLAG_STRIP_LOW,
        ],
        "fecha_vencimiento" => [
            'filter' => FILTER_SANITIZE_STRING,
            'flags'  => FILTER_FLAG_STRIP_LOW,
        ],
        "dosis" => FILTER_VALIDATE_INT
    ]; 

    //guardar datos
    if (isPost() and getParam("action") == "save") {
        //cargado datos a modelo
        $columnas["medicamento"] = getParam('medicamento');
        $columnas["proveedor"] = getParam('proveedor');
        $columnas["modos_aplicacion"] = getParam('modos');
        $columnas["fecha_vencimiento"] = getParam('fecha');
        $columnas["dosis"] = getParam('dosis');

        //creamos un nuevo array con las entradas filtradas
        $data = filter_var_array($columnas, $filter);

        if (insert($table, $data) > 0) {
            header('Location: /Laboratorio1/medicamentos');
        }else {
            header('Location: /Laboratorio1/medicamentos');
        }
    }

    //Actualizar datos
    if (isPost() and getParam("action") == "update") {
        //cargado datos a modelo
        $columnas["id"] = getParam("id");
        $columnas["medicamento"] = getParam('medicamento');
        $columnas["proveedor"] = getParam('proveedor');
        $columnas["modos_aplicacion"] = getParam('modos');
        $columnas["fecha_vencimiento"] = getParam('fecha');
        $columnas["dosis"] = getParam('dosis');

        //creamos un nuevo array con las entradas filtradas
        $data = filter_var_array($columnas, $filter);

        if (update($table, $data) > 0) {
            header('Location: /Laboratorio1/medicamentos');
        }else {
            header('Location: /Laboratorio1/medicamentos');
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