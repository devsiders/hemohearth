<div class="modal fade" id="results_<?php echo $datos[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Resultados médicos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../../controllers/paciente.php" method="POST" id="form_results_<?php echo $datos[0]; ?>">
                    <input type="hidden" name="id" value="<?php echo $datos[0]; ?>">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nombre completo</label>
                        <input type="text" class="form-control" readonly name="nombre" value="<?php echo $datos[1] . ' ' . $datos[2]; ?>">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Documento </label>
                        <input type="text" class="form-control" readonly value="<?php echo $datos[3] . ' ' . $datos[4]; ?>">
                    </div>
                    <div class="form-group mt-2">
                        <label for="email">Resultado </label>
                        <input type="number" class="form-control" name="resultado" value="<?php echo $datos[7]; ?>" required>
                    </div>
                    <div class="modal-footer mt-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>