<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LEGER NILAI</title>
</head>

<body>
  <table>
  <thead>
      <tr>
        <td colspan="6">
          <strong>LEGER NILAI TAHUN PELAJARAN {{$tapel->tahun_pelajaran}}
            @if($tapel->semester == 1)
            GANJIL
            @else
            GENAP
            @endif
          </strong>
        </td>
      </tr>
      <tr>
        <td colspan="6">Didownload oleh : {{Auth::user()->name}} ({{Auth::user()->email}})</td>
      </tr>
    </thead>
    <tbody>
      <!-- Pembelajaran  -->
      <tr>
      </tr>
      <tr>
        <td align="center" rowspan="2" style="vertical-align: middle;border: 1px solid #000000; background-color: #d9ecd0;">
          <strong>NO</strong>
        </td>
        <td align="center" rowspan="2" style="vertical-align: middle;border: 1px solid #000000; background-color: #d9ecd0;">
          <strong>NAMA SISWA</strong>
        </td>
        <td align="center" rowspan="2" style="vertical-align: middle;border: 1px solid #000000; background-color: #d9ecd0;">
          <strong>KI-1</strong>
        </td>
        <td align="center" rowspan="2" style="vertical-align: middle;border: 1px solid #000000; background-color: #d9ecd0;">
          <strong>KI-2</strong>
        </td>
        <td align="center" colspan="{{$mapel_k3->count()}}" style="vertical-align: middle;border: 1px solid #000000; background-color: #d9ecd0;">
          <strong>KI-3</strong>
        </td>
        <td align="center" colspan="{{$mapel_k3->count()}}" style="vertical-align: middle;border: 1px solid #000000; background-color: #d9ecd0;">
          <strong>KI-4</strong>
        </td>
        <td align="center" colspan="{{$mapel_kokulikuler->count()}}" style="vertical-align: middle;border: 1px solid #000000; background-color: #d9ecd0;">
          <strong>Kokurikuler</strong>
        </td>
        <td align="center" colspan="{{$mapel_mulok->count()}}" style="vertical-align: middle;border: 1px solid #000000; background-color: #d9ecd0;">
          <strong>Mulok</strong>
        </td>
        <td align="center" colspan="4" style="vertical-align: middle;border: 1px solid #000000; background-color: #d9ecd0;">
          <strong>Pelajaran Sholat</strong>
        </td>
        <td align="center" colspan="3" style="vertical-align: middle;border: 1px solid #000000; background-color: #d9ecd0;">
          <strong>Hafalan</strong>
        </td>
        <td align="center" rowspan="2" style="vertical-align: middle;border: 1px solid #000000; background-color: #d9ecd0;">
          <strong>Tahsin</strong>
        </td>
        <td align="center" rowspan="2" style="vertical-align: middle;border: 1px solid #000000; background-color: #d9ecd0;">
          <strong>Tahfidz</strong>
        </td>
        <td align="center" colspan="2" style="vertical-align: middle;border: 1px solid #000000; background-color: #d9ecd0;">
          <strong>Ekstrakulikuler</strong>
        </td>
        <td align="center" colspan="5" style="vertical-align: middle;border: 1px solid #000000; background-color: #d9ecd0;">
          <strong>Nilai Prima</strong>
        </td>
        <td align="center" colspan="3" style="vertical-align: middle;border: 1px solid #000000; background-color: #d9ecd0;">
          <strong>Presensi</strong>
        </td>
      </tr>
      <tr>
        @foreach($mapel_k3 as $mapel)
          <td align="center" style="vertical-align: middle;border: 1px solid #000000; background-color: #d9ecd0;">
            <strong>{{$mapel->mapel->ringkasan_mapel}}</strong>
          </td>
        @endforeach
        @foreach($mapel_k3 as $mapel)
          <td align="center" style="vertical-align: middle;border: 1px solid #000000; background-color: #d9ecd0;">
            <strong>{{$mapel->mapel->ringkasan_mapel}}</strong>
          </td>
        @endforeach
        @foreach($mapel_kokulikuler as $mapel)
          <td align="center" style="vertical-align: middle;border: 1px solid #000000; background-color: #d9ecd0;">
            <strong>{{$mapel->mapel->ringkasan_mapel}}</strong>
          </td>
        @endforeach
        @foreach($mapel_mulok as $mapel)
          <td align="center" style="vertical-align: middle;border: 1px solid #000000; background-color: #d9ecd0;">
            <strong>{{$mapel->mapel->ringkasan_mapel}}</strong>
          </td>
        @endforeach
          <td align="center" style="vertical-align: middle;border: 1px solid #000000; background-color: #d9ecd0;">
            <strong>Wudhu</strong>
          </td>
          <td align="center" style="vertical-align: middle;border: 1px solid #000000; background-color: #d9ecd0;">
            <strong>B. Sholat</strong>
          </td>
          <td align="center" style="vertical-align: middle;border: 1px solid #000000; background-color: #d9ecd0;">
            <strong>G. Sholat</strong>
          </td>
          <td align="center" style="vertical-align: middle;border: 1px solid #000000; background-color: #d9ecd0;">
            <strong>Dzikir</strong>
          </td>
          <td align="center" style="vertical-align: middle;border: 1px solid #000000; background-color: #d9ecd0;">
            <strong>Hadis</strong>
          </td>
          <td align="center" style="vertical-align: middle;border: 1px solid #000000; background-color: #d9ecd0;">
            <strong>Doa</strong>
          </td>
          <td align="center" style="vertical-align: middle;border: 1px solid #000000; background-color: #d9ecd0;">
            <strong>Hikmah</strong>
          </td>
          <td align="center" style="vertical-align: middle;border: 1px solid #000000; background-color: #d9ecd0;">
            <strong>Pramuka</strong>
          </td>
          <td align="center" style="vertical-align: middle;border: 1px solid #000000; background-color: #d9ecd0;">
            <strong>Pilihan</strong>
          </td>
          <td align="center" style="vertical-align: middle;border: 1px solid #000000; background-color: #d9ecd0;">
            <strong>P</strong>
          </td>
          <td align="center" style="vertical-align: middle;border: 1px solid #000000; background-color: #d9ecd0;">
            <strong>R</strong>
          </td>
          <td align="center" style="vertical-align: middle;border: 1px solid #000000; background-color: #d9ecd0;">
            <strong>I</strong>
          </td>
          <td align="center" style="vertical-align: middle;border: 1px solid #000000; background-color: #d9ecd0;">
            <strong>M</strong>
          </td>
          <td align="center" style="vertical-align: middle;border: 1px solid #000000; background-color: #d9ecd0;">
            <strong>A</strong>
          </td>
          <td align="center" style="vertical-align: middle;border: 1px solid #000000; background-color: #d9ecd0;">
            <strong>S</strong>
          </td>
          <td align="center" style="vertical-align: middle;border: 1px solid #000000; background-color: #d9ecd0;">
            <strong>I</strong>
          </td>
          <td align="center" style="vertical-align: middle;border: 1px solid #000000; background-color: #d9ecd0;">
            <strong>A</strong>
          </td>
      </tr>
      <?php $no = 0; ?>
      @foreach($data_anggota_kelas->sortBy('anggota_kelas.id') as $anggota_kelas)
      <?php $no++; ?>
      <tr>
        <td align="center" style="border: 1px solid #000000;">{{$no}}</td>
        <td style="border: 1px solid #000000;">{{$anggota_kelas->siswa->nama_lengkap}}</td>
        <td align="center" style="border: 1px solid #000000;">
          @if($anggota_kelas->data_nilai_ki_1 >= 3.1)
          SB
          @elseif($anggota_kelas->data_nilai_ki_1 >= 2.1)
          B
          @else
          C
          @endif
        </td>
        <td align="center" style="border: 1px solid #000000;">
          @if($anggota_kelas->data_nilai_ki_2 >= 3.1)
          SB
          @elseif($anggota_kelas->data_nilai_ki_2 >= 2.1)
          B
          @else
          C
          @endif
        </td>
        @foreach($mapel_k3 as $mapel)
          <td align="center" style="border: 1px solid #000000;">
          @foreach($anggota_kelas->data_nilai_ki_3->where('pembelajaran_id',$mapel->id) as $da)
            @if($da->nilai_raport)
              {{$da->nilai_raport}}
            @else
              
            @endif
          @endforeach
          </td>
        @endforeach

        @foreach($mapel_k3 as $mapel)
          <td align="center" style="border: 1px solid #000000;">
          @foreach($anggota_kelas->data_nilai_ki_4->where('pembelajaran_id',$mapel->id) as $da)
            @if($da->nilai_raport)
              {{$da->nilai_raport}}
            @else
              
            @endif
          @endforeach
          </td>
        @endforeach

        @foreach($mapel_kokulikuler as $mapel)
          <td align="center" style="border: 1px solid #000000;">
          @foreach($anggota_kelas->data_nilai_kokulikuler->where('pembelajaran_id',$mapel->id) as $da)
            @if($da->nilai_raport)
              {{$da->nilai_raport}}
            @else
              
            @endif
          @endforeach
          </td>
        @endforeach
        
        @foreach($mapel_mulok as $mapel)
          <td align="center" style="border: 1px solid #000000;">
          @foreach($anggota_kelas->data_nilai_mulok->where('pembelajaran_id',$mapel->id) as $da)
            @if($da->nilai_raport)
              {{$da->nilai_raport}}
            @else
              
            @endif
          @endforeach
          </td>
        @endforeach

        @if($anggota_kelas->data_nilai_sholat)
        <td align="center" style="border: 1px solid #000000;">{{$anggota_kelas->data_nilai_sholat->praktik_wudhu}}</td>
        <td align="center" style="border: 1px solid #000000;">{{$anggota_kelas->data_nilai_sholat->bacaan_sholat}}</td>
        <td align="center" style="border: 1px solid #000000;">{{$anggota_kelas->data_nilai_sholat->gerakan_sholat}}</td>
        <td align="center" style="border: 1px solid #000000;">{{$anggota_kelas->data_nilai_sholat->dzikir}}</td>
        @else
        <td align="center" style="border: 1px solid #000000;"> </td>
        <td align="center" style="border: 1px solid #000000;"> </td>
        <td align="center" style="border: 1px solid #000000;"> </td>
        <td align="center" style="border: 1px solid #000000;"> </td>
        @endif

        @if($anggota_kelas->data_nilai_hafalan)
        <td align="center" style="border: 1px solid #000000;">{{$anggota_kelas->data_nilai_hafalan->hadis}}</td>
        <td align="center" style="border: 1px solid #000000;">{{$anggota_kelas->data_nilai_hafalan->doa}}</td>
        <td align="center" style="border: 1px solid #000000;">{{$anggota_kelas->data_nilai_hafalan->hikmah}}</td>
        @else
        <td align="center" style="border: 1px solid #000000;"> </td>
        <td align="center" style="border: 1px solid #000000;"> </td>
        <td align="center" style="border: 1px solid #000000;"> </td>
        @endif

        @if($anggota_kelas->data_nilai_t2q)
        <td align="center" style="border: 1px solid #000000;">{{$anggota_kelas->data_nilai_t2q->tahsin_nilai}}</td>
        @else
        <td align="center" style="border: 1px solid #000000;"> </td>
        @endif

        @if($anggota_kelas->data_nilai_tahfidz)
        <td align="center" style="border: 1px solid #000000;">{{$anggota_kelas->data_nilai_tahfidz->tahfidz_nilai}}</td>
        @else
        <td align="center" style="border: 1px solid #000000;"> </td>
        @endif

        @if($anggota_kelas->data_nilai_pramuka)
        <td align="center" style="border: 1px solid #000000;">
          @if($anggota_kelas->data_nilai_pramuka->nilai == 4)
          SB
          @elseif($anggota_kelas->data_nilai_pramuka->nilai == 3)
          B
          @else
          C
          @endif
        </td>
        @else
        <td align="center" style="border: 1px solid #000000;"></td>
        @endif

        @if($anggota_kelas->data_nilai_ekskul)
        <td align="center" style="border: 1px solid #000000;">
          @if($anggota_kelas->data_nilai_ekskul->nilai == 4)
          SB
          @elseif($anggota_kelas->data_nilai_ekskul->nilai == 3)
          B
          @else
          C
          @endif
        </td>
        @else
        <td align="center" style="border: 1px solid #000000;"></td>
        @endif

        <td align="center" style="border: 1px solid #000000;">
          @if($anggota_kelas->data_nilai_proactive >= 3.1)
          SB
          @elseif($anggota_kelas->data_nilai_proactive >= 2.1)
          B
          @else
          C
          @endif
        </td>

        <td align="center" style="border: 1px solid #000000;">
          @if($anggota_kelas->data_nilai_responsible >= 3.1)
          SB
          @elseif($anggota_kelas->data_nilai_responsible >= 2.1)
          B
          @else
          C
          @endif
        </td>

        <td align="center" style="border: 1px solid #000000;">
          @if($anggota_kelas->data_nilai_innovative >= 3.1)
          SB
          @elseif($anggota_kelas->data_nilai_innovative >= 2.1)
          B
          @else
          C
          @endif
        </td>

        <td align="center" style="border: 1px solid #000000;">
          @if($anggota_kelas->data_nilai_modest >= 3.1)
          SB
          @elseif($anggota_kelas->data_nilai_modest >= 2.1)
          B
          @else
          C
          @endif
        </td>

        <td align="center" style="border: 1px solid #000000;">
          @if($anggota_kelas->data_nilai_achievement >= 3.1)
          SB
          @elseif($anggota_kelas->data_nilai_achievement >= 2.1)
          B
          @else
          C
          @endif
        </td>
        @if($anggota_kelas->kehadiran)
        <td align="center" style="border: 1px solid #000000;">{{$anggota_kelas->kehadiran->sakit}}</td>
        <td align="center" style="border: 1px solid #000000;">{{$anggota_kelas->kehadiran->izin}}</td>
        <td align="center" style="border: 1px solid #000000;">{{$anggota_kelas->kehadiran->tanpa_keterangan}}</td>
        @else
        <td align="center" style="border: 1px solid #000000;"></td>
        <td align="center" style="border: 1px solid #000000;"></td>
        <td align="center" style="border: 1px solid #000000;"></td>
        @endif
      </tr>
      @endforeach
      <!-- End Pembelajaran  -->
    </tbody>
  </table>

</body>

</html>