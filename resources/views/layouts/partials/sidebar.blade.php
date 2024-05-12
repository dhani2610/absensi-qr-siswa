<!-- ========== Left Sidebar Start ========== -->
<style>
span{
    color: black;
}
#sidebar-menu{
    background: white;
}
.simplebar-content-wrapper{
    background: white!important;
}

</style>
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu" style="background:white">
                @if(auth()->user()->can('dashboard') || auth()->user()->can('master-data') || auth()->user()->can('history-log-list'))
                <li class="menu-title" key="t-menu">Menu</li>
                @endif

                @if(auth()->user()->can('dashboard'))
                <li>
                    <a href="{{ route('dashboard.index') }}" class="waves-effect" style="background:{{ Request::is('dashboard*') ? '#0083ff!important' : '' }}" >
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Dashboard</span>
                    </a>
                </li>
                @endif

                @if(auth()->user()->can('main-menu'))
                <li>
                    <a href="{{ route('master-data.index') }}" class="waves-effect {{ Request::is(['master-data*', 'departement*', 'users*']) ? 'active' : '' }}" style="background:{{ Request::is(['master-data*', 'departement*', 'users*']) ? '#0083ff!important' : '' }}">
                        <i class="mdi mdi-folder-outline"></i>
                        <span data-key="t-dashboard">Menu Utama</span>
                    </a>
                </li>
                @endif


                <li>
                    <form action="{{ url('/logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn" style="color: white;background: red;margin-left: 9%;"> 
                            <i class="mdi mdi-logout"></i>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->