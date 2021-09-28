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
                        <p>De clic sobre la prueba que desea realizar y las que vaya realizando se irán bloqueando.</p>
                        <?php
                        $costo = new Pruebas();
                        $money = $costo->activo_detalle_personas($idDetalle);
                        if(empty($money[0]["costo_pago"])){
                            ?>
                                <form action="" method="post">
                                <p>Por favor indique la cantidad que pago por la prueba.<input type="number" name="costo" required></p>
                                <input type="submit" class="btn btn-outline-green btn-lg btn-block">
                                </form>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            
            <form action="" class="flexcontainerthree" method="post">
                <input type="hidden" name="select_test" value="ok">
                <?php 
                for ($l = 0; $l<sizeof($list); $l++) {
                    $pendiente = "<input type='submit' class='btn btn-outline-green btn-lg btn-block' name='".$list[$l]["idprueba"]."' value='".$list[$l]["prueba"]."'>";
                    $termino = "<button class='btn btn-green btn-lg btn-block' disabled>".$list[$l]["prueba"]."</button>";
                    // $termino = "<br><p><img src='assets/img/check.svg'>".$list[$l]["prueba"]."</p>";
                    if($list[$l]["idprueba"]!=13){
                        //1
                        if($list[$l]["idprueba"]==1 and $list[$l]["avance"]<10){
                            if($estud=="bachillerato" || $estud=="licenciatura" || $estud=="posgrados"){
                                echo $pendiente;
                            }
                        }elseif($list[$l]["idprueba"]==1 and $list[$l]["avance"]==10){
                            echo $termino;
                        }
                        //2
                        if($list[$l]["idprueba"]==2 and $list[$l]["avance"]<11){
                            echo $pendiente;
                        }elseif($list[$l]["idprueba"]==2 and $list[$l]["avance"]==11){
                            echo $termino;
                        } 
                        //3
                        if($list[$l]["idprueba"]==3 and $list[$l]["avance"]<5){
                            echo $pendiente;
                        }elseif($list[$l]["idprueba"]==3 and $list[$l]["avance"]==5){
                            echo $termino;
                        }
                        //4
                        if($list[$l]["idprueba"]==4 and $list[$l]["avance"]<5){
                            if($estud=="ninguno" || $estud=="preescolar" || $estud=="primaria" || $estud=="secundaria"){
                                echo $pendiente;
                            }
                        }elseif($list[$l]["idprueba"]==4 and $list[$l]["avance"]==5){
                            echo $termino;
                        }
                        //5
                        if($list[$l]["idprueba"]==5 and $list[$l]["avance"]<10){
                            echo $pendiente;
                        }elseif($list[$l]["idprueba"]==5 and $list[$l]["avance"]==10){
                            echo $termino;
                        }
                        //6
                        if($list[$l]["idprueba"]==6 and $list[$l]["avance"]<10){
                            echo $pendiente;
                        }elseif($list[$l]["idprueba"]==6 and $list[$l]["avance"]==10){
                            echo $termino;
                        }
                        //7
                        if($list[$l]["idprueba"]==7 and $list[$l]["avance"]<12){
                            echo $pendiente;
                        }elseif($list[$l]["idprueba"]==7 and $list[$l]["avance"]==12){
                            echo $termino;
                        }
                        //8
                        if($list[$l]["idprueba"]==8 and $list[$l]["avance"]<1){
                            echo $pendiente;
                        }elseif($list[$l]["idprueba"]==8 and $list[$l]["avance"]==1){
                            echo $termino;
                        }
                        //9
                        if($list[$l]["idprueba"]==9 and $list[$l]["avance"]<1){
                            echo $pendiente;
                        }elseif($list[$l]["idprueba"]==9 and $list[$l]["avance"]==1){
                            echo $termino;
                        }
                        //10
                        if($list[$l]["idprueba"]==10 and $list[$l]["avance"]<1){
                            echo $pendiente;
                        }elseif($list[$l]["idprueba"]==10 and $list[$l]["avance"]==1){
                            echo $termino;
                        }
                        //11
                        if($list[$l]["idprueba"]==11 and $list[$l]["avance"]<1){
                            echo $pendiente;
                        }elseif($list[$l]["idprueba"]==11 and $list[$l]["avance"]==1){
                            echo $termino;
                        }
                        //12
                        if($list[$l]["idprueba"]==12 and $list[$l]["avance"]<13){
                            echo $pendiente;
                        }elseif($list[$l]["idprueba"]==12 and $list[$l]["avance"]==13){
                            echo $termino;
                        }
                        //14
                        if($list[$l]["idprueba"]==14 and $list[$l]["avance"]<2){
                            echo $pendiente;
                        }elseif($list[$l]["idprueba"]==14 and $list[$l]["avance"]==2){
                            echo $termino;
                        }
                    }
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