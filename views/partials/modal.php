<div class="modal fade" id="results_<?php echo $paciente[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Resultados médicos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../../controllers/resultados.php" method="POST" id="form_results_<?php echo $paciente[0]; ?>">
                    <input type="hidden" name="id" value="<?php echo $paciente[0]; ?>">
                    <div class="form-group mb-3">
                        <label class="form-label">Nombre completo</label>
                        <input type="text" class="form-control bg-light" readonly name="nombre" value="<?php echo $paciente[1] . ' ' . $paciente[2]; ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Documento </label>
                        <input type="text" class="form-control bg-light" readonly value="<?php echo $paciente[3] . ' ' . $paciente[4]; ?>">
                    </div>
                    <div class="form-group mt-3">
                        <label class="form-label">Resultado </label>
                        <input type="number" class="form-control" name="resultado" value="<?php echo $paciente[7]; ?>" required>
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