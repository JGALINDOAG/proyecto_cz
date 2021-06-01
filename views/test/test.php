<!DOCTYPE html>
<html lang="es">
<?php require_once 'views/layout/head.php'; ?>
<body>
<?php require_once 'views/layout/navtest.php'; ?>
    <section class="container pt-5">
        <div class="shadow p-3 mb-5 bg-white rounded">
        <!-- -->
        <?php if($activo[0]['activo']==1){ ?>
            <div class="form-group row d-flex text-center justify-content-center pt-3 pb-3">
                <div class="media d-flex align-items-center">
                    <div class="media-body">
                        <h5 class="mt-0">PRUEBAS DISPONIBLES</h5>
                        <p>De clic sobre la prueba que desea realizar.</p>
                    </div>
                </div>
            </div>
            
            <form action="" class="flexcontainerthree" method="post">
                <input type="hidden" name="select_test" value="ok">
                <?php 
                for ($l = 0; $l<sizeof($list); $l++) { 
                    $cadena=str_replace(' ','',$list[$l]["prueba"]);
                    ?>
                    <!--<input type="submit" class="btn btn-outline-green btn-lg btn-block" name="<?php //echo $cadena; ?>" value="<?php //echo $list[$l]["prueba"]; ?>">-->
                    <?php
                    //
                    if($list[$l]["id_prueba"]!=13){
                        if($list[$l]["id_prueba"]==1){
                            if($estud=="bachillerato" || $estud=="licenciatura" || $estud=="posgrados"){
                                ?>
                                <input type="submit" class="btn btn-outline-green btn-lg btn-block" name="<?php echo $cadena; ?>" value="<?php echo $list[$l]["prueba"]; ?>">
                                <?php
                            }
                        }elseif($list[$l]["id_prueba"]==4){
                            if($estud=="ninguno" || $estud=="preescolar" || $estud=="primaria" || $estud=="secundaria"){
                                ?>
                                <input type="submit" class="btn btn-outline-green btn-lg btn-block" name="<?php echo $cadena; ?>" value="<?php echo $list[$l]["prueba"]; ?>">
                                <?php
                            }
                        }else{
                            ?>
                            <input type="submit" class="btn btn-outline-green btn-lg btn-block" name="<?php echo $cadena; ?>" value="<?php echo $list[$l]["prueba"]; ?>">
                            <?php
                        }
                    }
                    //
                }
                ?>
            </form>
            <?php }elseif($activo[0]['activo']==0){ ?>
                <div class="form-group row d-flex text-center justify-content-center pt-3 pb-3">
                <div class="media d-flex align-items-center">
                    <div class="media-body">
                        <h5 class="mt-0">MENSAJE</h5>
                        <p>Se requiere activación de las pruebas.</p>
                    </div>
                </div>
            </div>
            <?php } ?>
        <!-- -->
        </div>
    </section>
<?php require_once 'views/layout/footer.php'; ?>
</body>
</html>