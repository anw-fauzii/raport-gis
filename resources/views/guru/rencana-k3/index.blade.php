@extends('adminlte::page')

@section('title', 'Rencana KI-3 / Nilai Pengetahuan')

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
        <h3 class="card-title"><i class="fas fa-list-alt"></i> {{$title}}</h3>
      </div>

      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead class="bg-info">
              <tr>
                <th>No</th>
                <th>Mata Pelajaran</th>
                <th>Kelas</th>
                <th>Jumlah Rencana Penilaian</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 0; ?>
              @forelse($data_rencana_penilaian as $penilaian)
              <?php $no++; ?>
              <tr>
                <td>{{$no}}</td>
                <td>{{$penilaian->mapel->nama_mapel}}</td>
                <td>{{$penilaian->kelas->nama_kelas}}</td>
                <td>
                  @if($penilaian->jumlah_rencana_penilaian == 0)
                  <span class="badge badge-danger">Belum ada rencana penilaian</span>
                  @else
                  <span class="badge badge-success"><b>{{$penilaian->jumlah_rencana_penilaian}}</b> penilaian</span>
                  @endif
                </td>
                <td>
                  @if($penilaian->jumlah_rencana_penilaian == 0)
                  <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-tambah{{$penilaian->id}}">
                    <i class="fas fa-plus"></i>
                  </button>
                  @include('guru.rencana-k3.create')
                  @else
                  <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-show{{$penilaian->id}}">
                    <i class="fas fa-eye"></i>
                  </button>
                  <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-tambah{{$penilaian->id}}">
                    <i class="fas fa-pencil-alt"></i>
                  </button>
                  @include('guru.rencana-k3.create')
                  @include('guru.rencana-k3.show')
                  @endif
                </td>
              </tr>            
              @empty
              <tr>
                <td colspan="5" class="text-center">Belum ada pelajaran</td>
              </tr>
              @endforelse
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
  function submitForm(btn) {
    btn.disabled = true;  
    btn.form.submit();
  }
</script>
@stop