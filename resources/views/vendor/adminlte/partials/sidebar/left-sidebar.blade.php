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
          <a href="{{route('home')}}" class="nav-link {{(request()->is('home')) ? 'active' :''}}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        @role('admin')
        <li class="nav-item">
          <a href="{{route('pengumuman.index')}}" class="nav-link {{(request()->is('pengumuman')) ? 'active' :''}}">
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
                <p>Guru</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('tahun-pelajaran.index')}}" class="nav-link">
                <i class="fas fa-calendar-week nav-icon"></i>
                <p>Tahun Pelajaran</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('mapel.index')}}" class="nav-link">
                <i class="fas fa-book nav-icon"></i>
                <p>Mata Pelajaran</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('kelas.index')}}" class="nav-link">
                <i class="fas fa-layer-group nav-icon"></i>
                <p>Kelas & Wali</p>
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
                <p>Peserta Didik</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('ekstrakulikuler.index')}}" class="nav-link">
                <i class="fas fa-users nav-icon"></i>
                <p>Ekstrakulikuler</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('pembelajaran.index')}}" class="nav-link">
                <i class="fas fa-calendar-check nav-icon"></i>
                <p>Pembelajaran</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="{{route('kkm.index')}}" class="nav-link  {{(request()->is('kkm')) ? 'active' :''}}">
            <i class="nav-icon fas fa-greater-than-equal"></i>
            <p>
              KKM
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('interval')}}" class="nav-link {{(request()->is('interval')) ? 'active' :''}}">
            <i class="nav-icon fas fa-columns"></i>
            <p>
              Interval Nilai
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('tanggal-raport.index') }}" class="nav-link  {{(request()->is('tanggal-raport')) ? 'active' :''}}">
            <i class="nav-icon fas fa-calendar-week"></i>
            <p>
              Input Tanggal Raport
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('butir-sikap.index') }}" class="nav-link {{(request()->is('butir-sikap')) ? 'active' :''}}">
            <i class="nav-icon fas fa-clipboard"></i>
            <p>
              Butir-Butir Sikap
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('kd-mapel.index') }}" class="nav-link {{(request()->is('kd-mapel*')) ? 'active' :''}}">
            <i class="nav-icon fas fa-clipboard-list"></i>
            <p>
              Kompetensi Dasar
            </p>
          </a>
        </li>
        @endrole
        @role('wali')
        <li class="nav-item">
          <a href="{{route('data-siswa-wali')}}" class="nav-link {{(request()->is('data-siswa','detail-siswa*')) ? 'active' :''}}">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Peserta Didik
            </p>
          </a>
        </li>
        @endrole
        @role('mapel')
        <li class="nav-header">Rencana Penilaian</li>
        <li class="nav-item has-treeview {{(request()->is('rencana-k1*','rencana-k2*','rencana-k3*','rencana-k4*','rencana-kokulikuler*')) ? 'menu-open' :''}}">
          <a href="#" class="nav-link {{(request()->is('rencana-k1*','rencana-k2*','rencana-k3*','rencana-k4*','rencana-kokulikuler*')) ? 'active' :''}}">
            <i class="nav-icon fas fa-list-ol"></i>
            <p>
              Kompetensi Dasar
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview bg-secondary">
          @role('wali')
            <li class="nav-item">
              <a href="{{route('rencana-k1.index')}}" class="nav-link {{(request()->is('rencana-k1*')) ? 'active' :''}}">
                <i class="fas fa-check-square nav-icon"></i>
                <p>KI-1</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('rencana-k2.index')}}" class="nav-link {{(request()->is('rencana-k2*')) ? 'active' :''}}">
                <i class="fas fa-check-square nav-icon"></i>
                <p>KI-2</p>
              </a>
            </li>
            @endrole
            <li class="nav-item">
              <a href="{{route('rencana-k3.index')}}" class="nav-link {{(request()->is('rencana-k3*')) ? 'active' :''}}">
                <i class="fas fa-check-square nav-icon"></i>
                <p>KI-3</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('rencana-k4.index')}}" class="nav-link {{(request()->is('rencana-k4*')) ? 'active' :''}}">
                <i class="fas fa-check-square nav-icon"></i>
                <p>KI-4</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('rencana-kokulikuler.index')}}" class="nav-link {{(request()->is('rencana-kokulikuler*')) ? 'active' :''}}">
                <i class="fas fa-check-square nav-icon"></i>
                <p>Kokulikuler</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="{{route('rencana-mulok.index')}}" class="nav-link {{(request()->is('rencana-mulok')) ? 'active' :''}}">
            <i class="nav-icon fas fa-globe"></i>
            <p>
              Mulok Khas PI
            </p>
          </a>
        </li>
        @role('wali')
        <li class="nav-item has-treeview {{(request()->is('rencana-proactive','rencana-innovative','rencana-responsible','rencana-modest','rencana-achievement')) ? 'menu-open' :''}}">
          <a href="#" class="nav-link {{(request()->is('rencana-proactive','rencana-innovative','rencana-responsible','rencana-modest','rencana-achievement')) ? 'active' :''}}">
            <i class="nav-icon fas fa-star"></i>
            <p>
              Nilai PRIMA
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview bg-secondary">
            <li class="nav-item">
              <a href="{{route('rencana-proactive.index')}}" class="nav-link {{(request()->is('rencana-proactive')) ? 'active' :''}}">
                <i class="fas fa-check-square nav-icon"></i>
                <p>Proactive</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('rencana-responsible.index')}}" class="nav-link {{(request()->is('rencana-responsible')) ? 'active' :''}}">
                <i class="fas fa-check-square nav-icon"></i>
                <p>Responsible</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('rencana-innovative.index')}}" class="nav-link {{(request()->is('rencana-innovative')) ? 'active' :''}}">
                <i class="fas fa-check-square nav-icon"></i>
                <p>Innovative</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('rencana-modest.index')}}" class="nav-link {{(request()->is('rencana-modest')) ? 'active' :''}}">
                <i class="fas fa-check-square nav-icon"></i>
                <p>Modest</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('rencana-achievement.index')}}" class="nav-link {{(request()->is('rencana-achievement')) ? 'active' :''}}">
                <i class="fas fa-check-square nav-icon"></i>
                <p>Achievement</p>
              </a>
            </li>
          </ul>
        </li>
        @endrole
        <li class="nav-header">Penilaian</li>
        <li class="nav-item has-treeview {{(request()->is('penilaian-k1*','penilaian-k2*','penilaian-k3*','penilaian-k4*','penilaian-kokulikuler*')) ? 'menu-open' :''}}">
          <a href="#" class="nav-link {{(request()->is('penilaian-k1*','penilaian-k2*','penilaian-k3*','penilaian-k4*','penilaian-kokulikuler*')) ? 'active' :''}}">
            <i class="nav-icon fas fa-list-ol"></i>
            <p>
              Kompetensi Dasar
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview bg-secondary">
            @role('wali')
            <li class="nav-item">
              <a href="{{route('penilaian-k1.index')}}" class="nav-link {{(request()->is('penilaian-k1*')) ? 'active' :''}}">
                <i class="fas fa-check-square nav-icon"></i>
                <p>KI-1</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('penilaian-k2.index')}}" class="nav-link {{(request()->is('penilaian-k2*')) ? 'active' :''}}">
                <i class="fas fa-check-square nav-icon"></i>
                <p>KI-2</p>
              </a>
            </li>
            @endrole
            <li class="nav-item">
              <a href="{{route('penilaian-k3.index')}}" class="nav-link {{(request()->is('penilaian-k3*')) ? 'active' :''}}">
                <i class="fas fa-check-square nav-icon"></i>
                <p>KI-3</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('penilaian-k4.index')}}" class="nav-link {{(request()->is('penilaian-k4*')) ? 'active' :''}}">
                <i class="fas fa-check-square nav-icon"></i>
                <p>KI-4</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('penilaian-kokulikuler.index')}}" class="nav-link {{(request()->is('penilaian-kokulikuler*')) ? 'active' :''}}">
                <i class="fas fa-check-square nav-icon"></i>
                <p>Kokulikuler</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="{{route('penilaian-mulok.index')}}" class="nav-link {{(request()->is('penilaian-mulok')) ? 'active' :''}}">
            <i class="nav-icon fas fa-globe"></i>
            <p>
              Mulok Khas PI
            </p>
          </a>
        </li>
        @role('wali')
        <li class="nav-item has-treeview {{(request()->is('penilaian-proactive','penilaian-innovative','penilaian-responsible','penilaian-modest','penilaian-achievement')) ? 'menu-open' :''}}">
          <a href="#" class="nav-link {{(request()->is('penilaian-proactive','penilaian-innovative','penilaian-responsible','penilaian-modest','penilaian-achievement')) ? 'active' :''}}">
            <i class="nav-icon fas fa-star"></i>
            <p>
              Penilaian PRIMA
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview bg-secondary">
            <li class="nav-item">
              <a href="{{route('penilaian-proactive.index')}}" class="nav-link {{(request()->is('penilaian-proactive')) ? 'active' :''}}">
                <i class="fas fa-check-square nav-icon"></i>
                <p>Proactive</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('penilaian-responsible.index')}}" class="nav-link {{(request()->is('penilaian-responsible')) ? 'active' :''}}">
                <i class="fas fa-check-square nav-icon"></i>
                <p>Responsible</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('penilaian-innovative.index')}}" class="nav-link {{(request()->is('penilaian-innovative')) ? 'active' :''}}">
                <i class="fas fa-check-square nav-icon"></i>
                <p>Innovative</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('penilaian-modest.index')}}" class="nav-link {{(request()->is('penilaian-modest')) ? 'active' :''}}">
                <i class="fas fa-check-square nav-icon"></i>
                <p>Modest</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('penilaian-achievement.index')}}" class="nav-link {{(request()->is('penilaian-achievement')) ? 'active' :''}}">
                <i class="fas fa-check-square nav-icon"></i>
                <p>Achievement</p>
              </a>
            </li>
          </ul>
        </li>
        @endrole
        <li class="nav-item has-treeview {{(request()->is('penilaian-pramuka','penilaian-ekstrakulikuler')) ? 'menu-open' :''}}">
          <a href="#" class="nav-link {{(request()->is('penilaian-pramuka','penilaian-ekstrakulikuler')) ? 'active' :''}}">
            <i class="nav-icon fas fa-book-reader"></i>
            <p>
              Penilaian Ekstrakuler
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview bg-secondary">
          @role('wali')
            <li class="nav-item">
              <a href="{{route('penilaian-pramuka.index')}}" class="nav-link {{(request()->is('penilaian-pramuka')) ? 'active' :''}}">
                <i class="fas fa-check-square nav-icon"></i>
                <p>Pramuka</p>
              </a>
            </li>
          @endrole
            <li class="nav-item">
              <a href="{{route('penilaian-ekstrakulikuler.index')}}" class="nav-link {{(request()->is('penilaian-ekstrakulikuler')) ? 'active' :''}}">
                <i class="fas fa-check-square nav-icon"></i>
                <p>Pilihan</p>
              </a>
            </li>
          </ul>
        </li>
        
        @endrole
        @role('t2q')
        <li class="nav-item">
          <a href="{{route('penilaian-hafalan.index')}}" class="nav-link {{(request()->is('penilaian-hafalan*')) ? 'active' :''}}">
            <i class="nav-icon fas fa-brain"></i>
            <p>
              Hafalan
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('penilaian-sholat.index')}}" class="nav-link {{(request()->is('penilaian-sholat*')) ? 'active' :''}}">
            <i class="nav-icon fas fa-pray"></i>
            <p>
              Pelajaran Sholat
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('penilaian-tahsin.index')}}" class="nav-link {{(request()->is('penilaian-tahsin*')) ? 'active' :''}}">
            <i class="nav-icon fas fa-quran"></i>
            <p>
              Tahsin
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('penilaian-t2q.index')}}" class="nav-link {{(request()->is('penilaian-t2q*')) ? 'active' :''}}">
            <i class="nav-icon fas fa-quran"></i>
            <p>
              Tahfidz
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('catatan-t2q.index')}}" class="nav-link {{(request()->is('catatan-t2q*')) ? 'active' :''}}">
          <i class="nav-icon fas fa-comments"></i>
            <p>
              Catatan T2Q
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview {{(request()->is('penilaian-pramuka','penilaian-ekstrakulikuler')) ? 'menu-open' :''}}">
          <a href="#" class="nav-link {{(request()->is('penilaian-pramuka','penilaian-ekstrakulikuler')) ? 'active' :''}}">
            <i class="nav-icon fas fa-book-reader"></i>
            <p>
              Penilaian Ekstrakuler
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview bg-secondary">
            <li class="nav-item">
              <a href="{{route('penilaian-ekstrakulikuler.index')}}" class="nav-link {{(request()->is('penilaian-ekstrakulikuler')) ? 'active' :''}}">
                <i class="fas fa-check-square nav-icon"></i>
                <p>Pilihan</p>
              </a>
            </li>
          </ul>
        </li>
        @endrole
        @role('wali')
        <li class="nav-item">
          <a href="{{route('kehadiran.index')}}" class="nav-link {{(request()->is('kehadiran')) ? 'active' :''}}">
            <i class="nav-icon fas fa-calendar-check"></i>
            <p>
              Rekap Kehadiran Siswa
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('catatan-umum.index')}}" class="nav-link {{(request()->is('catatan-umum')) ? 'active' :''}}">
            <i class="nav-icon fas fa-sticky-note"></i>
            <p>
              Catatan Wali Kelas
            </p>
          </a>
        </li>   
        <li class="nav-item">
          <a href="{{route('leger')}}" class="nav-link {{(request()->is('leger-nilai')) ? 'active' :''}}"">
            <i class="nav-icon fas fa-table"></i>
            <p>
              Leger Nilai Siswa
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-print"></i>
            <p>
              Cetak Raport
            </p>
          </a>
        </li>
        
        @endrole
        
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