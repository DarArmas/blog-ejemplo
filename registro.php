<?php

if(isset($_POST)){   //EL INPUT TYPE SUBMIT TAMBIEN PUEDE MANDAR INFORMACION SI SE LE DA UN NOMBRE
//
require_once 'includes/conexion.php';
if(!isset($_SESSION)){
session_start();
}
//
//
    //OPERADOR ALTERNATIO: PARA EVITAR TENER QUE ESCRIBIR CONDICIONALES TAN LARGAS
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']): false; //asi se escapa informacion, para que el usuario no pueda crear o modificar consultas
    //        si existe nombre         entonces el valor es $_POST['nombre']      si no es false
     
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    $password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']): false;
 
    
    //ARRAY DE ERRORES: PARA AQUI GUARDAR LOS POSIBLES ERRORES
    $errores = array();
    
    
    //validar los datos antes de guardarlos en la base de datos
    if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/",$nombre)){
        $nombre_valido = true;
    }else{
        $nombre_valido = false;
        $errores['nombre'] = "El nombre es invalido";
    }
    
    if(!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/",$apellidos)){
        $apellidos_valido = true;
    }else{
        $apellidos_valido = false;
        $errores['apellidos'] = "Los apellidos son invalidos";
    }
    
    if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email_valido = true;
    }else{
        $email_valido = false;
        $errores['email'] = "El email es invalido";
    }
    
    if(!empty($password)){
        $password_valido = true;
    }else{
        $password_valido = false;
        $errores['password'] = "La contraseña es invalida";
    }
    
    var_dump($errores);
    //solamente podremos insertar datos cuando no haya ningun error
    $guardar_usuario = false;
    if(count($errores) == 0){
        //INSERTAR USUARIO EN LA TABLA USUARIOS
        $guardar_usuario = true;
        //cifrar la contraseña
        $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);  
                                        //variable de contra     METODO      CUANTAS PASADAS
        
    //password verify: LOS PROGAMADORES NO TIENEN PORQUE SABER LA CONTRASEÑA, SOLO EL HASH
    //var_dump(password_verify($password, $password_segura)); //regresa true mientras coincida
    
        $sql = "INSERT INTO usuarios VALUES(null, '$nombre', '$apellidos', '$email', '$password_segura', CURDATE())";
        $guardar = mysqli_query($db, $sql);
        
        //var_dump(mysqli_error($db));
        //die();
        
        if($guardar){
            $_SESSION['completado'] = "El registro se ha completado con exito";
        }else{
            $_SESSION['errores']['general'] = "Fallo al guardar la informacion";
        }
    
    }else{
        $_SESSION['errores'] = $errores;  //la variable sesion solo va a existir si hay minimo un error
       
    }
    
}

 header('Location: index.php'); //de esta manera tengo en la sesion todos los errores

