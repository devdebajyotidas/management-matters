<div class="row">
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="sttabs tabs-style-iconbox">
            <nav>
                <ul>
                    @if($role=="admin")
                        <li @if($page=='dashboard') class="tab-current" @endif><a href="{{url('/dashboard')}}" class="sticon ti-home"><span>Dashboard</span></a></li>
                        <li @if($page=='learnings') class="tab-current" @endif><a href="{{url('/learnings')}}" class="sticon ti-light-bulb"><span>Learnings</span></a></li>
                        <li @if($page=='organizations') class="tab-current" @endif><a href="{{url('/organizations')}}" class="sticon ti-pencil-alt"><span>Organizations</span></a></li>
                        <li @if($page=='learners') class="tab-current" @endif><a href="{{url('/learners')}}" class="sticon ti-pencil-alt"><span>Learners</span></a></li>
                        <li @if($page=='quiz') class="tab-current" @endif><a href="{{url('/quiz')}}" class="sticon ti-pencil-alt"><span>Quiz</span></a></li>
                        <li @if($page=='assessments') class="tab-current" @endif><a href="{{url('/assessments')}}" class="sticon ti-pencil-alt"><span>Assessment</span></a></li>
                        <li @if($page=='tickets') class="tab-current" @endif><a href="{{url('/tickets')}}" class="sticon ti-calendar"><span>Tickets</span></a></li>
                        <li @if($page=='awards') class="tab-current" @endif><a href="{{url('/awards')}}" class="sticon ti-medall"><span>Award Board</span></a></li>
                    @endif

                    @if($role=="organization")
                        <li @if($page=='dashboard') class="tab-current" @endif><a href="{{url('/dashboard')}}" class="sticon ti-home"><span>Dashboard</span></a></li>
                        <li @if($page=='learnings') class="tab-current" @endif><a href="{{url('/learnings')}}" class="sticon ti-light-bulb"><span>Learnings</span></a></li>
                        <li @if($page=='learners') class="tab-current" @endif><a href="{{url('organizations/'. auth()->user()->account_id .'/learners')}}" class="sticon ti-pencil-alt"><span>Learners</span></a></li>
                            <li @if($page=='quiz') class="tab-current" @endif><a href="{{url('/quiz')}}" class="sticon ti-pencil-alt"><span>Quiz</span></a></li>
                        <li @if($page=='assessments') class="tab-current" @endif><a href="{{url('/assessments')}}" class="sticon ti-pencil-alt"><span>Assessment</span></a></li>
                        <li @if($page=='tickets') class="tab-current" @endif><a href="{{url('/tickets')}}" class="sticon ti-calendar"><span>Tickets</span></a></li>
                        <li @if($page=='awards') class="tab-current" @endif><a href="{{url('/awards')}}" class="sticon ti-medall"><span>Award Board</span></a></li>
                    @endif

                    @if($role=="learner")
                            <li @if($page=='dashboard') class="tab-current" @endif><a href="{{url('/dashboard')}}" class="sticon ti-home"><span>Dashboard</span></a></li>
                            <li @if($page=='learnings') class="tab-current" @endif><a href="{{url('/learnings')}}" class="sticon ti-light-bulb"><span>Learnings</span></a></li>
                            <li @if($page=='cost') class="tab-current" @endif><a href="{{url('/cost')}}" class="sticon ti-stats-down"><span>Cost of Not Managing</span></a></li>
                            <li @if($page=='assessments') class="tab-current" @endif><a href="{{url('/assessments')}}" class="sticon ti-pencil-alt"><span>Assessment</span></a></li>
                            <li @if($page=='tickets') class="tab-current" @endif><a href="{{url('/tickets')}}" class="sticon ti-calendar"><span>Tickets</span></a></li>
                            <li @if($page=='awards') class="tab-current" @endif><a href="{{url('/awards')}}" class="sticon ti-medall"><span>Award Board</span></a></li>
                    @endif


                </ul>
            </nav>
        </div>
    </div>
</div>