<?php require_once 'includes/redireccion.php' ?> <!--RECUERDA QUE TODAS LAS PAGINAS PRIVADAS LLEVAN ESTE REQUIRE-->
<?php require_once 'includes/helpers.php'; ?> 
<?php require_once 'includes/conexion.php'; ?>    <!--EL REQUIRE ONCE ME EVITA PROBLEMAS DE QUE SE VUELVA A INCLUIR ESA LIBRERIA-->
<?php 
                $entrada_actual = conseguirEntrada($db, $_GET['id']);
                if(!isset($entrada_actual['id'])){
                    header("Location: index.php");    //SI NO EXISTE EL ID DE LA CATEGORIA REGRESA AL INCICIO
                }
?> 


<?php require_once 'includes/cabecera.php'; ?> 
<?php require_once 'includes/lateral.php'; ?>

<div id="principal"> 
    <h1>Editar entrada <?=$entrada_actual['titulo']?></h1>
    <P>
        Añade nuevas entradas al blog para que los 
        usuarios puedan leerlas y disfrutar de nuestro contenido
    </P>
    <br/>
    <form action="guardar-entradas.php?editar=<?=$entrada_actual['id']?>" method="POST">
        <label for="titulo">Titulo:</label> 
        <input type="text" name="titulo" value="<?=$entrada_actual['titulo']?>"/> 
        <?php echo isset($_SESSION['errores-entrada']) ? mostrarError($_SESSION['errores-entrada'], 'titulo') : '';   ?>
        
        <label for="descripcion">Descripcion:</label> 
        <textarea name="descripcion"><?=$entrada_actual['descripcion']?></textarea><br/>
        <?php echo isset($_SESSION['errores-entrada']) ? mostrarError($_SESSION['errores-entrada'], 'descripcion') : '';   ?>
        
        <label for="categoria">Categoría:</label>
        <select name="categoria">
            <?php 
            $categorias = conseguirCategorias($db);
                if(!empty($categorias)):
                    while($categoria = mysqli_fetch_assoc($categorias)):
            ?>
            
            <option value="<?=$categoria['id']?>"
                    <?= ($categoria['id'] == $entrada_actual['categoria_id']) ? 'selected="selected"' : '' ?> > <!--esto solo es para que me salga seleccionado el valor que ya tiene la entrada -->
                     <!-- quiero que cuando eliga la opcion se pase el parametro id-->
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
        