<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title>{{$title}} | {{$anggota_kelas->siswa->nama_lengkap}} ({{$anggota_kelas->siswa->nis}})</title>
  <link href="./assets/invoice_raport.css" rel="stylesheet">
</head>
<style>
  body {
    margin-top: 8mm; 
  }
  table { page-break-inside:auto }
  tr    { page-break-inside:avoid}
  thead { display:table-header-group }
</style>
<body>
  <!-- Page 5 Penilaian Peserta Didik -->
  <div class="invoice-box">
    <div class="header">
      <table>
        <tr>
          <td style="width: 23%;">Nama Peserta Didik</td>
          <td style="width: 40%;">: {{$anggota_kelas->siswa->nama_lengkap}} </td>
          <td style="width: 20%;">Kelas</td>
          <td style="width: 13%;">: {{$anggota_kelas->kelas->romawi}}</td> 
        </tr>
        <tr style="line-height: 20px;">
          <td style="width: 23%;">Nomor Induk/NISN</td>
          <td style="width: 52%;">: {{$anggota_kelas->siswa->nis}}/{{$anggota_kelas->siswa->nisn}} </td>
          <td style="width: 20%;">Semester</td>
          <td style="width: 13%;">:
            @if($anggota_kelas->kelas->tapel->semester == 1)
            1 (Satu)
            @else
            2 (Dua)
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
          <td colspan="4" style="width: 52%;">: Jl. Ciledug No 283</td>
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
          @if($des_ki1->count() != 0)
            @php
            $hasil_k1=round($des_ki1->sum('nilai')/$des_ki1->count(),1);
            @endphp
            <td style="text-align:center;">
              @if($hasil_k1 >= 3.1)
              SB
              @elseif($hasil_k1 >= 2.1)
              B
              @else
              C
              @endif
            </td>
            <td class="description">
              <span>
                Ananda
                @if($des_ki1->where('nilai',4)->count() != 0)
                    sangat baik dalam hal
                    @foreach($des_ki1->where('nilai',4) as $ki1)
                        @if(!$loop->last)
                          {{$ki1->rencana_nilai_k1->butir_sikap->butir_sikap}},
                        @else
                          {{$ki1->rencana_nilai_k1->butir_sikap->butir_sikap}}.
                        @endif
                    @endforeach
                @endif

                @if($des_ki1->where('nilai',3)->count() != 0)
                  @if($des_ki1->where('nilai',4)->count() == 0)
                    baik dalam hal
                  @else
                    Baik dalam hal
                  @endif
                    @foreach($des_ki1->where('nilai',3) as $ki1)
                        @if(!$loop->last)
                          {{$ki1->rencana_nilai_k1->butir_sikap->butir_sikap}},
                        @else
                          {{$ki1->rencana_nilai_k1->butir_sikap->butir_sikap}}.
                        @endif
                    @endforeach
                @endif
                
                @if($des_ki1->where('nilai',2)->count() != 0 || $des_ki1->where('nilai',1)->count() != 0)
                  @if($des_ki1->where('nilai',4)->count() == 0 && $des_ki1->where('nilai',3)->count() == 0)
                    cukup dalam hal
                  @else
                    Cukup dalam hal
                  @endif
                    @foreach($des_ki1->where('nilai', 2) as $ki1)
                        @if(!$loop->last)
                          {{$ki1->rencana_nilai_k1->butir_sikap->butir_sikap}},
                        @else
                          @if($des_ki1->where('nilai',1)->count() == 0)
                            {{$ki1->rencana_nilai_k1->butir_sikap->butir_sikap}}.
                          @else
                            {{$ki1->rencana_nilai_k1->butir_sikap->butir_sikap}},
                          @endif
                        @endif
                    @endforeach

                    @foreach($des_ki1->where('nilai', 1) as $ki1)
                        @if(!$loop->last)
                          {{$ki1->rencana_nilai_k1->butir_sikap->butir_sikap}},
                        @else
                          {{$ki1->rencana_nilai_k1->butir_sikap->butir_sikap}}.
                        @endif
                    @endforeach
                @endif
              </span>
            </td>
          @else
            <td style="text-align:center;"> - </td>
            <td style="text-align:center;"> - </td>
          @endif
        </tr>
        <tr class="sikap">
          <td>2</td>
          <td>
              Penilaian Sikap Sosial (KI-2)
          </td>
          @if($des_ki2->count() != 0)
            @php
            $hasil_k2 = round($des_ki2->sum('nilai')/$des_ki2->count(),1);
            @endphp
            <td style="text-align:center;">
              @if($hasil_k2 >= 3.1)
              SB
              @elseif($hasil_k2 >= 2.1)
              B
              @else
              C
              @endif
            </td>
            <td class="description">
              <span>
                Ananda
                @if($des_ki2->where('nilai',4)->count() != 0)
                    sangat baik dalam hal
                    @foreach($des_ki2->where('nilai',4) as $ki2)
                        @if(!$loop->last)
                          {{$ki2->rencana_nilai_k2->butir_sikap->butir_sikap}},
                        @else
                          {{$ki2->rencana_nilai_k2->butir_sikap->butir_sikap}}.
                        @endif
                    @endforeach
                @endif

                @if($des_ki2->where('nilai',3)->count() != 0)
                  @if($des_ki2->where('nilai',4)->count() == 0)
                    baik dalam hal
                  @else
                    Baik dalam hal
                  @endif
                    @foreach($des_ki2->where('nilai',3) as $ki2)
                        @if(!$loop->last)
                          {{$ki2->rencana_nilai_k2->butir_sikap->butir_sikap}},
                        @else
                          {{$ki2->rencana_nilai_k2->butir_sikap->butir_sikap}}.
                        @endif
                    @endforeach
                @endif
                
                @if($des_ki2->where('nilai',2)->count() != 0 || $des_ki2->where('nilai',1)->count() != 0)
                  @if($des_ki2->where('nilai',4)->count() == 0 && $des_ki2->where('nilai',3)->count() == 0)
                    cukup dalam hal
                  @else
                    Cukup dalam hal
                  @endif
                    @foreach($des_ki2->where('nilai', 2) as $ki2)
                        @if(!$loop->last)
                          {{$ki2->rencana_nilai_k2->butir_sikap->butir_sikap}},
                        @else
                          @if($des_ki2->where('nilai',1)->count() == 0)
                            {{$ki2->rencana_nilai_k2->butir_sikap->butir_sikap}}.
                          @else
                            {{$ki2->rencana_nilai_k2->butir_sikap->butir_sikap}},
                          @endif
                        @endif
                    @endforeach

                    @foreach($des_ki2->where('nilai', 1) as $ki2)
                        @if(!$loop->last)
                          {{$ki2->rencana_nilai_k2->butir_sikap->butir_sikap}},
                        @else
                          {{$ki2->rencana_nilai_k2->butir_sikap->butir_sikap}}.
                        @endif
                    @endforeach
                @endif
              </span>
            </td>
          @else
            <td style="text-align:center;"> - </td>
            <td style="text-align:center;"> - </td>
          @endif
        </tr>
      </table>
      <table cellspacing="0">
        <tr>
          <td colspan="4" style="height: 30px;"><strong>B. PENGETAHUAN KI-3</strong></td>
        </tr>
        <tr>
          <td colspan="4"><strong>KKM : 75</strong></td>
        </tr>
        <thead>
          <tr class="heading">
            <td style="width: 4%;">NO</td>
            <td style="width: 26%;">KOMPETENSI YANG DINILAI</td>
            <td style="width: 10%;">CAPAIAN</td>
            <td style="width: 60%;">DESKRIPSI</td>
          </tr>
        </thead>
        <tbody>
        @php 
          $no_k1 = 1;
          $no_k2 = 1;
          $no_ko = 1;
          $no_mul = 1;
        @endphp
          @forelse($nilai_ki3 as $ki3)
          <tr class="sikap">
            <td>{{$no_k1++}}</td>
            <td>
              {{$ki3->pembelajaran->mapel->nama_mapel}}
            </td>
            <td style="text-align:center;">{{$ki3->nilai_raport}}</td>
            <td class="description">
              <span>
                Ananda 
                @if($des_ki3->where('pembelajaran_id',$ki3->pembelajaran_id)->whereBetween('nilai_kd', [$ki3->predikat_a,100])->count() != 0)
                    sangat baik dalam hal
                    @foreach($des_ki3->where('pembelajaran_id',$ki3->pembelajaran_id)->whereBetween('nilai_kd', [$ki3->predikat_a,100]) as $deskripsi)
                      @if(!$loop->last)
                          {!!$deskripsi->rencana_mapel->kd_mapel->kompetensi_dasar!!},
                      @else
                          {!!$deskripsi->rencana_mapel->kd_mapel->kompetensi_dasar!!}.
                      @endif
                    @endforeach
                @endif

                @if($des_ki3->where('pembelajaran_id',$ki3->pembelajaran_id)->whereBetween('nilai_kd', [$ki3->predikat_b,($ki3->predikat_a - 1)])->count() != 0)
                  @if($des_ki3->where('pembelajaran_id',$ki3->pembelajaran_id)->whereBetween('nilai_kd', [$ki3->predikat_a,100])->count() == 0)
                    baik dalam hal
                  @else
                    Baik dalam hal
                  @endif
                    @foreach($des_ki3->where('pembelajaran_id',$ki3->pembelajaran_id)->whereBetween('nilai_kd', [$ki3->predikat_b,($ki3->predikat_a - 1)]) as $deskripsi)
                      @if(!$loop->last)
                          {!!$deskripsi->rencana_mapel->kd_mapel->kompetensi_dasar!!},
                      @else
                          {!!$deskripsi->rencana_mapel->kd_mapel->kompetensi_dasar!!}.
                      @endif
                    @endforeach
                @endif
                    
                @if($des_ki3->where('pembelajaran_id',$ki3->pembelajaran_id)->whereBetween('nilai_kd', [$ki3->predikat_c,($ki3->predikat_b - 1)])->count() != 0)
                  @if($des_ki3->where('pembelajaran_id',$ki3->pembelajaran_id)->whereBetween('nilai_kd', [$ki3->predikat_a,100])->count() == 0 && $des_ki3->where('pembelajaran_id',$ki3->pembelajaran_id)->whereBetween('nilai_kd', [$ki3->predikat_b,($ki3->predikat_a - 1)])->count() == 0)
                    cukup dalam hal
                  @else
                    Cukup dalam hal
                  @endif
                    @foreach($des_ki3->where('pembelajaran_id',$ki3->pembelajaran_id)->whereBetween('nilai_kd', [$ki3->predikat_c,($ki3->predikat_b - 1)]) as $deskripsi)
                      @if(!$loop->last)
                          {!!$deskripsi->rencana_mapel->kd_mapel->kompetensi_dasar!!},
                      @else
                          {!!$deskripsi->rencana_mapel->kd_mapel->kompetensi_dasar!!}.
                      @endif
                    @endforeach
                @endif

                @if($des_ki3->where('pembelajaran_id',$ki3->pembelajaran_id)->whereBetween('nilai_kd', [0,74])->count() != 0)
                    Perlu perbaikan
                    @foreach($des_ki3->where('pembelajaran_id',$ki3->pembelajaran_id)->whereBetween('nilai_kd', [0,74]) as $deskripsi)
                      @if(!$loop->last)
                          {!!$deskripsi->rencana_mapel->kd_mapel->kompetensi_dasar!!},
                      @else
                          {!!$deskripsi->rencana_mapel->kd_mapel->kompetensi_dasar!!}.
                      @endif
                    @endforeach
                @endif
              </span>
            </td>
          </tr>
          @empty
          <tr class="sikap">
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
          </tr>
          @endforelse
        </tbody>
      </table>
      <table cellspacing="0">
        <tr>
          <td colspan="4" style="height: 30px;"><strong>C. KETERAMPILAN KI-4</strong></td>
        </tr>
        <tr>
          <td colspan="4"><strong>KKM : 75</strong></td>
        </tr>
        <thead>
          <tr class="heading">
            <td style="width: 4%;">NO</td>
            <td style="width: 26%;">KOMPETENSI YANG DINILAI</td>
            <td style="width: 10%;">CAPAIAN</td>
            <td style="width: 60%;">DESKRIPSI</td>
          </tr>
        </thead>
        <tbody>
          @forelse($nilai_ki4 as $ki4)
          <tr class="sikap">
            <td>{{$no_k2++}}</td>
            <td>
            {{$ki4->pembelajaran->mapel->nama_mapel}}
            </td>
            <td style="text-align:center;">{{$ki4->nilai_raport}}</td>
            <td class="description">
              <span>
                Ananda
                @if($des_ki4->where('pembelajaran_id',$ki4->pembelajaran_id)->whereBetween('nilai', [$ki4->predikat_a,100])->count() != 0)
                    sangat baik dalam hal
                    @foreach($des_ki4->where('pembelajaran_id',$ki4->pembelajaran_id)->whereBetween('nilai', [$ki4->predikat_a,100]) as $deskripsi)
                      @if(!$loop->last)
                          {!!$deskripsi->rencana_mapel->kd_mapel->kompetensi_dasar!!},
                      @else
                          {!!$deskripsi->rencana_mapel->kd_mapel->kompetensi_dasar!!}.
                      @endif
                    @endforeach
                @endif

                @if($des_ki4->where('pembelajaran_id',$ki4->pembelajaran_id)->whereBetween('nilai', [$ki4->predikat_b,($ki4->predikat_a - 1)])->count() != 0)
                  @if($des_ki4->where('pembelajaran_id',$ki4->pembelajaran_id)->whereBetween('nilai', [$ki4->predikat_a,100])->count() == 0)
                    baik dalam hal
                  @else
                    Baik dalam hal
                  @endif
                    @foreach($des_ki4->where('pembelajaran_id',$ki4->pembelajaran_id)->whereBetween('nilai', [$ki4->predikat_b,($ki4->predikat_a - 1)]) as $deskripsi)
                      @if(!$loop->last)
                          {!!$deskripsi->rencana_mapel->kd_mapel->kompetensi_dasar!!},
                      @else
                          {!!$deskripsi->rencana_mapel->kd_mapel->kompetensi_dasar!!}.
                      @endif
                    @endforeach
                @endif
                    
                @if($des_ki4->where('pembelajaran_id',$ki4->pembelajaran_id)->whereBetween('nilai', [$ki4->predikat_c,($ki4->predikat_b - 1)])->count() != 0)
                  @if($des_ki4->where('pembelajaran_id',$ki4->pembelajaran_id)->whereBetween('nilai_kd', [$ki4->predikat_a,100])->count() == 0 && $des_ki4->where('pembelajaran_id',$ki4->pembelajaran_id)->whereBetween('nilai_kd', [$ki4->predikat_b,($ki4->predikat_a - 1)])->count() == 0)
                    cukup dalam hal
                  @else
                    Cukup dalam hal
                  @endif
                    @foreach($des_ki4->where('pembelajaran_id',$ki4->pembelajaran_id)->whereBetween('nilai', [$ki4->predikat_c,($ki4->predikat_b - 1)]) as $deskripsi)
                      @if(!$loop->last)
                          {!!$deskripsi->rencana_mapel->kd_mapel->kompetensi_dasar!!},
                      @else
                          {!!$deskripsi->rencana_mapel->kd_mapel->kompetensi_dasar!!}.
                      @endif
                    @endforeach
                @endif

                @if($des_ki4->where('pembelajaran_id',$ki4->pembelajaran_id)->whereBetween('nilai', [0,74])->count() != 0)
                    Perlu perbaikan
                    @foreach($des_ki4->where('pembelajaran_id',$ki4->pembelajaran_id)->whereBetween('nilai', [0,74]) as $deskripsi)
                      @if(!$loop->last)
                          {!!$deskripsi->rencana_mapel->kd_mapel->kompetensi_dasar!!},
                      @else
                          {!!$deskripsi->rencana_mapel->kd_mapel->kompetensi_dasar!!}.
                      @endif
                    @endforeach
                @endif
              </span>
            </td>
          </tr>
          @empty
          <tr class="sikap">
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
          </tr>
          @endforelse
        </tbody>
      </table>
      <table cellspacing="0">
        <tr>
          <td colspan="4" style="height: 30px;"><strong>D. KOKULIKULER</strong></td>
        </tr>
        <tr>
          <td colspan="4"><strong>KKM : 75</strong></td>
        </tr>
        <thead>
          <tr class="heading">
            <td style="width: 4%;">NO</td>
            <td style="width: 26%;">KOMPETENSI YANG DINILAI</td>
            <td style="width: 10%;">CAPAIAN</td>
            <td style="width: 60%;">DESKRIPSI</td>
          </tr>
        </thead>
        <tbody>
          @forelse($nilai_kokulikuler as $kokulikuler)
          <tr class="sikap">
            <td>{{$no_ko++}}</td>
            <td>
              {{$kokulikuler->pembelajaran->mapel->nama_mapel}}
            </td>
            <td style="text-align:center;">{{$kokulikuler->nilai_raport}}</td>
            <td class="description">
              <span>
                Ananda
                @if($des_kokulikuler->where('pembelajaran_id',$kokulikuler->pembelajaran_id)->whereBetween('nilai_kd', [$kokulikuler->predikat_a,100])->count() != 0)
                    sangat baik dalam hal
                    @foreach($des_kokulikuler->where('pembelajaran_id',$kokulikuler->pembelajaran_id)->whereBetween('nilai_kd', [$kokulikuler->predikat_a,100]) as $deskripsi)
                      @if(!$loop->last)
                          {!!$deskripsi->rencana_mapel->kd_mapel->kompetensi_dasar!!},
                      @else
                          {!!$deskripsi->rencana_mapel->kd_mapel->kompetensi_dasar!!}.
                      @endif
                    @endforeach
                @endif

                @if($des_kokulikuler->where('pembelajaran_id',$kokulikuler->pembelajaran_id)->whereBetween('nilai_kd', [$kokulikuler->predikat_b,($kokulikuler->predikat_a - 1)])->count() != 0)
                  @if($des_kokulikuler->where('pembelajaran_id',$kokulikuler->pembelajaran_id)->whereBetween('nilai_kd', [$kokulikuler->predikat_a,100])->count() == 0)
                    baik dalam hal
                  @else
                    Baik dalam hal
                  @endif
                    @foreach($des_kokulikuler->where('pembelajaran_id',$kokulikuler->pembelajaran_id)->whereBetween('nilai_kd', [$kokulikuler->predikat_b,($kokulikuler->predikat_a - 1)]) as $deskripsi)
                      @if(!$loop->last)
                          {!!$deskripsi->rencana_mapel->kd_mapel->kompetensi_dasar!!},
                      @else
                          {!!$deskripsi->rencana_mapel->kd_mapel->kompetensi_dasar!!}.
                      @endif
                    @endforeach
                @endif
                    
                @if($des_kokulikuler->where('pembelajaran_id',$kokulikuler->pembelajaran_id)->whereBetween('nilai_kd', [$kokulikuler->predikat_c,($kokulikuler->predikat_b - 1)])->count() != 0)
                  @if($des_kokulikuler->where('pembelajaran_id',$kokulikuler->pembelajaran_id)->whereBetween('nilai_kd', [$kokulikuler->predikat_a,100])->count() == 0 && $des_kokulikuler->where('pembelajaran_id',$kokulikuler->pembelajaran_id)->whereBetween('nilai_kd', [$kokulikuler->predikat_b,($kokulikuler->predikat_a - 1)])->count() == 0)
                    cukup dalam hal
                  @else
                    Cukup dalam hal
                  @endif
                    @foreach($des_kokulikuler->where('pembelajaran_id',$kokulikuler->pembelajaran_id)->whereBetween('nilai_kd', [$kokulikuler->predikat_c,($kokulikuler->predikat_b - 1)]) as $deskripsi)
                      @if(!$loop->last)
                          {!!$deskripsi->rencana_mapel->kd_mapel->kompetensi_dasar!!},
                      @else
                          {!!$deskripsi->rencana_mapel->kd_mapel->kompetensi_dasar!!}.
                      @endif
                    @endforeach
                @endif

                @if($des_kokulikuler->where('pembelajaran_id',$kokulikuler->pembelajaran_id)->whereBetween('nilai_kd', [0,74])->count() != 0)
                    Perlu perbaikan
                    @foreach($des_kokulikuler->where('pembelajaran_id',$kokulikuler->pembelajaran_id)->whereBetween('nilai_kd', [0,74]) as $deskripsi)
                      @if(!$loop->last)
                          {!!$deskripsi->rencana_mapel->kd_mapel->kompetensi_dasar!!},
                      @else
                          {!!$deskripsi->rencana_mapel->kd_mapel->kompetensi_dasar!!}.
                      @endif
                    @endforeach
                @endif
              </span>
            </td>
          </tr>
          @empty
          <tr class="sikap">
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
          </tr>
          @endforelse
        </tbody>
      </table>
      <table cellspacing="0">
        <tr>
          <td colspan="4" style="height: 30px;"><strong>E. MUATAN LOKAL KHAS PRIMA INSANI</strong></td>
        </tr>
        <tr>
          <td colspan="4"><strong>KKM : 75</strong></td>
        </tr>
        <thead>
          <tr class="heading">
            <td style="width: 4%;">NO</td>
            <td style="width: 26%;">KOMPETENSI YANG DINILAI</td>
            <td style="width: 10%;">CAPAIAN</td>
            <td style="width: 60%;">DESKRIPSI</td>
          </tr>
        </thead>
        <tbody>
          @forelse($nilai_mulok as $mulok)
            <tr class="sikap">
            <td>{{$no_mul++}}</td>
              <td>
                {{$mulok->pembelajaran->mapel->nama_mapel}}
              </td>
              <td style="text-align:center;">{{$mulok->nilai_raport}}</td>
              <td class="description">
              <span>
                Ananda
                @if($des_mulok->where('pembelajaran_id',$mulok->pembelajaran_id)->whereBetween('nilai_kd', [$mulok->predikat_a,100])->count() != 0)
                    sangat baik dalam hal
                    @foreach($des_mulok->where('pembelajaran_id',$mulok->pembelajaran_id)->whereBetween('nilai_kd', [$mulok->predikat_a,100]) as $deskripsi)
                      @if(!$loop->last)
                          {!!$deskripsi->rencana_mulok->kd_mapel->kompetensi_dasar!!},
                      @else
                          {!!$deskripsi->rencana_mulok->kd_mapel->kompetensi_dasar!!}.
                      @endif
                    @endforeach
                @endif

                @if($des_mulok->where('pembelajaran_id',$mulok->pembelajaran_id)->whereBetween('nilai_kd', [$mulok->predikat_b,($mulok->predikat_a - 1)])->count() != 0)
                  @if($des_mulok->where('pembelajaran_id',$mulok->pembelajaran_id)->whereBetween('nilai_kd', [$mulok->predikat_a,100])->count() == 0)
                    baik dalam hal
                  @else
                    Baik dalam hal
                  @endif
                    @foreach($des_mulok->where('pembelajaran_id',$mulok->pembelajaran_id)->whereBetween('nilai_kd', [$mulok->predikat_b,($mulok->predikat_a - 1)]) as $deskripsi)
                      @if(!$loop->last)
                          {!!$deskripsi->rencana_mulok->kd_mapel->kompetensi_dasar!!},
                      @else
                          {!!$deskripsi->rencana_mulok->kd_mapel->kompetensi_dasar!!}.
                      @endif
                    @endforeach
                @endif
                    
                @if($des_mulok->where('pembelajaran_id',$mulok->pembelajaran_id)->whereBetween('nilai_kd', [$mulok->predikat_c,($mulok->predikat_b - 1)])->count() != 0)
                  @if($des_mulok->where('pembelajaran_id',$mulok->pembelajaran_id)->whereBetween('nilai_kd', [$mulok->predikat_a,100])->count() == 0 && $des_mulok->where('pembelajaran_id',$mulok->pembelajaran_id)->whereBetween('nilai_kd', [$mulok->predikat_b,($mulok->predikat_a - 1)])->count() == 0)
                    cukup dalam hal
                  @else
                    Cukup dalam hal
                  @endif
                    @foreach($des_mulok->where('pembelajaran_id',$mulok->pembelajaran_id)->whereBetween('nilai_kd', [$mulok->predikat_c,($mulok->predikat_b - 1)]) as $deskripsi)
                      @if(!$loop->last)
                          {!!$deskripsi->rencana_mulok->kd_mapel->kompetensi_dasar!!},
                      @else
                          {!!$deskripsi->rencana_mulok->kd_mapel->kompetensi_dasar!!}.
                      @endif
                    @endforeach
                @endif

                @if($des_mulok->where('pembelajaran_id',$mulok->pembelajaran_id)->whereBetween('nilai_kd', [0,74])->count() != 0)
                    Perlu perbaikan
                    @foreach($des_mulok->where('pembelajaran_id',$mulok->pembelajaran_id)->whereBetween('nilai_kd', [0,74]) as $deskripsi)
                      @if(!$loop->last)
                          {!!$deskripsi->rencana_mulok->kd_mapel->kompetensi_dasar!!},
                      @else
                          {!!$deskripsi->rencana_mulok->kd_mapel->kompetensi_dasar!!}.
                      @endif
                    @endforeach
                @endif
              </span>
              </td>
            </tr>
          @empty
            <tr class="sikap">
              <td>-</td>
              <td>-</td>
              <td>-</td>
              <td>-</td>
            </tr>
          @endforelse
        </tbody>
      </table>
      <table cellspacing="0">
        <tr>
          <td colspan="4" style="height: 30px;"><strong>F. MUATAN LOKAL PAI KHAS PRIMA INSANI</strong></td>
        </tr>
        <tr>
          <td colspan="4"><strong>KKM : 75</strong></td>
        </tr>
        <tr>
          <td colspan="4" style="height: 30px;"><strong>1. PELAJARAN SHOLAT</strong></td>
        </tr>
        <thead>
          <tr class="heading">
            <td style="width: 4%;">NO</td>
            <td style="width: 26%;">KOMPETENSI YANG DINILAI</td>
            <td style="width: 10%;">CAPAIAN</td>
            <td style="width: 60%;">DESKRIPSI</td>
          </tr>
        </thead>
        <tbody>
          @if($nilai_sholat)
          <tr class="sikap">
            <td>1</td>
            <td>
              Praktek Wudhu
            </td>
            <td style="text-align:center;">{{$nilai_sholat->praktik_wudhu}}</td>
            <td class="description">
              <span>{{$nilai_sholat->deskripsi_praktik_wudhu}}</span>
            </td>
          </tr>
          <tr class="sikap">
            <td>2</td>
            <td>
              Bacaan Sholat
            </td>
            <td style="text-align:center;">{{$nilai_sholat->bacaan_sholat}}</td>
            <td class="description">
              <span>{{$nilai_sholat->deskripsi_bacaan_sholat}}</span>
            </td>
          </tr>
          <tr class="sikap">
            <td>3</td>
            <td>
              Gerakan Sholat
            </td>
            <td style="text-align:center;">{{$nilai_sholat->gerakan_sholat}}</td>
            <td class="description">
              <span>{{$nilai_sholat->deskripsi_gerakan_sholat}}</span>
            </td>
          </tr>
          <tr class="sikap">
            <td>4</td>
            <td>
              Dzikir Bacaan Sholat
            </td>
            <td style="text-align:center;">{{$nilai_sholat->dzikir}}</td>
            <td class="description">
              <span>{{$nilai_sholat->deskripsi_dzikir}}</span>
            </td>
          </tr>
          @else
          <tr class="sikap">
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
          </tr>
          @endif
        </tbody>
      </table>
      <table cellspacing="0">
        <tr>
          <td colspan="4" style="height: 30px;"><strong>2. HAFALAN</strong></td>
        </tr>
        <thead>
          <tr class="heading">
            <td style="width: 4%;">NO</td>
            <td style="width: 26%;">KOMPETENSI YANG DINILAI</td>
            <td style="width: 10%;">CAPAIAN</td>
            <td style="width: 60%;">DESKRIPSI</td>
          </tr>
        </thead>
        <tbody>
          @if($nilai_hafalan)
          <tr class="sikap">
            <td>1</td>
            <td>
              Hafalan Hadis
            </td>
            <td style="text-align:center;">{{$nilai_hafalan->hadis}}</td>
            <td class="description">
              <span>{{$nilai_hafalan->deskripsi_hadis}}</span>
            </td>
          </tr>
          <tr class="sikap">
            <td>2</td>
            <td>
              Hafalan Do'a
            </td>
            <td style="text-align:center;">{{$nilai_hafalan->doa}}</td>
            <td class="description">
              <span>{{$nilai_hafalan->deskripsi_doa}}</span>
            </td>
          </tr>
          <tr class="sikap">
            <td>3</td>
            <td>
              Hafalan Kata - Kata Hikmah
            </td>
            <td style="text-align:center;">{{$nilai_hafalan->hikmah}}</td>
            <td class="description">
              <span>{{$nilai_hafalan->deskripsi_hikmah}}</span>
            </td>
          </tr>
          @else
          <tr class="sikap">
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
          </tr>
          @endif
        </tbody>
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
        @if($nilai_t2q)
          <tr class="sikap">
            <td>1</td>
            <td>
            {{$nilai_t2q->tahsin_jilid}} {{$nilai_t2q->tahsin_halaman}}
            </td>
            <td style="text-align:center;">{{$nilai_t2q->tahsin_nilai}}</td>
            <td class="description">
              @if($nilai_t2q->tahfidz_nilai < 85)
              <span>Ananda sudah menguasai sebagian besar kompetensi tahsin dengan baik, terutama {{$nilai_t2q->tahsin_kelebihan}}. Perlu peningkatan dalam {{$nilai_t2q->tahsin_kekurangan}}.</span>
              @elseif($nilai_t2q->tahfidz_nilai < 100)
              <span>Ananda sudah menguasai seluruh kompetensi tahsin dengan sangat baik, terutama {{$nilai_t2q->tahsin_kelebihan}}. Perlu peningkatan dalam {{$nilai_t2q->tahsin_kekurangan}}.</span>
              @endif 
            </td>
          </tr>
        @else
          <tr class="sikap">
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
          </tr>
        @endif
        <tr class="heading">
          <td style="width: 4%;">NO</td>
          <td style="width: 26%;">TAHFIDZ AL-QUR'AN</td>
          <td style="width: 10%;">CAPAIAN</td>
          <td style="width: 60%;">DESKRIPSI</td>
        </tr>
        @if($nilai_tahfidz)
          <tr class="sikap">
            <td>1</td>
            <td>
              Surah {{$nilai_tahfidz->tahfidz_surah}}
            </td>
            <td style="text-align:center;">{{$nilai_tahfidz->tahfidz_nilai}}</td>
            <td class="description">
              @if($nilai_tahfidz->tahfidz_nilai < 85)
              <span>Ananda sudah menguasai sebagian kompetensi hafalan dengan baik terutama {{$nilai_tahfidz->tahfidz_kelebihan}}. Perlu peningkatan dalam {{$nilai_tahfidz->tahfidz_kekurangan}}.</span>
              @elseif($nilai_tahfidz->tahfidz_nilai < 100)
              <span>Ananda sudah menguasai seluruh kompetensi hafalan dengan sangat baik terutama {{$nilai_tahfidz->tahfidz_kelebihan}}. Perlu peningkatan dalam {{$nilai_tahfidz->tahfidz_kekurangan}}.</span>
              @endif 
            </td>
          </tr>
        @else
          <tr class="sikap">
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
          </tr>
        @endif
      </table>
      <table cellspacing="0">
        <tr>
          <td style="height: 30px;"><strong>G. CATATAN TAHSIN TAHFIDZ AL-QUR'AN</strong></td>
        </tr>
        <tr class="sikap">
          <td class="description">
            @if($catatan_t2q)
            <span>{{$catatan_t2q->catatan}}</span>
            @else
            -
            @endif
          </td>
        </tr>
      </table>
      <table cellspacing="0">
        <tr>
          <td colspan="4" style="height: 30px;"><strong>H. EKSTRAKULIKULER</strong></td>
        </tr>
        <thead>
          <tr class="heading">
            <td style="width: 4%;">NO</td>
            <td style="width: 26%;">KOMPETENSI YANG DINILAI</td>
            <td style="width: 10%;">CAPAIAN</td>
            <td style="width: 60%;">DESKRIPSI</td>
          </tr>
        </thead>
        <tbody>
          <tr class="sikap">
            <td>1</td>
            <td>
              Pramuka
            </td>
            @if($pramuka)
              <td style="text-align:center;">
                @if($pramuka->nilai == 4)
                SB
                @elseif($pramuka->nilai == 3)
                B
                @elseif($pramuka->nilai == 2)
                C
                @else
                K
                @endif</td>
              <td class="description">
                <span>
                {{$pramuka->deskripsi}}
                </span>
              </td>
            @else
              <td>-</td>
              <td>-</td>
            @endif
          </tr>
          @foreach($ekstrakulikuler as $nilai_ekstra)
          <tr class="sikap">
            <td>2</td>
            <td>{{$nilai_ekstra->ekstrakulikuler->nama_ekstrakulikuler}}</td>
            <td style="text-align:center;">
                @if($nilai_ekstra->nilai == 4)
                SB
                @elseif($nilai_ekstra->nilai == 3)
                B
                @elseif($nilai_ekstra->nilai == 2)
                C
                @elseif($nilai_ekstra->nilai == 1)
                K
                @else
                -
                @endif
            </td>
            <td class="description">
                <span>{{$nilai_ekstra->deskripsi}}</span>
            </td>
          @endforeach
          </tr>
        </tbody>
      </table>
      <table cellspacing="0">
        <tr>
          <td colspan="4" style="height: 30px;"><strong>I. BUDAYA NILAI PRIMA</strong></td>
        </tr>
        <thead >
          <tr class="heading">
            <td style="width: 4%;">NO</td>
            <td style="width: 26%;">BUDAYA</td>
            <td style="width: 10%;">CAPAIAN</td>
            <td style="width: 60%;">DESKRIPSI</td>
          </tr>
        </thead>
        <tbody>
          @if($proactive->count() != 0)
            <tr class="sikap">
              <td>1</td>
              <td>
                Proactive
              </td>
              @php
              $hasil_proactive = round($proactive->sum('nilai')/$proactive->count(),1);
              @endphp
              <td style="text-align:center;">
                @if($hasil_proactive >= 3.1)
                SB
                @elseif($hasil_proactive >= 2.1)
                B
                @else
                C
                @endif
              </td>
              <td class="description">
              <span>
                Ananda
                @if($proactive->where('nilai',4)->count() != 0)
                    sangat baik dalam hal
                    @foreach($proactive->where('nilai',4) as $ki2)
                        @if(!$loop->last)
                          {{$ki2->rencana_proactive->butir_sikap->butir_sikap}},
                        @else
                          {{$ki2->rencana_proactive->butir_sikap->butir_sikap}}.
                        @endif
                    @endforeach
                @endif

                @if($proactive->where('nilai',3)->count() != 0)
                  @if($proactive->where('nilai',4)->count() == 0)
                    baik dalam hal
                  @else
                    Baik dalam hal
                  @endif
                    @foreach($proactive->where('nilai',3) as $ki2)
                        @if(!$loop->last)
                          {{$ki2->rencana_proactive->butir_sikap->butir_sikap}},
                        @else
                          {{$ki2->rencana_proactive->butir_sikap->butir_sikap}}.
                        @endif
                    @endforeach
                @endif
                
                @if($proactive->where('nilai',2)->count() != 0 || $proactive->where('nilai',1)->count() != 0)
                  @if($proactive->where('nilai',4)->count() == 0 && $proactive->where('nilai',3)->count() == 0)
                    cukup dalam hal
                  @else
                    Cukup dalam hal
                  @endif
                    @foreach($proactive->where('nilai', 2) as $ki2)
                        @if(!$loop->last)
                          {{$ki2->rencana_proactive->butir_sikap->butir_sikap}},
                        @else
                          @if($proactive->where('nilai',1)->count() == 0)
                            {{$ki2->rencana_proactive->butir_sikap->butir_sikap}}.
                          @else
                            {{$ki2->rencana_proactive->butir_sikap->butir_sikap}},
                          @endif
                        @endif
                    @endforeach

                    @foreach($proactive->where('nilai', 1) as $ki2)
                        @if(!$loop->last)
                          {{$ki2->rencana_proactive->butir_sikap->butir_sikap}},
                        @else
                          {{$ki2->rencana_proactive->butir_sikap->butir_sikap}}.
                        @endif
                    @endforeach
                @endif
              </span>
              </td>
            </tr>
          @else
            <tr class="sikap">
              <td>1</td>
              <td>
                Proactive
              </td>
              <td style="text-align:center;">-</td>
              <td>-</td>
            </tr>
          @endif

          @if($responsible->count() != 0)
            <tr class="sikap">
              <td>2</td>
              <td>
                Responsible
              </td>
              @php
              $hasil_responsible = round($responsible->sum('nilai')/$responsible->count(),1);
              @endphp
              <td style="text-align:center;">
                @if($hasil_responsible >= 3.1)
                SB
                @elseif($hasil_responsible >= 2.1)
                B
                @else
                C
                @endif
              </td>
              <td class="description">
              <span>
                Ananda
                @if($responsible->where('nilai',4)->count() != 0)
                    sangat baik dalam hal
                    @foreach($responsible->where('nilai',4) as $ki2)
                        @if(!$loop->last)
                          {{$ki2->rencana_responsible->butir_sikap->butir_sikap}},
                        @else
                          {{$ki2->rencana_responsible->butir_sikap->butir_sikap}}.
                        @endif
                    @endforeach
                @endif

                @if($responsible->where('nilai',3)->count() != 0)
                  @if($responsible->where('nilai',4)->count() == 0)
                    baik dalam hal
                  @else 
                    Baik dalam hal 
                  @endif
                    @foreach($responsible->where('nilai',3) as $ki2)
                        @if(!$loop->last)
                          {{$ki2->rencana_responsible->butir_sikap->butir_sikap}},
                        @else
                          {{$ki2->rencana_responsible->butir_sikap->butir_sikap}}.
                        @endif
                    @endforeach
                @endif
                
                @if($responsible->where('nilai',2)->count() != 0 || $responsible->where('nilai',1)->count() != 0)
                  @if($responsible->where('nilai',4)->count() == 0 && $responsible->where('nilai',3)->count() == 0)
                    cukup dalam hal
                  @else 
                    Cukup dalam hal 
                  @endif
                    @foreach($responsible->where('nilai', 2) as $ki2)
                        @if(!$loop->last)
                          {{$ki2->rencana_responsible->butir_sikap->butir_sikap}},
                        @else
                          @if($responsible->where('nilai',1)->count() == 0)
                            {{$ki2->rencana_responsible->butir_sikap->butir_sikap}}.
                          @else
                            {{$ki2->rencana_responsible->butir_sikap->butir_sikap}},
                          @endif
                        @endif
                    @endforeach

                    @foreach($responsible->where('nilai', 1) as $ki2)
                        @if(!$loop->last)
                          {{$ki2->rencana_responsible->butir_sikap->butir_sikap}},
                        @else
                          {{$ki2->rencana_responsible->butir_sikap->butir_sikap}}.
                        @endif
                    @endforeach
                @endif
              </span>
              </td>
            </tr>
          @else
            <tr class="sikap">
              <td>2</td>
              <td>
                Responsible
              </td>
              <td style="text-align:center;">-</td>
              <td>-</td>
            </tr>
          @endif
        
          @if($innovative->count() != 0)
            <tr class="sikap">
              <td>3</td>
              <td>
                Innovative
              </td>
              @php
              $hasil_innovative = round($innovative->sum('nilai')/$innovative->count(),1);
              @endphp
              <td style="text-align:center;">
                @if($hasil_innovative >= 3.1)
                SB
                @elseif($hasil_innovative >= 2.1)
                B
                @else
                C
                @endif
              </td>
              <td class="description">
              <span>
                Ananda
                @if($innovative->where('nilai',4)->count() != 0)
                    sangat baik dalam hal
                    @foreach($innovative->where('nilai',4) as $ki2)
                        @if(!$loop->last)
                          {{$ki2->rencana_innovative->butir_sikap->butir_sikap}},
                        @else
                          {{$ki2->rencana_innovative->butir_sikap->butir_sikap}}.
                        @endif
                    @endforeach
                @endif

                @if($innovative->where('nilai',3)->count() != 0)
                  @if($innovative->where('nilai',4)->count() == 0)
                    baik dalam hal
                  @else 
                    Baik dalam hal
                  @endif
                    @foreach($innovative->where('nilai',3) as $ki2)
                        @if(!$loop->last)
                          {{$ki2->rencana_innovative->butir_sikap->butir_sikap}},
                        @else
                          {{$ki2->rencana_innovative->butir_sikap->butir_sikap}}.
                        @endif
                    @endforeach
                @endif
                
                @if($innovative->where('nilai',2)->count() != 0 || $innovative->where('nilai',1)->count() != 0)
                  @if($innovative->where('nilai',4)->count() == 0 && $innovative->where('nilai',3)->count() == 0)
                    cukup dalam hal
                  @else 
                    Cukup dalam hal
                  @endif
                    @foreach($innovative->where('nilai', 2) as $ki2)
                        @if(!$loop->last)
                          {{$ki2->rencana_innovative->butir_sikap->butir_sikap}},
                        @else
                          @if($innovative->where('nilai',1)->count() == 0)
                            {{$ki2->rencana_innovative->butir_sikap->butir_sikap}}.
                          @else
                            {{$ki2->rencana_innovative->butir_sikap->butir_sikap}},
                          @endif
                        @endif
                    @endforeach

                    @foreach($innovative->where('nilai', 1) as $ki2)
                        @if(!$loop->last)
                          {{$ki2->rencana_innovative->butir_sikap->butir_sikap}},
                        @else
                          {{$ki2->rencana_innovative->butir_sikap->butir_sikap}}.
                        @endif
                    @endforeach
                @endif
              </span>
              </td>
            </tr>
          @else
            <tr class="sikap">
              <td>3</td>
              <td>
                Innovative
              </td>
              <td style="text-align:center;">-</td>
              <td>-</td>
            </tr>
          @endif

          @if($modest->count() != 0)
            <tr class="sikap">
              <td>4</td>
              <td>
                Modest
              </td>
              @php
              $hasil_modest = round($modest->sum('nilai')/$modest->count(),1);
              @endphp
              <td style="text-align:center;">
                @if($hasil_modest >= 3.1)
                SB
                @elseif($hasil_modest >= 2.1)
                B
                @else
                C
                @endif
              </td>
              <td class="description">
              <span>
                Ananda
                @if($modest->where('nilai',4)->count() != 0)
                    sangat baik dalam hal
                    @foreach($modest->where('nilai',4) as $ki2)
                        @if(!$loop->last)
                          {{$ki2->rencana_modest->butir_sikap->butir_sikap}},
                        @else
                          {{$ki2->rencana_modest->butir_sikap->butir_sikap}}.
                        @endif
                    @endforeach
                @endif

                @if($modest->where('nilai',3)->count() != 0)
                  @if($modest->where('nilai',4)->count() == 0)
                    baik dalam hal
                  @else
                    Baik dalam hal 
                  @endif
                    @foreach($modest->where('nilai',3) as $ki2)
                        @if(!$loop->last)
                          {{$ki2->rencana_modest->butir_sikap->butir_sikap}},
                        @else
                          {{$ki2->rencana_modest->butir_sikap->butir_sikap}}.
                        @endif
                    @endforeach
                @endif
                
                @if($modest->where('nilai',2)->count() != 0 || $modest->where('nilai',1)->count() != 0)
                  @if($modest->where('nilai',4)->count() == 0 && $modest->where('nilai',3)->count() == 0)
                    cukup dalam hal
                  @else
                    Cukup dalam hal 
                  @endif
                    @foreach($modest->where('nilai', 2) as $ki2)
                        @if(!$loop->last)
                          {{$ki2->rencana_modest->butir_sikap->butir_sikap}},
                        @else
                          @if($modest->where('nilai',1)->count() == 0)
                            {{$ki2->rencana_modest->butir_sikap->butir_sikap}}.
                          @else
                            {{$ki2->rencana_modest->butir_sikap->butir_sikap}},
                          @endif
                        @endif
                    @endforeach

                    @foreach($modest->where('nilai', 1) as $ki2)
                        @if(!$loop->last)
                          {{$ki2->rencana_modest->butir_sikap->butir_sikap}},
                        @else
                          {{$ki2->rencana_modest->butir_sikap->butir_sikap}}.
                        @endif
                    @endforeach
                @endif
              </span>
              </td>
            </tr>
          @else
            <tr class="sikap">
              <td>4</td>
              <td>
                Modest
              </td>
              <td style="text-align:center;">-</td>
              <td>-</td>
            </tr>
          @endif

          @if($achievement->count() != 0)
            <tr class="sikap">
              <td>5</td>
              <td>
                Achievement
              </td>
              @php
              $hasil_achievement = round($achievement->sum('nilai')/$achievement->count(),1);
              @endphp
              <td style="text-align:center;">
                @if($hasil_achievement >= 3.1)
                SB
                @elseif($hasil_achievement >= 2.1)
                B
                @else
                C
                @endif
              </td>
              <td class="description">
              <span>
                Ananda
                @if($achievement->where('nilai',4)->count() != 0)
                    sangat baik dalam hal
                    @foreach($achievement->where('nilai',4) as $ki2)
                        @if(!$loop->last)
                          {{$ki2->rencana_achievement->butir_sikap->butir_sikap}},
                        @else
                          {{$ki2->rencana_achievement->butir_sikap->butir_sikap}}.
                        @endif
                    @endforeach
                @endif

                @if($achievement->where('nilai',3)->count() != 0)
                  @if($achievement->where('nilai',4)->count() == 0)
                    baik dalam hal
                  @else
                    Baik dalam hal 
                  @endif
                    @foreach($achievement->where('nilai',3) as $ki2)
                        @if(!$loop->last)
                          {{$ki2->rencana_achievement->butir_sikap->butir_sikap}},
                        @else
                          {{$ki2->rencana_achievement->butir_sikap->butir_sikap}}.
                        @endif
                    @endforeach
                @endif
                
                @if($achievement->where('nilai',2)->count() != 0 || $achievement->where('nilai',1)->count() != 0)
                  @if($achievement->where('nilai',4)->count() == 0 && $achievement->where('nilai',3)->count() == 0)
                    cukup dalam hal
                  @else
                    Cukup dalam hal 
                  @endif
                    @foreach($achievement->where('nilai', 2) as $ki2)
                        @if(!$loop->last)
                          {{$ki2->rencana_achievement->butir_sikap->butir_sikap}},
                        @else
                          @if($achievement->where('nilai',1)->count() == 0)
                            {{$ki2->rencana_achievement->butir_sikap->butir_sikap}}.
                          @else
                            {{$ki2->rencana_achievement->butir_sikap->butir_sikap}},
                          @endif
                        @endif
                    @endforeach

                    @foreach($achievement->where('nilai', 1) as $ki2)
                        @if(!$loop->last)
                          {{$ki2->rencana_achievement->butir_sikap->butir_sikap}},
                        @else
                          {{$ki2->rencana_achievement->butir_sikap->butir_sikap}}.
                        @endif
                    @endforeach
                @endif
              </span>
              </td>
            </tr>
          @else
            <tr class="sikap">
              <td>5</td>
              <td>
                Achievement
              </td>
              <td style="text-align:center;">-</td>
              <td>-</td>
            </tr>
          @endif
        </tbody>
      </table>
      <table cellspacing="0">
        <tr>
          <td style="height: 30px;"><strong>J. CATATAN WALI KELAS</strong></td>
        </tr>
        <tr class="sikap">
          <td class="description">
            @if($catatan_umum)
            <span>{{$catatan_umum->catatan}}</span>
            @else
            -
            @endif
          </td>
        </tr>
      </table>
      <table cellspacing="0">
        <tr>
          <td style="height: 30px;"><strong>K. KETIDAKHADIRAN</strong></td>
        </tr>
        @if($kehadiran)
        <tr class="sikap">
          <td width="25%">Sakit</td>
          <td class="text-center" width="2%">:</td>
          <td width="13%">{{$kehadiran->sakit}} Hari</td>
        </tr>
        <tr class="sikap">
          <td width="25%">Izin</td>
          <td class="text-center" width="2%">:</td>
          <td width="13%">{{$kehadiran->izin}} Hari</td>
        </tr>
        <tr class="sikap">
          <td width="25%">Tanpa Keterangan</td>
          <td class="text-center" width="2%">:</td>
          <td width="13%">{{$kehadiran->tanpa_keterangan}} Hari</td>
        </tr>
        @else
        <tr class="sikap">
          <td width="25%">Sakit</td>
          <td class="text-center" width="2%">:</td>
          <td width="13%">-</td>
        </tr>
        <tr class="sikap">
          <td width="25%">Izin</td>
          <td class="text-center" width="2%">:</td>
          <td width="13%">-</td>
        </tr>
        <tr class="sikap">
          <td width="25%">Tanpa Keterangan</td>
          <td class="text-center" width="2%">:</td>
          <td width="13%">-</td>
        </tr>
        @endif
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