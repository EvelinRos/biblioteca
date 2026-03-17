<h2 class="mb-3">Gestión de Autores</h2>

<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalAuthor">
    <i class="fas fa-plus"></i> Nuevo Autor
</button>

<div class="card">
    <div class="card-body">

        <table id="tablaAutores" class="table table-bordered table-striped">

            <thead class="table-dark">
                <tr>
                    <th>Id del Autor</th>
                    <th>Nombre del Autor</th>
                    <th width="120">Acciones</th>
                </tr>
            </thead>

            <tbody></tbody>

        </table>

    </div>

</div>

<!-- MODAL CREAR AUTOR -->

<div class="modal fade" id="modalAuthor" tabindex="-1">

    <div class="modal-dialog">
        <div class="modal-content">

            <form id="formAuthor">

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Nuevo Autor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Id del Autor</label>
                        <input type="number" name="id_author" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nombre del Autor</label>
                        <input type="text" name="name_author" class="form-control" required>
                    </div>

                </div>

                <div class="modal-footer">

                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Guardar
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>

<!-- MODAL EDITAR AUTOR -->

<div class="modal fade" id="modalEditAuthor" tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <form id="formEditAuthor">

                <div class="modal-header bg-warning text-dark">

                    <h5 class="modal-title">

                        <i class="fas fa-edit"></i> Editar Autor
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="hidden" name="id_author" id="edit_id_author">

                    <div class="mb-3">

                        <label class="form-label">Nombre del Autor</label>

                        <input type="text" name="name_author" id="edit_name_author" class="form-control" required>
                    </div>

                </div>

                <div class="modal-footer">

                    <button type="submit" class="btn btn-warning">

                        <i class="fas fa-sync"></i> Actualizar

                    </button>

                </div>

            </form>

        </div>
    </div>

</div>