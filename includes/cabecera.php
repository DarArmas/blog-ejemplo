<?php require_once 'conexion.php'; ?>
<?php require_once 'includes/helpers.php';    ?>

<!DOCTYPE HTML>
<html lang="es">
    <head> 
        <meta charset="utf-8"/>
        <title>Blog de Videojuegos</title>
        <link rel="stylesheet" type="text/css" href="./assets/css/style.css"/> <!--para poder cargar los estilos. RECUERDA: "." SIGNIFICA LA CARPETA EN LA QUE ME ENCUENTRO ACTUALMENTE -->
    </head>
    <body>
        <!-- cabecera -->
        <header id="cabecera">
            <!-- logo-->
            <div id="logo">
            <a href="index.php">
                EL BLOG DEL NARCO              
            </a>
            </div>
             
        <!-- menu -->
        
        <nav id="menu">
            <ul>    
                <li>
                    <a href="index.php">Inicio</a>
                </li>
                <!--conseguir las categorias desde la base de datos-->
                <?php 
                    $categorias = conseguirCategorias($db); //recuerda que la consulta que realizamos en el helper contiene toda la informacion de la tabla CATEGORIAS
                    if(!empty($categorias)):
                        while($categoria = mysqli_fetch_assoc($categorias)):  //por cada fila que recorra que me haga un array asocioativo 
                ?>
                
                        <li>
                        <a href="categoria.php?id=<?=$categoria['id']?>"><?=$categoria['nombre']?></a>
                        </li>
                
                <?php
                        endwhile;
                    endif;
                ?>
                
                 <li>
                    <a href="index.php">Sobre mí</a>
                </li>  
                
                <li>
                    <a href="index.php">Contacto
                    </a>
                </li>  
            
            </ul>
            
            
        </nav>
        <div class="clearfix"></div>
        </header>
        
        <div id="contenedor">