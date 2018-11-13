<!DOCTYPE html>
<html>
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <title>{{ config('app.name') }}</title>
	    <!-- Tell the browser to be responsive to screen width -->
	    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	    <!-- Bootstrap 3.3.5 -->
	    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
	    <!-- Font Awesome -->
	    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
	    <!-- Theme style -->
	    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
	    <link rel="stylesheet" type="text/css" href="{{asset('css/glyphicons.css')}}">  ç
	</head>
	<style>
		body{
			background-color: #efefef;
		}
	</style>
	<body class="">
		@include('partials.flash')
	  <div class="login-box">
	    <div class="login-logo">
	    <center>
	    	<img class="img-responsive" src="{{ asset('img/genesis2.png') }}" alt="Logo" style="height:200px">
	    </center>
	    </div><!-- /.login-logo -->
	    <div class="login-box-body">
	      <p class="login-box-msg">-Login-</p>
	      @if (count($errors) > 0)
	        <div class="alert alert-danger">
	        	<ul>
	          @foreach($errors->all() as $error)
	             <li>{{$error}}</li>
	          @endforeach
	         	</ul>
	        </div>
	      @endif
	      <form action="{{route('auth')}}" method="POST" id="form-login">
	          {{ csrf_field() }}
	        <div class="form-group has-feedback">
	          <input  class="form-control" type="text" name="usuario" placeholder="Usuario" required="">
	          <span class="glyphicon glyphicon-user form-control-feedback"></span>
	        </div>
	        <div class="form-group has-feedback">
	          <input id="password" class="form-control" type="password" name="password" placeholder="Password (max 12 caracteres)" minlength="5" maxlength="12" required="">
	          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
	        </div>

	        <div class="form-group">
	            <button id="b-login" type="submit" class="btn btn-success btn-block">Acceder</button>
	            <br>
	            <div class="progress" style="display:none;">
				  <div class="progress-bar progress-bar-striped progress-bar-success active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
				  </div>
				</div>
	        </div>
	      </form>
	    </div><!-- /.login-box-body -->
	  </div><!-- /.login-box -->
	  <script type="text/javascript" src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>

	  	<script type="text/javascript">
      		$("#form-login").on('submit',function() {
      			$(".progress").fadeIn(400, "linear");
      		});
    	</script>
	</body>
</html>
