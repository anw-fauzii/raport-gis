<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title>{{$title}} | {{$anggota_kelas->siswa->nama_lengkap}} ({{$anggota_kelas->siswa->nis}})</title>
  <link href="./assets/invoice_raport.css" rel="stylesheet">
</head>
<style>
  body {
    margin-left: 16mm;
  }
  table {
    page-break-inside:avoid;
  }
</style>
<body>
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
          <td>Pendidikan {{$anggota_kelas->siswa->nama_ayah}}</td>
        </tr>
        <tr style="line-height: 15px;">
          <td style="width: 4%;"></td>
          <td style="width: 25%;">b. Ibu</td>
          <td style="width: 2%;">:</td>
          <td>Pendidikan {{$anggota_kelas->siswa->nama_ibu}}</td>
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
          <td>Alamat</td>
        </tr>
        <tr style="line-height: 15px;">
          <td style="width: 4%;"></td>
          <td style="width: 25%;">b. Kelurahan / Desa</td>
          <td style="width: 2%;">:</td>
          <td>Alamat</td>
        </tr>
        <tr style="line-height: 15px;">
          <td style="width: 4%;"></td>
          <td style="width: 25%;">c. Kecamatan</td>
          <td style="width: 2%;">:</td>
          <td>Alamat</td>
        </tr>
        <tr style="line-height: 15px;">
          <td style="width: 4%;"></td>
          <td style="width: 25%;">d. Kabupaten / Kota</td>
          <td style="width: 2%;">:</td>
          <td>Alamat</td>
        </tr>
        <tr style="line-height: 15px;">
          <td style="width: 4%;"></td>
          <td style="width: 25%;">a. Alamat</td>
          <td style="width: 2%;">:</td>
          <td>Alamat</td>
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
  <div class="invoice-box">
    <div class="header">
      <table>
        <tr>
          <td style="width: 23%;">Nama Peserta Didik</td>
          <td style="width: 40%;">: {{$anggota_kelas->siswa->nama_lengkap}} </td>
          <td style="width: 20%;">Kelas</td>
          <td style="width: 13%;">: {{$anggota_kelas->kelas->nama_kelas}}</td> 
        </tr>
        <tr style="line-height: 20px;">
          <td style="width: 23%;">Nomor Induk/NISN</td>
          <td style="width: 52%;">: {{$anggota_kelas->siswa->nis}} / {{$anggota_kelas->siswa->nisn}} </td>
          <td style="width: 20%;">Semester</td>
          <td style="width: 13%;">:
            @if($anggota_kelas->kelas->tapel->semester == 1)
            1 (Ganjil)
            @else
            2 (Genap)
            @endif
          </td>
        </tr>
        <tr style="line-height: 20px;">
          <td style="width: 23%;">Nama Sekolah</td>
          <td style="width: 40%;">: {{$sekolah->nama_sekolah}}</td>
          <td style="width: 20%;">Tahun Pelajaran</td>
          <td style="width: 13%;">: {{$anggota_kelas->kelas->tapel->tahun_pelajaran}}</td>
        </tr>
        <tr style="line-height: 20px;">
          <td style="width: 23%;">Alamat</td>
          <td colspan="4" style="width: 52%;">: Jl. Ciledug No 281</td>
        </tr>
      </table>
    </div>
    <div class="content">
      <h3><strong>PENCAPAIAN KOMPETENSI PESERTA DIDIK</strong></h3>
      <table cellspacing="0">
        <tr>
          <td colspan="4" style="height: 30px;"><strong>A. SIKAP SPIRITUAL (KI-1) DAN SIKAP SOSIAL (KI-2)</strong></td>
        </tr>
        <tr class="heading">
          <td style="width: 4%;">NO</td>
          <td style="width: 26%;">KOMPETENSI YANG DINILAI</td>
          <td style="width: 10%;">CAPAIAN</td>
          <td style="width: 60%;">DESKRIPSI</td>
        </tr>
        <tr class="sikap">
          <td>1</td>
          <td>
            Penilaian Sikap Spiritual (KI-1)
          </td>
          <td style="text-align:center;">SB</td>
          <td class="description">
            <span>Semua aspek spiritual sudah menjadi kebiasaan, terutama terbiasa menyebarkan dan menjawab salam; terbiasa berinfaq; dan terbiasa berdoa dan berdzikir setelah sholat. Perlu peningkatan  lebih lanjut dalam mengembangkan sikap terbiasa mengucapkan kalimat thoyyibah; mengenal dan berlatih shalat dhuha; dan terbiasa shalat dhuha.</span>
          </td>
        </tr>
        <tr class="sikap">
          <td>2</td>
          <td>
              Penilaian Sikap Sosial (KI-2)
          </td>
          <td style="text-align:center;">SB</td>
          <td class="description">
            <span>Semua aspek sikap sudah menjadi kebiasaan, terutama menunjukkan perilaku bersih dan rapi; menunjukkan perilaku sopan santun; menunjukkan perilaku jujur; dan menunjukkan perilaku birrul walidain. Perlu peningkatan  lebih lanjut dalam mengembangkan sikap menunjukkan perilaku disiplin, mandiri dan tanggung jawab; dan menunjukkan perilaku percaya diri.</span>
          </td>
        </tr>
      </table>
      <table cellspacing="0">
        <tr>
          <td colspan="4" style="height: 30px;"><strong>C. PENGETAHUAN KI-1</strong></td>
        </tr>
        <tr class="heading">
          <td style="width: 4%;">NO</td>
          <td style="width: 26%;">KOMPETENSI YANG DINILAI</td>
          <td style="width: 10%;">KKM</td>
          <td style="width: 10%;">CAPAIAN</td>
          <td style="width: 60%;">DESKRIPSI</td>
        </tr>
        @foreach($nilai_k3 as $nilai)
        <tr class="sikap">
          <td>1</td>
          <td>
            {{$nilai->pembelajaran->mapel->nama_mapel}}
          </td>
          <td style="text-align:center;">72</td>
          <td style="text-align:center;">{{$nilai->nilai_raport}}</td>
          <td class="description">
            <span>{{$nilai->deskripsi}}Semua aspek sikap sudah menjadi kebiasaan, terutama menunjukkan perilaku bersih dan rapi; menunjukkan perilaku sopan santun; menunjukkan perilaku jujur; dan menunjukkan perilaku birrul walidain. Perlu peningkatan  lebih lanjut dalam mengembangkan sikap menunjukkan perilaku disiplin, mandiri dan tanggung jawab; dan menunjukkan perilaku percaya diri.</span>
          </td>
        </tr>
        @endforeach
      </table>
      <table cellspacing="0">
        <tr>
          <td colspan="4" style="height: 30px;"><strong>D. KETERAMPILAN KI-2</strong></td>
        </tr>
        <tr class="heading">
          <td style="width: 4%;">NO</td>
          <td style="width: 26%;">KOMPETENSI YANG DINILAI</td>
          <td style="width: 10%;">CAPAIAN</td>
          <td style="width: 60%;">DESKRIPSI</td>
        </tr>
        <tr class="sikap">
          <td>1</td>
          <td>
            Bahasa Indonesia
          </td>
          <td style="text-align:center;">99</td>
          <td class="description">
            <span>Semua aspek sikap sudah menjadi kebiasaan, terutama menunjukkan perilaku bersih dan rapi; menunjukkan perilaku sopan santun; menunjukkan perilaku jujur; dan menunjukkan perilaku birrul walidain. Perlu peningkatan  lebih lanjut dalam mengembangkan sikap menunjukkan perilaku disiplin, mandiri dan tanggung jawab; dan menunjukkan perilaku percaya diri.</span>
          </td>
        </tr>
      </table>
      <table cellspacing="0">
        <tr>
          <td colspan="4" style="height: 30px;"><strong>E. KO KULIKULER DAN EKSTRAKULIKULER</strong></td>
        </tr>
        <tr class="heading">
          <td style="width: 4%;">NO</td>
          <td style="width: 26%;">KOMPETENSI YANG DINILAI</td>
          <td style="width: 10%;">CAPAIAN</td>
          <td style="width: 60%;">DESKRIPSI</td>
        </tr>
        <tr class="sikap">
          <td>1</td>
          <td>
            Bahasa Sunda
          </td>
          <td style="text-align:center;">99</td>
          <td class="description">
            <span>Semua aspek sikap sudah menjadi kebiasaan, terutama menunjukkan perilaku bersih dan rapi; menunjukkan perilaku sopan santun; menunjukkan perilaku jujur; dan menunjukkan perilaku birrul walidain. Perlu peningkatan  lebih lanjut dalam mengembangkan sikap menunjukkan perilaku disiplin, mandiri dan tanggung jawab; dan menunjukkan perilaku percaya diri.</span>
          </td>
        </tr>
        <tr class="sikap">
          <td>2</td>
          <td>
            Pramuka
          </td>
          <td style="text-align:center;">99</td>
          <td class="description">
            <span>Semua aspek sikap sudah menjadi kebiasaan, terutama menunjukkan perilaku bersih dan rapi; menunjukkan perilaku sopan santun; menunjukkan perilaku jujur; dan menunjukkan perilaku birrul walidain. Perlu peningkatan  lebih lanjut dalam mengembangkan sikap menunjukkan perilaku disiplin, mandiri dan tanggung jawab; dan menunjukkan perilaku percaya diri.</span>
          </td>
        </tr>
        <tr class="sikap">
          <td>3</td>
          <td>
            Futsal
          </td>
          <td style="text-align:center;">99</td>
          <td class="description">
            <span>Semua aspek sikap sudah menjadi kebiasaan, terutama menunjukkan perilaku bersih dan rapi; menunjukkan perilaku sopan santun; menunjukkan perilaku jujur; dan menunjukkan perilaku birrul walidain. Perlu peningkatan  lebih lanjut dalam mengembangkan sikap menunjukkan perilaku disiplin, mandiri dan tanggung jawab; dan menunjukkan perilaku percaya diri.</span>
          </td>
        </tr>
      </table>
      <table cellspacing="0">
        <tr>
          <td colspan="4" style="height: 30px;"><strong>F. MUATAN LOKAL KHAS PRIMA INSANI</strong></td>
        </tr>
        <tr class="heading">
          <td style="width: 4%;">NO</td>
          <td style="width: 26%;">KOMPETENSI YANG DINILAI</td>
          <td style="width: 10%;">CAPAIAN</td>
          <td style="width: 60%;">DESKRIPSI</td>
        </tr>
        <tr class="sikap">
          <td>1</td>
          <td>
            Handwritting
          </td>
          <td style="text-align:center;">-</td>
          <td class="description">
            <span>-</span>
          </td>
        </tr>
        <tr class="sikap">
          <td>2</td>
          <td>
            Jurnal
          </td>
          <td style="text-align:center;">-</td>
          <td>
            <span>-</span>
          </td>
        </tr>
        <tr class="sikap">
          <td>3</td>
          <td>
            Kitabah
          </td>
          <td style="text-align:center;">-</td>
          <td class="description">
            <span>-</span>
          </td>
        </tr>
      </table>
      <table cellspacing="0">
        <tr>
          <td colspan="4" style="height: 30px;"><strong>G. MUATAN LOKAL PAI KHAS PRIMA INSANI</strong></td>
        </tr>
        <tr>
          <td colspan="4" style="height: 30px;"><strong>1. PELAJARAN SHOLAT</strong></td>
        </tr>
        <tr class="heading">
          <td style="width: 4%;">NO</td>
          <td style="width: 26%;">KOMPETENSI YANG DINILAI</td>
          <td style="width: 10%;">CAPAIAN</td>
          <td style="width: 60%;">DESKRIPSI</td>
        </tr>
        <tr class="sikap">
          <td>1</td>
          <td>
            Praktek Wudhu
          </td>
          <td style="text-align:center;">99</td>
          <td class="description">
            <span>Semua aspek sikap sudah menjadi kebiasaan, terutama menunjukkan perilaku bersih dan rapi; menunjukkan perilaku sopan santun; menunjukkan perilaku jujur; dan menunjukkan perilaku birrul walidain. Perlu peningkatan  lebih lanjut dalam mengembangkan sikap menunjukkan perilaku disiplin, mandiri dan tanggung jawab; dan menunjukkan perilaku percaya diri.</span>
          </td>
        </tr>
        <tr class="sikap">
          <td>2</td>
          <td>
            Bacaan Sholat
          </td>
          <td style="text-align:center;">99</td>
          <td class="description">
            <span>Semua aspek sikap sudah menjadi kebiasaan, terutama menunjukkan perilaku bersih dan rapi; menunjukkan perilaku sopan santun; menunjukkan perilaku jujur; dan menunjukkan perilaku birrul walidain. Perlu peningkatan  lebih lanjut dalam mengembangkan sikap menunjukkan perilaku disiplin, mandiri dan tanggung jawab; dan menunjukkan perilaku percaya diri.</span>
          </td>
        </tr>
        <tr class="sikap">
          <td>3</td>
          <td>
            Gerakan Sholat
          </td>
          <td style="text-align:center;">99</td>
          <td class="description">
            <span>Semua aspek sikap sudah menjadi kebiasaan, terutama menunjukkan perilaku bersih dan rapi; menunjukkan perilaku sopan santun; menunjukkan perilaku jujur; dan menunjukkan perilaku birrul walidain. Perlu peningkatan  lebih lanjut dalam mengembangkan sikap menunjukkan perilaku disiplin, mandiri dan tanggung jawab; dan menunjukkan perilaku percaya diri.</span>
          </td>
        </tr>
        <tr class="sikap">
          <td>4</td>
          <td>
            Dzikir Bacaan Sholat
          </td>
          <td style="text-align:center;">99</td>
          <td class="description">
            <span>Semua aspek sikap sudah menjadi kebiasaan, terutama menunjukkan perilaku bersih dan rapi; menunjukkan perilaku sopan santun; menunjukkan perilaku jujur; dan menunjukkan perilaku birrul walidain. Perlu peningkatan  lebih lanjut dalam mengembangkan sikap menunjukkan perilaku disiplin, mandiri dan tanggung jawab; dan menunjukkan perilaku percaya diri.</span>
          </td>
        </tr>
      </table>
      <table cellspacing="0">
        <tr>
          <td colspan="4" style="height: 30px;"><strong>2. HAFALAN</strong></td>
        </tr>
        <tr class="heading">
          <td style="width: 4%;">NO</td>
          <td style="width: 26%;">KOMPETENSI YANG DINILAI</td>
          <td style="width: 10%;">CAPAIAN</td>
          <td style="width: 60%;">DESKRIPSI</td>
        </tr>
        <tr class="sikap">
          <td>1</td>
          <td>
            Hafalan Hadis
          </td>
          <td style="text-align:center;">99</td>
          <td class="description">
            <span>Semua aspek sikap sudah menjadi kebiasaan, terutama menunjukkan perilaku bersih dan rapi; menunjukkan perilaku sopan santun; menunjukkan perilaku jujur; dan menunjukkan perilaku birrul walidain. Perlu peningkatan  lebih lanjut dalam mengembangkan sikap menunjukkan perilaku disiplin, mandiri dan tanggung jawab; dan menunjukkan perilaku percaya diri.</span>
          </td>
        </tr>
        <tr class="sikap">
          <td>2</td>
          <td>
            Hafalan Dia
          </td>
          <td style="text-align:center;">99</td>
          <td class="description">
            <span>Semua aspek sikap sudah menjadi kebiasaan, terutama menunjukkan perilaku bersih dan rapi; menunjukkan perilaku sopan santun; menunjukkan perilaku jujur; dan menunjukkan perilaku birrul walidain. Perlu peningkatan  lebih lanjut dalam mengembangkan sikap menunjukkan perilaku disiplin, mandiri dan tanggung jawab; dan menunjukkan perilaku percaya diri.</span>
          </td>
        </tr>
        <tr class="sikap">
          <td>3</td>
          <td>
            Hafalan Kata - Kata Hikmah
          </td>
          <td style="text-align:center;">99</td>
          <td class="description">
            <span>Semua aspek sikap sudah menjadi kebiasaan, terutama menunjukkan perilaku bersih dan rapi; menunjukkan perilaku sopan santun; menunjukkan perilaku jujur; dan menunjukkan perilaku birrul walidain. Perlu peningkatan  lebih lanjut dalam mengembangkan sikap menunjukkan perilaku disiplin, mandiri dan tanggung jawab; dan menunjukkan perilaku percaya diri.</span>
          </td>
        </tr>
      </table>
      <table cellspacing="0">
        <tr>
          <td colspan="4" style="height: 30px;"><strong>3. TAHSIN DAN TAHFIDZ AL-QUR'AN</strong></td>
        </tr>
        <tr class="heading">
          <td style="width: 4%;">NO</td>
          <td style="width: 26%;">TAHSIN AL-QUR'AN</td>
          <td style="width: 10%;">CAPAIAN</td>
          <td style="width: 60%;">DESKRIPSI</td>
        </tr>
        <tr class="sikap">
          <td>1</td>
          <td>
            JILID 3 HALAMAN 14
          </td>
          <td style="text-align:center;">99</td>
          <td class="description">
            <span>Semua aspek sikap sudah menjadi kebiasaan, terutama menunjukkan perilaku bersih dan rapi; menunjukkan perilaku sopan santun; menunjukkan perilaku jujur; dan menunjukkan perilaku birrul walidain. Perlu peningkatan  lebih lanjut dalam mengembangkan sikap menunjukkan perilaku disiplin, mandiri dan tanggung jawab; dan menunjukkan perilaku percaya diri.</span>
          </td>
        </tr>
        <tr class="heading">
          <td style="width: 4%;">NO</td>
          <td style="width: 26%;">TAHFIDZ AL-QUR'AN</td>
          <td style="width: 10%;">CAPAIAN</td>
          <td style="width: 60%;">DESKRIPSI</td>
        </tr>
        <tr class="sikap">
          <td>1</td>
          <td>
            AL-'ADIYAT AYAT 6
          </td>
          <td style="text-align:center;">99</td>
          <td class="description">
            <span>Semua aspek sikap sudah menjadi kebiasaan, terutama menunjukkan perilaku bersih dan rapi; menunjukkan perilaku sopan santun; menunjukkan perilaku jujur; dan menunjukkan perilaku birrul walidain. Perlu peningkatan  lebih lanjut dalam mengembangkan sikap menunjukkan perilaku disiplin, mandiri dan tanggung jawab; dan menunjukkan perilaku percaya diri.</span>
          </td>
        </tr>
      </table>
      <table cellspacing="0">
        <tr>
          <td style="height: 30px;"><strong>CATATAN TAHSIN TAHFIDZ AL-QUR'AN</strong></td>
        </tr>
        <tr class="sikap">
          <td class="description">
            <span>Semua aspek sikap sudah menjadi kebiasaan, terutama menunjukkan perilaku bersih dan rapi; menunjukkan perilaku sopan santun; menunjukkan perilaku jujur; dan menunjukkan perilaku birrul walidain. Perlu peningkatan  lebih lanjut dalam mengembangkan sikap menunjukkan perilaku disiplin, mandiri dan tanggung jawab; dan menunjukkan perilaku percaya diri.</span>
          </td>
        </tr>
      </table>
      <table cellspacing="0">
        <tr>
          <td colspan="4" style="height: 30px;"><strong>H. BUDAYA NILAI PRIMA</strong></td>
        </tr>
        <thead>
          <tr class="heading">
            <td style="width: 4%;">NO</td>
            <td style="width: 26%;">BUDAYA</td>
            <td style="width: 10%;">CAPAIAN</td>
            <td style="width: 60%;">DESKRIPSI</td>
          </tr>
        </thead>
        <tbody>
        <tr class="sikap">
          <td>1</td>
          <td>
            Proactive
          </td>
          <td style="text-align:center;">S</td>
          <td class="description">
            <span>Semua aspek sikap sudah menjadi kebiasaan, terutama menunjukkan perilaku bersih dan rapi; menunjukkan perilaku sopan santun; menunjukkan perilaku jujur; dan menunjukkan perilaku birrul walidain. Perlu peningkatan  lebih lanjut dalam mengembangkan sikap menunjukkan perilaku disiplin, mandiri dan tanggung jawab; dan menunjukkan perilaku percaya diri.</span>
          </td>
        </tr>
        <tr class="sikap">
          <td>2</td>
          <td>
            Responsible
          </td>
          <td style="text-align:center;">S</td>
          <td class="description">
            <span>Semua aspek sikap sudah menjadi kebiasaan, terutama menunjukkan perilaku bersih dan rapi; menunjukkan perilaku sopan santun; menunjukkan perilaku jujur; dan menunjukkan perilaku birrul walidain. Perlu peningkatan  lebih lanjut dalam mengembangkan sikap menunjukkan perilaku disiplin, mandiri dan tanggung jawab; dan menunjukkan perilaku percaya diri.</span>
          </td>
        </tr>
        <tr class="sikap">
          <td>3</td>
          <td>
            Innovative
          </td>
          <td style="text-align:center;">S</td>
          <td class="description">
            <span>Semua aspek sikap sudah menjadi kebiasaan, terutama menunjukkan perilaku bersih dan rapi; menunjukkan perilaku sopan santun; menunjukkan perilaku jujur; dan menunjukkan perilaku birrul walidain. Perlu peningkatan  lebih lanjut dalam mengembangkan sikap menunjukkan perilaku disiplin, mandiri dan tanggung jawab; dan menunjukkan perilaku percaya diri.</span>
          </td>
        </tr>
        <tr class="sikap">
          <td>4</td>
          <td>
            Modest
          </td>
          <td style="text-align:center;">S</td>
          <td class="description">
            <span>Semua aspek sikap sudah menjadi kebiasaan, terutama menunjukkan perilaku bersih dan rapi; menunjukkan perilaku sopan santun; menunjukkan perilaku jujur; dan menunjukkan perilaku birrul walidain. Perlu peningkatan  lebih lanjut dalam mengembangkan sikap menunjukkan perilaku disiplin, mandiri dan tanggung jawab; dan menunjukkan perilaku percaya diri.</span>
          </td>
        </tr>
        <tr class="sikap">
          <td>5</td>
          <td>
            Achievement
          </td>
          <td style="text-align:center;">S</td>
          <td class="description">
            <span>Semua aspek sikap sudah menjadi kebiasaan, terutama menunjukkan perilaku bersih dan rapi; menunjukkan perilaku sopan santun; menunjukkan perilaku jujur; dan menunjukkan perilaku birrul walidain. Perlu peningkatan  lebih lanjut dalam mengembangkan sikap menunjukkan perilaku disiplin, mandiri dan tanggung jawab; dan menunjukkan perilaku percaya diri.</span>
          </td>
        </tr>
        </tbody>
      </table>
      <table cellspacing="0">
        <tr>
          <td style="height: 30px;"><strong>CATATAN WALI KELAS</strong></td>
        </tr>
        <tr class="sikap">
          <td class="description">
            <span>Semua aspek sikap sudah menjadi kebiasaan, terutama menunjukkan perilaku bersih dan rapi; menunjukkan perilaku sopan santun; menunjukkan perilaku jujur; dan menunjukkan perilaku birrul walidain. Perlu peningkatan  lebih lanjut dalam mengembangkan sikap menunjukkan perilaku disiplin, mandiri dan tanggung jawab; dan menunjukkan perilaku percaya diri.</span>
          </td>
        </tr>
      </table>
      <table cellspacing="0">
        <tr>
          <td style="height: 30px;"><strong>KETIDAKHADIRAN</strong></td>
        </tr>
        <tr class="nilai">
          <td colspan="1" style="border-right:0 ;">Sakit</td>
          <td style="border-left:0 ;">: 0 hari</td>
          <td class="false"></td>
        </tr>
        <tr class="nilai">
          <td colspan="1" style="border-right:0 ;">Izin</td>
          <td style="border-left:0 ;">: 0 hari</td>
          <td class="false"></td>
        </tr>
        <tr class="nilai">
          <td colspan="1" style="border-right:0 ;">Tanpa Keterangan</td>
          <td style="border-left:0 ;">: 0 hari</td>
          <td class="false"></td>
        </tr>
      </table>
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
            Garut, 99 DESEMBER 9999<br>
            Wali Kelas, <br><br><br><br>
            <b><u>IKRIMAH MUKAROMAH, S.Psi.</u></b><br>
            NIPY. 15920019-1
          </td>
        </tr>
        <tr>
          <td style="width: 30%;"></td>
          <td style="width: 35%;">
            Mengetahui <br>
            Kepala Sekolah, <br><br><br><br>
            <b><u>PUJI FAUZIAH, S.Pd.SD</u></b><br>
            NRKS. 12313 123 123 12 3123123
          </td>
          <td style="width: 35%;"></td>
        </tr>
      </table>
      </div>
    </div>
  </div>
</body>

</html>