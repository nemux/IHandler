@extends('layout.dashboard_topmenu')

@section('title',$user->person->fullName())
@section('section_description',$user->type->description)

@section('include_up')
@endsection

@section('include_down')
@endsection

@section('dashboard_content')

    <section class="profile-env">
        <div class="row">
            <div class="col-sm-4">
                <div class="user-info-sidebar">
                    <a href="#" class="user-name">
                        {{$user->person->fullName()}}
                        {{--<span class="user-status is-online"></span> --}}
                    </a>
                    <span class="user-title"> {{$user->type->description}} @ <strong>GCS IH</strong></span>
                    <hr/>
                    <ul class="list-unstyled user-info-list">
                        <li>
                            <i class="fa-envelope"></i>
                            @if(isset($user->person->contact->email))
                                {{$user->person->contact->email}}
                            @else
                                S/D
                            @endif
                        </li>
                        <hr/>
                        <li>
                            <i class="fa-phone"></i> <a href="#">
                                @if(isset($user->person->contact->phone))
                                    {{$user->person->contact->phone}}
                                @else
                                    S/D
                                @endif
                            </a>
                        </li>
                        <hr/>
                        <li>
                            <i class="fa-calendar"></i><a href="#">
                                Usuario desde <b>{{$user->created_at->format('d/M/Y')}}</b>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

@endsection