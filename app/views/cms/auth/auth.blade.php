
<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>iAgree | Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="{{asset('assets/css/AdminLTE.css')}}" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header">Sign In</div>
    {{ Form::open(['url' => '/admin/auth/', 'method' => 'POST'])  }}
           
                <div class="body bg-gray">
                	@if (Session::has('message'))
					    <div class="alert alert-danger">{{ Session::get('message') }}</div>
					@endif

                    <div class="form-group  {{($errors->has('email'))? 'has-error' : ''}}">
                    	{{ Form::text('email', NULL,  array('class'=> 'form-control', 'placeholder'=>'Email')) }}
						@if ($errors->has('email'))
						    {{ $errors->first('email', '<label class="control-label"></i>:message</label>') }}
						@endif
                    </div>
                    <div class="form-group  {{($errors->has('password'))? 'has-error' : ''}}">
                        {{ Form::password('password', array('class'=> 'form-control', 'placeholder'=>'Password')) }}
						@if ($errors->has('password'))
						    {{ $errors->first('password', '<label class="control-label"></i>:message</label>') }}
						@endif
                    </div>          
                  
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-olive btn-block">Log in</button>  
                </div>
   	{{ Form::close() }}
           
        </div>

     

    </body>
</html>