<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>


    <link href="{{asset('/custom/asset/js/dropzone/dropzone.css')}}">


</head>
<body>
<h1>Dropzone</h1>

<div class="container">
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Dropzone
            </div>
            <div class="panel-body">
                {!! Form::open(['route'=>'test.files.store',
                   'method' => 'POST',
                   'files'=>'true',
                   'id' => 'my-dropzone' ,
                   'class' => 'dropzone']) !!}
                <div class="dz-message" style="height:200px;">
                    Drop your files here
                </div>
                <div class="dropzone-previews"></div>
                <button type="submit" class="btn btn-success" id="submit">Save</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<script src="{{asset('/custom/assets/js/dropzone/dropzone.js')}}"></script>
<script>
    Dropzone.options.myDropzone = {
        autoProcessQueue: false,
        uploadMultiple: true,
        maxFilezise: 10, //MB
        maxFiles: 100,

        init: function () {
            var submitBtn = document.querySelector("#submit");
            myDropzone = this;

            submitBtn.addEventListener("click", function (e) {
                e.preventDefault();
                e.stopPropagation();
                myDropzone.processQueue();
            });
            this.on("addedfile", function (file) {
//                alert("file uploaded");
                console.log('file uploaded');
            });

            this.on("complete", function (file) {
                myDropzone.removeFile(file);
            });

            this.on("success",
                    myDropzone.processQueue.bind(myDropzone)
            );
        }
    };
</script>
</body>
</html>