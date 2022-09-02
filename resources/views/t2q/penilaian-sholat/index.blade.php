@extends('adminlte::page')

@section('title', 'Data Guru')

@section('content_header')
    
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">{{$title}}</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item "><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item active">{{$title}}</li>
      </ol>
    </div><!-- /.col -->
  </div><!-- /.row -->
</div><!-- /.container-fluid -->

@stop

@section('content')

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><i class="fas fa-book"></i> {{$title}}</h3>
        <div class="card-tools">
          <form action="{{ route('penilaian-k1.create') }}" method="GET">
            @csrf
            <input type="hidden" name="pembelajaran_id" value="#">
            <button type="submit" class="btn btn-tool btn-sm">
              <i class="fas fa-plus"></i>
            </button>
          </form>
        </div>
      </div>

      <div class="card-body">
        <div class="table-responsive">
          <table id="example1" class="table table-striped table-valign-middle table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Nilai</th>
                <th>Deskripsi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 0; ?>
              @foreach($data_anggota_kelas->sortBy('siswa.nama_lengkap') as $anggota_kelas)
              <?php $no++; ?>
              <tr>
                <td class="text-center" style="vertical-align: middle;">{{$no}}</td>
                <td style="vertical-align: middle;">{{$anggota_kelas->siswa->nis}}</td>
                <td>{{$anggota_kelas->siswa->nama_lengkap}}</td>
                @foreach($anggota_kelas->data_nilai as $nilai)
                  @if($nilai)
                    <td>{{$nilai->nilai}}</td>
                    <td>{{$nilai->deskripsi}}</td>
                  @else
                    <td>-</td>
                    <td>-</td>
                  @endif
                @endforeach
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- /.card -->
  </div>

</div>

@stop

@section('css')
<link rel="stylesheet" href="{{asset('vendor/datatables/css/dataTables.bootstrap4.css')}}">
@stop

@section('js')
<script src="{{asset('vendor/datatables/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('vendor/datatables/js/dataTables.bootstrap4.js')}}"></script>

<script>
  $(function () {
    $("#example1").DataTable();
  });
</script>
@stop