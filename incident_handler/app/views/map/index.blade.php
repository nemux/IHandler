<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8"/>
    <title>Color Admin | Vector Map</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet"/>
    <link href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet"/>
    <link href="/assets/css/animate.min.css" rel="stylesheet"/>
    <link href="/assets/css/style.min.css" rel="stylesheet"/>
    <link href="/assets/css/style-responsive.min.css" rel="stylesheet"/>
    <link href="/assets/css/theme/default.css" rel="stylesheet" id="theme"/>
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="/assets/plugins/jquery-jvectormap-2.0.2/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
    <!-- ================== END PAGE LEVEL STYLE ================== -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="/assets/plugins/pace/pace.min.js"></script>
    <!-- ================== END BASE JS ================== -->


    <style>
        @-webkit-keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                /*opacity: 0.25;*/
                opacity: 1;
            }
        }

        @-moz-keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                /*opacity: 0.25;*/
                opacity: 1;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                /*opacity: 0.25;*/
                opacity: 1;
            }
        }
    </style>
</head>
<body>
<!-- begin #page-loader -->
<div id="page-loader" class="fade in"><span class="spinner"></span></div>
<!-- end #page-loader -->

<!-- begin #page-container -->
<div id="page-container" class="fade">

    <!-- begin #content -->
    <div id="content" class="">
        <!-- begin page-header -->
        <h1 class="page-header">Global Incident Locator
            <small>locating incidents...</small>
        </h1>
        <!-- end page-header -->

        <div class="map">
            <div id="world-map"></div>
        </div>
    </div>
    <!-- end #content -->

    <!-- begin scroll to top btn -->
    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i
                class="fa fa-angle-up"></i></a>
    <!-- end scroll to top btn -->
</div>
<!-- end page container -->

<!-- ================== BEGIN BASE JS ================== -->
<script src="/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
<script src="/assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
<script src="/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
<script src="/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
<script src="/assets/crossbrowserjs/html5shiv.js"></script>
<script src="/assets/crossbrowserjs/respond.min.js"></script>
<script src="/assets/crossbrowserjs/excanvas.min.js"></script>
<![endif]-->
<script src="/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
<!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="/assets/plugins/jquery-jvectormap-2.0.2/jquery-jvectormap-2.0.2.min.js"></script>
<script src="/assets/plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="/assets/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->


<script>
    var MapVector = function () {
        "use strict";
        return {
            mapa: null,
            last: 10,
            fadeStyle: '-webkit-animation:fadeIn ease-in 1;' +
            '-moz-animation:fadeIn ease-in 1;' +
            'animation:fadeIn ease-in 1;' +

            '-webkit-animation-fill-mode:forwards;' +
            '-moz-animation-fill-mode:forwards;' +
            'animation-fill-mode:forwards;' +
            '-webkit-animation-duration:1s;' +
            '-moz-animation-duration:1s;' +
            'animation-duration:1s;',
            markerIndex: 0,
            init: function (map) {
                if (map.length !== 0) {
                    $(map).css("height", $(window).height());
                    $(map).vectorMap({
                                map: 'world_mill_en'
                                , scaleColors: ["#e74c3c", "#0071a4"]
                                , normalizeFunction: 'polynomial'
                                , hoverOpacity: .5
                                , hoverColor: false
                                , backgroundColor: "#242a30"
                                , regionStyle: {
                                    initial: {
                                        fill: "rgb(97,109,125)",
                                        "fill-opacity": .5,
                                        stroke: "none",
                                        "stroke-width": .4,
                                        "stroke-opacity": 1
                                    }
                                    , hover: {
                                        'fill-opacity': .8
                                    }
                                    , selected: {
                                        fill: 'yellow'
                                    }
                                    , selectedHover: {}
                                }
                                , markerStyle: {
                                    initial: {
//                                        fill: "#4cabc7",
//                                        stroke: "white",
                                        r: 5,
                                        opacity: 1
//                                        style: this.fadeStyle
                                    }
                                }
                                , markers: []
                            }
                    )
                    ;
                    this.mapa = $('#world-map').vectorMap('get', 'mapObject');
                }
            }
            ,
            addLocation: function (index, lat, lon, name, ip_type) {
                var color = (ip_type == 1) ? 'green' : 'red';
                this.mapa.addMarker(
                        index, {
                            latLng: [lat, lon],
                            name: name,
                            style: {
                                fill: color,
                                id: 'mk' + index
                            }
                        });

            }
            ,
            clearDots: function () {
                this.mapa.removeAllMarkers();
            }
        }
    }();

    $(document).ready(function () {
        App.init();
        MapVector.init("#world-map");
        getLocations();

        setInterval(function () {
            getLocations();
        }, 500);
    });

    function getLocations() {
        $.ajax({
            type: 'POST',
            url: 'map/incidents',
            async: true,
            data: {
                _token: '{{ csrf_token() }}',
                last: MapVector.last,
                items: 1
            },
            dataType: 'json',
            success: function (data) {
                addLocationsOnMap(data);
            }
        });
    }

    function addLocationsOnMap(data) {
        console.log('AddLocationsOnMap');
        MapVector.last = data['last'];
        console.log(MapVector.last);
        $.each(data['occs'], function (index, element) {
            var src = element['src'];
            var dst = element['dst'];
            MapVector.addLocation(MapVector.markerIndex++, src['lat'], src['lon'], src['city'] + ', ' + src['country'], 1);
            MapVector.addLocation(MapVector.markerIndex++, dst['lat'], dst['lon'], dst['city'] + ', ' + dst['country'], 2);

        });
    }
</script>
</body>
</html>
