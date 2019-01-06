<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/admin/home">Dipacommerce Admin</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                {{--<li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>--}}
                {{--</li>--}}
                {{--<li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>--}}
                {{--</li>--}}
                <li class="divider"></li>
                <li><a href="/admin/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="/admin/home"><i class="fa fa-table fa-fw"></i> Home</a>
                </li>
                {{--<li>--}}
                    {{--<a href="/admin/menus"><i class="fa fa-table fa-fw"></i> Menus</a>--}}
                {{--</li>--}}
                <li>
                    <a href="/admin/types"><i class="fa fa-table fa-fw"></i> Types</a>
                </li>
                <li>
                    <a href="/admin/groups"><i class="fa fa-table fa-fw"></i> Groups</a>
                </li>
                <li>
                    <a href="/admin/group_items"><i class="fa fa-table fa-fw"></i> Group Items</a>
                </li>
                <li>
                    <a href="/admin/items"><i class="fa fa-table fa-fw"></i> Products</a>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>
