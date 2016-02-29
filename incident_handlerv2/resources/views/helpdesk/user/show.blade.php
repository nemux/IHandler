@extends('layout.dashboard_topmenu')

@section('title',"Usuario ".$user->username)

@section('dashboard_content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Usuario: <b>{{$user->person->fullName()}}</b></h3>

            <div class="panel-options"><a href="#" data-toggle="panel">
                    <span class="collapse-icon">&ndash;</span>
                    <span class="expand-icon">+</span> </a>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-2 text-right">
                    <b>Cliente</b>
                </div>
                <div class="col-md-10 text-left">
                    {{$user->customer->name}}
                </div>
            </div>
        </div>
        @include('person.show',['person'=>$user->person])
    </div>

@endsection