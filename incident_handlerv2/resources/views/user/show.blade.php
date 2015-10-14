@extends('layout.dashboard_topmenu')

@section('title',"Usuarios")

@section('dashboard_content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Usuario: <b>{{$user->person->fullName()}}</b></h3>

            <div class="panel-options"><a href="#" data-toggle="panel">
                    <span class="collapse-icon">&ndash;</span>
                    <span class="expand-icon">+</span> </a>
            </div>
        </div>
        @include('person.show',['person'=>$user->person])
    </div>

@endsection