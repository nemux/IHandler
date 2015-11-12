@if(isset($case))
    $(sel_customer).select2('val', '{{$case->customer_id}}');
    $(sel_criticity).select2('val', '{{$case->criticity_id}}');
    $(sel_flow).select2('val', '{{$case->attack_flow_id}}');

    var categories_inc = new Array();
    @foreach($case->categories as $category)
        categories_inc.push('{{$category->category->id}}');
    @endforeach
    $(sel_categories).select2('val', categories_inc);

    $(sel_risk).select2('val', '{{$case->risk}}');
    $(sel_impact).select2('val', '{{$case->impact}}');
    $(sel_type).select2('val', '{{$case->attack_type_id}}');

    var sensors_inc = new Array();
    @foreach($case->sensors as $sensor)
        sensors_inc.push('{{$sensor->sensor->id}}');
    @endforeach
    $(sel_sensors).select2('val', sensors_inc);

    var signatures_inc = new Array();
    @foreach($case->signatures as $signature)
        signatures_inc.push('{{$signature->signature->id}}');
    @endforeach
    $(sel_signatures).select2('val', signatures_inc);

    var dropzone_filetable = $("#example-dropzone-filetable");
    @foreach($case->evidences as $index=>$evidence)
        @if($index==0)
            dropzone_filetable.find('tbody').html('');
        @endif
        <?php
        $index2 = $index + 1;
        echo "var entry = $(\"<tr id='ie-{$evidence->id}'><td class='text-center'>{$index2}</td><td>{$evidence->evidence->original_name}</td><td><div class='progress progress-striped'><div class='progress-bar progress-bar-success' style='width: 100%;'></div></div></td><td></td><td><span class='btn btn-danger' onclick='modalDeleteEvidence({$evidence->id})'>Eliminar Evidencia</span></td></tr>\");";
        ?>
        dropzone_filetable.find('tbody').append(entry);
    @endforeach

    {{--@foreach($case->events as $index=>$event)--}}
    {{--addEvent({{$event->id}},JSON.parse('{!! $event->source->json() !!}'),JSON.parse('{!! $event->target->json() !!}'),'{{$event->payload}}');--}}
    {{--@endforeach--}}
@endif