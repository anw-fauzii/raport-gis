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
    
<!-- ./row -->
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title"><i class="fas fa-calendar-week"></i> {{$title}}</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modal-tambah">
              <i class="fas fa-plus"></i>
            </button>
          </div>
        </div>

        @include('admin.tanggal-raport.create')

        <div class="card-body">
          <div class="table-responsive">
            <table id="example1" class="table table-striped table-valign-middle table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Semester</th>
                  <th>Tempat</th>
                  <th>Tanggal Pembagian Raport</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 0; ?>
                @foreach($data_tgl_raport as $tgl_raport)
                <?php $no++; ?>
                <tr>
                  <td>{{$no}}</td>
                  <td>{{$tgl_raport->tapel->tahun_pelajaran}}
                    @if($tgl_raport->tapel->semester == 1)
                    Ganjil
                    @else
                    Genap
                    @endif
                  </td>
                  <td>{{$tgl_raport->tempat_penerbitan}}</td>
                  <td>{{ date('d-M-Y', strtotime($tgl_raport->tanggal_pembagian))}}</td>
                  <td>
                    <form action="{{ route('tanggal-raport.destroy', $tgl_raport->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="button" class="btn btn-warning btn-sm mt-1" data-toggle="modal" data-target="#modal-edit{{$tgl_raport->id}}">
                        <i class="fas fa-pencil-alt"></i>
                      </button>
                      <button type="submit" class="btn btn-danger btn-sm mt-1" onclick="return confirm('Hapus {{$title}} ?')">
                        <i class="fas fa-trash-alt"></i>
                      </button>
                    </form>
                  </td>
                </tr>
                
                @include('admin.tanggal-raport.edit')
                
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- /.card -->
    </div>

  </div>
<!-- /.row -->
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