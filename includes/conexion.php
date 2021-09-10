<?php
/* 
primero se hace la conexion a la base de datos
 */
$server= 'localhost';   //RECUERDA: SI NO FUERA LOCAL, AQUI SERIA LA IP DEL SERVIDOR
$user='root';
$password= '';
$database = 'prueba';
$db = mysqli_connect($server, $user, $password, $database, "3308");

mysqli_query($db, "SET NAMES 'utf8'"); //PARA NO TENER PROBLEMAS SI ALGUNOS DATOS VIENEN CON Ñ Y ASÍ DESDE LA BASE DE DATOS

//iniciar la sesion
if(!isset($_SESSION)){
session_start();    
}


//if(!mysqli_errno($db)){
//    echo "Conexion exitosa";
//}
