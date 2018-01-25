<!-- Left navbar-header -->
<div class="navbar-default sidebar" role="navigation">
<div class="sidebar-nav navbar-collapse slimscrollsidebar">
    <div class="user-profile" style="display: none;">
        <div class="dropdown user-pro-body">
            <div><img src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/users/varun.jpg" alt="user-img" class="img-circle"></div> <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Steave Gection <span class="caret"></span></a>
            <ul class="dropdown-menu animated flipInY">
                <li><a href="#"><i class="ti-user"></i> My Profile</a></li>
                <li><a href="#"><i class="ti-wallet"></i> My Balance</a></li>
                <li><a href="#"><i class="ti-email"></i> Inbox</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#"><i class="ti-settings"></i> Account Setting</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="login.html"><i class="fa fa-power-off"></i> Logout</a></li>
            </ul>
        </div>
    </div>
    <ul class="nav" id="side-menu">
        <li><a @if($page=='dashboard') class="active" @endif href="{{url($role.'/dashboard')}}" class="waves-effect"><i class="linea-icon linea-basic fa-fw" data-icon="Z"></i> <span class="hide-menu">Dashboard</span></a></li>
        <li><a @if($page=='learnings') class="active" @endif href="{{url($role.'/learnings')}}" class="waves-effect"><i class="linea-icon linea-basic fa-fw" data-icon="7"></i> <span class="hide-menu">Learnings</span></a></li>
        <li><a @if($page=='assessment') class="active" @endif href="{{url($role.'/assessment')}}" class="waves-effect"><i class="linea-icon linea-basic fa-fw" data-icon="&#xe00a;"></i> <span class="hide-menu">Assessment</span></a></li>
        <li><a @if($page=='tickets') class="active" @endif href="{{url($role.'/tickets')}}" class="waves-effect"><i class="linea-icon linea-elaborate fa-fw" data-icon="A"></i> <span class="hide-menu">Tickets</span></a></li>
        <li><a @if($page=='awards') class="active" @endif href="{{url($role.'/awards')}}" class="waves-effect"><i class="linea-icon linea-basic fa-fw" data-icon="&#xe013;"></i> <span class="hide-menu">Award Board</span></a></li>
        <li class=""><hr></li>
    </ul>
</div>
</div>
<!-- Left navbar-header end -->