<?php
    $title = "Contact";
    require_once "./utils/utils.php";
    /*
        Inicializar SIEMPRE todas las variables
    */
    $info = $firstName = $lastName = $email = $subject = $message = "";
    $firstNameError = $emailErr = $subjectError = $hayErrores = false;
    $errores = [];

    if ("POST" === $_SERVER["REQUEST_METHOD"]) {
        //Nunca confiar en que llegan todos los datos!!
        $firstName = sanitizeInput(($_POST["firstName"] ?? ""));
        $lastName = sanitizeInput(($_POST["lastName"] ?? "")); //Campo opcional
        $email = sanitizeInput(($_POST["email"] ?? ""));
        $subject = sanitizeInput(($_POST["subject"] ?? ""));
        $message = sanitizeInput(($_POST["message"] ?? "")); //Campo opcional
        //Ahora hacer las comprobaciones
        if (empty($firstName)) {
            $errores[] =  "El nombre es obligatorio";
            $firstNameError = true;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores[] =  "Formato inválido de correo";
            $emailErr = true;
        }
        if (empty($subject)) {
            $errores[] =  "El asunto es obligatorio";
            $subjectError = true;
        }
        if (sizeOf($errores) > 0) {
            $hayErrores = true;
        }
        if (!$hayErrores) {
            //En este caso todo ha ido bien. En un caso real insertaríamos el mensaje en la base de datos
            //... Código para insertar.
            //Además, en este caso vamos a mostrar un mensaje al usuario indicando que todo ha ido bien
            $info = "Mensaje insertado correctamente:"; 
             //Reseteamos los datos del formulario
             $firstName = $lastName = $email = $subject = $message = "";
        }else {
            $info = "Datos erróneos"; 
        }
    }    
    include("./views/contact.view.php");