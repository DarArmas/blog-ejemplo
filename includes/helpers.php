<?php
//esto es un script/libreria 

function mostrarError($errores, $campo){
    $alerta = '';
    if(isset($errores[$campo]) && !empty($campo)){
        $alerta = "<div class='alerta alerta-error'>".$errores[$campo]."</div>";
    }
return $alerta;
}
//utilizaré esta funcion para que cada vez que recargue la pagina se me borren los errores
function borrarErrores(){
    
     //$borrado = session_unset();  //SI NO PUSIERA ESTO, CADA VEZ QUE RECARGO LA PAGINA Y POR EJEMPLO SI TENGO MENSAJES, ESTOS SE veran
    $borrado= false; 
    
     if(isset($_SESSION['errores-entrada'])){
         $_SESSION['errores-entrada'] = null;
     } //aqui no necesito que me borre todo porque si no se cierra la sesion
     
     if(isset($_SESSION['errores'])){
         $_SESSION['errores'] = null; // recuerda que al setear nulo esto significa que la variable sesion esta vacia
         $borrado= true;
     }
     
     if(isset($_SESSION['completado'])){
         $_SESSION['completado'] = null;
         $borrado = true;
     }
     return $borrado;//$borrado; 
}


function conseguirCategorias($conexion){
    $sql = "SELECT * FROM categorias ORDER BY id ASC;";
    $categorias = mysqli_query($conexion, $sql);
    $resultado = array();
    
    if($categorias && mysqli_num_rows($categorias) >= 1){
        $resultado = $categorias;
    }else{
        
    }
    
    return $resultado;
}

function conseguirCategoria($conexion, $id){
    $sql = "SELECT * FROM categorias WHERE id = $id";
    $categorias = mysqli_query($conexion, $sql);
    //$resultado = array(); ahora no me va a regresar varios objetos sql, solamente uno, por eso no quiero un array
    
    
    if($categorias && mysqli_num_rows($categorias) >= 1){
        $resultado = mysqli_fetch_assoc($categorias);
    }else{
        
    }
    
    return $resultado;
}


function conseguirEntrada($conexion,$id){
    $sql= "SELECT e.*, c.nombre AS 'categoria', CONCAT(u.nombre,' ',u.apellidos) AS usuario FROM entradas e INNER JOIN categorias c ON e.categoria_id = c.id ".
            "INNER JOIN usuarios u ON e.usuario_id = u.id ".
            "WHERE e.id = $id";
    $entrada = mysqli_query($conexion, $sql);
    
    $resultado = array();
    if($entrada && mysqli_num_rows($entrada) >= 1){
        $resultado = mysqli_fetch_assoc($entrada);
    }
    
    return $resultado;
}


function conseguirEntradas($conexion, $limit = null, $categoria = null, $busqueda = null){  //SI NO LE PASO EL SEGUNDO PARAMETRO ESTE SE TOMARA COMO NULL, INDICANDO QUE IMPRIMA TODAS LAS ENTRADAS
    $sql = "SELECT e.*, c.nombre AS 'categoria' FROM entradas e INNER JOIN categorias c ON e.categoria_id = c.id";
    
    if(!empty($categoria)){
        $sql .= " WHERE e.categoria_id = $categoria";
    }
    
     if(!empty($busqueda)){
        $sql .= " WHERE e.titulo LIKE '%$busqueda%'";
    }
    
    $sql .= " ORDER BY e.id DESC"; //RECUERDA EL ORDEN DE LAS CLAUSULAD DE SQL
    
    if($limit){ //SOLO SI EL SEGUNDO PARAMETRO ES TRUE VA A IMPRIMIR LAS PRIMERAS CUATRO ENTRADAS
        $sql.= " LIMIT 4";
    
    }
    
   
    $entradas = mysqli_query($conexion, $sql);
   
    
    $resultado = array();
    
if($entradas && mysqli_num_rows($entradas) >= 1){
    $resultado = $entradas;
}

return $entradas;
    
}