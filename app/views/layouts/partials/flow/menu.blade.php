<body>
<!-- Menu -->
<div class="container">
<ul id="gn-menu" class="gn-menu-main">
<li class="gn-trigger">
    <a class="gn-icon gn-icon-menu"><span>Menu</span></a>
    <nav class="gn-menu-wrapper">
        <div class="gn-scroller">
            <ul class="gn-menu">
                <li>
                    <a href="/admin/index.html" class="gn-icon gn-icon-cog">ADMIN</a>
                </li>
                <li class="gn-search-item">
                    <input placeholder="Search" type="search" class="gn-search">
                    <a class="gn-icon gn-icon-search"><span>Search</span></a>
                </li>
                <li>
                    <a href="#about" class="gn-icon gn-icon-cog">Near me</a>
                </li>
                <li><a href="#service" class="gn-icon gn-icon-cog">Latest</a>
                </li>
                <li> <a href="#service" class="gn-icon gn-icon-cog">Groups</a>
                </li>
                <li> <a href="#service" class="gn-icon gn-icon-cog">Topics</a>
                </li>
                <li> <a href="#service" class="gn-icon gn-icon-cog">Groups</a>
                </li>
                <li> <a href="#service" class="gn-icon gn-icon-cog">Trends</a>
                </li>
                <li> <a href="#service" class="gn-icon gn-icon-cog">Most answered</a>
                </li>
                <li> <a href="#service" class="gn-icon gn-icon-cog">Most commented</a>
                </li>
                <li> <a href="ask.html" class="gn-icon gn-icon-cog">Ask a question</a>
                </li>
                <li> <a href="#contact" class="gn-icon gn-icon-archive">Get in touch</a>
                </li>
            </ul>

        </div>
        <!-- /gn-scroller -->
    </nav>
</li>
<li><a href="/">Represent</a>
</li>
<li class="dropdown pull-right">
    <a href="" class="dropdown-toggle" data-toggle="dropdown">Sign up <b class="caret"></b></a>
    <ul class="dropdown-menu" style="padding: 15px;min-width: 250px;">
        <li>
            <div class="row">
                <div class="col-md-12">
                    <form class="form" role="form" method="post" action="login" accept-charset="UTF-8" id="login-nav">
                        <div class="form-group">
                            <label class="sr-only" for="exampleInputEmail2">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Email address" required>
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="exampleInputPassword2">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password" required>
                        </div>
                        <label>
                            <input type="checkbox"> Remember me
                        </label>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block">Sign in</button>
                        </div>
                    </form>
                </div>
            </div>
        </li>
        <li class="divider"></li>
        <li>
            <button class="btn  btn-social btn-facebook btn-block"><i class="fa fa-facebook"></i> Sign in with Facebook</button>
            <button class="btn  btn-social btn-twitter btn-block"><i class="fa fa-twitter"></i> Sign in with Twitter</button>
            <button class="btn  btn-social btn-google-plus btn-block"><i class="fa fa-google-plus"></i> Sign in with Google</button>
        </li>

    </ul>
</li>

<li class="dropdown pull-right">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-user"></i> Ed
        <b class="caret"></b>
    </a>
    <ul class="dropdown-menu">
        <li>
            <div class="navbar-content">
                <div class="row">
                    <div class="col-md-5">
                        <img src="{{ $current_user->avatar or 'http://placehold.it/120x120'}}" alt="Alternate Text" class="img-responsive" />
                        <p class="text-center small">
                            <a href="#">Change Photo</a>
                        </p>
                    </div>
                    <div class="col-md-7">
                        <span>{{$current_user->firstname . " ". $current_user->lastname}}</span>
                        <p class="text-muted small">
                            {{ $current_user->email }}</p>
                        <div class="divider">
                        </div>
                        <a href="#" class="btn btn-primary btn-sm active">View Profile</a>
                    </div>
                </div>
            </div>
            <div class="navbar-footer">
                <div class="navbar-footer-content">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="#" class="btn btn-default btn-sm">Change Passowrd</a>
                        </div>
                        <div class="col-md-6">

                            <a href="#" class="btn btn-default btn-sm pull-right">Sign Out</a>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</li>

<li class="notifications pull-right"><a href="/"><i class="fa fa-envelope-o fa-lg"></i><span class="count">12</span></a>
</li>
</ul>
</div>
<!-- Menu end -->