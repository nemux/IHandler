<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta content="text/html">

    <style>
        html {
            margin: 0px;
            width: 100%;
        }

        body {
            width: 100%;
            margin: 0px;
            padding: 10px;
            font-family: Arimo, "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 12px;
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
    </style>
</head>
<body class="page-body">
<div class="watermark"></div>
<div class="page-container">
    <div class="main-content">
        <div class="panel panel-default">
            <div class="panel-body">
                @include('incident._preview')
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


