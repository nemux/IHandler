@extends('layouts.master')
@section('content')

<!-- begin #page-container -->
	<div id="page-container" class="fade">
	    <!-- begin error -->
        <div class="error">
          <div class="error-code m-b-10"> {{ $code }} <i class="fa fa-warning"></i></div>
            <div class="error-content">
              <div class="error-message">{{$error_msg}}</div>
                <div class="error-desc m-b-20">

                </div>
                <div>
                    <a href="/" class="btn btn-success">Regresar al inicio.</a>
                </div>
            </div>
        </div>
    </div>
