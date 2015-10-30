<div class="row">
    <div class="col-md-2 text-right">
        <b>Nombre del ataque</b>
    </div>
    <div class="col-md-10 text-left">
        {{$item->name}}
    </div>
</div>
<div class="row">
    <div class="col-md-2 text-right">
        <b>Descripción</b>
    </div>
    <div class="col-md-10">
        {{$item->description}}
    </div>
</div>
<div class="row">
    <div class="col-md-2 text-right">
        <b>Ataque Padre</b>
    </div>
    <div class="col-md-10 text-left">
        {{isset($item->parent->name)?$item->parent->name:''}}
    </div>
</div>