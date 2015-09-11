{{Form::open(['id'=>'cv-report-form','type'=>'POST','action'=>'CustomerController@cvReport'])}}
{{Form::hidden('customer_id',$customer->id)}}
<div class="row">
    <div class="col-md-3">
        <div class="input-group input-daterange" data-date-format="dd/mm/yyyy">
            <input type="text" class="form-control" id="from_date" name="from_date"
                   placeholder="Fecha de Inicio"/>
            <span class="input-group-addon">a</span>
            <input type="text" class="form-control" id="to_date" name="to_date"
                   placeholder="Fecha Final"/>
        </div>
    </div>
    <div class="col-md-2">
        <button id="submit-html" class="btn btn btn-info"><i class="fa fa-file"></i> Generar Reporte
        </button>
    </div>
    <div class="col-md-2">
        <button id="submit-email" class="btn btn-success"><i class="fa fa-envelope"></i> Enviar por
            Correo
        </button>
    </div>
</div>
{{Form::close()}}

<div id="cv-report-result">

</div>

<script>
    $('#submit-email').on('click', function (event) {
        event.preventDefault();

        var data = ajaxRequest('{{action('CustomerController@cvMail')}}', 'El reporte ha sido enviado por correo electrónico');

        console.log(data);

        return false;
    });


    $('#cv-report-form').on('submit', function (event) {
        event.preventDefault();

        $('#cv-report-result').empty();

        var data = ajaxRequest('{{action('CustomerController@cvReport')}}', 'El reporte está listo');

        $('#cv-report-result').append(data);

        console.log(data);

        return false;
    });


    function ajaxRequest(url, message) {
        var postData = new FormData($('#cv-report-form')[0]);
        var response = '';
        $.ajax({
            url: url,
            type: 'POST',
            data: postData,
            async: false,
            cache: false,
            processData: false,
            contentType: false,
            success: function (data) {
                mensaje = data.message;
                if (data.errores != null) {
                    mensaje += "<ul>";
                    $.each(data.errores, function (key, value) {
                        mensaje += '<li>' + value + '</li>';
                    });
                    mensaje += "</ul>";

                    $.gritter.add({
                        title: "Mensaje del servidor",
                        text: mensaje,
                        sticky: false,
                        time: ""
                    });
                } else {
                    $.gritter.add({
                        title: "Mensaje del servidor",
                        text: message,
                        sticky: false,
                        time: ""
                    });
                }
                response = data;
            },
            error: function (data) {
//                $('#cv-report-result').append(data);
                response = data;
            }
        });

        return response;
    }
</script>