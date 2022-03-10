<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <span class="brand-text font-weight-light">{{config('app.name', 'Laravel')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image text-white">
                <i class="fas fa-user-circle fa-3x mt-2 img-circle elevation-2" alt="User Image"></i>
            </div>
            <div class="info">
                @if(Auth::user() != null)
                    <a href="{{ route('dashboard') }}" class="d-block">
                        {{Auth::user()->name}}
                    </a>
                    <small class="text-white"><i class="fas fa-circle text-success"></i>&nbsp;Online</small>
                @endif
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2 sidebarmenu">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">MAIN NAVIGATION</li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="{{Request::path() == 'dashboard'
                    ? 'nav-link active' : 'nav-link'}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('appointments.index') }}" class="{{Request::path() == 'appointments'
                    ? 'nav-link active' : 'nav-link'}}">
                        <i class="nav-icon fas fa-calendar-check"></i>
                        <p>Appointments</p>
                    </a>
                </li>
                @if(Auth::user()->type==1)
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="{{Request::path() == 'users'
                    ? 'nav-link active' : 'nav-link'}}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Users</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('therapy-rooms.index') }}" class="{{Request::path() == 'therapy-rooms'
                    ? 'nav-link active' : 'nav-link'}}">
                        <i class="nav-icon fas fa-door-closed"></i>
                        <p>Therapy Rooms</p>
                    </a>
                </li>
                @endif


                {{-- <li class="{{Request::path() == 'meetings' || Request::path() == 'live-tracking'
                ? 'nav-item has-treeview menu-open' : 'nav-item has-treeview'}}">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-handshake"></i>
                    <p>Activities<i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('meetings.index')}}" class="{{Request::path() == 'meetings'
                        ? 'nav-link active' : 'nav-link'}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Meetings</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('live-tracking.index')}}" class="{{Request::path() == 'live-tracking'
                        ? 'nav-link active' : 'nav-link'}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Live Tracking</p>
                        </a>
                    </li>
                </ul> --}}
            {{-- </li> --}}

                <li class="nav-header">APPLICATION SETTINGS</li>
                <li class="nav-item">
                    <a href="{{ route('profile.index') }}" class="{{Request::path() == 'profile'
                    ? 'nav-link active' : 'nav-link'}}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Profile</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.Sidebar Menu -->

    </div>
    <!-- /.Sidebar -->

</aside>
<!-- ./Main Sidebar Container -->
