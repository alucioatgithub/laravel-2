<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>iAgree | Admin Panel</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="{{asset('assets/css/ionicons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="{{asset('assets/css/AdminLTE.css')}}" rel="stylesheet" type="text/css" />
        <!-- Date picker style -->
        <link href="{{asset('assets/css/jquey-ui.css')}}" rel="stylesheet" type="text/css" />

        <!-- iCheck for checkboxes and radio inputs -->
        <link href="{{asset('assets/css/iCheck/all.css')}}" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <script src="{{asset('assets/js/jquery.min.js')}}"></script>

        <script src="{{asset('assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="{{asset('assets/js/app.js')}}" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{asset('assets/js/demo.js')}}" type="text/javascript"></script>
        <!--Date picker js-->
        <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
        <!-- Chosenjs styles and scripts -->
        <link href="{{asset('assets/css/chosen.css')}}" rel="stylesheet" type="text/css" />
        <script src="{{asset('assets/js/chosen.jquery.js')}}" type="text/javascript"></script>
        
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="{{route('cms.index')}}" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                iAgree
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>{{$current_user->firstname or $current_user->email}} <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="{{$current_user->avatar or asset('assets/img/avatar3.png')}}" class="img-circle" alt="User Image" />
                                    <p>
                                       {{$current_user->firstname or $current_user->email}} -  {{$current_user->role or ''}}
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">                               
                                    <div class="pull-right">
                                        <a href="{{url('admin/logout')}}" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>