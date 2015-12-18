<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                </div>
                <!-- /input-group -->
            </li>

            <li>
                <a href="{{ route('admin.index') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>

            <li>
                <a href="{{ route('admin.users.list') }}"><i class="fa fa-user fa-fw"></i> Users Managment</a>
            </li>

            @if(isset($user))
            <li>
                <a href="#"><img class="img-rounded" style="height: 20px; width: 20px" src="{{ asset('img/persons/'.$user->avatar) }}"> {{ $user->username }}<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#">Info</a>
                    </li>
                    <li>
                        <a href="#">Skills</a>
                    </li>
                    <li>
                        <a href="#">Posts</a>
                    </li>
                    <li>
                        <a href="#">Articles</a>
                    </li>
                    <li>
                        <a href="#">Problems</a>
                    </li>
                    <li>
                        <a href="#">Comments & Answers</a>
                    </li>
                    <li>
                        <a href="#">Addons</a>
                    </li>
                    <li>
                        <a href="#">Payment</a>
                    </li>
                    <li>
                        <a href="#">Credit Managment</a>
                    </li>
                    @if(count($user->shop))
                        <li>
                            <a href="#">Shop</a>
                        </li>
                    @endif
                    <li>
                        <a href="#">Friends</a>
                    </li>
                    <li>
                        <a href="#">Shares</a>
                    </li>
                    <li>
                        <a href="#">Showcases</a>
                    </li>
                    <li>
                        <a href="#">Files</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            @endif

            <li>
                <a href="#"><i class="fa fa-cogs fa-fw"></i> Setting<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('admin.setting.categories') }}">Categories</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.setting.provinces') }}">Provinces & Cities</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.setting.universities') }}">Universities</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="{{ route('admin.report.show') }}"><i class="fa fa-bug fa-fw"></i> Reports</a>
            </li>

            <li>
                <a href="{{ route('admin.feedback.show') }}"><i class="fa fa-feed fa-fw"></i> Feedback</a>
            </li>

            <li>
                <a href="#"><i class="fa fa-bar-chart fa-fw"></i> Visitors<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('admin.visitors.list') }}"> Visitors List</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.visitors.diagram') }}"> Visitors Diagram</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="#"><i class="fa fa-money fa-fw"></i> Accountant<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('admin.settle.requests') }}"> Settlement Requests</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.settle.index') }}"> Settlement Events List</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.settle.create') }}"> New Settlement Event</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="#"><i class="fa fa-user-secret fa-fw"></i> Admins Management<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('admin.admins.list') }}">Admins List</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.admins.create') }}">Create New Admin</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="#"><i class="fa fa-envelope-o fa-fw"></i> Invitations</a>
            </li>

        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->