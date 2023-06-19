
<div class="navbar navbar-default" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <div class="navbar-brand">
                <a href="{{url('/admin')}}" class="logo">
                    Dormitory Management
                </a>
            </div>

            <button class="navbar-toggle pull-right" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <i class="fa fa-cog"></i>
            </button>
        </div><!-- /.navbar-header -->
        <div class="navbar-collapse collapse">

            <div class="sponsor-campaign-select">
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="divider"></li>
                <li class="dropdown navbar-profile">

                    <ul class="dropdown-menu" role="menu">

                        <li class="divider"></li>
                        <li>
                            <a href="{{route('logout')}}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out"></i>
                                &nbsp;&nbsp;Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div> <!--/.container -->
</div> <!--/.navbar -->

<div class="sidebar">
    <div class="sidebar-bg"></div><!-- /.sidebar-bg -->
    <div class="sidebar-trigger sidebar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
        <i class="fa fa-bars"></i>
    </div><!-- /.sidebar-trigger -->

    <div class="sidebar-inner sidebar-collapse collapse">
        <ul class="sidebar-menu">
            <li class="sidebar-header"> Dashboards </li>


            <li class="{{ (request()->is('/admin')) ? 'active' : '' }}"><a href="{{url('/admin')}}"><i class="fa fa-home"></i>Home</a></li><br>
                <li class="dropdown has_sub {{request()->is('/admin')?'open active':''}}">
                    <a href="javascript:void(0)" class="">
                        <i class="fa fa-edit"></i>
                        Settings
                        <span class="">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>

                    <ul class="list-unstyled" style="">
                            <li class="{{ (request()->is('admin')) ? 'active' : '' }}"> <a href="#">Permissions </a> </li>
                            <li class="{{ (request()->is('admin')) ? 'active' : '' }}"> <a href="#">Roles </a> </li>
                            <li class="{{ (request()->is('admin')) ? 'active' : '' }}"> <a href="#">Error Logs </a> </li>
                    </ul>
                </li>
        
        </ul>
        <div class="clearfix"></div>

    </div><!-- /.sidebar-inner -->
</div> <!-- /.side-menu -->

