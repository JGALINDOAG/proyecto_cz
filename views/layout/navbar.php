<?php $uri = basename($_SERVER["REQUEST_URI"]); ?>
<nav class="navbar navbar-expand-lg navbar-dark <?php if (isset($_SESSION['isLoggedIn'])) echo 'bg-dark'; else echo "bg-dark-nav"; ?>">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="<?php echo AccesoDatos::ruta(); ?>?accion=indexUsuario">
            <img src="<?php echo AccesoDatos::ruta(); ?>assets/img/ico.png" width="45" height="45" class="d-inline-block align-top" alt="">
            &nbsp;CHROME
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <?php if (isset($_SESSION['isLoggedIn'])) : ?>
                <ul class="navbar-nav mr-auto">
                    <?php if (!empty($json_menu_fijo)) : ?>
                        <?php foreach ($json_menu_fijo as $key => $item_principal) : ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php echo $key ?>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <?php foreach ($item_principal as $key => $item) : ?>
                                        <a class="dropdown-item" href="<?php echo AccesoDatos::ruta() . $item["enlace"]; ?>"><?php echo $key; ?></a>
                                    <?php endforeach; ?>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
                <ul class="navbar-nav my-2 my-lg-0">
                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Bienvenido(a) <?php echo $_SESSION["nombre"]; ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="?accion=homeUsuario&pag=updateUser">Cambiar contraseña</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?php echo AccesoDatos::ruta(); ?>?accion=salirUsuario">Cerrar
                                sesión</a>
                        </div>
                    </li>
                </ul>
            <?php else : ?>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo AccesoDatos::ruta(); ?>?accion=loginUsuario">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo AccesoDatos::ruta(); ?>?accion=Home">Realizar pruebas</a>
                    </li>
                </ul>
                <!-- <ul class="navbar-nav my-2 my-lg-0"> -->
                <ul class="my-2 my-lg-0">
                    <p class="mb-0 text-white-50">CHROME | Crhome Consultores</p>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</nav>