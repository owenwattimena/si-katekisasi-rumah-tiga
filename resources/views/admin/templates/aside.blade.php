<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="info" style="position: static; text-align: center">
                @auth
                <p><i class="fa fa-user-circle"></i> {{ \Auth::user()->name }}</p>
                @endauth
                <!-- Status -->
                {{-- <a href="#"><i class="fa fa-circle text-success"></i> {{ \Auth::user()->email }}</a> --}}
            </div>
        </div>

        <!-- search form (Optional) -->
        {{-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i
                            class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form> --}}
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            {{-- <li class="header">HEADER</li> --}}
            <li class="{{ (request()->is('admin/dashboard*')) ? 'active' : '' }}"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a></li>
            @if (Auth::user()->akses == 'admin')
            <li class="{{ (request()->is('admin/periode*')) ? 'active' : '' }}"><a href="{{ route('admin.periode') }}"}><i class="fa fa-calendar"></i> <span>Periode</span></a></li>
            <li class="{{ (request()->is('admin/katekisan*')) ? 'active' : '' }}"><a href="{{ route('admin.katekisan') }}"}><i class="fa fa-users"></i> <span>Katekisan</span></a></li>
            <li class="{{ (request()->is('admin/pengajar*')) ? 'active' : '' }}"><a href="{{ route('admin.pengajar') }}"}><i class="fa fa-user"></i> <span>Pengajar</span></a></li>
            @endif
            
            <li class="{{ (request()->is('admin/jadwal*')) ? 'active' : '' }}"><a href="{{ route('admin.jadwal') }}"><i class="fa fa-calendar"></i> <span>Jadwal</span></a></li>
            
            <li class="{{ (request()->is('admin/tes*')) ? 'active' : '' }}"><a href="{{ route('admin.test') }}"><i class="fa fa-list"></i> <span>Test</span></a></li>
            <li class="{{ (request()->is('admin/pengaturan*')) ? 'active' : '' }}"><a href="{{ route('admin.pengaturan') }}"><i class="fa fa-cog"></i> <span>Pengaturan</span></a></li>
            

        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>