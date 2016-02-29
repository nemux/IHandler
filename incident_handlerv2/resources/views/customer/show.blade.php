@extends('layout.dashboard_topmenu')

@section('title',$customer->name)
@section('section_description',$customer->business_name)
@section('include_up')
    <link rel="stylesheet" type="text/css"
          href="/custom/assets/js/DataTables/DataTables-1.10.10/css/dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css"
          href="/custom/assets/js/DataTables/Buttons-1.1.0/css/buttons.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css"
          href="/custom/assets/js/DataTables/Responsive-2.0.0/css/responsive.bootstrap.min.css"/>
@endsection

@section('include_down')
    <script type="text/javascript" src="/custom/assets/js/DataTables/pdfmake-0.1.18/build/pdfmake.min.js"></script>
    <script type="text/javascript" src="/custom/assets/js/DataTables/pdfmake-0.1.18/build/vfs_fonts.js"></script>
    <script type="text/javascript"
            src="/custom/assets/js/DataTables/DataTables-1.10.10/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript"
            src="/custom/assets/js/DataTables/DataTables-1.10.10/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript"
            src="/custom/assets/js/DataTables/Buttons-1.1.0/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript"
            src="/custom/assets/js/DataTables/Buttons-1.1.0/js/buttons.bootstrap.min.js"></script>
    <script type="text/javascript" src="/custom/assets/js/DataTables/Buttons-1.1.0/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="/custom/assets/js/DataTables/Buttons-1.1.0/js/buttons.print.min.js"></script>
    <script type="text/javascript"
            src="/custom/assets/js/DataTables/Responsive-2.0.0/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript"
            src="/custom/assets/js/DataTables/Responsive-2.0.0/js/responsive.bootstrap.min.js"></script>
@endsection

@section('dashboard_content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Cliente: <b>{{$customer->name}}</b></h3>

            <div class="panel-options"><a href="#" data-toggle="panel">
                    <span class="collapse-icon">&ndash;</span>
                    <span class="expand-icon">+</span> </a>
            </div>
        </div>
        <div class="panel-body row">
            <div class="col-md-12">
                <div class="tabs-vertical-env tabs-vertical-bordered">
                    <ul class="nav tabs-vertical">
                        <li class="{{ ($tab=='customer')?' active':'' }}"><a href="#customer_info" data-toggle="tab">Información
                                General</a></li>
                        <li class="{{($tab=='sensor')?' active':''}}"><a href="#customer_sensor" data-toggle="tab">Sensores</a>
                        </li>
                        <li class="{{ ($tab=='asset')?' active':'' }}"><a href="#customer_assets" data-toggle="tab">Activos</a>
                        </li>
                        <li class="{{ ($tab=='employee')?' active':'' }}"><a href="#customer_employees"
                                                                             data-toggle="tab">Empleados</a></li>
                        <li class="{{ ($tab=='page')?' active':'' }}"><a href="#customer_pages" data-toggle="tab">Páginas</a>
                        </li>
                        {{--<li class="{{($tab=='surveillance')?' active':''}}">--}}
                        {{--<a href="#surveillance" data-toggle="tab">Cibervigilancia</a>--}}
                        {{--</li>--}}
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane {{ ($tab=='customer')?' active':'' }}" id="customer_info">
                            <section class="profile-env">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="user-info-sidebar">
                                            <a href="#" class="user-name">
                                                {{$customer->name}}
                                            </a>
                                            @if(Auth::user()->isAdmin())
                                                <a href="{{route('customer.edit',$customer->id)}}"
                                                   class="btn btn-secondary btn-sm btn-icon icon-left"> Editar</a>
                                            @endif
                                            <span class="user-title"> {{$customer->business_name}}</span>
                                            <hr/>
                                            <span class="user-details">Datos de Contacto</span>
                                            <ul class="list-unstyled user-info-list">
                                                <li>
                                                    <ul class="list-unstyled user-info-list">
                                                        @foreach($customer->contacts as $contact)
                                                            <li>
                                                                {{$contact->person->fullName()}} <br/>
                                                                <i class="fa-phone"></i>{{$contact->person->contact->phone}}
                                                                <br/>
                                                                <i class="fa-envelope"></i> {{$contact->person->contact->email}}
                                                            </li>
                                                            <hr/>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                                <li>
                                                    <i class="fa-calendar"></i><a href="#">
                                                        Cliente desde <b>{{$customer->created_at->format('d/M/Y')}}</b>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                    <div class="col-md-8">
                                        @if(isset($customer->logo))
                                            <img style="max-width: 500px; max-height: 300px;" class="img-thumbnail"
                                                 src="{{route('customer.logo',$customer->id)}}">
                                        @endif
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="tab-pane {{ ($tab=='sensor')?' active':'' }}" id="customer_sensor">
                            @include('customer.sensor.index')
                        </div>
                        <div class="tab-pane {{ ($tab=='asset')?' active':'' }}" id="customer_assets">
                            @include('customer.asset.index')
                        </div>
                        <div class="tab-pane {{ ($tab=='employee')?' active':'' }}" id="customer_employees">
                            @include('customer.employee.index')
                        </div>
                        <div class="tab-pane {{ ($tab=='page')?' active':'' }}" id="customer_pages">
                            @include('customer.page.index')
                        </div>
                        <!-- TODO revisar de qué forma se puede integrar la pestaña -->
                        {{--<div class="tab-pane {{($tab=='surveillance')?' active':''}}" id="surveillance">--}}
                        {{--@include('surveillance._table',['cases'=>$customer->surveillances->paginate(10)])--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('modal.confirm_delete')
@endsection