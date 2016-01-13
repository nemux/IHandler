<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta content="text/html">

    <style>
        html {
        }

        body {
            margin: 0px;
            padding: 10px;
            font-family: Arimo, "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 13px;
            line-height: 1.42857;
            color: black;
        }

        h3 {

        }

        * {
            box-sizing: border-box;
        }

        .page-body {
            /*background-color: #eeeeee;*/
            width: 100%;
        }

        .page-container {
            border-collapse: collapse;
            border-spacing: 0px;
        }

        .main-content {

        }

        .panel {
            position: relative;
            background: #FFF none repeat scroll 0% 0%;
            padding: 20px 30px;
            border: 0px none;
            margin-bottom: 30px;
            box-shadow: none;
            border-radius: 0px;
        }

        .panel .panel-heading {
            position: relative;
            padding: 0px 0px 15px;
            margin: 0px;
            background: transparent none repeat scroll 0% 0%;
            font-size: 17px;
            border-bottom: 2px solid #F5F5F5;
        }

        .panel-default {

        }

        .panel-heading {

        }

        .panel-title {

        }

        .panel-body {
            padding: 10px;
            background-color: white;
        }

        p {
            color: black;
        }

        img {
            max-width: 100%;
        }

        /*For surveillance._preview*/
        .row {
            width: 100%;
        }

        .col-md-12 {
            width: 100%;
        }

        .col-md-11 {
            width: 91.66%;
        }

        .col-md-10 {
            width: 83.33%;
        }

        .col-md-offset-1 {
            padding-left: 30px;
            /*30px;*/
        }

        .col-md-offset-2 {
            padding-left: 60px;
            /*16.66%;*/
        }

        .col-md-offset-3 {
            padding-left: 90px;
            /*25%;*/
        }

        .h3 {

        }

        .semi-bold {
            font-weight: bolder;
        }

        .h4 {

        }

        .text-justify {
            text-align: justify;
        }

        .watermark {
            opacity: 0.25;
            width: 100%;
            height: 100%;
            z-index: 10;
            top: 0;
            left: 0;
            position: fixed;

            background-image: url('/custom/assets/img/logo-bgclaro-watermark.png');
            background-repeat: no-repeat;
            background-position: center center;
        }

        img.logo {
            max-height: 120px;
        }
    </style>
</head>
<body class="page-body">
<div class="watermark"></div>
<div class="page-container">
    <div class="main-content">
        <div class="panel panel-default">
            <div class="panel-heading">
                @if(isset($case->customer->logo))
                    <img class="img-responsive logo" src="{{$isPdf?'':'/'}}upload/customer/{{$case->customer->logo}}">
                @else
                    <h1>Cliente: {{$case->customer->name}}</h1>
                @endif
            </div>
            <div class="panel-body">
                @include('surveillance._preview')
            </div>
        </div>
    </div>
</div>
<div style="margin: 0px 20px; font-size: 80%; text-align: center; font-family: Helvetica,Arial,sans-serif;
            color: rgb(200, 0, 0);">
    <small style="font-family: Helvetica,Arial,sans-serif;">
        <big><strong>Información Confidencial</strong></big></small>
</div>

<div style="bottom: 0px; ;margin: 0px 20px; font-size: 80%; text-align: center; font-family: Helvetica,Arial,sans-serif;
            color: rgb(30, 144, 255);">
    <small style="font-family: Helvetica,Arial,sans-serif;">
        <strong>&copy; {{ date("Y") }} Global Cybersec</strong></small>
</div>
</body>
</html>


