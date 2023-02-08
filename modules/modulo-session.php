<?php 
    //incluyendo librerias
    include_once(dirname(__DIR__)."/config/config.php");
    require_once(MODELS."session-model.php");
    require_once(REQUESTS."request.php");

    //Definimos la codificación de caracteres en la cabecera.
    header('Content-Type: text/html; charset=utf-8');


    //iniciar sesion
    if (isPost()) {
        $email = getParam("email");
        $password = md5(getParam("password"));
        $user = array();

        foreach (findUser($email, $password) as $userlogin) {
            $user["userId"] = $userlogin['userId'];
            $user["username"] = $userlogin["username"];
        }

        if (count($user) > 0) {
            session_id(md5($user["username"]));
            session_start();
            
            $_SESSION["logged_ok"] = true;
            $_SESSION["logged_id"] = $user["userId"]; 
            $_SESSION['username'] = $user["username"];

            header("Location: /Laboratorio1/home");
        }else {
            header("Location: /Laboratorio1/login");
        }
    }

    //Cerrar sesion
    if (isGet()) {
        session_start();
        unset($_REQUEST["logout"]);
        session_destroy();
        header("Location: /Laboratorio1/login");
    }
?>