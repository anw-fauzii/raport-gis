<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title>{{$title}} | {{$anggota_kelas->siswa->nama_lengkap}} ({{$anggota_kelas->siswa->nis}})</title>
  <link href="./assets/invoice_raport.css" rel="stylesheet">
</head>

<body>
  <!-- Page 1 Sikap -->
  <div class="invoice-box">
    <div class="header">
      <table>
        <tr>
          <td style="width: 19%;">Nama Sekolah</td>
          <td style="width: 52%;">: {{$sekolah->nama_sekolah}}</td>
          <td style="width: 16%;">Kelas</td>
          <td style="width: 13%;">: {{$anggota_kelas->kelas->nama_kelas}}</td>
        </tr>
        <tr>
          <td style="width: 19%;">Alamat</td>
          <td style="width: 52%;">: {{$sekolah->alamat}}</td>
          <td style="width: 16%;">Semester</td>
          <td style="width: 13%;">:
            @if($anggota_kelas->kelas->tapel->semester == 1)
            1 (Ganjil)
            @else
            2 (Genap)
            @endif
          </td>
        </tr>
        <tr>
          <td style="width: 19%;">Nama Peserta Didik</td>
          <td style="width: 52%;">: {{$anggota_kelas->siswa->nama_lengkap}} </td>
          <td style="width: 16%;">Tahun Pelajaran</td>
          <td style="width: 13%;">: {{$anggota_kelas->kelas->tapel->tahun_pelajaran}}</td>
        </tr>
        <tr>
          <td style="width: 19%;">Nomor Induk/NISN</td>
          <td style="width: 52%;">: {{$anggota_kelas->siswa->nis}} / {{$anggota_kelas->siswa->nisn}} </td>
        </tr>
      </table>
    </div>

    <div class="content">
      <h3><strong>PENCAPAIAN KOMPETENSI PESERTA DIDIK</strong></h3>
      <table cellspacing="0">
        <tr>
          <td colspan="2"><strong>A. SIKAP</strong></td>
        </tr>

        <tr>
          <td colspan="2" style="height: 30px;"><strong>1. Sikap Spiritual</strong></td>
        </tr>
        <tr class="heading">
          <td style="width: 20%;">Predikat</td>
          <td>Deskripsi</td>
        </tr>
        <tr class="sikap">
          @if(!is_null($deskripsi_sikap))
          <td class="predikat">
            @if($deskripsi_sikap->nilai_spiritual == 4)
            <b>Sangat Baik</b>
            @elseif($deskripsi_sikap->nilai_spiritual == 3)
            <b>Baik</b>
            @elseif($deskripsi_sikap->nilai_spiritual == 2)
            <b>Cukup</b>
            @elseif($deskripsi_sikap->nilai_spiritual == 1)
            <b>Kurang</b>
            @endif
          </td>
          <td class="description">
            <span>{!! nl2br($deskripsi_sikap->deskripsi_spiritual) !!}</span>
          </td>
          @else
          <td></td>
          <td></td>
          @endif
        </tr>

        <tr>
          <td colspan="2" style="height: 30px;"><strong>2. Sikap Sosial</strong></td>
        </tr>
        <tr class="heading">
          <td style="width: 20%;">Predikat</td>
          <td>Deskripsi</td>
        </tr>
        <tr class="sikap">
          @if(!is_null($deskripsi_sikap))
          <td class="predikat">
            @if($deskripsi_sikap->nilai_sosial == 4)
            <b>Sangat Baik</b>
            @elseif($deskripsi_sikap->nilai_sosial == 3)
            <b>Baik</b>
            @elseif($deskripsi_sikap->nilai_sosial == 2)
            <b>Cukup</b>
            @elseif($deskripsi_sikap->nilai_sosial == 1)
            <b>Kurang</b>
            @endif
          </td>
          <td class="description">
            <span>{!! nl2br($deskripsi_sikap->deskripsi_sosial) !!}</span>
          </td>
          @else
          <td></td>
          <td></td>
          @endif
        </tr>
      </table>
    </div>

    <div style="padding-left:60%; padding-top:1rem; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;">
      {{$anggota_kelas->kelas->tapel->k13_tgl_raport->tempat_penerbitan}}, {{$anggota_kelas->kelas->tapel->k13_tgl_raport->tanggal_pembagian->isoFormat('D MMMM Y')}}<br>
      Wali Kelas, <br><br><br><br>
      <b><u>{{$anggota_kelas->kelas->guru->nama_lengkap}}, {{$anggota_kelas->kelas->guru->gelar}}</u></b><br>
      NIP. {{konversi_nip($anggota_kelas->kelas->guru->nip)}}
    </div>
    <div class="footer">
      <i>{{$anggota_kelas->kelas->nama_kelas}} | {{$anggota_kelas->siswa->nama_lengkap}} | {{$anggota_kelas->siswa->nis}}</i> <b style="float: right;"><i>Halaman 1</i></b>
    </div>
  </div>
  <div class="page-break"></div>

  <!-- Page 2 Pengetahuan  -->
  <div class="invoice-box">
    <div class="header">
      <table>
        <tr>
          <td style="width: 19%;">Nama Sekolah</td>
          <td style="width: 52%;">: {{$sekolah->nama_sekolah}}</td>
          <td style="width: 16%;">Kelas</td>
          <td style="width: 13%;">: {{$anggota_kelas->kelas->nama_kelas}}</td>
        </tr>
        <tr>
          <td style="width: 19%;">Alamat</td>
          <td style="width: 52%;">: {{$sekolah->alamat}}</td>
          <td style="width: 16%;">Semester</td>
          <td style="width: 13%;">:
            @if($anggota_kelas->kelas->tapel->semester == 1)
            1 (Ganjil)
            @else
            2 (Genap)
            @endif
          </td>
        </tr>
        <tr>
          <td style="width: 19%;">Nama Peserta Didik</td>
          <td style="width: 52%;">: {{$anggota_kelas->siswa->nama_lengkap}} </td>
          <td style="width: 16%;">Tahun Pelajaran</td>
          <td style="width: 13%;">: {{$anggota_kelas->kelas->tapel->tahun_pelajaran}}</td>
        </tr>
        <tr>
          <td style="width: 19%;">Nomor Induk/NISN</td>
          <td style="width: 52%;">: {{$anggota_kelas->siswa->nis}} / {{$anggota_kelas->siswa->nisn}} </td>
        </tr>
      </table>
    </div>

    <div class="content">
      <table cellspacing="0">
        <tr>
          <td colspan="6" style="height: 30px;"><strong>B. PENGETAHUAN DAN KETERAMPILAN</strong></td>
        </tr>
        <tr class="heading">
          <td rowspan="2" style="width: 5%;">NO</td>
          <td rowspan="2" style="width: 23%;">Mata Pelajaran</td>
          <td rowspan="2" style="width: 7%;">KKM</td>
          <td colspan="3">Pengetahuan</td>
        </tr>
        <tr class="heading">
          <td style="width: 6%;">Nilai</td>
          <td style="width: 7%;">Predikat</td>
          <td>Deskripsi</td>
        </tr>
        <!-- Nilai A  -->
        <tr class="nilai">
          <td colspan="6"><strong>Kelompok A</strong></td>
        </tr>

        <?php $no = 0; ?>
        @foreach($data_nilai_kelompok_a->sortBy('pembelajaran.mapel.k13_mapping_mapel.nomor_urut') as $nilai_kelompok_a)
        <?php $no++; ?>
        <tr class="nilai">
          <td class="center">{{$no}}</td>
          <td>{{$nilai_kelompok_a->pembelajaran->mapel->nama_mapel}}</td>
          <td class="center">{{$nilai_kelompok_a->kkm}}</td>
          <td class="center">{{$nilai_kelompok_a->nilai_pengetahuan}}</td>
          <td class="center">{{$nilai_kelompok_a->predikat_pengetahuan}}</td>
          <td class="description">
            <span>{!! nl2br($nilai_kelompok_a->k13_deskripsi_nilai_siswa->deskripsi_pengetahuan) !!}</span>
          </td>
        </tr>
        @endforeach

        <!-- Nilai B  -->
        <tr class="nilai">
          <td colspan="6"><strong>Kelompok B</strong></td>
        </tr>
        <?php $no = 0; ?>
        @foreach($data_nilai_kelompok_b->sortBy('pembelajaran.mapel.k13_mapping_mapel.nomor_urut') as $nilai_kelompok_b)
        <?php $no++; ?>
        <tr class="nilai">
          <td class="center">{{$no}}</td>
          <td>{{$nilai_kelompok_b->pembelajaran->mapel->nama_mapel}}</td>
          <td class="center">{{$nilai_kelompok_b->kkm}}</td>
          <td class="center">{{$nilai_kelompok_b->nilai_pengetahuan}}</td>
          <td class="center">{{$nilai_kelompok_b->predikat_pengetahuan}}</td>
          <td class="description">
            <span>{!! nl2br($nilai_kelompok_b->k13_deskripsi_nilai_siswa->deskripsi_pengetahuan) !!}</span>
          </td>
        </tr>
        @endforeach

      </table>
    </div>

    <div style="padding-left:60%; padding-top:1rem; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;">
      {{$anggota_kelas->kelas->tapel->k13_tgl_raport->tempat_penerbitan}}, {{$anggota_kelas->kelas->tapel->k13_tgl_raport->tanggal_pembagian->isoFormat('D MMMM Y')}}<br>
      Wali Kelas, <br><br><br><br>
      <b><u>{{$anggota_kelas->kelas->guru->nama_lengkap}}, {{$anggota_kelas->kelas->guru->gelar}}</u></b><br>
      NIP. {{konversi_nip($anggota_kelas->kelas->guru->nip)}}
    </div>
    <div class="footer">
      <i>{{$anggota_kelas->kelas->nama_kelas}} | {{$anggota_kelas->siswa->nama_lengkap}} | {{$anggota_kelas->siswa->nis}}</i> <b style="float: right;"><i>Halaman 2</i></b>
    </div>
  </div>
  <div class="page-break"></div>

  <!-- Page 3 Keterampilan -->
  <div class="invoice-box">
    <div class="header">
      <table>
        <tr>
          <td style="width: 19%;">Nama Sekolah</td>
          <td style="width: 52%;">: {{$sekolah->nama_sekolah}}</td>
          <td style="width: 16%;">Kelas</td>
          <td style="width: 13%;">: {{$anggota_kelas->kelas->nama_kelas}}</td>
        </tr>
        <tr>
          <td style="width: 19%;">Alamat</td>
          <td style="width: 52%;">: {{$sekolah->alamat}}</td>
          <td style="width: 16%;">Semester</td>
          <td style="width: 13%;">:
            @if($anggota_kelas->kelas->tapel->semester == 1)
            1 (Ganjil)
            @else
            2 (Genap)
            @endif
          </td>
        </tr>
        <tr>
          <td style="width: 19%;">Nama Peserta Didik</td>
          <td style="width: 52%;">: {{$anggota_kelas->siswa->nama_lengkap}} </td>
          <td style="width: 16%;">Tahun Pelajaran</td>
          <td style="width: 13%;">: {{$anggota_kelas->kelas->tapel->tahun_pelajaran}}</td>
        </tr>
        <tr>
          <td style="width: 19%;">Nomor Induk/NISN</td>
          <td style="width: 52%;">: {{$anggota_kelas->siswa->nis}} / {{$anggota_kelas->siswa->nisn}} </td>
        </tr>
      </table>
    </div>

    <div class="content">
      <table cellspacing="0" style="padding-top: 10px;">
        <tr class="heading">
          <td rowspan="2" style="width: 5%;">NO</td>
          <td rowspan="2" style="width: 23%;">Mata Pelajaran</td>
          <td rowspan="2" style="width: 7%;">KKM</td>
          <td colspan="3">Keterampilan</td>
        </tr>
        <tr class="heading">
          <td style="width: 6%;">Nilai</td>
          <td style="width: 7%;">Predikat</td>
          <td>Deskripsi</td>
        </tr>
        <!-- Nilai A  -->
        <tr class="nilai">
          <td colspan="6"><strong>Kelompok A</strong></td>
        </tr>

        <?php $no = 0; ?>
        @foreach($data_nilai_kelompok_a->sortBy('pembelajaran.mapel.k13_mapping_mapel.nomor_urut') as $nilai_kelompok_a)
        <?php $no++; ?>
        <tr class="nilai">
          <td class="center">{{$no}}</td>
          <td>{{$nilai_kelompok_a->pembelajaran->mapel->nama_mapel}}</td>
          <td class="center">{{$nilai_kelompok_a->kkm}}</td>
          <td class="center">{{$nilai_kelompok_a->nilai_keterampilan}}</td>
          <td class="center">{{$nilai_kelompok_a->predikat_keterampilan}}</td>
          <td class="description">
            <span>{!! nl2br($nilai_kelompok_a->k13_deskripsi_nilai_siswa->deskripsi_keterampilan) !!}</span>
          </td>
        </tr>
        @endforeach

        <!-- Nilai B  -->
        <tr class="nilai">
          <td colspan="6"><strong>Kelompok B</strong></td>
        </tr>
        <?php $no = 0; ?>
        @foreach($data_nilai_kelompok_b->sortBy('pembelajaran.mapel.k13_mapping_mapel.nomor_urut') as $nilai_kelompok_b)
        <?php $no++; ?>
        <tr class="nilai">
          <td class="center">{{$no}}</td>
          <td>{{$nilai_kelompok_b->pembelajaran->mapel->nama_mapel}}</td>
          <td class="center">{{$nilai_kelompok_b->kkm}}</td>
          <td class="center">{{$nilai_kelompok_b->nilai_keterampilan}}</td>
          <td class="center">{{$nilai_kelompok_b->predikat_keterampilan}}</td>
          <td class="description">
            <span>{!! nl2br($nilai_kelompok_b->k13_deskripsi_nilai_siswa->deskripsi_keterampilan) !!}</span>
          </td>
        </tr>
        @endforeach

      </table>
    </div>

    <div style="padding-left:60%; padding-top:1rem; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;">
      {{$anggota_kelas->kelas->tapel->k13_tgl_raport->tempat_penerbitan}}, {{$anggota_kelas->kelas->tapel->k13_tgl_raport->tanggal_pembagian->isoFormat('D MMMM Y')}}<br>
      Wali Kelas, <br><br><br><br>
      <b><u>{{$anggota_kelas->kelas->guru->nama_lengkap}}, {{$anggota_kelas->kelas->guru->gelar}}</u></b><br>
      NIP. {{konversi_nip($anggota_kelas->kelas->guru->nip)}}
    </div>
    <div class="footer">
      <i>{{$anggota_kelas->kelas->nama_kelas}} | {{$anggota_kelas->siswa->nama_lengkap}} | {{$anggota_kelas->siswa->nis}}</i> <b style="float: right;"><i>Halaman 3</i></b>
    </div>
  </div>
  <div class="page-break"></div>

  <!-- Page 4 (Other) -->
  <div class="invoice-box">
    <div class="header">
      <table>
        <tr>
          <td style="width: 19%;">Nama Sekolah</td>
          <td style="width: 52%;">: {{$sekolah->nama_sekolah}}</td>
          <td style="width: 16%;">Kelas</td>
          <td style="width: 13%;">: {{$anggota_kelas->kelas->nama_kelas}}</td>
        </tr>
        <tr>
          <td style="width: 19%;">Alamat</td>
          <td style="width: 52%;">: {{$sekolah->alamat}}</td>
          <td style="width: 16%;">Semester</td>
          <td style="width: 13%;">:
            @if($anggota_kelas->kelas->tapel->semester == 1)
            1 (Ganjil)
            @else
            2 (Genap)
            @endif
          </td>
        </tr>
        <tr>
          <td style="width: 19%;">Nama Peserta Didik</td>
          <td style="width: 52%;">: {{$anggota_kelas->siswa->nama_lengkap}} </td>
          <td style="width: 16%;">Tahun Pelajaran</td>
          <td style="width: 13%;">: {{$anggota_kelas->kelas->tapel->tahun_pelajaran}}</td>
        </tr>
        <tr>
          <td style="width: 19%;">Nomor Induk/NISN</td>
          <td style="width: 52%;">: {{$anggota_kelas->siswa->nis}} / {{$anggota_kelas->siswa->nisn}} </td>
        </tr>
      </table>
    </div>

    <div class="content">
      <table cellspacing="0">

        <!-- EkstraKulikuler  -->
        <tr>
          <td colspan="4" style="height: 25px;"><strong>C. EKSTRAKULIKULER</strong></td>
        </tr>
        <tr class="heading">
          <td style="width: 5%;">NO</td>
          <td style="width: 28%;">Kegiatan Ekstrakulikuler</td>
          <td style="width: 15%;">Predikat</td>
          <td>Keterangan</td>
        </tr>

        @if(count($data_anggota_ekstrakulikuler) == 0)
        <tr class="nilai">
          <td class="center">1</td>
          <td></td>
          <td class="center"></td>
          <td class="description">
            <span></span>
          </td>
        </tr>
        <tr class="nilai">
          <td class="center">2</td>
          <td></td>
          <td class="center"></td>
          <td class="description">
            <span></span>
          </td>
        </tr>
        @elseif(count($data_anggota_ekstrakulikuler) == 1)
        <?php $no = 0; ?>
        @foreach($data_anggota_ekstrakulikuler as $nilai_ekstra)
        <?php $no++; ?>
        <tr class="nilai">
          <td class="center">{{$no}}</td>
          <td>{{$nilai_ekstra->ekstrakulikuler->nama_ekstrakulikuler}}</td>
          <td class="center">
            @if($nilai_ekstra->nilai == 4)
            Sangat Baik
            @elseif($nilai_ekstra->nilai == 3)
            Baik
            @elseif($nilai_ekstra->nilai == 2)
            Cukup
            @elseif($nilai_ekstra->nilai == 1)
            Kurang
            @endif
          </td>
          <td class="description">
            <span>{!! nl2br($nilai_ekstra->deskripsi) !!}</span>
          </td>
        </tr>
        @endforeach
        <tr class="nilai">
          <td class="center">2</td>
          <td></td>
          <td class="center"></td>
          <td class="description">
            <span></span>
          </td>
        </tr>
        @else
        <?php $no = 0; ?>
        @foreach($data_anggota_ekstrakulikuler as $nilai_ekstra)
        <?php $no++; ?>
        <tr class="nilai">
          <td class="center">{{$no}}</td>
          <td>{{$nilai_ekstra->ekstrakulikuler->nama_ekstrakulikuler}}</td>
          <td class="center">
            @if($nilai_ekstra->nilai == 4)
            Sangat Baik
            @elseif($nilai_ekstra->nilai == 3)
            Baik
            @elseif($nilai_ekstra->nilai == 2)
            Cukup
            @elseif($nilai_ekstra->nilai == 1)
            Kurang
            @endif
          </td>
          <td class="description">
            <span>{!! nl2br($nilai_ekstra->deskripsi) !!}</span>
          </td>
        </tr>
        @endforeach
        @endif
        <!-- End Ekstrakulikuler  -->

        <!-- Prestasi -->
        <tr>
          <td colspan="4" style="height: 25px; padding-top: 5px"><strong>D. PRESTASI</strong></td>
        </tr>
        <tr class="heading">
          <td style="width: 5%;">NO</td>
          <td style="width: 28%;">Jenis Prestasi</td>
          <td colspan="2">Keterangan</td>
        </tr>
        @if(count($data_prestasi_siswa) == 0)
        <tr class="nilai">
          <td class="center">1</td>
          <td></td>
          <td colspan="2" class="description">
            <span></span>
          </td>
        </tr>
        <tr class="nilai">
          <td class="center">2</td>
          <td></td>
          <td colspan="2" class="description">
            <span></span>
          </td>
        </tr>
        @elseif(count($data_prestasi_siswa) == 1)
        <?php $no = 0; ?>
        @foreach($data_prestasi_siswa as $prestasi)
        <?php $no++; ?>
        <tr class="nilai">
          <td class="center">{{$no}}</td>
          <td>
            @if($prestasi->jenis_prestasi == 1)
            Akademik
            @elseif($prestasi->jenis_prestasi == 2)
            Non Akademik
            @endif
          </td>
          <td colspan="2" class="description">
            <span>{!! nl2br($prestasi->deskripsi) !!}</span>
          </td>
        </tr>
        @endforeach
        <tr class="nilai">
          <td class="center">2</td>
          <td></td>
          <td colspan="2" class="description">
            <span></span>
          </td>
        </tr>
        @else
        <?php $no = 0; ?>
        @foreach($data_prestasi_siswa as $prestasi)
        <?php $no++; ?>
        <tr class="nilai">
          <td class="center">{{$no}}</td>
          <td>
            @if($prestasi->jenis_prestasi == 1)
            Akademik
            @elseif($prestasi->jenis_prestasi == 2)
            Non Akademik
            @endif
          </td>
          <td colspan="2" class="description">
            <span>{!! nl2br($prestasi->deskripsi) !!}</span>
          </td>
        </tr>
        @endforeach
        @endif
        <!-- End Prestasi -->

        <!-- Ketidakhadiran  -->
        <tr>
          <td colspan="4" style="height: 25px; padding-top: 5px"><strong>E. KETIDAKHADIRAN</strong></td>
        </tr>
        @if(!is_null($kehadiran_siswa))
        <tr class="nilai">
          <td colspan="2" style="border-right:0 ;">Sakit</td>
          <td style="border-left:0 ;">: {{$kehadiran_siswa->sakit}} hari</td>
          <td class="false"></td>
        </tr>
        <tr class="nilai">
          <td colspan="2" style="border-right:0 ;">Izin</td>
          <td style="border-left:0 ;">: {{$kehadiran_siswa->izin}} hari</td>
          <td class="false"></td>
        </tr>
        <tr class="nilai">
          <td colspan="2" style="border-right:0 ;">Tanpa Keterangan</td>
          <td style="border-left:0 ;">: {{$kehadiran_siswa->tanpa_keterangan}} hari</td>
          <td class="false"></td>
        </tr>
        @else
        <tr class="nilai">
          <td colspan="4"><b>Data kehadiran belum diinput</b></td>
        </tr>
        @endif
        <!-- End Ketidakhadiran  -->

        <!-- Catatan Wali Kelas -->
        <tr>
          <td colspan="4" style="height: 25px; padding-top: 5px"><strong>F. CATATAN WALI KELAS</strong></td>
        </tr>
        <tr class="sikap">
          <td colspan="4" class="description" style="height: 50px;">
            @if(!is_null($catatan_wali_kelas))
            <i><b>{{$catatan_wali_kelas->catatan}}</b></i>
            @endif
          </td>
        </tr>
        <!-- End Catatan Wali Kelas -->

        <!-- Tanggapan ORANG TUA/WALI -->
        <tr>
          <td colspan="4" style="height: 25px; padding-top: 5px"><strong>G. TANGGAPAN ORANG TUA/WALI</strong></td>
        </tr>
        <tr class="sikap">
          <td colspan="4" class="description" style="height: 45px;">
          </td>
        </tr>
        <!-- End Tanggapan ORANG TUA/WALI -->

        <!-- Keputusan -->
        @if($anggota_kelas->kelas->tapel->semester == 2)
        <tr>
          <td colspan="4" style="height: 25px; padding-top: 5px"><strong>H. KEPUTUSAN</strong></td>
        </tr>
        <tr class="sikap">
          <td colspan="4" class="description" style="height: 45px;">
            Berdasarkan hasil yang dicapai pada semester 1 dan 2, Peserta didik ditetapkan : <br>
            @if(!is_null($anggota_kelas->kenaikan_kelas))
            <b>
              @if($anggota_kelas->kenaikan_kelas->keputusan == 1)
              NAIK KE KELAS : {{$anggota_kelas->kenaikan_kelas->kelas_tujuan}}
              @elseif($anggota_kelas->kenaikan_kelas->keputusan == 2)
              TINGGAL DI KELAS : {{$anggota_kelas->kenaikan_kelas->kelas_tujuan}}
              @elseif($anggota_kelas->kenaikan_kelas->keputusan == 3)
              LULUS
              @elseif($anggota_kelas->kenaikan_kelas->keputusan == 4)
              TIDAK LULUS
              @endif
            </b>
            @endif
          </td>
        </tr>
        @endif
        <!-- End Keputusan -->

      </table>
    </div>

    <div style="padding-top:1rem; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;">
      <table>
        <tr>
          <td style="width: 30%;">
            Mengetahui <br>
            Orang Tua/Wali, <br><br><br><br>
            .............................
          </td>
          <td style="width: 35%;"></td>
          <td style="width: 35%;">
            {{$anggota_kelas->kelas->tapel->k13_tgl_raport->tempat_penerbitan}}, {{$anggota_kelas->kelas->tapel->k13_tgl_raport->tanggal_pembagian->isoFormat('D MMMM Y')}}<br>
            Wali Kelas, <br><br><br><br>
            <b><u>{{$anggota_kelas->kelas->guru->nama_lengkap}}, {{$anggota_kelas->kelas->guru->gelar}}</u></b><br>
            NIP. {{konversi_nip($anggota_kelas->kelas->guru->nip)}}
          </td>
        </tr>
        <tr>
          <td style="width: 30%;"></td>
          <td style="width: 35%;">
            Mengetahui <br>
            Kepala Sekolah, <br><br><br><br>
            <b><u>{{$sekolah->kepala_sekolah}}</u></b><br>
            NIP. {{konversi_nip($sekolah->nip_kepala_sekolah)}}
          </td>
          <td style="width: 35%;"></td>
        </tr>
      </table>
    </div>
    <div class="footer">
      <i>{{$anggota_kelas->kelas->nama_kelas}} | {{$anggota_kelas->siswa->nama_lengkap}} | {{$anggota_kelas->siswa->nis}}</i> <b style="float: right;"><i>Halaman 4</i></b>
    </div>
  </div>
</body>

</html>


  <!-- Page 1 Sampul -->
  <div class="invoice-box">
    <div class="content">
      <div style="text-align: center; padding-bottom: 10px;">
        <img src="assets/images/logo/logo.png" alt="Logo" height="160px">
      </div>
      <h2><strong>RAPOR PESERTA DIDIK</strong></h2>
      <h2><strong>SEKOLAH DASAR</strong></h2>
      <h2><strong>(SD)</strong></h2>
    </div>
    <div style="text-align: center; padding-top: 100px;">
      <h3>NAMA PESERTA DIDIK</h3>
      <table>
        <tr>
          <td style="width: 15%;"></td>
          <td style="width: 70%; border: 1px solid #333; height: 35px; text-align: center; font-size: 18px;"><b>{{$anggota_kelas->siswa->nama_lengkap}}</b></td>
          <td style="width: 15%;"></td>
        </tr>
      </table>
    </div>
    <div style="text-align: center; padding-top: 25px;">
      <h3>NISN / NIS</h3>
      <table>
        <tr>
          <td style="width: 20%;"></td>
          <td style="width: 60%; border: 1px solid #333; height: 35px; text-align: center; font-size: 18px;"><b>{{$anggota_kelas->siswa->nisn}} / {{$anggota_kelas->siswa->nis}}</b></td>
          <td style="width: 20%;"></td>
        </tr>
      </table>
    </div>
    <div style="text-align: center; padding-top: 140px;">
      <h2><strong>KEMENTRIAN PENDIDIKAN DAN KEBUDAYAAN</strong></h2>
      <h2><strong>REPUBLIK INDONESIA</strong></h2>
    </div>
  </div>
  <div class="page-break"></div>

  <!-- Page 2 Identitas Sekolah -->
  <div class="invoice-box">
    <div style="text-align: center;">
      <h2><strong>RAPOR PESERTA DIDIK</strong></h2>
      <h2><strong>SEKOLAH DASAR</strong></h2>
      <h2><strong>(SD)</strong></h2>
    </div>
    <div style="padding-top: 15px;   font-size: 15px;">
      <table>
        <tr>
          <td style="width: 20%;">Nama Sekolah</td>
          <td style="width: 2%;">:</td>
          <td style="width: 78%;">SD GARUT ISLAMIC SCHOOL PRIMA INSANI</td>
        </tr>
        <tr style="line-height: 30px;">
          <td style="width: 20%;">NPSN</td>
          <td style="width: 2%;">:</td>
          <td style="width: 78%;">{{$sekolah->npsn}}</td>
        </tr>
        <tr style="line-height: 30px;">
          <td style="width: 20%;">Alamat</td>
          <td style="width: 2%;">:</td>
          <td style="width: 78%;">{{$sekolah->alamat}} RT/RW 001/014</td>
        </tr>
        <tr style="line-height: 30px;">
          <td style="width: 20%;">No Telepon</td>
          <td style="width: 2%;">:</td>
          <td style="width: 78%;">{{$sekolah->nomor_telpon}}</td>
        </tr>
        <tr style="line-height: 30px;">
          <td style="width: 20%;">Kode Pos</td>
          <td style="width: 2%;">:</td>
          <td style="width: 78%;">{{$sekolah->kode_pos}}</td>
        </tr>
        <tr style="line-height: 30px;">
          <td style="width: 20%;">Kelurahan / Desa</td>
          <td style="width: 2%;">:</td>
          <td style="width: 78%;">Kota Kulon</td>
        </tr>
        <tr style="line-height: 30px;">
          <td style="width: 20%;">Kecamatan</td>
          <td style="width: 2%;">:</td>
          <td style="width: 78%;">Garut Kota</td>
        </tr>
        <tr style="line-height: 30px;">
          <td style="width: 20%;">Kota / Kabupaten</td>
          <td style="width: 2%;">:</td>
          <td style="width: 78%;">Garut</td>
        </tr>
        <tr style="line-height: 30px;">
          <td style="width: 20%;">Provinsi</td>
          <td style="width: 2%;">:</td>
          <td style="width: 78%;">Jawa Barat</td>
        </tr>
        <tr style="line-height: 30px;">
          <td style="width: 20%;">Website</td>
          <td style="width: 2%;">:</td>
          <td style="width: 78%;">http://{{$sekolah->website}}</td>
        </tr>
        <tr style="line-height: 30px;">
          <td style="width: 20%;">Email</td>
          <td style="width: 2%;">:</td>
          <td style="width: 78%;">{{$sekolah->email}}</td>
        </tr>
      </table>
    </div>
  </div>
  <div class="page-break"></div>

  <!-- Page 3 Petunjuk penggunaan -->
  <div class="invoice-box">
    <div style="text-align: center;">
      <h2><strong>PETUNJUK PENGGUNAAN</strong></h2>
    </div>
    <div style="padding-top: 10px; font-size: 15px;">
      <table>
        <tr>
          <td style="width: 4%;vertical-align:top">1.</td>
          <td style="width: 96%;text-align: justify;text-justify: inter-word;">Rapor Peserta Didik dipergunakan selama peserta didik yang bersangkutan mengikuti seluruh program pembelajaran di Sekolah Dasar tersebut.</td>
        </tr>
        <tr>
          <td style="width: 4%;vertical-align:top">2.</td>
          <td style="width: 96%;text-align: justify;text-justify: inter-word;">Identitas Sekolah diisi dengan data yang sesuai dengan keberadaan Sekolah Dasar.</td>
        </tr>
        <tr>
          <td style="width: 4%;vertical-align:top">3.</td>
          <td style="width: 96%;text-align: justify;text-justify: inter-word;">Daftar Peserta didik diisi oleh data peserta didik yang ada dalam Rapor Peserta Didik ini.</td>
        </tr>
        <tr>
          <td style="width: 4%;vertical-align:top">4.</td>
          <td style="width: 96%;text-align: justify;text-justify: inter-word;">Identitas  Peserta  didik  diisi  oleh  data  yang  sesuai  dengan  keberadaan  peserta didik.</td>
        </tr>
        <tr>
          <td style="width: 4%;vertical-align:top">5.</td>
          <td style="width: 96%;text-align: justify;text-justify: inter-word;">Rapor  Peserta  Didik  harus  dilengkapi  dengan  pas  foto  berwarna  (3 x 4) dan pengisiannya dilakukan oleh Guru Kelas</td>
        </tr>
        <tr>
          <td style="width: 4%;vertical-align:top">6.</td>
          <td style="width: 96%;text-align: justify;text-justify: inter-word;"">Kompetensi inti 1 (KI-1) untuk sikap spiritual diambil dari KI-1 pada muatan pelajaran pendidikan agama dan budi pekerti dan PPKn.</td>
        </tr>
        <tr>
          <td style="width: 4%;vertical-align:top">7.</td>
          <td style="width: 96%;text-align: justify;text-justify: inter-word;"">Kompetensi inti 2 (KI-2) untuk sikap sosial diambil dari KI-2 pada muatan pelajaran Pendidikan Agama dan Budi Pekerti dan PPKn.</td>
        </tr>
        <tr>
          <td style="width: 4%;vertical-align:top">8.</td>
          <td style="width: 96%;text-align: justify;text-justify: inter-word;"">Kompetensi inti 3 dan 4 (KI-3 dan KI-4) diambil dari KI-3 dan KI-4 pada semua muatan pelajaran.</td>
        </tr>
        <tr>
          <td style="width: 4%;vertical-align:top">9.</td>
          <td style="width: 96%;text-align: justify;text-justify: inter-word;"">Hasil penilaian pengetahuan dan keterampilan dilaporkan dalam bentuk nilai, predikat dan deskripsi pencapaian kompetensi mata pelajaran.</td>
        </tr>
        <tr>
          <td style="width: 4%;vertical-align:top">10.</td>
          <td style="width: 96%;text-align: justify;text-justify: inter-word;"">Hasil penilaian sikap dilaporkan dalam bentuk predikat dan/atau deskripsi.</td>
        </tr>
        <tr>
          <td style="width: 4%;vertical-align:top">11.</td>
          <td style="width: 96%;text-align: justify;text-justify: inter-word;"">Predikat yang ditulis dalam Rapor Peserta Didik:<br/>				
      A : Sangat Baik<br/>							
      B : Baik<br/>								
      C : Cukup<br/>							
      D : Kurang
    </td>
        </tr>
        <tr>
          <td style="width: 4%;vertical-align:top">12.</td>
          <td style="width: 96%;text-align: justify;text-justify: inter-word;"">Deskripsi pengetahuan dan keterampilan ditulis dengan kalimat positif sesuai dengan capaian KD tertinggi atau terendah dari masing-masing muatan pelajaran yang diperoleh peserta didik. Deskripsi berisi pengetahuan dan keterampilan yang sangat baik/dan atau baik yang dikuasai dan penguasaannya belum optimal. Apabila nilai capaian KD muatan pelajaran yang diperoleh dari suatu muatan pelajaran sama, kolom deskripsi ditulis sesuai dengan capaian untuk semua KD.</td>
        </tr>
        <tr>
          <td style="width: 4%;vertical-align:top">13.</td>
          <td style="width: 96%;text-align: justify;text-justify: inter-word;">Laporan  Ekstrakurikuler  diisi  oleh  kegiatan  ekstrakurikuler  yang  diikuti  oleh peserta didik.</td>
        </tr>
        <tr>
          <td style="width: 4%;vertical-align:top">14.</td>
          <td style="width: 96%;text-align: justify;text-justify: inter-word;">Saran–saran diisi tentang hal-hal yang perlu mendapatkan perhatian peserta didik, pendidik, dan orangtua/wali terutama untuk hal-hal yang tidak didapatkan dari sekolah.</td>
        </tr>
        <tr>
          <td style="width: 4%;vertical-align:top">15.</td>
          <td style="width: 96%;text-align: justify;text-justify: inter-word;">Laporan tinggi dan berat badan peserta didik ditulis berdasarkan hasil pengukuran yang dilakukan pendidik.</td>
        </tr>
        <tr>
          <td style="width: 4%;vertical-align:top">16.</td>
          <td style="width: 96%;text-align: justify;text-justify: inter-word;">Laporan kondisi kesehatan fisik diisi dengan deskripsi hasil pemeriksaan yang dilakukan pendidik, bekerjasama dengan tenaga kesehatan atau puskesmas terdekat.</td>
        </tr>
        <tr>
          <td style="width: 4%;vertical-align:top">17.</td>
          <td style="width: 96%;text-align: justify;text-justify: inter-word;">Prestasi diisi dengan prestasi peserta didik yang menonjol.</td>
        </tr>
        <tr>
          <td style="width: 4%;vertical-align:top">18.</td>
          <td style="width: 96%;text-align: justify;text-justify: inter-word;">Kolom ketidakhadiran ditulis dengan data akumulasi ketidakhadiran peserta didik karena sakit, izin, atau tanpa keterangan selama satu semester.</td>
        </tr>
        <tr>
          <td style="width: 4%;vertical-align:top">19.</td>
          <td style="width: 96%;text-align: justify;text-justify: inter-word;">Apabila peserta didik pindah, maka dicatat di dalam kolom keterangan pindah.</td>
        </tr>
        <tr>
          <td style="width: 4%;vertical-align:top">20.</td>
          <td style="width: 96%;text-align: justify;text-justify: inter-word;">Kolom pernyataan kenaikan kelas diisi keterangan naik atau tinggal kelas.</td>
        </tr>
      </table>
    </div>
  </div>
  <div class="page-break"></div>

  <!-- Page 4 Identitas Peserta Didik -->
  <div class="invoice-box">
    <div style="text-align: center;">
      <h2><strong>IDENTITAS PESERTA DIDIK</strong></h2>
    </div>
    <div style="padding-top: 15px; font-size: 15px;">
      <table>
        <tr>
          <td style="width: 4%;">1</td>
          <td style="width: 25%;">Nama Peserta Didik</td>
          <td style="width: 2%;">:</td>
          <td>{{$anggota_kelas->siswa->nama_lengkap}}</td>
        </tr>
        <tr style="line-height: 15px;">
          <td style="width: 4%;">2</td>
          <td style="width: 25%;">Nomor Induk Siswa</td>
          <td style="width: 2%;">:</td>
          <td>{{$anggota_kelas->siswa->nis}}</td>
        </tr>
        <tr style="line-height: 15px;">
          <td style="width: 4%;">3</td>
          <td style="width: 25%;">N I S N</td>
          <td style="width: 2%;">:</td>
          <td>{{$anggota_kelas->siswa->nisn}}</td>
        </tr>
        <tr style="line-height: 15px;">
          <td style="width: 4%;">4</td>
          <td style="width: 25%;">Tempat, Tanggal Lahir</td>
          <td style="width: 2%;">:</td>
          <td>{{$anggota_kelas->siswa->tempat_lahir}}, {{$anggota_kelas->siswa->tanggal_lahir->isoFormat('D MMMM Y')}}</td>
        </tr>
        <tr style="line-height: 15px;">
          <td style="width: 4%;">5</td>
          <td style="width: 25%;">Jenis Kelamin</td>
          <td style="width: 2%;">:</td>
          <td>
            @if($anggota_kelas->siswa->jenis_kelamin == 'L')
            Laki-Laki
            @else
            Perempuan
            @endif
          </td>
        </tr>
        <tr style="line-height: 15px;">
          <td style="width: 4%;">6</td>
          <td style="width: 25%;">Agama</td>
          <td style="width: 2%;">:</td>
          <td>
            Islam
          </td>
        </tr>
        <tr style="line-height: 15px;">
          <td style="width: 4%;">7</td>
          <td style="width: 25%;">Pendidikan Sebelumnya</td>
          <td style="width: 2%;">:</td>
          <td>TK Islam Plus Prima Insani</td>
        </tr>
        <tr style="line-height: 15px;">
          <td style="width: 4%;">8</td>
          <td style="width: 25%;">Alamat Peserta Didik</td>
          <td style="width: 2%;">:</td>
          <td>{{$anggota_kelas->siswa->alamat}}</td>
        </tr>
        <tr style="line-height: 15px;">
          <td style="width: 4%;">9</td>
          <td style="width: 25%;">Nama Orang Tua</td>
          <td style="width: 2%;"></td>
          <td></td>
        </tr>
        <tr style="line-height: 15px;">
          <td style="width: 4%;"></td>
          <td style="width: 25%;">a. Ayah</td>
          <td style="width: 2%;">:</td>
          <td>{{$anggota_kelas->siswa->nama_ayah}}</td>
        </tr>
        <tr style="line-height: 15px;">
          <td style="width: 4%;"></td>
          <td style="width: 25%;">b. Ibu</td>
          <td style="width: 2%;">:</td>
          <td>{{$anggota_kelas->siswa->nama_ibu}}</td>
        </tr>
        <tr style="line-height: 15px;">
          <td style="width: 4%;">10</td>
          <td style="width: 25%;">Pendidikan Orang Tua</td>
          <td style="width: 2%;"></td>
          <td></td>
        </tr>
        <tr style="line-height: 15px;">
          <td style="width: 4%;"></td>
          <td style="width: 25%;">a. Ayah</td>
          <td style="width: 2%;">:</td>
          <td>{{$anggota_kelas->siswa->pendidikan_ayah}}</td>
        </tr>
        <tr style="line-height: 15px;">
          <td style="width: 4%;"></td>
          <td style="width: 25%;">b. Ibu</td>
          <td style="width: 2%;">:</td>
          <td>{{$anggota_kelas->siswa->pendidikan_ibu}}</td>
        </tr>
        <tr style="line-height: 15px;">
          <td style="width: 4%;">11</td>
          <td style="width: 25%;">Pekerjaan Orang Tua</td>
          <td style="width: 2%;"></td>
          <td></td>
        </tr>
        <tr style="line-height: 15px;">
          <td style="width: 4%;"></td>
          <td style="width: 25%;">a. Ayah</td>
          <td style="width: 2%;">:</td>
          <td>{{$anggota_kelas->siswa->pekerjaan_ayah}}</td>
        </tr>
        <tr style="line-height: 15px;">
          <td style="width: 4%;"></td>
          <td style="width: 25%;">b. Ibu</td>
          <td style="width: 2%;">:</td>
          <td>{{$anggota_kelas->siswa->pekerjaan_ibu}}</td>
        </tr>
        <tr style="line-height: 15px;">
          <td style="width: 4%;">12</td>
          <td style="width: 25%;">Alamat Orang Tua</td>
          <td style="width: 2%;"></td>
          <td></td>
        </tr>
        <tr style="line-height: 15px;">
          <td style="width: 4%;"></td>
          <td style="width: 25%;">a. Alamat</td>
          <td style="width: 2%;">:</td>
          <td>{{$anggota_kelas->siswa->alamat}}</td>
        </tr>
        <tr style="line-height: 15px;">
          <td style="width: 4%;"></td>
          <td style="width: 25%;">b. Kelurahan / Desa</td>
          <td style="width: 2%;">:</td>
          <td>{{$anggota_kelas->siswa->desa}}</td>
        </tr>
        <tr style="line-height: 15px;">
          <td style="width: 4%;"></td>
          <td style="width: 25%;">c. Kecamatan</td>
          <td style="width: 2%;">:</td>
          <td>{{$anggota_kelas->siswa->kecamatan}}</td>
        </tr>
        <tr style="line-height: 15px;">
          <td style="width: 4%;"></td>
          <td style="width: 25%;">d. Kabupaten / Kota</td>
          <td style="width: 2%;">:</td>
          <td>{{$anggota_kelas->siswa->kabupaten}}</td>
        </tr>
        <tr style="line-height: 15px;">
          <td style="width: 4%;"></td>
          <td style="width: 25%;">e. Provinsi</td>
          <td style="width: 2%;">:</td>
          <td>{{$anggota_kelas->siswa->provinsi}}</td>
        </tr>
        <tr style="line-height: 15px;">
          <td style="width: 4%;">13</td>
          <td style="width: 25%;">Wali Peserta Didik</td>
          <td style="width: 2%;"></td>
          <td></td>
        </tr>
        <tr style="line-height: 15px;">
          <td style="width: 4%;"></td>
          <td style="width: 25%;">a. Nama</td>
          <td style="width: 2%;">:</td>
          <td>{{$anggota_kelas->siswa->nama_wali}}</td>
        </tr>
        <tr style="line-height: 15px;">
          <td style="width: 4%;"></td>
          <td style="width: 25%;">b. Pekerjaan</td>
          <td style="width: 2%;">:</td>
          <td>{{$anggota_kelas->siswa->pekerjaan_wali}}</td>
        </tr>
        <tr style="line-height: 15px;">
          <td style="width: 4%;"></td>
          <td style="width: 25%;">c. Alamat</td>
          <td style="width: 2%;"></td>
          <td>{{$anggota_kelas->siswa->nama_wali}}</td>
        </tr>
      </table>
      <table style="padding-top: 30px;">
        <tr>
        <td style="width: 8%;"></td>
          <td style="width: 22%;">
            <div style="border: 1px solid #333; width: 25mm; height: 35mm; text-align: center; font-size: 12px;">
              <br><br><br>
              Foto Siswa <br>
              3x4
            </div>
          </td>
          <td style="width: 30%;"></td>
          <td style="width: 40%; font-size: 15px;">
            @if(!is_null($anggota_kelas->kelas->tapel->k13_tgl_raport))
            {{$anggota_kelas->kelas->tapel->k13_tgl_raport->tempat_penerbitan}},
            @endif
            {{$anggota_kelas->siswa->created_at->isoFormat('D MMMM Y')}}<br>
            Kepala Sekolah, <br><br><br><br>
            <b><u>{{$sekolah->kepala_sekolah}}</u></b><br>
            NRKS. {{$sekolah->nip_kepala_sekolah}}
          </td>
        </tr>
      </table>
    </div>
  </div>
  <div class="page-break"></div>
