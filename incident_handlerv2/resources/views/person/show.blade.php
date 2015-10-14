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
            {{$person->sex=='M'?'Masculino':'Femenino'}}
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 text-right">
            <b>Datos Personales</b>
        </div>
        <div class="col-md-10 text-left">
            <i class="fa-envelope"></i> {{$person->contact->email}}<br/>
            <i class="fa-phone"></i> {{$person->contact->phone}}
        </div>
    </div>
</div>