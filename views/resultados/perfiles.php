<!DOCTYPE html>
<html lang="es">

<!-- Invoca al Head -->
<?php require_once 'views/layout/head.php'; ?>

<body>
    <!-- Invoca al Navbar -->
    <?php NavbarUsuarioController::index(); ?>

    <!-- Cuerpo de la pagina -->
    <section class="container pt-5">
        <!-- Reporte por folio -->
        <div class="shadow p-3 mb-5 bg-white rounded pt-4">
            <div class="alert alert-light" role="alert">
                <div class="form-row">
                    <div class="col-11">REPORTE DE PERFILES</div>
                </div>
                <hr>
            </div>
            <div class="form-row">
                <div class="form-group col-sm-12">
                    <label>Nombre de la Institución</label>
                    <select name="cmbInstitucion" id="cmbInstitucion" class="selectpicker form-control" data-live-search="true" required>
                        <option value="" selected>Selecciona una Institucion</option>
                        <?php foreach ($rowInstitucion as $item) : ?>
                            <option value="<?php echo $item['id_institucion']; ?>" <?php if (isset($_POST["cmbInstitucion"]) == $item['id_institucion']) echo "selected"; ?>><?php echo $item['nombre']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-sm-12">
                    <label>Folio</label>
                    <select id="cmbFolio" name="cmbFolio" class="form-control">
                        <option value="" disabled selected>Selecciona el folio a pagar</option>
                    </select>
                </div>
            </div>
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>Rasgos de personalidad</th>
                            <th>Capacidad para adaptarse</th>
                        </tr>
                        <tr>
                            <!-- Rasgos de personalidad -->
                            <th>A - Estres</th>
                            <th>L - Adaptación familiar</th>
                        </tr>
                        <tr>
                            <th>B - Soledad</th>
                            <th>M - Adaptación a la salud</th>
                        </tr>
                        <tr>
                            <th>C - Tristeza</th>
                            <th>N - Adaptación socila</th>
                        </tr>
                        <tr>
                            <th>D - Impulsivo</th>
                            <th>O - Adaptación emoción</th>
                        </tr>
                        <tr>
                            <th>E - Integración social</th>
                            <th>P - Adaptación profesional</th>
                        </tr>
                        <tr>
                            <th>F - Rasgos autodestructivos o destructivos</th>
                        </tr>
                        <tr>
                            <th>G - Alcoholismo</th>
                            <th>&nbsp;</th>
                        </tr>
                        <tr>
                            <th>H - Farmacodependencia</th>
                            <th>&nbsp;</th>
                        </tr>
                        <tr>
                            <th>I - Género</th>
                            <th>&nbsp;</th>
                        </tr>
                        <tr>
                            <th>J - Autodisciplina</th>
                            <th>&nbsp;</th>
                        </tr>
                        <tr>
                            <th>K - Conflictos con la imaginación</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="table-responsive pt-5">
                <table class="display table table-hover table-sm" id="reporte" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" rowspan="2">Nombre</th>
                            <th scope="col" rowspan="2">Grado estudios</th>
                            <th scope="col" rowspan="2">Area</th>
                            <th scope="col" rowspan="2">Turno</th>
                            <th scope="col" rowspan="2">Perfil CI</th>
                            <th colspan="12">Rasgos de personalidad</th>
                            <th colspan="6">Capacidad para adaptarse</th>
                            <th scope="col" rowspan="2">CI Terman</th>
                            <th scope="col" rowspan="2">CI RAVEN</th>
                            <th scope="col" rowspan="2">Perfil Final</th>
                        </tr>
                        <tr>
                            <!-- Rasgos de personalidad -->
                            <th>A</th>
                            <th>B</th>
                            <th>C</th>
                            <th>D</th>
                            <th>E</th>
                            <th>F</th>
                            <th>G</th>
                            <th>H</th>
                            <th>I</th>
                            <th>J</th>
                            <th>K</th>
                            <th>Perfil P1</th>
                            <!-- Capacidad para adaptarse -->
                            <th>L</th>
                            <th>M</th>
                            <th>N</th>
                            <th>O</th>
                            <th>P</th>
                            <th>Perfil P2</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="26" class="text-center">No hay datos disponibles en la tabla.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- Invoca al Footer -->
    <?php require_once 'views/layout/footer.php'; ?>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
    <!-- <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script> -->
    <script src="<?php echo AccesoDatos::ruta(); ?>assets/js/JqueryReportPerfiles.js"></script>
</body>

</html>