<nav class="main-header navbar
    {{ config('adminlte.classes_topnav_nav', 'navbar-expand') }}
    {{ config('adminlte.classes_topnav', 'navbar-white navbar-light') }}">

    {{-- Navbar left links --}}
    <ul class="navbar-nav">
        {{-- Left sidebar toggler link --}}
        @include('adminlte::partials.navbar.menu-item-left-sidebar-toggler')

        {{-- Configured left links --}}
        @each('adminlte::partials.navbar.menu-item', $adminlte->menu('navbar-left'), 'item')

        {{-- Custom left links --}}
        @yield('content_top_nav_left')
    </ul>

    {{-- Navbar right links --}}
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown pr-2">
          <!-- User Block  -->
          <a class="user-block" data-toggle="dropdown" href="#">
            <img class="img-circle" src="{{asset('storage/logo/user.png')}}" alt="User Image">
            <span class="username">Anwar Fauzi</span>
            <span class="description">Administrator</span>
          </a>
          <!-- End User Block  -->

          <!-- User Dropdown  -->
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">Akun Saya</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-user mr-2"></i> Profile
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-key mr-2"></i> Ganti Password
            </a>
            <div class="dropdown-divider"></div>
            <div class="dropdown-divider"></div>
            <a href="{{ route('logout') }}" class="dropdown-item dropdown-footer bg-danger" onclick="return confirm('Apakah anda yakin ingin keluar ?')"><i class="fas fa-sign-out-alt mr-1"></i> Keluar / Logout</a>
          </div>
          <!-- End User Dropdown  -->
        </li>
    </ul>

</nav>
