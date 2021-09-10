<?php

//1.iniciar la sesion y la conexion a la bd
require_once 'includes/conexion.php';


////2.recoger datos del formulario
if(isset($_POST)){
  
    $email = trim($_POST['email']); //recuerda que trim es para quitar los espacios 
    $password = $_POST['password'];
    
    //CONSULTA PARA COMPROBAR LAS CREDENCIALES DEL USUARIO
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";   //para saber si esta registrado ese correo (CONSULTA PARA CONOCER LAS CREDENCIALES DEL USUARIO)
    $login = mysqli_query($db, $sql);       //hacer la consulta
    
    if($login && mysqli_num_rows($login)==1){     //confirmar que no se repita el correo
     
        $usuario = mysqli_fetch_assoc($login);      //GUARDAR LA INFORMACION EN EL ARRAY $usuario
        $verify = password_verify($password, $usuario['password']);   //la funcion verify retorna true o false en funcion de si matchean
        
        if($verify){
        //5.utilizar una sesion para guardar los datos del usuario logeado
            $_SESSION['usuario'] = $usuario;
            // en caso de que ya ponga la contraseña correctamente entonces se borra la informacion del error
            if(isset($_SESSION['error_login'])){
                session_unset($_SESSION['error_login']);
            }
            
        }else{
        //6. enviar una sesion con el fallo
            $_SESSION['error_login'] = "Contraseña incorrecta puñeton!";
        } 
        
    }else{   // EN CASO DE NO QUE NO EXISTA EL CORREO QUE INTRODUCISTE 
         $_SESSION['error_login'] = "No existe este correo";
    }
}

//7.redirigir al index
header("Location: index.php");
