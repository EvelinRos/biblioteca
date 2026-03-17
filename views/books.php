<h2 class="mb-3">Gestión de Libros</h2>

<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalBook">
    <i class="fas fa-plus"></i> Nuevo Libro
</button>

<div class="card">
    <div class="card-body">


        <table id="tablaLibros" class="table table-bordered table-striped">

            <thead class="table-dark">
                <tr>
                    <th>Id del Libro</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Isbn</th>
                    <th width="120">Acciones</th>
                </tr>
            </thead>

            <tbody></tbody>

        </table>

    </div>


</div>



<!-- MODAL NUEVO LIBRO -->

<div class="modal fade" id="modalBook" tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <form id="formBook">

                <div class="modal-header bg-primary text-white">

                    <h5 class="modal-title">
                        <i class="fas fa-book"></i> Nuevo Libro
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

                </div>

                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label">Id del Libro</label>

                        <input type="number" name="id_book" class="form-control" required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">Título</label>

                        <input type="text" name="title" class="form-control" required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">Autor</label>

                        <select name="id_author" id="id_author" class="form-control" required>

                            <option value="">Seleccione autor</option>

                        </select>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">ISBN</label>

                        <input type="text" name="isbn" class="form-control">

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar
                    </button>

                    <button type="submit" class="btn btn-success">

                        <i class="fas fa-save"></i>
                        Guardar

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


<!-- MODAL EDITAR LIBRO -->

<div class="modal fade" id="modalEditBook" tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <form id="formEditBook">

                <div class="modal-header bg-warning">

                    <h5 class="modal-title">
                        <i class="fas fa-edit"></i> Editar Libro
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

                </div>

                <div class="modal-body">

                    <input type="hidden" name="id_book" id="edit_id">

                    <div class="mb-3">

                        <label class="form-label">Título</label>

                        <input type="text" name="title" id="edit_title" class="form-control">

                    </div>

                    <div class="mb-3">

                        <label class="form-label">Autor</label>

                        <select name="id_author" id="edit_author" class="form-control">
                        </select>

                    </div>


                    <div class="mb-3">

                        <label class="form-label">Isbn</label>

                        <input type="text" name="isbn" id="edit_isbn" class="form-control">

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="submit" class="btn btn-warning">

                        <i class="fas fa-sync"></i>
                        Actualizar

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>