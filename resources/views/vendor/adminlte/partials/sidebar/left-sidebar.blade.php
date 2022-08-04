<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <img src="{{asset('storage/logo/gis.png')}}" alt="Logo" class="brand-image img-circle">
    <span class="brand-text font-weight-light">E-Raport SD GIS</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('pengumuman.index')}}" class="nav-link">
            <i class="nav-icon fas fa-bullhorn"></i>
            <p>
              Pengumuman
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-server"></i>
            <p>
              Data Master
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview bg-secondary">
            <li class="nav-item">
              <a href="{{route('sekolah.index')}}" class="nav-link">
                <i class="fas fa-school nav-icon"></i>
                <p>Profil Sekolah</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('guru.index')}}" class="nav-link">
                <i class="fas fa-user-tie nav-icon"></i>
                <p>Data Guru</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('tahun-pelajaran.index')}}" class="nav-link">
                <i class="fas fa-calendar-week nav-icon"></i>
                <p>Data Tahun Pelajaran</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('mapel.index')}}" class="nav-link">
                <i class="fas fa-book nav-icon"></i>
                <p>Data Mata Pelajaran</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('kelas.index')}}" class="nav-link">
                <i class="fas fa-layer-group nav-icon"></i>
                <p>Data Kelas & Wali</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('t2q.index')}}" class="nav-link">
              <i class="fas fa-mosque nav-icon"></i>
                <p>Kelompok T2Q</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('siswa.index')}}" class="nav-link">
                <i class="fas fa-users nav-icon"></i>
                <p>Data Siswa</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('pembelajaran.index')}}" class="nav-link">
                <i class="fas fa-calendar-check nav-icon"></i>
                <p>Data Pembelajaran</p>
              </a>
            </li>
          </ul>
        </li>

          <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><i class="nav-icon fas fa-sign-out-alt"></i>
            <p>
              Keluar / Logout
            </p></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf                   </form>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>