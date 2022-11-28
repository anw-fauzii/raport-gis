@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    
<div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Leger Nilai Siswa</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">LEGER Nilai Siswa</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->

@stop

@section('content')

    <div class="container-fluid">
      <!-- ./row -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-table"></i> {{$title}}</h3>
              <div class="card-tools">
                <a href="#" class="btn btn-tool btn-sm" onclick="return confirm('Download {{$title}} ?')">
                  <i class="fas fa-download"></i>
                </a>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped" width="300%">
                  <thead class="bg-info">
                    <tr>
                      <th rowspan="2" class="text-center" style="width: 50px;">No</th>
                      <th rowspan="2" class="text-center">Nama Siswa</th>
                      <th rowspan="2" class="text-center">KI1</th>
                      <th rowspan="2" class="text-center">KI2</th>
                      <th colspan="{{$mapel_k3->count()}}" class="text-center">KI3</th>
                      <th colspan="{{$mapel_k3->count()}}" class="text-center">KI4</th>
                      <th colspan="{{$mapel_kokulikuler->count()}}" class="text-center">Kokulikuler</th>
                      <th colspan="{{$mapel_mulok->count()}}" class="text-center">Mulok</th>
                      <th colspan="4" class="text-center">Pel.Sholat</th>
                      <th colspan="3" class="text-center">Hafalan</th>
                      <th rowspan="2" class="text-center">Tahsin</th>
                      <th rowspan="2" class="text-center">Tahfidz</th>
                      <th colspan="5" class="text-center">Nilai Prima</th>
                      <th colspan="3" class="text-center">Presensi</th>
                    </tr>
                    <tr>
                      @foreach($mapel_k3 as $mapel)
                      <th class="text-center">{{$mapel->mapel->ringkasan_mapel}}</th>
                      @endforeach
                      @foreach($mapel_k3 as $mapel)
                      <th class="text-center">{{$mapel->mapel->ringkasan_mapel}}</th>
                      @endforeach
                      @foreach($mapel_kokulikuler as $mapel)
                      <th class="text-center">{{$mapel->mapel->ringkasan_mapel}}</th>
                      @endforeach
                      @foreach($mapel_mulok as $mapel)
                      <th class="text-center">{{$mapel->mapel->ringkasan_mapel}}</th>
                      @endforeach
                      <th class="text-center">Wudhu</th>
                      <th class="text-center">B. Sholat</th>
                      <th class="text-center">G. Sholat</th>
                      <th class="text-center">Dzikir</th>
                      <th class="text-center">Hadis</th>
                      <th class="text-center">Doa</th>
                      <th class="text-center">Hikmah</th>
                      <th class="text-center">P</th>
                      <th class="text-center">R</th>
                      <th class="text-center">I</th>
                      <th class="text-center">M</th>
                      <th class="text-center">A</th>
                      <th class="text-center">S</th>
                      <th class="text-center">I</th>
                      <th class="text-center">A</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 0; ?>
                    @foreach($data_anggota_kelas->sortBy('siswa.nama_lengkap') as $anggota_kelas)
                    <?php $no++; ?>
                    <tr>
                      <td class="text-center">{{$no}}</td>
                      <td>{{$anggota_kelas->siswa->nama_lengkap}}</td>
                      <td>
                        @if($anggota_kelas->data_nilai_ki_1 >= 3.1)
                        SB
                        @elseif($anggota_kelas->data_nilai_ki_1 >= 2.1)
                        B
                        @else
                        C
                        @endif
                      </td>
                      <td>
                        @if($anggota_kelas->data_nilai_ki_2 >= 3.1)
                        SB
                        @elseif($anggota_kelas->data_nilai_ki_2 >= 2.1)
                        B
                        @else
                        C
                        @endif
                      </td>
                      @foreach($mapel_k3 as $mapel)
                        <td>
                        @foreach($anggota_kelas->data_nilai_ki_3->where('pembelajaran_id',$mapel->id) as $da)
                          @if($da->nilai_raport)
                            {{$da->nilai_raport}}
                          @else
                            
                          @endif
                        @endforeach
                        </td>
                      @endforeach

                      @foreach($mapel_k3 as $mapel)
                        <td>
                        @foreach($anggota_kelas->data_nilai_ki_4->where('pembelajaran_id',$mapel->id) as $da)
                          @if($da->nilai_raport)
                            {{$da->nilai_raport}}
                          @else
                            
                          @endif
                        @endforeach
                        </td>
                      @endforeach

                      @foreach($mapel_kokulikuler as $mapel)
                        <td>
                        @foreach($anggota_kelas->data_nilai_kokulikuler->where('pembelajaran_id',$mapel->id) as $da)
                          @if($da->nilai_raport)
                            {{$da->nilai_raport}}
                          @else
                            
                          @endif
                        @endforeach
                        </td>
                      @endforeach
                      
                      @foreach($mapel_mulok as $mapel)
                        <td>
                        @foreach($anggota_kelas->data_nilai_mulok->where('pembelajaran_id',$mapel->id) as $da)
                          @if($da->nilai_raport)
                            {{$da->nilai_raport}}
                          @else
                            
                          @endif
                        @endforeach
                        </td>
                      @endforeach

                      @if($anggota_kelas->data_nilai_sholat)
                      <td>{{$anggota_kelas->data_nilai_sholat->praktik_wudhu}}</td>
                      <td>{{$anggota_kelas->data_nilai_sholat->bacaan_sholat}}</td>
                      <td>{{$anggota_kelas->data_nilai_sholat->gerakan_sholat}}</td>
                      <td>{{$anggota_kelas->data_nilai_sholat->dzikir}}</td>
                      @else
                      <td> </td>
                      <td> </td>
                      <td> </td>
                      <td> </td>
                      @endif

                      @if($anggota_kelas->data_nilai_hafalan)
                      <td>{{$anggota_kelas->data_nilai_hafalan->hadis}}</td>
                      <td>{{$anggota_kelas->data_nilai_hafalan->doa}}</td>
                      <td>{{$anggota_kelas->data_nilai_hafalan->hikmah}}</td>
                      @else
                      <td> </td>
                      <td> </td>
                      <td> </td>
                      @endif

                      @if($anggota_kelas->data_nilai_t2q)
                      <td>{{$anggota_kelas->data_nilai_t2q->tahsin_nilai}}</td>
                      <td>{{$anggota_kelas->data_nilai_t2q->tahfidz_nilai}}</td>
                      @else
                      <td> </td>
                      <td> </td>
                      @endif
                      
                      <td>
                        @if($anggota_kelas->data_nilai_proactive >= 3.1)
                        SB
                        @elseif($anggota_kelas->data_nilai_proactive >= 2.1)
                        B
                        @else
                        C
                        @endif
                      </td>

                      <td>
                        @if($anggota_kelas->data_nilai_responsible >= 3.1)
                        SB
                        @elseif($anggota_kelas->data_nilai_responsible >= 2.1)
                        B
                        @else
                        C
                        @endif
                      </td>

                      <td>
                        @if($anggota_kelas->data_nilai_innovative >= 3.1)
                        SB
                        @elseif($anggota_kelas->data_nilai_innovative >= 2.1)
                        B
                        @else
                        C
                        @endif
                      </td>

                      <td>
                        @if($anggota_kelas->data_nilai_modest >= 3.1)
                        SB
                        @elseif($anggota_kelas->data_nilai_modest >= 2.1)
                        B
                        @else
                        C
                        @endif
                      </td>

                      <td>
                        @if($anggota_kelas->data_nilai_achievement >= 3.1)
                        SB
                        @elseif($anggota_kelas->data_nilai_achievement >= 2.1)
                        B
                        @else
                        C
                        @endif
                      </td>

                      <td>{{$anggota_kelas->kehadiran->sakit}}</td>
                      <td>{{$anggota_kelas->kehadiran->izin}}</td>
                      <td>{{$anggota_kelas->kehadiran->tanpa_keterangan}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>

      </div>
      <!-- /.row -->
    </div>
    <!--/. container-fluid -->
@stop

@section('css')
    
@stop

@section('js')
    
@stop