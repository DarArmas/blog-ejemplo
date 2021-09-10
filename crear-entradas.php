<?php include_once 'includes/redireccion.php' ?>
<?php require_once 'includes/cabecera.php'; ?> 
<?php require_once 'includes/lateral.php'; ?>

<div id="principal"> 
    <h1>Crear entradas</h1>
    <P>
        Añade nuevas entradas al blog para que los 
        usuarios puedan leerlas y disfrutar de nuestro contenido
    </P>
    <br/>
    <form action="guardar-entradas.php" method="POST">
        <label for="titulo">Titulo:</label> 
        <input type="text" name="titulo"/> 
        <?php echo isset($_SESSION['errores-entrada']) ? mostrarError($_SESSION['errores-entrada'], 'titulo') : '';   ?>
        
        <label for="descripcion">Descripcion:</label> 
        <textarea name="descripcion"></textarea><br/>
        <?php echo isset($_SESSION['errores-entrada']) ? mostrarError($_SESSION['errores-entrada'], 'descripcion') : '';   ?>
        
        <label for="categoria">Categoría:</label>
        <select name="categoria">
            <?php 
            $categorias = conseguirCategorias($db);
                if(!empty($categorias)):
                    while($categoria = mysqli_fetch_assoc($categorias)):
            ?>
            
            <option value="<?=$categoria['id']?>">  <!-- quiero que cuando eliga la opcion se pase el parametro id-->
                <?=$categoria['nombre'] ?>
            </option>
            
            <?php 
                    endwhile;
                endif;
            ?>
            
        </select>
        <?php echo isset($_SESSION['errores-entrada']) ? mostrarError($_SESSION['errores-entrada'], 'categoria') : '';   ?>
        
        <input type="submit" value="Guardar"/>
    </form>
    <?php            borrarErrores(); ?>
</div>

<?php require_once 'includes/footer.php';
