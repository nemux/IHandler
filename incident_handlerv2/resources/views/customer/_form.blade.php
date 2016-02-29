<div class="form-group row">
    {!! Form::label('customer_name','Nombre de la empresa',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('customer_name',isset($customer->name)?$customer->name:'',['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('business_name','Razón Social',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('business_name',isset($customer->business_name)?$customer->business_name:'',['class'=>'form-control']) !!}
    </div>
</div>
@if(isset($customer->logo))
    <div class="form-group row">
        <div class="col-md-2">

        </div>
        <div class="col-sm-10">
            <img class="img-responsive img-thumbnail" src="{{route('customer.logo',$customer->id)}}"
                 style="max-width: 200px; max-height: 200px;">
        </div>
    </div>
@endif
<div class="form-group row">
    {!! Form::label('logo','Logotipo',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::file('logo',[]) !!}
    </div>
</div>