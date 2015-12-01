<input type="button" class="form-control btn btn-success" value="Generar gráfica" id="{{$id}}">
<script type="text/javascript">
    $(document).ready(function () {
        $('#submit').click(function (e) {
            $('#submit').attr('disabled', true);
            Graph.make();
        });
    });
</script>