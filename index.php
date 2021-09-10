<!--aqui junto todo para hacer la pagina principal-->
<!-- cabecera -->
<?php require_once 'includes/cabecera.php'; ?> 
           
        <!-- sidebar -->
<?php require_once 'includes/lateral.php'; ?>
        
        
        <!-- caja principal -->
        <div id="principal">
            <h1>Ultimas entradas</h1>
            
            <?php 
                $entradas = conseguirEntradas($db, true);
                
                if(!empty($entradas)):
                    while($entrada = mysqli_fetch_assoc($entradas)):
            ?>
            
            <article class="entrada">               <!--un article es como un div pero semanticamente es mejor para los navegadores-->
                
                 
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
                endif;
            ?>
            
            
            <div id="ver-todas">
                <a href="entradas-php.php">Ver todas las entradas</a>
            </div>
        </div> <!--fin principal-->
       
        <!-- pie de pagina -->
<?php require_once 'includes/footer.php';