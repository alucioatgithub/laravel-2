        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li {{($current_route == 'admin')? 'class="active"' : '' }}>
                            <a href="{{route('cms.index')}}">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                       
                        <li class="treeview {{(in_array('users',  explode('/', $current_route))) ? 'active': ''; }} ">
                            <a href="#">
                                <i class="fa fa-user"></i>
                                <span>User</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li {{($current_route == 'admin/users')? 'class="active"' : '' }} ><a href="{{route('admin.users.index')}}"><i class="fa fa-angle-double-right"></i> Manage users</a></li>
                                <li {{($current_route == 'admin/users/create')? 'class="active"' : '' }} ><a href="{{route('admin.users.create')}}"><i class="fa fa-angle-double-right"></i> Add new user</a></li>
                            </ul>
                        </li> 

                        <li class="treeview {{(in_array('tag',  explode('/', $current_route))) ? 'active': ''; }}">
                            <a href="#">
                                <i class="fa fa-tag"></i>
                                <span>Tag</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li {{($current_route == 'admin/tag')? 'class="active"' : '' }} ><a href="{{route('admin.tag.index')}}"><i class="fa fa-angle-double-right"></i> Manage Tags</a></li>
                                <li {{($current_route == 'admin/tag/create')? 'class="active"' : '' }} ><a href="{{route('admin.tag.create')}}"><i class="fa fa-angle-double-right"></i> Add new tag</a></li>
                            </ul>
                        </li> 

                        <li class="treeview {{(in_array('survey',  explode('/', $current_route))) ? 'active': ''; }}">
                            <a href="#">
                                <i class="fa fa-comments"></i>
                                <span>Survey</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li {{($current_route == 'admin/survey')? 'class="active"' : '' }} ><a href="{{route('admin.survey.index')}}"><i class="fa fa-angle-double-right"></i> Manage Survey</a></li>
                                <li {{($current_route == 'admin/survey/create')? 'class="active"' : '' }} ><a href="{{route('admin.survey.create')}}"><i class="fa fa-angle-double-right"></i> Add new survey</a></li>
                            </ul>
                        </li> 
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->