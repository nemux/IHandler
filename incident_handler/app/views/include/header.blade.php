<div id="header" class="header navbar navbar-inverse navbar-fixed-top">
    <!-- begin container-fluid -->
    <div class="container-fluid ">
        <!-- begin mobile sidebar expand / collapse button -->
        <div class="navbar-header ">
            <a href="/" class="navbar-brand bg-blue" style="color:#FFF">Global Cybersec</a>
            <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- end mobile sidebar expand / collapse button -->

        <nav class="collapse navbar-collapse navbar-left" role="Navigation">
            <ul id="nav" class="nav navbar-nav">
                <li class="current">
                    {{--TODO Continuar con la revisiónd e este módulo--}}
                    {{--<a href="{{url('dashboard/map')}}">--}}
                        {{--<span class="fa fa-globe fa-2x blue"></span>--}}
                        {{--<span style="font-size: 24px;">GIL</span>--}}
                    {{--</a>--}}
                </li>
            </ul>
        </nav>

        <!-- begin header navigation right -->
        <ul class="nav navbar-nav navbar-right">
            <li class="media">
                <div style="padding-top:18px;color:#FFF">
                    <?php echo date("d-m-Y") ?>
                    <a id="new_clock"></a>
                </div>
            </li>
            <li class="dropdown navbar-user">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="hidden-xs">Mi sesión</span> <b class="caret"></b>
                </a>
                <ul class="dropdown-menu animated fadeInLeft">
                    <li class="arrow"></li>
                    <li><a href="#modal-message" class="	" data-toggle="modal">Change pass</a></li>
                    <li class="divider"></li>

                    <li><a href="/logout">Log Out</a></li>

                </ul>
            </li>
        </ul>
        <!-- end header navigation right -->
    </div>
    <!-- end container-fluid -->
</div>
<div class="modal modal-message fade" id="modal-message">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Cambio de password</h4>
            </div>
            <div class="modal-body">
                {{ Form::model(null,array('action' => 'IncidentHandlerController@passwordUpdate','role'=>"form", 'id'=>"form","class"=>"form-horizontal form-bordered","data-parsley-validate"=>"true", "name"=>"demo-form")) }}

                <div class="col-lg-4">
                    Password Anterior
                </div>
                <div class="col-lg-8">
                    <div class="form-group">
                        <input class="form-control" type="password" name="old_pass" value="">
                    </div>
                </div>
                <br>

                <div class="col-lg-4">
                    Password Nuevo
                </div>
                <div class="col-lg-8">
                    <div class="form-group">
                        <input class="form-control" type="password" name="new_pass" value="">
                    </div>
                </div>
                <br>

                <div class="col-lg-4">
                    Token
                </div>
                <div class="col-lg-8">
                    <div class="form-group">
                        <input class="form-control" type="text" name="token" value="">
                    </div>
                </div>
                <br>
            </div>
            <div class="modal-footer">
                <br>
                <input type="submit" class="btn btn-primary btn-sm pull-right" value="Cambiar Password"
                       style="margin-left:10px">
                <a class="btn btn-default btn-sm pull-right" onclick="getToken()">Solicitar Token</a>

            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
<script charset="utf-8">
    function getToken() {
        $.post("/handler/send/token");
    }

</script>
