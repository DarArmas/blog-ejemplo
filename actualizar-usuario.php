<?php

if(isset($_POST)){   

        require_once 'includes/conexion.php';
        
        if(!isset($_SESSION)){
            session_start();
        }
        
        //var_dump($_SESSION['usuario']);
        //die();
        
        //RECOGER LOS VALORES DEL FORMULARIO DE ACTUALIZACION
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']): false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    
    
    $errores = array();
    
     

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
    
    //var_dump($errores);

    $guardar_usuario = false;
 
    
    if(count($errores) == 0){
        $usuario = $_SESSION['usuario']; //ahora tengo u array asociativo con todos los datos que tengo de usuario en mi sesion
        $guardar_usuario = true;                               
        
        //ANTES DE ACTUALIZAR LOS DATOS DE USUARIO TENGO QUE ASEGURARME QUE EL EMAIL NO EXISTE
        $sql = "SELECT id, email FROM usuarios WHERE email = '$email'";
        $isset_email = mysqli_query($db, $sql); // recuerda que aqui se me guarda 1 o 0
        $isset_user = mysqli_fetch_assoc($isset_email);
        
//        echo "Este de aqui es el id de mi SESSION".var_dump($_SESSION['usuario']);
//        
//        echo "Este de aqui es el id de la Consulta". var_dump($isset_user);
//        
//        die();
        
        //ES DECIR, SOLO VA A GUARDAR LA INFORMACION SI EL CORREO NO ES CAMBIA/ ES EL MISMO DEL USUARIO QUE TIENE LA SESION 
        //INICIDADA O CUANDO NO EXISTA EL USER CON EL EMAIL QUE SE HA INTRODUCIDO
        if($isset_user['id'] == $usuario['id'] || empty($isset_user)){
                //ACTUALIZAR LA INFORMACION DEL USUARIO
                
                $sql = "UPDATE usuarios SET nombre = '$nombre', apellidos ='$apellidos', email = '$email' WHERE id= ".$usuario['id' ];
                $guardar = mysqli_query($db, $sql);

                //EJEMPLO PARA VER ERRORES EN LA CONSULTA
                //echo mysqli_error($db);
               //die();

                if($guardar){
                    //ES IMPORTANTE ACTUALIZAR LA INFORMACION EN LA SESION
                    $_SESSION['usuario']['nombre'] = $nombre;
                    $_SESSION['usuario']['apellidos'] = $apellidos;
                    $_SESSION['usuario']['email'] = $email;
                    $_SESSION['completado'] = "Los datos se han actualizado con exito";
                }else{
                    $_SESSION['errores']['general'] = "Fallo al actualizar la informacion";
                }
                
         }else{
             $_SESSION['errores']['general'] = "Este correo ya está en uso";
         }
    
    }else{
        $_SESSION['errores'] = $errores;  
    }
    
}

 header('Location: mis-datos.php'); 