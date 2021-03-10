<!DOCTYPE html>
<html lang="es">
<?php require_once 'views/layout/head.php'; ?>
<body>
<?php require_once 'views/layout/navtest.php'; ?>
    <section class="container pt-5">
        <div class="shadow p-3 mb-5 bg-white rounded">
        <!-- -->
            <?php
            switch ($progreso) {
                case 'Progreso':
                    ?>
                    <div class="form-group row d-flex text-center justify-content-center pt-3 pb-3">
                        <div class="media d-flex align-items-center">
                            <div class="media-body">
                            <form action="<?php echo 'index.php?accion=Raven'; ?>" method="post">
                                <h4>TEST RAVEN</h4>
                                <h5>Descripcion Examen</h5>
                                <p>El test de Raven es una herramienta creada para medir la "inteligencia" o el coeficiente intelectual del sujeto a evaluar, usando el razonamiento por analogías, la comparación de formas y la capacidad de razonamiento con base en estímulos figurativos.</p>
                                <h5>Instrucciones:</h5>
                                <p>En este test encontraras 60 problemas divididos en 5 series. En cada problema encontrara una figura impresa con un espacio en blanco, es decir que está incompleta; debajo de cada figura encontrara igualmente pedazos de figuras igualmente enumeradas, seleccionando la que tu consideres pueda complementar a la figura.
        Trate de resolver todos los problemas si detenerse demasiado. Si alguno se le dificulta continúe con los siguientes regresando a los que le hayan faltado si le queda tiempo.</p>
                                <center><input type="submit" class="btn btn-outline-green btn-lg btn-block" value="CONTINUAR"></center>
                            </form>
                            </div>
                        </div>
                    </div>
                    <?php
                    break;
                case 'Finalizo':
                    ?>
                    <div class="form-group row d-flex text-center justify-content-center pt-3 pb-3">
                        <div class="media d-flex align-items-center">
                            <div class="media-body">
                            <h3>HA CONCLUIDO SATISFACTORIAMENTE EL TEST RAVEN.</h3>
                            <h3>PULSE <a href="<?php echo 'index.php?accion=Tests'; ?>">AQUÍ</a> PARA REGRESAR AL MENÚ DE PRUEBAS.</h3>
                            </div>
                        </div>
                    </div>
                    <?php
                    break;
            }
            ?>
        <!-- -->
        </div>
    </section>
<?php require_once 'views/layout/footer.php'; ?>
</body>
</html>