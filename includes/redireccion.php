<?php
if(!isset($_SESSION)){
session_start();    
}

if(!isset($_SESSION['usuario'])){
    header("Location:index.php");
}//si no he inicidado sesion entonces que me regrese al indice


