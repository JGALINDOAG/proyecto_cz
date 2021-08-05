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
                            <option value="<?php echo $item['id_institucion']; ?>" <?php if (isset($_POST["cmbInstitucion"]) == $item['id_institucion']) echo "selected"; ?>>
                                <?php echo $item['nombre']; ?>
                            </option>
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
                            <th>Personalidad 1</th>
                            <th>Personalidad 2</th>
                        </tr>
                        <tr>
                            <!-- Personalidad 1 -->
                            <th>1 - ESTRES</th>
                            <th>12 - ADAPTACIÓN FAMILIAR</th>
                        </tr>
                        <tr>
                            <th>2 - SOLEDAD</th>
                            <th>13 - ADAPTACIÓN A LA SALUD</th>
                        </tr>
                        <tr>
                            <th>3 - TRISTEZA</th>
                            <th>14 - ADAPTACIÓN SOCIAL</th>
                        </tr>
                        <tr>
                            <th>4 - IMPULSIVO</th>
                            <th>15 - ADAPTACIÓN EMOCIÓN</th>
                        </tr>
                        <tr>
                            <th>5 - INTEGRACION SOCIAL</th>
                            <th>16 - ADAPTACIÓN PROFESIONAL</th>
                        </tr>
                        <tr>
                            <th>6 - DISTANCIAMIENTO DEL YO</th>
                        </tr>
                        <tr>
                            <th>7 - ALCOHOLISMO</th>
                            <th>&nbsp;</th>
                        </tr>
                        <tr>
                            <th>8 - FARMACODEPENDENCIA</th>
                            <th>&nbsp;</th>
                        </tr>
                        <tr>
                            <th>9 - GÉNERO</th>
                            <th>&nbsp;</th>
                        </tr>
                        <tr>
                            <th>10 - AUTODISCIPLINA</th>
                            <th>&nbsp;</th>
                        </tr>
                        <tr>
                            <th>11 - DIFICULTAD EN EL SUPER YO</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="table-responsive pt-5">
                <table class="table table-hover table-sm" id="reporte" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" rowspan="2">Nombre</th>
                            <th scope="col" rowspan="2">Grado estudios</th>
                            <th scope="col" rowspan="2">Area</th>
                            <th scope="col" rowspan="2">Turno</th>
                            <th colspan="12">Personalidad 1</th>
                            <th colspan="6">Personalidad 2</th>
                            <th scope="col" rowspan="2">CI Terman</th>
                            <th scope="col" rowspan="2">CI RAVEN</th>
                            <th scope="col" rowspan="2">Perfil CI</th>
                            <th scope="col" rowspan="2">Perfil Final</th>
                        </tr>
                        <tr>
                            <!-- Personalidad 1 -->
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                            <th>5</th>
                            <th>6</th>
                            <th>7</th>
                            <th>8</th>
                            <th>9</th>
                            <th>10</th>
                            <th>11</th>
                            <th>Perfil</th>
                            <!-- Personalidad 2 -->
                            <th>12</th>
                            <th>13</th>
                            <th>14</th>
                            <th>15</th>
                            <th>16</th>
                            <th>Perfil</th>
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
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
    <script src="<?php echo AccesoDatos::ruta(); ?>assets/js/JqueryReportPerfiles.js"></script>
</body>

</html>