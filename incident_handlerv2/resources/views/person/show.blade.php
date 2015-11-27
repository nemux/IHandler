<div class="panel-body">
    <div class="row">
        <div class="col-md-2 text-right">
            <b>Nombre Completo</b>
        </div>
        <div class="col-md-10 text-left">
            {{$person->fullName()}}
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 text-right">
            <b>Sexo</b>
        </div>
        <div class="col-md-10">
            @if($person->sex=='M')
                Masculino
            @elseif($person->sex=='F')
                Femenino
            @else
                Undefined
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 text-right">
            <b>Datos Personales</b>
        </div>
        <div class="col-md-10 text-left">
            <i class="fa-envelope"></i> {{isset($person->contact->email)?$person->contact->email:''}}<br/>
            <i class="fa-phone"></i> {{isset($person->contact->phone)?$person->contact->phone:''}}
        </div>
    </div>
</div>