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
                    <div class="col-11">ACTUALIZACIÓN DE PERSONAL</div>
                </div>
                <hr>
            </div>
            <input type="hidden" id="idInstitucion" value="<?php echo $_SESSION["idInstitucion"]; ?>">
            <?php if ($_SESSION['idInstitucion'] == 1) : ?>
            <div class="form-row">
                <div class="form-group col-sm-12">
                    <label>Nombre de la Institución</label>
                    <select name="cmbInstitucion" id="cmbInstitucion" class="selectpicker form-control" data-live-search="true" required>
                        <option value="" selected>Selecciona una Institucion</option>
                        <?php foreach ($rowInstitucion as $item) : ?>
                            <option value="<?php echo $item['id_institucion']; ?>"><?php echo $item['nombre']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <?php endif; ?>
            <div class="table-responsive <?php if ($_SESSION['idInstitucion'] == 1) echo "pt-5"; ?>">
                <table class="display table table-hover table-sm" id="listPersonal" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" rowspan="2">Nombre</th>
                            <th colspan="12">Opciones</th>
                        </tr>
                        <tr>
                            <th>Editar</th>
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

    <!-- Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form name="formUpdate" id="formUpdate" method="post">
                    <div class="modal-body">

                        <!-- <div class="form-row">
                            <div class="form-group col-sm-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="btn btn-outline-secondary">Institución</label>
                                    </div>
                                    <select name="cmbInstitucion_modal" id="cmbInstitucion_modal" class="form-control" data-live-search="true" required>
                                        <option value="" selected>Selecciona una Institucion</option>
                                        <?php foreach ($rowInstitucion as $item) : ?>
                                            <option value="<?php echo $item['id_institucion']; ?>">
                                                <?php echo $item['nombre']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Por favor seleccione el cargo.
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="msnUpdate">
                            <strong>¡AVISO!</strong>&nbsp;Se realizó la actualizacion del usuario exitosamente
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="btn btn-outline-secondary">Nombre(s)</span>
                                    </div>
                                    <input type="text" name="txtNombre" id="txtNombre" placeholder="Nombre(s)" class="form-control" onkeyup="conMayusculas(this);" onkeypress="return soloLetras(event);" required>
                                    <div class="invalid-feedback">
                                        Escriba el nombre de la persona.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="btn btn-outline-secondary">Apellidos</span>
                                    </div>
                                    <input type="text" name="txtApellido" id="txtApellido" onkeyup="conMayusculas(this);" onkeypress="return soloLetras(event);" placeholder="Apellido Paterno" class="form-control" required>
                                    <div class="invalid-feedback">
                                        Por favor escriba el apellido Paterno.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-12 col-lg-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="btn btn-outline-secondary">Email</span>
                                    </div>
                                    <input type="email" name="txtEmail" id="txtEmail" placeholder="Email" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-sm-12 col-lg-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="btn btn-outline-secondary">Número telefonico</span>
                                    </div>
                                    <input type="text" name="txtTelefono" id="txtTelefono" maxlength="10" placeholder="Ej: 5537126509" onkeypress="return soloNumeros(this);" class="form-control" required>
                                </div>
                                <div class="invalid-feedback">
                                    Por favor escriba el # de telefóno.
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="btn btn-outline-secondary">Cargo</label>
                                    </div>
                                    <select name="cmbCargo" id="cmbCargo" class="custom-select" required>
                                        <option value="" selected>Selecciona un cargo</option>
                                        <?php foreach ($rowRol as $value) { ?>
                                            <option value="<?php echo $value['id_rol']; ?>"><?php echo $value['nombre']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Por favor seleccione el cargo.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="idAdmin" id="idAdmin" value="">
                    </div>
                    <div class="modal-footer">
                        <input type="submit" value="Actualizar Personal" class="btn btn-outline-green btn-lg btn-block">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Invoca al Footer -->
    <?php require_once 'views/layout/footer.php'; ?>
    <script src="<?php echo AccesoDatos::ruta(); ?>assets/js/jqueryUpdateAdministrador.js"></script>
</body>

</html>