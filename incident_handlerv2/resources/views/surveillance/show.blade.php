@extends('layout.dashboard_topmenu')

@section('title', 'Caso <b>'.$case->title.'</b>')

@section('include_up')
@endsection

@section('dashboard_content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Cliente: <b>{{$case->customer->name}}</b></h3>

            <div class="panel-options"><a href="#" data-toggle="panel">
                    <span class="collapse-icon">&ndash;</span>
                    <span class="expand-icon">+</span> </a>
            </div>
        </div>
        <div class="panel-body">
            @include('surveillance._preview')
        </div>
    </div>
@endsection