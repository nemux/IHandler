<div class="row">
    <div class="col-md-12">
        <p>
            <b class="h3 semi-bold">
                1.- <span id="preview-title">{{$case->title}}</span>
            </b>
        </p>
    </div>
    <div class="col-md-11 col-md-offset-1">
        <p>
            <span class="h4">
                <b>
                    <span id="preview-created_at">
                        ({{isset($case->created_at)?$case->created_at->format('d/m/Y'):date('d/m/Y')}})
                    </span>
                    Criticidad
                    <span id="preview-criticity_id">
                        {{isset($case->criticity->name)?$case->criticity->name:''}}
                    </span>
                </b>
            </span>
        </p>
    </div>
    <div class="col-md-10 col-md-offset-2 text-justify">
        <p class="h4">
            <b>
                Descripción:
            </b>
        </p>

        <p id="preview-description">
            {{--Si es un render para PDF, modifica la ruta de las imágenes --}}
            @if(isset($isPdf) && $isPdf)
                {!! str_replace(url(),'',$case->description) !!}
            @else
                {!! $case->description !!}
            @endif
        </p>
    </div>

    <div class="col-md-10 col-md-offset-2 text-justify">
        <p class="h4">
            <b>
                Recomendaciones:
            </b>
        </p>

        <p id="preview-recommendation">
            {{--Si es un render para PDF, modifica la ruta de las imágenes --}}
            @if(isset($isPdf) && $isPdf)
                {!! str_replace(url(),'',$case->recommendation) !!}
            @else
                {!! $case->recommendation !!}
            @endif
        </p>
    </div>
</div>