<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title>{{$title}} | {{$anggota_kelas->siswa->nama_lengkap}} ({{$anggota_kelas->siswa->nis}})</title>
  <link href="./assets/invoice_p5.css" rel="stylesheet">
</head>
<style>
  table { page-break-inside:auto }
  tr    { page-break-inside:avoid}
  thead { display:table-header-group }
</style>
<body>
    <!-- Page 5 Penilaian Peserta Didik -->
    <div class="invoice-box">
        <div class="header">
            <div style="text-align:center">
                <img src="assets/images/logo/cop.jpeg" alt="Logo" height="135px">
            </div>
            <table>
                <tr>
                    <td colspan="4" style="text-align:center"><h3>RAPOR PROJEK PENGUATAN PROFIL PELAJAR PANCASILA</h3></td> 
                </tr>
                <tr>
                <td style="width: 23%;">Nama Sekolah</td>
                <td style="width: 50%;">: {{$sekolah->nama_sekolah}}</td>
                <td style="width: 20%;">Kelas</td>
                <td style="width: 13%;">: {{$anggota_kelas->kelas->romawi}}</td> 
                </tr>
                <tr style="line-height: 20px;">
                <td style="width: 23%;">Alamat</td>
                <td style="width: 50%;">: Jl. Ciledug No 283</td>
                <td style="width: 20%;">Fase</td>
                <td style="width: 13%;">:
                    @if($anggota_kelas->kelas->tingkatan_kelas == 1 || $anggota_kelas->kelas->tingkatan_kelas == 2)
                    A
                    @elseif($anggota_kelas->kelas->tingkatan_kelas == 3 || $anggota_kelas->kelas->tingkatan_kelas == 4)
                    B
                    @else
                    C
                    @endif
                </td>
                </tr>
                <tr style="line-height: 20px;">
                <td style="width: 23%;">Nama Peserta Didik</td>
                <td style="width: 50%;">: {{$anggota_kelas->siswa->nama_lengkap}} </td>
                <td style="width: 20%;">Tahun Pelajaran</td>
                <td style="width: 13%;">: {{$anggota_kelas->kelas->tapel->tahun_pelajaran}}</td>
                </tr>
                <tr style="line-height: 20px;">
                <td style="width: 23%;">Nomor Induk/NISN</td>
                <td colspan="4" style="width: 50%;">: {{$anggota_kelas->siswa->nis}}/{{$anggota_kelas->siswa->nisn}} </td>
                </tr>
            </table>
        </div>
        <div class="content">
            <table cellspacing="0">
                @foreach($p5 as $data)
                <tr>
                    <td style="height: 30px;"><strong>Projek Profil {{$data->no}} | {{$data->judul}}</strong></td>
                </tr>
                <tr class="sikap">
                    <td class="satu">
                        {{$data->deskripsi}} 
                    </td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                @endforeach
            </table>
            <div class="page-break"></div><br>
            @foreach($p5 as $data)
                <h3>{{$data->no}}. {{$data->judul}}</h3>
                <table cellspacing="0">
                    <tr class="heading">
                        <td style="width: 72%;" colspan="2">Capaian</td>
                        <td style="width: 7%;">MB</td>
                        <td style="width: 7%;">SB</td>
                        <td style="width: 7%;">BSH</td>
                        <td style="width: 7%;">SAB</td>
                    </tr>
                    @foreach($data->p5_deskripsi->groupBy('dimensi') as $dimensi => $deskripsiGroup)
                        <tr class="sikap" style="background:rgb(240, 238, 255);">
                            <td colspan="6"><strong>{{ $dimensi }}</strong></td>
                        </tr>
                        @foreach($deskripsiGroup as $deskripsi)
                            @foreach($nilai as $nilaiItem)
                                @if($nilaiItem->p5_deskripsi_id == $deskripsi->id)
                                    <tr class="sikap">
                                        <td class="button" width="2%">&bull;</td>
                                        <td class="description"><strong>{{ $deskripsi->judul }}.</strong> {{ $deskripsi->deskripsi }}</td>
                                        <td style="text-align:center">@if($nilaiItem->nilai == 1)<img src="assets/images/logo/checklist.png" alt="Logo" width="35%">@endif</td>
                                        <td style="text-align:center">@if($nilaiItem->nilai == 2)<img src="assets/images/logo/checklist.png" alt="Logo" width="35%">@endif</td>
                                        <td style="text-align:center">@if($nilaiItem->nilai == 3)<img src="assets/images/logo/checklist.png" alt="Logo" width="35%">@endif</td>
                                        <td style="text-align:center">@if($nilaiItem->nilai == 4)<img src="assets/images/logo/checklist.png" alt="Logo" width="35%">@endif</td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach   
                    @endforeach
                </table><br>
                <table cellspacing="0" >
                    <tr>
                        <td style="height: 30px;"><strong>Catatan proses:</strong></td>
                    </tr>
                    <tr class="sikap">
                    @foreach($catatan as $catatanItem)
                        @if($catatanItem->p5_id == $data->id)
                        <td class="satu">
                        {{$catatanItem->catatan}}
                        </td>
                        @endif
                    @endforeach
                    </tr>
                </table>
                @if(!$loop->last)
                <div class="page-break"></div><br>
                @endif
            @endforeach
            <table cellspacing="0" width="100%">
                <tr>
                    <td width="50%">
                        <table cellspacing="0">
                            <tr>
                                <td style="height: 30px;"><strong>Keterangan</strong></td>
                            </tr>
                            <tr class="sikap">
                                <td width="5%">MB</td>
                                <td class="text-center" width="2%">:</td>
                                <td width="30%">Mulai Berkembang</td>
                            </tr>
                            <tr class="sikap">
                                <td width="5%">SB</td>
                                <td class="text-center" width="2%">:</td>
                                <td width="30%">Sudah Berkembang</td>
                            </tr>
                            <tr class="sikap">
                                <td width="5%">BSH</td>
                                <td class="text-center" width="2%">:</td>
                                <td width="30%">Berkembang Sesuai Harapan</td>
                            </tr>
                            <tr class="sikap">
                                <td width="5%">SAB</td>
                                <td class="text-center" width="2%">:</td>
                                <td width="30%">Sangat Berkebang</td>
                            </tr>
                        </table>
                    </td>
                    <td width="5%"></td>
                    <td width="45%">
                    </td>
                </tr>
            </table>
            <div style="padding-top:1rem; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;">
            <table>
                <tr style="text-align:center">
                <td style="width: 45%;">
                    Mengetahui <br>
                    Orang Tua/Wali, <br><br><br><br><br>
                    .............................
                </td>
                <td style="width: 10%;">
                <td style="width: 45%;">
                {{$anggota_kelas->kelas->tapel->tgl_raport->tempat_penerbitan}}, {{$anggota_kelas->kelas->tapel->tgl_raport->tanggal_pembagian->isoFormat('D MMMM Y')}}<br>
                    Wali Kelas, <br><br><br><br><br>
                    <span style="text-transform: capitalize;"><b><u>{{$guru->nama_lengkap}}, {{$guru->gelar}}</u></b></span><br>
                    @if($guru->nuptk)
                    NUPTK. {{$guru->nuptk}}
                    @else
                    NIPY. {{$guru->nip}}
                    @endif
                </td>
                </tr>
                <tr style="text-align:center">
                <td colspan="3" style="width: 100%;">
                    Mengetahui <br>
                    Kepala Sekolah, <br><br><br><br><br>
                    <b><u>Puji Fauziah, S.Pd.SD.</u></b><br>
                    NRKS. {{$sekolah->nip_kepala_sekolah}}
                </td>
                </tr>
            </table>
        </div>
    </div>
    <script type="text/php">
      if ( isset($pdf) ) {
          $x = 520;
          $y = 800;
          $text = "{PAGE_NUM} of {PAGE_COUNT}";
          $font = $fontMetrics->get_font("helvetica", "bold");
          $size = 10;
          $color = array(0,0,0);
          $word_space = 0.0;
          $char_space = 0.0;
          $angle = 0.0;
          $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
      }
  </script>
</body>

</html>