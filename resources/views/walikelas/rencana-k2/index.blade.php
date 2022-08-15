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
            <h3 class="card-title"><i class="fas fa-user-check"></i> {{$title}}</h3>
            <div class="card-tools">
            <button type="button" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modal-tambah">
              <i class="fas fa-plus"></i>
            </button>
          </div>
        </div>
            @csrf
            <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                <thead class="bg-info">
                    <tr>
                    <th class="text-center" style="width: 5%;">No</th>
                    <th class="text-center" style="width: 5%;">Kode</th>
                    <th class="text-center" style="width: 35%;">Butir Spiritual</th>
                    <th class="text-center" style="width: 5%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    @foreach($data_rencana_penilaian as $data)
                    <tr>
                    <td class="text-center">{{$no++}}</td>
                    <td class="text-center">{{$data->kode}}</td>
                    <td>{{$data->butir_sikap}}</td>
                    <td class="text-center"><form action="{{ route('rencana-k2.destroy', $data->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm mt-1" onclick="return confirm('Hapus {{$title}} ?')">
                      <i class="fas fa-trash-alt"></i>
                    </button>
                  </form></td>
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
@include('walikelas.rencana-k2.create')
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