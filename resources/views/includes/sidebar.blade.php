<!-- .right-sidebar -->
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar" style="height: 100%;">
        <ul class="nav" id="side-menu">
            @if(session('role')=="admin")
                <li @if($page=='dashboard') class="tab-current" @endif><a href="{{url('/dashboard')}}" class="waves-effect"><i class="sticon ti-home"></i><span class="hide-menu">Dashboard</span></a></li>
                <li @if($page=='learnings') class="tab-current" @endif>
                    <a href="javascript:void(0)" class="waves-effect"><i class="sticon ti-blackboard"></i> <span class="hide-menu">Learnings<span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{url('/learnings')}}">View all modules</a></li>
                        <li><a href="{{url('/learnings/create')}}">Add new module</a></li>
                    </ul>
                </li>
                <li @if($page=='cost') class="tab-current" @endif><a href="{{url('/cost/edit')}}" class="waves-effect"> <i class="sticon ti-stats-down"></i><span class="hide-menu">Cost of Not</span></a></li>
                <li @if($page=='organizations') class="tab-current" @endif><a href="{{url('/organizations')}}" class="waves-effect"> <i class="sticon ti-briefcase"></i><span class="hide-menu">Organizations</span></a></li>
                <li @if($page=='learners') class="tab-current" @endif><a href="{{url('/learners')}}" class="waves-effect"> <i class="sticon ti-user"></i><span class="hide-menu">Learners</span></a></li>
                <li @if($page=='quiz') class="tab-current" @endif><a href="{{url('/quiz')}}" class="waves-effect"> <i class="sticon ti-thought"></i><span class="hide-menu">Quiz</span></a></li>
                <li @if($page=='assessments') class="tab-current" @endif><a href="{{url('/assessments')}}" class="waves-effect"> <i class="sticon ti-agenda"></i><span class="hide-menu">Assessment</span></a></li>
                <li @if($page=='tickets') class="tab-current" @endif><a href="{{url('/tickets')}}" class="waves-effect"> <i class="sticon ti-calendar"></i><span class="hide-menu">Tickets</span></a></li>
                <li @if($page=='awards') class="tab-current" @endif><a href="{{url('/awards')}}" class="waves-effect"><i class="sticon ti-crown"></i><span class="hide-menu">Award Board</span></a></li>
            @elseif(session('role')=="organization")
                <li @if($page=='dashboard') class="tab-current" @endif><a href="{{url('/dashboard')}}" class="waves-effect"><i class="sticon ti-home"></i> <span class="hide-menu">Dashboard</span></a></li>
                <li @if($page=='learnings') class="tab-current" @endif>
                    <a href="{{url('/learnings')}}" class="waves-effect"><i class="sticon ti-blackboard"></i> <span class="hide-menu">Learnings</span></a>
                </li>
                <li @if($page=='learners') class="tab-current" @endif><a href="{{url('organizations/'. auth()->user()->account_id .'/learners')}}" class="waves-effect"><i class="sticon ti-user"></i> <span class="hide-menu">Learners</span></a></li>
                <li @if($page=='quiz') class="tab-current" @endif><a href="{{url('/quiz')}}" class="waves-effect"><i class="sticon ti-thought"></i> <span class="hide-menu">Quiz</span></a></li>
                <li @if($page=='assessments') class="tab-current" @endif><a href="{{url('/assessments')}}" class="waves-effect"><i class="sticon ti-agenda"></i> <span class="hide-menu">Assessment</span></a></li>
                <li @if($page=='tickets') class="tab-current" @endif><a href="{{url('/tickets')}}" class="waves-effect"><i class="sticon ti-calendar"></i> <span class="hide-menu">Tickets</span></a></li>
                <li @if($page=='awards') class="tab-current" @endif><a href="{{url('/awards')}}" class="waves-effect"><i class="sticon ti-crown"></i> <span class="hide-menu">Award Board</span></a></li>
            @elseif(session('role')=='learner')
                <li @if($page=='dashboard') class="tab-current" @endif><a href="{{url('/dashboard')}}" class="waves-effect"><i class="sticon ti-home"></i> <span class="hide-menu">Dashboard</span></a></li>
                <li @if($page=='learnings') class="tab-current" @endif>
                    <a href="{{url('/learnings')}}" class="waves-effect"><i class="sticon ti-blackboard"></i> <span class="hide-menu">Learnings</span></a>
                </li>
                <li @if($page=='cost') class="tab-current" @endif><a href="{{url('/cost')}}" class="waves-effect"><i class="sticon ti-stats-down"></i> <span class="hide-menu">Cost of Not</span></a></li>
                <li @if($page=='assessments') class="tab-current" @endif><a href="{{url('/assessments')}}" class="waves-effect"><i class="sticon ti-agenda"></i> <span class="hide-menu">Assessment</span></a></li>
                <li @if($page=='tickets') class="tab-current" @endif><a href="{{url('/tickets')}}" class="waves-effect"><i class="sticon ti-calendar"></i> <span class="hide-menu">Tickets</span></a></li>
                <li @if($page=='awards') class="tab-current" @endif><a href="{{url('/awards')}}" class="waves-effect"><i class="sticon ti-crown"></i> <span class="hide-menu">Award Board</span></a></li>
            @endif
        </ul>
    </div>
</div>
<!-- /.right-sidebar -->