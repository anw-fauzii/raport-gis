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
        <li class="nav-header">MENU UTAMA</li>
        <li class="nav-item">
          <a href="{{route('home')}}" class="nav-link">
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
        <li class="nav-item">
          <a href="{{route('kkm.index')}}" class="nav-link">
            <i class="nav-icon fas fa-star"></i>
            <p>
              KKM
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('interval')}}" class="nav-link">
            <i class="nav-icon fas fa-greater-than-equal"></i>
            <p>
              Interval Nilai
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('tanggal-raport.index') }}" class="nav-link">
            <i class="nav-icon fas fa-calendar-week"></i>
            <p>
              Input Tanggal Raport
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('butir-sikap.index') }}" class="nav-link">
            <i class="nav-icon fas fa-clipboard"></i>
            <p>
              Butir-Butir Sikap
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('kd-mapel.index') }}" class="nav-link">
            <i class="nav-icon fas fa-clipboard-list"></i>
            <p>
              Data Kompetensi Dasar
            </p>
          </a>
        </li>
        <li class="nav-header">Rencana Penilaian</li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-list-ol"></i>
            <p>
              Kompetensi Dasar
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview bg-secondary">
            <li class="nav-item">
              <a href="{{route('rencana-k1.index')}}" class="nav-link">
                <i class="fas fa-check-circle nav-icon"></i>
                <p>KI-1</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('rencana-k2.index')}}" class="nav-link">
                <i class="fas fa-check-square nav-icon"></i>
                <p>KI-2</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('rencana-k3.index')}}" class="nav-link">
                <i class="fas fa-check-square nav-icon"></i>
                <p>KI-3</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('rencana-k4.index')}}" class="nav-link">
                <i class="fas fa-check-square nav-icon"></i>
                <p>KI-4</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="{{route('rencana-mulok.index')}}" class="nav-link">
            <i class="nav-icon fas fa-calendar-check"></i>
            <p>
              Mulok Khas PI
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-list-ol"></i>
            <p>
              Nilai PRIMA
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview bg-secondary">
            <li class="nav-item">
              <a href="{{route('rencana-proactive.index')}}" class="nav-link">
                <i class="fas fa-check-circle nav-icon"></i>
                <p>Proactive</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('rencana-responsible.index')}}" class="nav-link">
                <i class="fas fa-check-square nav-icon"></i>
                <p>Responsible</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('rencana-innovative.index')}}" class="nav-link">
                <i class="fas fa-check-circle nav-icon"></i>
                <p>Innovative</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('rencana-modest.index')}}" class="nav-link">
                <i class="fas fa-check-square nav-icon"></i>
                <p>Modest</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('rencana-achievement.index')}}" class="nav-link">
                <i class="fas fa-check-square nav-icon"></i>
                <p>Achievement</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-header">Penilaian</li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-list-ol"></i>
            <p>
              Kompetensi Dasar
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview bg-secondary">
            <li class="nav-item">
              <a href="{{route('penilaian-k1.index')}}" class="nav-link">
                <i class="fas fa-check-circle nav-icon"></i>
                <p>KI-1</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('penilaian-k2.index')}}" class="nav-link">
                <i class="fas fa-check-square nav-icon"></i>
                <p>KI-2</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('penilaian-k3.index')}}" class="nav-link">
                <i class="fas fa-check-circle nav-icon"></i>
                <p>KI-3</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('penilaian-k4.index')}}" class="nav-link">
                <i class="fas fa-check-square nav-icon"></i>
                <p>KI-4</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="{{route('penilaian-mulok.index')}}" class="nav-link">
            <i class="nav-icon fas fa-calendar-check"></i>
            <p>
              Mulok Khas PI
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-list-ol"></i>
            <p>
              Penilaian PRIMA
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview bg-secondary">
            <li class="nav-item">
              <a href="{{route('penilaian-proactive.index')}}" class="nav-link">
                <i class="fas fa-check-circle nav-icon"></i>
                <p>Proactive</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('penilaian-responsible.index')}}" class="nav-link">
                <i class="fas fa-check-square nav-icon"></i>
                <p>Responsible</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('penilaian-innovative.index')}}" class="nav-link">
                <i class="fas fa-check-circle nav-icon"></i>
                <p>Innovative</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('penilaian-modest.index')}}" class="nav-link">
                <i class="fas fa-check-square nav-icon"></i>
                <p>Modest</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('penilaian-achievement.index')}}" class="nav-link">
                <i class="fas fa-check-square nav-icon"></i>
                <p>Achievement</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-header">T2Q</li>
        <li class="nav-item">
          <a href="{{route('penilaian-sholat.index')}}" class="nav-link">
            <i class="nav-icon fas fa-calendar-check"></i>
            <p>
              Nil Pelajaran Sholat
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('penilaian-hafalan.index')}}" class="nav-link">
            <i class="nav-icon fas fa-calendar-check"></i>
            <p>
              Nil Hafalan
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('penilaian-t2q.index')}}" class="nav-link">
            <i class="nav-icon fas fa-calendar-check"></i>
            <p>
              Nil Pelajaran Sholat
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('catatan-t2q.index')}}" class="nav-link">
            <i class="nav-icon fas fa-calendar-check"></i>
            <p>
              Catatan T2Q
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('kehadiran.index')}}" class="nav-link">
            <i class="nav-icon fas fa-calendar-check"></i>
            <p>
              Rekap Kehadiran Siswa
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{route('catatan-umum.index')}}" class="nav-link">
            <i class="nav-icon fas fa-calendar-check"></i>
            <p>
              Catatan Umum
            </p>
          </a>
        </li>
        
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
            <p>
              Leger Nilai Siswa
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-print"></i>
            <p>
              Cetak Raport
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview bg-secondary">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-print nav-icon"></i>
                <p>Raport Semester</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
           document.getElementById('logout-form').submit();"><i class="nav-icon fas fa-sign-out-alt"></i>
            <p>
              Keluar / Logout
            </p></a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>