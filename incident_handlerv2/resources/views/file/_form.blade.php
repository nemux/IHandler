<div class="row">
    <div class="col-sm-3 text-center">
        <div id="advancedDropzone" class="droppable-area">
            Arrastra aquí las evidencias
        </div>
    </div>
    <div class="col-sm-9">
        <table class="table table-bordered table-striped" id="example-dropzone-filetable">
            <thead>
            <tr>
                <th width="1%" class="text-center">#</th>
                <th width="50%">Nombre</th>
                <th width="20%">Progreso</th>
                <th>Enviado</th>
                <th>Estatus</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="5">La lista de archivos aparecerá aquí</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function () {
        var dropzone_filetable = $("#example-dropzone-filetable");
        var i = 1;
        example_dropzone = $("#advancedDropzone").dropzone({
            url: "{{route($postroute)}}",
            autoProcessQueue: true,
            uploadMultiple: false,
            maxFilezise: 10, //MB
            maxFiles: 100,
            addedfile: function (file) {
                if (i == 1) {
                    dropzone_filetable.find('tbody').html('');
                }
                var size = parseInt(file.size / 1024, 10);
                size = size < 1024 ? (size + " KB") : (parseInt(size / 1024, 10) + " MB");
                var $entry = $('<tr>\
                                    <td class="text-center">' + (i++) + '</td>\
                                    <td>' + file.name + '</td>\
                                    <td><div class="progress progress-striped"><div class="progress-bar progress-bar-warning"></div></div></td>\
                                    <td>' + size + '</td>\
                                    <td>Cargando...</td>\
                                </tr>');
                dropzone_filetable.find('tbody').append($entry);
                file.fileEntryTd = $entry;
                file.progressBar = $entry.find('.progress-bar');
            },
            sending: function (file, xhr, data) {
                data.append("customer_id", $('#customer_id').val());
            },
            uploadprogress: function (file, progress, bytesSent) {
                file.progressBar.width(progress + '%');
            },
            success: function (file, evidence) {
                var evidenceurl = '{!! url('') !!}/dashboard/evidence/file/' + evidence.id; //No se usa el helper route por ser un espacio javascript

                file.fileEntryTd.find('td:last').html('<span class="text-success">Finalizó la carga</span>');
                file.fileEntryTd.find('td:last').on('click', function () {
                    window.open(pathFile);
                });

                file.progressBar.removeClass('progress-bar-warning').addClass('progress-bar-success');

                var img_thumbnail = "<div class='col-md-3 col-sm-4 col-xs-6'>" +
                        "<div class='album-image'>" +
                        "<div class='thumb'>" +
                        "<img src='" + evidenceurl + "' class='img-thumbnail img-responsive'>" +
                        "</div>" +
                        "<div class='name'>" +
                        "<span>" + file.name + "</span>" +
                        "<em>" + evidenceurl + "</em>" +
                        "</div>" +
                        "</div>" +
                        "</div>";

                $('#evidences-thumbs').html($('#evidences-thumbs').html() + img_thumbnail);

                {{-- Permite agregar un nuevo elemento al formulario {{$file_list}} para crear un objeto con un arreglo de archivos  --}}
                $('<input>').attr({
                    type: 'hidden',
                    id: 'evidence_' + evidence.id,
                    name: 'evidence_' + evidence.id,
                    value: evidence.id
                }).appendTo('#{{$file_list}}');
            },
            error: function (file) {
                file.fileEntryTd.find('td:last').html('<span class="text-danger">Falló la carga</span>');
                file.progressBar.removeClass('progress-bar-warning').addClass('progress-bar-red');
            }
        });
    });
</script>