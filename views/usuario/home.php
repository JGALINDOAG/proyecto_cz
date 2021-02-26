<!DOCTYPE html>
<html lang="es">

<!-- Invoca al Head -->
<?php require_once 'views/layout/head.php'; ?>

<body>
    <!-- Invoca al Navbar -->
    <?php NavbarUsuarioController::index(); ?>

    <!-- Cuerpo de la pagina -->
    <section class="container pt-5">
        <div class="shadow p-3 mb-5 bg-white rounded pt-4">
            <div class="alert alert-light" role="alert">
                <div class="form-row">
                    <div class="col-11">LISTADO DE PACIENTES</div>
                    <div class="col-1">
                        <?php echo ' <a href="'.AccesoDatos::ruta().'?accion=expediente&pag=index" ><img src="script/ima/addExped.svg" width="35" height="35" class="d-inline-block align-top" title="Nuevo expediente"></a>'; ?>
                    </div>
                </div>
                <hr>
            </div>
            <div class="table-responsive">
                <table id="paciente" class="table table-sm table-hover" style="width:100%">
                    <thead class="thead-dark">
                        <tr class="text-center">
                            <th scope="col">#</th>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">APELLIDO PATERNO</th>
                            <th scope="col">APELLIDO MATERNO</th>
                            <th scope="col">OPCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for($i=0;$i<count($listPersonas); $i++){ ?>
                        <tr class="text-center">
                            <th scope="row"><?php echo $i+1; ?></th>
                            <td><?php echo $listPersonas[$i]["nombre"]; ?></td>
                            <td><?php echo $listPersonas[$i]["ap_paterno"]; ?></td>
                            <td><?php echo $listPersonas[$i]["ap_materno"]; ?></td>
                            <td>
                                <?php echo ' <a href="'.AccesoDatos::ruta().'?accion=expediente&pag=searchId&cve='.AccesoDatos::encriptar($listPersonas[$i]['cve_persona']).'" ><img src="script/ima/exp.svg" width="35" height="35" class="d-inline-block align-top" title="Consultar expediente"></a>'; ?>
                                <?php echo ' <a href="'.AccesoDatos::ruta().'?accion=expediente&pag=generarPDF&cve='.AccesoDatos::encriptar($listPersonas[$i]['cve_persona']).'" target="_blank"><img src="script/ima/pdf.svg" width="35" height="35" class="d-inline-block align-top" title="Imprimir expediente"></a>'; ?>
                            </td>
                        </tr>
                        <?php  } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- Invoca al Footer -->
    <?php require_once 'views/layout/footer.php'; ?>
    <script src="<?php echo AccesoDatos::ruta(); ?>script/js/JqueryPacientes.js"></script>

</body>
</html>