<?php $uri = basename($_SERVER["REQUEST_URI"]); ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="<?php echo AccesoDatos::ruta(); ?>">
            <img src="<?php echo AccesoDatos::ruta(); ?>assets/img/ico.png" width="35" height="35" class="d-inline-block align-top" alt="">
            &nbsp;Cruzeac
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <?php if (isset($_SESSION['isLoggedIn'])):?>
            <ul class="navbar-nav mr-auto">
                <?php 
                foreach ($menu as $key=>$title): 
                if($title['sub_menu'] == 0):
                ?>
                <li class="nav-item <?php if ($uri == $title['enlace']) echo 'active'; ?>">
                    <a class="nav-link" href="<?php echo $title['enlace']; ?>"><?php echo $title['texto_enlace']; ?></a>
                </li>
                <?php endif; ?>
                <?php endforeach; ?>
                <li class="nav-item dropdown" <?php if ($uri == $title['enlace']) echo 'active'; ?>>
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Institución
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php 
                    foreach ($menu as $key=>$title):  
                    if($title['sub_menu'] == 1):
                    ?>
                    <a class="dropdown-item" href="<?php echo $title['enlace']; ?>"><?php echo $title['texto_enlace']; ?></a>
                    <!-- <div class="dropdown-divider"></div> -->
                    <?php endif; ?>
                    <?php endforeach; ?>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav my-2 my-lg-0">
                <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Bienvenido(a) <?php echo $_SESSION["nombre"]; ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="?accion=homeUsuario&pag=updateUser">Cambiar contraseña</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo AccesoDatos::ruta();?>?accion=salirUsuario">Cerrar
                            sesión</a>
                    </div>
                </li>
            </ul>
            <?php else: ?>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo AccesoDatos::ruta(); ?>?accion=Home">Test</a>
                </li>
            </ul>
            <ul class="navbar-nav my-2 my-lg-0">
                <p class="mb-0 text-white-50 bg-dark">Cruzeac, Inteligencia y Excelencia | Cruzeac Consultores S. A. de C. V.</p>
            </ul>
            <?php endif; ?>
        </div>
    </div>
</nav>