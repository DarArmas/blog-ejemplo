

<aside id="sidebar">
    
    <div id="buscador" class="block-aside">  <!--las clases me sirven para que tengan todos los mismos estilos -->
                <h3>Buscar</h3>
               
                
                <form action="buscar.php" method="POST">
                    <input type="text" name="busqueda"/>
                    <input type="submit" value="Buscar"/>
                </form>  
            </div> <!-- enddiv del form de login -->
    
    
           <?php if(isset($_SESSION['usuario'])): ?>  <!-- recuerda que usuario solo existe si se logro identificar correctamente -->
                <div id="usuario-logueado" class="block-aside">
                    <h3>Bienvenido <?=$_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos']; ?></h3>  
                    <!--botones-->
                    <a href="crear-entradas.php" class="boton boton-verde">Crear entradas</a>
                    <a href="crear-categoria.php" class="boton">Crear categorias</a>
                    <a href="mis-datos.php" class="boton boton-naranja">Mis datos</a>
                    <a href="cerrar.php" class="boton boton-rojo">Cerrar sesión</a>   <!-- tiene propiedades de boton y de boton rojo-->
                    
                </div>
           <?php endif; ?>
    
           <?php if(!isset($_SESSION['usuario'])): ?>
            <div id="login" class="block-aside">  <!--las clases me sirven para que tengan todos los mismos estilos -->
                
                 <?php if(isset($_SESSION['error_login'])): ?>  <!-- recuerda que error_login solo existe si tenemos un error en la info de logeado-->
                <div class="alerta alerta-error">
                    <?= $_SESSION['error_login']; ?>
                </div>
           <?php endif; ?>
                
                
                
                
                <h3>Iniciar sesion</h3>
                <form action="login.php" method="POST">
                    <label for="email">Email</label>
                    <input type="email" name="email"/>
                    
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" required="required"/>
                    
                    <input type="submit" value="Entrar" name="submit"/>
                </form>  
            </div> <!-- enddiv del form de login -->

            
            
            <div id="register" class="block-aside">
               <?php //if(isset($_SESSION['errores'])):?>
                <?php //var_dump($_SESSION['errores']); ?>
                <?php //endif; ?>
                <h3>Registrate</h3>
                
                <?php if(isset($_SESSION['completado'])): ?>
                   <div class="alerta alerta-exito"> 
                    <?=$_SESSION['completado']?>
                   </div>
                <?php elseif(isset($_SESSION['errores']['general'])): ?>
                    <div class="alerta alerta-error"> 
                    <?=$_SESSION['errores']['general']?>
                   </div>
                <?php endif; ?>
                    
                
                
                <form action="registro.php" method="POST">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre"/>
                    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : '';   ?>
                    <!-- SI NO EXISTE $_SESSION['errores'] ENTONCES ME VA A DAR ERROR, POR ESO TIENE QUE IMPRIMIR ''--> 
                    
                    <label for="apellidos">Apellidos</label>
                    <input type="text" name="apellidos"/>
                    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellidos') : '';   ?>
                    
                    <label for="email">Email</label>
                    <input type="email" name="email"/>
                    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : '';   ?>
                    
                    <label for="password">Contraseña</label>
                    <input type="password" name="password"/>
                    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'password') : '';   ?>
                    
                    <input type="submit" value="Registrar" name="submit"/>
                </form> 
                <?php borrarErrores(); ?>
               
            </div><!-- enddiv del form de registrarse-->    
            <?php endif;?>
</aside><!--enddiv de la caja aside-->

