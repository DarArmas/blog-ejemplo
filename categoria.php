<?php require_once 'includes/helpers.php'; ?> 
<?php require_once 'includes/conexion.php'; ?>    <!--EL REQUIRE ONCE ME EVITA PROBLEMAS DE QUE SE VUELVA A INCLUIR ESA LIBRERIA-->
<?php 
                $categoria_actual = conseguirCategoria($db, $_GET['id']);
                if(!isset($categoria_actual['id'])){
                    header("Location: index.php");    //SI NO EXISTE EL ID DE LA CATEGORIA REGRESA AL INCICIO
                }
?>  


<?php require_once 'includes/cabecera.php'; ?> 
<?php require_once 'includes/lateral.php'; ?>
        
        
        <div id="principal">
            
            
            <h1>Entradas de <?=$categoria_actual['nombre'] ?></h1>
            
            <?php 
                $entradas = conseguirEntradas($db, null,$_GET['id'] );
                
                if(!empty($entradas) && mysqli_num_rows($entradas) >= 1):
                    while($entrada = mysqli_fetch_assoc($entradas)):
            ?>
            
            <article class="entrada">             
                
                 
                <a href="entrada.php?id=<?=$entrada['id']?>">
                    <h2><?= $entrada['titulo']?></h2>
                    <span class="fecha"><?= $entrada['categoria'].' | '.$entrada['fecha'] ?></span>
                        <p>
                            <?= substr($entrada['descripcion'], 0,300)."..." //imprime desde el caracter 0 hasta el 300 ?>  
                        </p>
                </a>
            </article>
            
            
            
            <?php
                    endwhile;                    
                else:
            ?>
            <div class="alerta-error"> No hay entradas en  esta categoria</div>
            <?php 
                endif;
            ?>
            
<?php require_once 'includes/footer.php';




