<!-- .right-sidebar -->
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar" style="height: 100%;">
        @if(session('role')!='admin')
        <div class="user-profile">
            <div class="dropdown user-pro-body">
                <div><img src="{{!empty(auth()->user()->account->image) ? asset('uploads/'.auth()->user()->account->image) : 'https://www.timeshighereducation.com/sites/default/files/byline_photos/default-avatar.png' }}" alt="user-img" class="img-circle"></div>
                <a href="javascript:void(0)" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{auth()->user()->account->name}} <span class="caret"></span></a>
                <ul class="dropdown-menu animated flipInY">
                    <li><a href="{{url('profile')}}"><i class="ti-user"></i> My Profile</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="{{url('logout')}}"><i class="fa fa-power-off"></i> Logout</a></li>
                </ul>
            </div>
        </div>
        @endif
        <ul class="nav" id="side-menu">
            @if($role=="admin")
                <li @if($page=='dashboard') class="tab-current" @endif><a href="{{url('/dashboard')}}" class="sticon ti-home"><span>Dashboard</span></a></li>
                <li @if($page=='learnings') class="tab-current" @endif><a href="{{url('/learnings')}}" class="sticon ti-blackboard"><span>Learnings</span></a></li>
                <li @if($page=='cost') class="tab-current" @endif><a href="{{url('/cost/edit')}}" class="sticon ti-stats-down"><span>Cost of Not</span></a></li>
                <li @if($page=='organizations') class="tab-current" @endif><a href="{{url('/organizations')}}" class="sticon ti-briefcase"><span>Organizations</span></a></li>
                <li @if($page=='learners') class="tab-current" @endif><a href="{{url('/learners')}}" class="sticon ti-user"><span>Learners</span></a></li>
                <li @if($page=='quiz') class="tab-current" @endif><a href="{{url('/quiz')}}" class="sticon ti-thought"><span>Quiz</span></a></li>
                <li @if($page=='assessments') class="tab-current" @endif><a href="{{url('/assessments')}}" class="sticon ti-agenda"><span>Assessment</span></a></li>
                <li @if($page=='tickets') class="tab-current" @endif><a href="{{url('/tickets')}}" class="sticon ti-calendar"><span>Tickets</span></a></li>
                <li @if($page=='awards') class="tab-current" @endif><a href="{{url('/awards')}}" class="sticon ti-crown"><span>Award Board</span></a></li>
            @endif

            @if($role=="organization")
                <li @if($page=='dashboard') class="tab-current" @endif><a href="{{url('/dashboard')}}" class="waves-effect"><i class="sticon ti-home"></i> <span class="hide-menu">Dashboard</span></a></li>
                <li @if($page=='learnings') class="tab-current" @endif><a href="{{url('/learnings')}}" class="waves-effect"><i class="sticon ti-blackboard"></i> <span class="hide-menu">Learnings</span></a></li>
                <li @if($page=='learners') class="tab-current" @endif><a href="{{url('organizations/'. auth()->user()->account_id .'/learners')}}" class="waves-effect"><i class="sticon ti-user"></i> <span class="hide-menu">Learners</span></a></li>
                <li @if($page=='quiz') class="tab-current" @endif><a href="{{url('/quiz')}}" class="waves-effect"><i class="sticon ti-thought"></i> <span class="hide-menu">Quiz</span></a></li>
                <li @if($page=='assessments') class="tab-current" @endif><a href="{{url('/assessments')}}" class="waves-effect"><i class="sticon ti-agenda"></i> <span class="hide-menu">Assessment</span></a></li>
                <li @if($page=='tickets') class="tab-current" @endif><a href="{{url('/tickets')}}" class="waves-effect"><i class="sticon ti-calendar"></i> <span class="hide-menu">Tickets</span></a></li>
                <li @if($page=='awards') class="tab-current" @endif><a href="{{url('/awards')}}" class="waves-effect"><i class="sticon ti-crown"></i> <span class="hide-menu">Award Board</span></a></li>
            @endif

                @if($role=="learner")
                    <li @if($page=='dashboard') class="tab-current" @endif><a href="{{url('/dashboard')}}" class="waves-effect"><i class="sticon ti-home"></i> <span class="hide-menu">Dashboard</span></a></li>
                    <li @if($page=='learnings') class="tab-current" @endif><a href="{{url('/learnings')}}" class="waves-effect"><i class="sticon ti-blackboard"></i> <span class="hide-menu">Learnings</span></a></li>
                    <li @if($page=='cost') class="tab-current" @endif><a href="{{url('/cost')}}" class="waves-effect"><i class="sticon ti-stats-down"></i> <span class="hide-menu">Cost of Not Managing Better</span></a></li>
                    <li @if($page=='assessments') class="tab-current" @endif><a href="{{url('/assessments')}}" class="waves-effect"><i class="sticon ti-agenda"></i> <span class="hide-menu">Assessment</span></a></li>
                    <li @if($page=='tickets') class="tab-current" @endif><a href="{{url('/tickets')}}" class="waves-effect"><i class="sticon ti-calendar"></i> <span class="hide-menu">Tickets</span></a></li>
                    <li @if($page=='awards') class="tab-current" @endif><a href="{{url('/awards')}}" class="waves-effect"><i class="sticon ti-crown"></i> <span class="hide-menu">Award Board</span></a></li>
                @endif
        </ul>
    </div>
</div>
<!-- /.right-sidebar -->