<?php $uri = basename($_SERVER["REQUEST_URI"]); ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center">
            <img src="<?php echo AccesoDatos::ruta(); ?>assets/img/ico.png" width="35" height="35" class="d-inline-block align-top" alt="">
            &nbsp;CHROME
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="navbar-nav mr-auto"></ul>
        <ul class="navbar-nav my-2 my-lg-0">
            <p class="mb-0 text-white-50 bg-dark">Resultados</p>
        </ul>
    </div>
</nav>