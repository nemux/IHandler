<script>
    function modalDeleteEvidence(id) {
        $('#modalConfirmDeleteEvidence').modal('show', {backdrop: 'fade'});
        $('#modalConfirmDeleteEvidence .modal-footer .btn-danger').unbind('click').click(function () {

            $.ajax({
                url: '/dashboard/incident/delete/evidence/' + id,
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    _method: 'delete'
                },
                success: function (response) {
                    if (response.status === 0) {
                        $("#ie-" + id).remove();
                    }
                },
                failed: function (msg) {
                    alert(msg)
                }
            });

            $('#modalConfirmDeleteEvidence').modal('hide');
        })
        ;
    }
    function modalDeleteEvent(isNew, id, callback) {
        $('#modalConfirmDeleteEvent').modal('show', {backdrop: 'fade'});
        $('#modalConfirmDeleteEvent .modal-footer .btn-danger').unbind('click').click(function () {
            if (!isNew)
                $.ajax({
                    url: '/dashboard/incident/delete/event/' + id,
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        _method: 'delete'
                    },
                    success: function (response) {
                        if (response.status === 0) {
                            callback(true);
                        }
                    },
                    failed: function (msg) {
                        alert(msg);
                        callback(false);
                    }
                });
            else
                callback(true);

            $('#modalConfirmDeleteEvent').modal('hide');
        });

        return status;
    }
</script>

<div aria-hidden="false" class="modal fade in" id="modalConfirmDeleteEvidence">
    <div class="modal-backdrop fade in"></div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Eliminar la Evidencia del Incidente</h4>
            </div>
            <div class="modal-body">
                ¿Seguro que desea eliminar la evidencia seleccionada? <br/>
                <b>Esta acción no se podrá deshacer</b>
                <br/>
                <br/>Nota: Los archivos no serán eliminados del repositorio
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger">Borrar</button>
            </div>
        </div>
    </div>
</div>

<div aria-hidden="false" class="modal fade in" id="modalConfirmDeleteEvent">
    <div class="modal-backdrop fade in"></div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Eliminar el Evento del Incidente</h4>
            </div>
            <div class="modal-body">
                ¿Seguro que desea eliminar el evento seleccionada? <br/>
                <b>Esta acción no se podrá deshacer</b>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger">Borrar</button>
            </div>
        </div>
    </div>
</div>