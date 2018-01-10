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

        {{--@if($role=="admin")--}}
            {{--<li @if($page=='dashboard') class="active" @endif><a href="{{url($prefix.'/dashboard')}}" class="sticon ti-home"><span>Dashboard</span></a></li>--}}
            {{--<li @if($page=='learnings') class="active" @endif><a href="{{url($prefix.'/learnings')}}" class="sticon ti-light-bulb"><span>Learnings</span></a></li>--}}
            {{--<li @if($page=='organizations') class="active" @endif><a href="{{url($prefix.'/organizations')}}" class="sticon ti-pencil-alt"><span>Organizations</span></a></li>--}}
            {{--<li @if($page=='learners') class="active" @endif><a href="{{url($prefix.'/learners')}}" class="sticon ti-pencil-alt"><span>Learners</span></a></li>--}}
            {{--<li @if($page=='assessments') class="active" @endif><a href="{{url($prefix.'/assessments')}}" class="sticon ti-pencil-alt"><span>Assessment</span></a></li>--}}
            {{--<li @if($page=='tickets') class="active" @endif><a href="{{url($prefix.'/tickets')}}" class="sticon ti-calendar"><span>Tickets</span></a></li>--}}
            {{--<li @if($page=='awards') class="active" @endif><a href="{{url($prefix.'/awards')}}" class="sticon ti-medall"><span>Award Board</span></a></li>--}}
        {{--@endif--}}

        {{--@if($role=="organization")--}}
            {{--<li @if($page=='dashboard') class="active" @endif><a href="{{url($prefix.'/dashboard')}}" class="sticon ti-home"><span>Dashboard</span></a></li>--}}
            {{--<li @if($page=='learnings') class="active" @endif><a href="{{url($prefix.'/learnings')}}" class="sticon ti-light-bulb"><span>Learnings</span></a></li>--}}
            {{--<li @if($page=='learners') class="active" @endif><a href="{{url($prefix.'/learners')}}" class="sticon ti-pencil-alt"><span>Learners</span></a></li>--}}
            {{--<li @if($page=='assessments') class="active" @endif><a href="{{url($prefix.'/assessments')}}" class="sticon ti-pencil-alt"><span>Assessment</span></a></li>--}}
            {{--<li @if($page=='tickets') class="active" @endif><a href="{{url($prefix.'/tickets')}}" class="sticon ti-calendar"><span>Tickets</span></a></li>--}}
            {{--<li @if($page=='awards') class="active" @endif><a href="{{url($prefix.'/awards')}}" class="sticon ti-medall"><span>Award Board</span></a></li>--}}
        {{--@endif--}}

        {{--@if($role=="learner")--}}
            {{--<li @if($page=='dashboard') class="active" @endif><a href="{{url($prefix.'/dashboard')}}" class="sticon ti-home"><span>Dashboard</span></a></li>--}}
            {{--<li @if($page=='learnings') class="active" @endif><a href="{{url($prefix.'/learnings')}}" class="sticon ti-light-bulb"><span>Learnings</span></a></li>--}}
            {{--<li @if($page=='assessments') class="active" @endif><a href="{{url($prefix.'/assessments')}}" class="sticon ti-pencil-alt"><span>Assessment</span></a></li>--}}
            {{--<li @if($page=='tickets') class="active" @endif><a href="{{url($prefix.'/tickets')}}" class="sticon ti-calendar"><span>Tickets</span></a></li>--}}
            {{--<li @if($page=='awards') class="active" @endif><a href="{{url($prefix.'/awards')}}" class="sticon ti-medall"><span>Award Board</span></a></li>--}}
        {{--@endif--}}

        <li class=""><hr></li>

        {{--<li class="nav-small-cap m-t-10">--- Main Menu</li>--}}
        {{--<li><a href="index.html" class="waves-effect"><i class="linea-icon linea-basic fa-fw" data-icon="v"></i> <span class="hide-menu">Dashboard</span></a></li>--}}
        {{--<li><a href="inbox.html" class="waves-effect"><i data-icon=")" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Apps<span class="fa arrow"></span><span class="label label-rouded label-danger pull-right">New</span></span></a>--}}
            {{--<ul class="nav nav-second-level">--}}
                {{--<li><a href="chat.html">Chat-message</a></li>--}}
                {{--<li><a href="javascript:void(0)" class="waves-effect">Inbox<span class="fa arrow"></span></a>--}}
                    {{--<ul class="nav nav-third-level">--}}
                        {{--<li> <a href="inbox.html">Mail box</a></li>--}}
                        {{--<li> <a href="inbox-detail.html">Inbox detail</a></li>--}}
                        {{--<li> <a href="compose.html">Compose mail</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                {{--<li><a href="javascript:void(0)" class="waves-effect">Contacts<span class="fa arrow"></span></a>--}}
                    {{--<ul class="nav nav-third-level">--}}
                        {{--<li> <a href="contact.html">Contact1</a></li>--}}
                        {{--<li> <a href="contact2.html">Contact2</a></li>--}}
                        {{--<li> <a href="contact-detail.html">Contact Detail</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
            {{--</ul>--}}
        {{--</li>--}}
        {{--<li> <a href="#" class="waves-effect"><i data-icon="/" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">UI Elements<span class="fa arrow"></span> <span class="label label-rouded label-info pull-right">13</span> </span></a>--}}
            {{--<ul class="nav nav-second-level">--}}
                {{--<li><a href="panels-wells.html">Panels and Wells</a></li>--}}
                {{--<li><a href="panel-ui-block.html">Panels With BlockUI</a></li>--}}
                {{--<li><a href="buttons.html">Buttons</a></li>--}}
                {{--<li><a href="sweatalert.html">Sweat alert</a></li>--}}
                {{--<li><a href="typography.html">Typography</a></li>--}}
                {{--<li><a href="grid.html">Grid</a></li>--}}
                {{--<li><a href="tabs.html">Tabs</a></li>--}}
                {{--<li><a href="tab-stylish.html">Stylish Tabs</a></li>--}}
                {{--<li><a href="modals.html">Modals</a></li>--}}
                {{--<li><a href="progressbars.html">Progress Bars</a></li>--}}
                {{--<li><a href="notification.html">Notifications</a></li>--}}
                {{--<li><a href="carousel.html">Carousel</a></li>--}}
                {{--<li><a href="list-style.html">List & Media object</a></li>--}}
                {{--<li><a href="user-cards.html">User Cards</a></li>--}}
                {{--<li><a href="timeline.html">Timeline</a></li>--}}
                {{--<li><a href="timeline-horizontal.html">Horizontal Timeline</a></li>--}}
                {{--<li><a href="nestable.html">Nesteble</a></li>--}}
                {{--<li><a href="range-slider.html">Range Slider</a></li>--}}
                {{--<li><a href="tooltip-stylish.html">Stylish Tooltip</a></li>--}}
                {{--<li><a href="bootstrap.html">Bootstrap UI</a></li>--}}
            {{--</ul>--}}
        {{--</li>--}}
        {{--<li> <a href="forms.html" class="waves-effect"><i data-icon="&#xe00b;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Forms<span class="fa arrow"></span></span></a>--}}
            {{--<ul class="nav nav-second-level">--}}
                {{--<li><a href="form-basic.html">Basic Forms</a></li>--}}
                {{--<li><a href="form-layout.html">Form Layout</a></li>--}}
                {{--<li><a href="form-advanced.html">Form Addons</a></li>--}}
                {{--<li><a href="form-material-elements.html">Form Material</a></li>--}}
                {{--<li><a href="form-float-input.html">Form Float Input</a></li>--}}
                {{--<li><a href="form-upload.html">File Upload</a></li>--}}
                {{--<li><a href="form-mask.html">Form Mask</a></li>--}}
                {{--<li><a href="form-img-cropper.html">Image Cropping</a></li>--}}
                {{--<li><a href="form-validation.html">Form Validation</a></li>--}}
                {{--<li><a href="form-dropzone.html">File Dropzone</a></li>--}}
                {{--<li><a href="form-pickers.html">Form-pickers</a></li>--}}
                {{--<li><a href="form-wizard.html">Form-wizards</a></li>--}}
                {{--<li><a href="form-typehead.html">Typehead</a></li>--}}
                {{--<li><a href="form-xeditable.html">X-editable</a></li>--}}
                {{--<li><a href="form-summernote.html">Summernote</a></li>--}}
                {{--<li><a href="form-bootstrap-wysihtml5.html">Bootstrap wysihtml5</a></li>--}}
                {{--<li><a href="form-tinymce-wysihtml5.html">Tinymce wysihtml5</a></li>--}}
            {{--</ul>--}}
        {{--</li>--}}
        {{--<li class="nav-small-cap">--- Proffessional</li>--}}
        {{--<li> <a href="#" class="waves-effect"><i data-icon="&#xe008;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Sample Pages<span class="fa arrow"></span><span class="label label-rouded label-purple pull-right">30</span></span></a>--}}
            {{--<ul class="nav nav-second-level">--}}
                {{--<li><a href="starter-page.html">Starter Page</a></li>--}}
                {{--<li><a href="blank.html">Blank Page</a></li>--}}
                {{--<li><a href="javascript:void(0)" class="waves-effect">Email Templates<span class="fa arrow"></span></a>--}}
                    {{--<ul class="nav nav-third-level">--}}
                        {{--<li> <a href="https://wrappixel.com/demos/admin-templates/pixeladmin/email-templates/basic.html">Basic</a></li>--}}
                        {{--<li> <a href="https://wrappixel.com/demos/admin-templates/pixeladmin/email-templates/alert.html">Alert</a></li>--}}
                        {{--<li> <a href="https://wrappixel.com/demos/admin-templates/pixeladmin/email-templates/billing.html">Billing</a></li>--}}
                        {{--<li> <a href="https://wrappixel.com/demos/admin-templates/pixeladmin/email-templates/password-reset.html">Reset Pwd</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                {{--<li><a href="lightbox.html">Lightbox Popup</a></li>--}}
                {{--<li><a href="treeview.html">Treeview</a></li>--}}
                {{--<li><a href="search-result.html">Search Result</a></li>--}}
                {{--<li><a href="utility-classes.html">Utility Classes</a></li>--}}
                {{--<li><a href="custom-scroll.html">Custom Scrolls</a></li>--}}
                {{--<li><a href="login.html">Login Page</a></li>--}}
                {{--<li><a href="login2.html">Login v2</a></li>--}}
                {{--<li><a href="animation.html">Animations</a></li>--}}
                {{--<li><a href="profile.html">Profile</a></li>--}}
                {{--<li><a href="invoice.html">Invoice</a></li>--}}
                {{--<li><a href="faq.html">FAQ</a></li>--}}
                {{--<li><a href="gallery.html">Gallery</a></li>--}}
                {{--<li><a href="pricing.html">Pricing</a></li>--}}
                {{--<li><a href="register.html">Register</a></li>--}}
                {{--<li><a href="register2.html">Register v2</a></li>--}}
                {{--<li><a href="recoverpw.html">Recover Password</a></li>--}}
                {{--<li><a href="lock-screen.html">Lock Screen</a></li>--}}
                {{--<li><a href="400.html">Error 400</a></li>--}}
                {{--<li><a href="403.html">Error 403</a></li>--}}
                {{--<li><a href="404.html">Error 404</a></li>--}}
                {{--<li><a href="500.html">Error 500</a></li>--}}
                {{--<li><a href="503.html">Error 503</a></li>--}}
            {{--</ul>--}}
        {{--</li>--}}
        {{--<li> <a href="#" class="waves-effect"><i data-icon="&#xe006;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Charts<span class="fa arrow"></span></span></a>--}}
            {{--<ul class="nav nav-second-level">--}}
                {{--<li> <a href="flot.html">Flot Charts</a> </li>--}}
                {{--<li><a href="morris-chart.html">Morris Chart</a></li>--}}
                {{--<li><a href="chart-js.html">Chart-js</a></li>--}}
                {{--<li><a href="peity-chart.html">Peity Charts</a></li>--}}
                {{--<li><a href="knob-chart.html">Knob Charts</a></li>--}}
                {{--<li><a href="sparkline-chart.html">Sparkline charts</a></li>--}}
                {{--<li><a href="extra-charts.html">Extra Charts</a></li>--}}
            {{--</ul>--}}
        {{--</li>--}}
        {{--<li> <a href="tables.html" class="waves-effect"><i data-icon="O" class="linea-icon linea-software fa-fw"></i> <span class="hide-menu">Tables<span class="fa arrow"></span><span class="label label-rouded label-danger pull-right">7</span></span></a>--}}
            {{--<ul class="nav nav-second-level">--}}
                {{--<li><a href="basic-table.html">Basic Tables</a></li>--}}
                {{--<li><a href="table-layouts.html">Table Layouts</a></li>--}}
                {{--<li><a href="data-table.html">Data Table</a></li>--}}
                {{--<li><a href="bootstrap-tables.html">Bootstrap Tables</a></li>--}}
                {{--<li><a href="responsive-tables.html">Responsive Tables</a></li>--}}
                {{--<li><a href="editable-tables.html">Editable Tables</a></li>--}}
                {{--<li><a href="foo-tables.html">FooTables</a></li>--}}
                {{--<li><a href="jsgrid.html">JsGrid Tables</a></li>--}}
            {{--</ul>--}}
        {{--</li>--}}
        {{--<li> <a href="widgets.html" class="waves-effect active"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Widgets</span></a> </li>--}}
        {{--<li> <a href="#" class="waves-effect"><i data-icon="7" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Icons<span class="fa arrow"></span></span></a>--}}
            {{--<ul class="nav nav-second-level">--}}
                {{--<li> <a href="fontawesome.html">Font awesome</a> </li>--}}
                {{--<li> <a href="themifyicon.html">Themify Icons</a> </li>--}}
                {{--<li> <a href="simple-line.html">Simple line Icons</a> </li>--}}
                {{--<li><a href="linea-icon.html">Linea Icons</a></li>--}}
                {{--<li><a href="weather.html">Weather Icons</a></li>--}}
            {{--</ul>--}}
        {{--</li>--}}
        {{--<li> <a href="map-google.html" class="waves-effect"><i data-icon="Q" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu" >Google Map</span></a> </li>--}}
        {{--<li> <a href="map-vector.html" class="waves-effect"><i data-icon="S" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu" >Vector Map</span></a> </li>--}}
        {{--<li> <a href="calendar.html" class="waves-effect"><i data-icon="A" class="linea-icon linea-elaborate fa-fw"></i> <span class="hide-menu">Calendar</span></a></li>--}}
        {{--<li> <a href="javascript:void(0)" class="waves-effect"><i data-icon="F" class="linea-icon linea-software fa-fw"></i> <span class="hide-menu">Multi-Level Dropdown<span class="fa arrow"></span></span></a>--}}
            {{--<ul class="nav nav-second-level">--}}
                {{--<li> <a href="javascript:void(0)">Second Level Item</a> </li>--}}
                {{--<li> <a href="javascript:void(0)">Second Level Item</a> </li>--}}
                {{--<li> <a href="javascript:void(0)" class="waves-effect">Third Level <span class="fa arrow"></span></a>--}}
                    {{--<ul class="nav nav-third-level">--}}
                        {{--<li> <a href="javascript:void(0)">Third Level Item</a> </li>--}}
                        {{--<li> <a href="javascript:void(0)">Third Level Item</a> </li>--}}
                        {{--<li> <a href="javascript:void(0)">Third Level Item</a> </li>--}}
                        {{--<li> <a href="javascript:void(0)">Third Level Item</a> </li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
            {{--</ul>--}}
        {{--</li>--}}
        {{--<li><a href="login.html" class="waves-effect"><i class="icon-logout fa-fw"></i> <span class="hide-menu">Log out</span></a></li>--}}
        {{--<li class="nav-small-cap">--- Support</li>--}}
        {{--<li><a href="documentation.html" class="waves-effect"><i class="fa fa-circle-o text-danger"></i> <span class="hide-menu">Documentation</span></a></li>--}}
        {{--<li><a href="gallery.html" class="waves-effect"><i class="fa fa-circle-o text-info"></i> <span class="hide-menu">Gallery</span></a></li>--}}
        {{--<li><a href="faq.html" class="waves-effect"><i class="fa fa-circle-o text-success"></i> <span class="hide-menu">Faqs</span></a></li>--}}
    </ul>
</div>
</div>
<!-- Left navbar-header end -->