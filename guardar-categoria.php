<?php
if(isset($_POST)){
    require_once 'includes/conexion.php';
    
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    
    $errores = array();
    
    if(!empty($nombre) && !is_numeric($nombre)){
        $nombre_valido = true;
    }else{
        $nombre_valido = false;
        $errores['nombre'] = "El nombre no es valido";
    }
    
    if(count($errores) == 0){  // si no hay ningun error entonces va a hacer la consulta
        $sql= "INSERT INTO categorias VALUES(NULL,'$nombre');";
        $guardar = mysqli_query($db, $sql);
    }
}//fin del isset($_POST)

header("Location:index.php"); 