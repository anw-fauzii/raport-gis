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
                <table class="table table-bordered table-striped">
                  <thead class="bg-info">
                    <tr>
                      <th rowspan="2" class="text-center" style="width: 50px;">No</th>
                      <th rowspan="2" class="text-center">Nama Siswa</th>
                      <th rowspan="2" class="text-center">KI1</th>
                      <th rowspan="2" class="text-center">KI2</th>
                      <th colspan="{{$data_pembelajaran->count()}}" class="text-center">KI3</th>
                      <th colspan="3" class="text-center">Presensi</th>
                    </tr>
                    <tr>
                      @foreach($data_pembelajaran as $mapel)
                      <th class="text-center">{{$mapel->mapel->nama_mapel}}</th>
                      @endforeach
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
                      @foreach($data_pembelajaran as $mapel)
                      <td>{{$anggota_kelas->data_nilai_ki_3}}</td>
                      @else
                      <td>-</td>
                      @endif
                      @endforeach
                      
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