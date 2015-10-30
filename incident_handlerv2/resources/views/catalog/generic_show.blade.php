@extends('layout.dashboard_topmenu')

@section('title',$base->title)

@section('dashboard_content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{$base->name}}: <b>{{$item->name}}</b></h3>
        </div>
        <div class="panel-body">
            @include($base->showView)
        </div>
    </div>

@endsection