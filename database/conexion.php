<?php 
    #funcion para la conexion a base de datos
    function getConexion() {
        $server = "localhost";
        $database = "db_veterinaria";
        $user = "root";
        $password = "";
        // Creando conexion
        $conexion = new mysqli($server, $user, $password, $database);
        $conexion->set_charset("utf8mb4");

        // Verficando conexion
        if (!$conexion) {
            die("Connection failed: " . mysqli_connect_error());
        }

        return $conexion;
    }
?>