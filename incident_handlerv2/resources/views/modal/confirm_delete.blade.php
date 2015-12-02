<script>
    function onClickDelete(type, id) {
        //Cambia las etiquetas que se requieren para personalizarlo con el módulo en cuestión
        //TODO mejorar performance en las consultas de jQuery
        $('#modalConfirmDelete .modal-title > b').text(id);
        $('#modalConfirmDelete .modal-title > span').text(type.toLowerCase());
        $('#modalConfirmDelete .modal-body > span').text(type.toLowerCase());

        $('#modalConfirmDelete').modal('show', {backdrop: 'fade'});

        /**
         * Define la acción en caso de que haya sido presionado el botón "Eliminar"
         */
        $('#modalConfirmDelete .modal-footer .btn-danger').click(function () {
            //En este caso, se ejecuta el submit del form con el id definido
            $('#deleteForm-' + id).submit();
        });
    }
</script>

<div aria-hidden="false" class="modal fade in" id="modalConfirmDelete">
    <div class="modal-backdrop fade in"></div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Eliminar <span></span> <b></b></h4>
            </div>
            <div class="modal-body">
                ¿Seguro que desea eliminar este <span></span>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger">Borrar</button>
            </div>
        </div>
    </div>
</div>