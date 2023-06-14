<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FORMAT IMPORT KKM</title>
</head>

<body>
  <table>
  <thead>
      <tr>
        <td colspan="6">
          <strong>FORMAT IMPORT KKM MATA PELAJARAN TAHUN PELAJARAN {{$tapel->tahun_pelajaran}}
            @if($tapel->semester == 1)
            GANJIL
            @else
            GENAP
            @endif
          </strong>
        </td>
      </tr>
      <tr>
        <td colspan="6">Waktu download : {{$time_download}}</td>
      </tr>
      <tr>
        <td colspan="6">Didownload oleh : {{Auth::user()->name}} ({{Auth::user()->email}})</td>
      </tr>
      <tr></tr>
      <tr>
        <td colspan="6"><Strong>Catatan :</Strong></td>
      </tr>
      <tr>
        <td colspan="6">- Merubah format file akan menyebabkan error pada saat proses import data.</td>
      </tr>
      <tr>
        <td colspan="6">- Isikan KKM dengan angka antara 0 s/d 100</td>
      </tr>
      <tr>
        <td colspan="6">- Misalkan kkm kelas 1A 1B sama, boleh dihapus yg 1b dengan cara klik kanan->delete->entire row->ok</td>
      </tr>
    </thead>
    <tbody>
      <!-- Pembelajaran  -->
      <tr>
      </tr>
      <tr>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;">
          <strong>NO</strong>
        </td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;">
          <strong>ANG ID</strong>
        </td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;">
          <strong>NILAI ID</strong>
        </td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;">
          <strong>NAMA</strong>
        </td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;">
          <strong>KODE KD</strong>
        </td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;">
          <strong>HARIAN</strong>
        </td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;">
          <strong>NPTS</strong>
        </td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;">
          <strong>NPAS</strong>
        </td>
      </tr>
      <?php $no = 0; ?>
      @foreach($data_kode_penilaian as $rencana_penilaian)
      <?php $no++; ?>
      @foreach($data_anggota_kelas->sortBy('anggota_kelas.id') as $anggota_kelas)
      <tr>
        <td align="center" style="border: 1px solid #000000;">
        {{$no}}
        </td>
        <td align="center" style="border: 1px solid #000000;">
        {{$anggota_kelas->id}}
        </td>
        <td align="center" style="border: 1px solid #000000;">
        {{$rencana_penilaian->id}}
        </td>
        <td align="center" style="border: 1px solid #000000;">
        {{$anggota_kelas->siswa->nama_lengkap}}
        </td>
        <td align="center" style="border: 1px solid #000000;">
        {{$rencana_penilaian->kd_mapel->kode_kd}}
        </td>
        <td align="center" style="border: 1px solid #000000;"></td>
        <td align="center" style="border: 1px solid #000000;"></td>
        <td align="center" style="border: 1px solid #000000;"></td>
      </tr>
      @endforeach
      @endforeach
      <!-- End Pembelajaran  -->
    </tbody>
  </table>

</body>

</html>