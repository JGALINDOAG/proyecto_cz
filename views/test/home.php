<?php require_once("views/test/header.php"); ?>
        <nav class="nav">
            <!-- <a onclick="document.getElementById('id01').style.display = 'block'" style="width:auto;">Iniciar sesión</a> -->
            <a onclick="document.getElementById('id01').style.display = 'block'" style="width:auto;" href="<?php echo AccesoDatos::ruta(); ?>?accion=indexUsuario">Iniciar sesión</a>
        </nav>
        <!-- Formulario de registro -->
        <div class="wrap">
            <form action="" class="flexcontainer" method="post">
                <input type="hidden" name="personal" value="ok">
                <p>Nombre:</p>
                <input type="text" name="nom" placeholder="Ingrese su nombre" required>
                <p>Primer apellido:</p>
                <input type="text" name="ap1" placeholder="Ingrese su primer apellido" required>
                <p>Segundo apellido:</p>
                <input type="text" name="ap2" placeholder="Ingrese su segundo apellido">
                <p>Correo electrónico:</p>
                <input type="email" name="email" placeholder="Ingrese su email" required>
                <input type="submit" class="botonsubmit" value="Continuar">
            </form>
        </div>
<?php require_once("views/test/footer.php"); ?>