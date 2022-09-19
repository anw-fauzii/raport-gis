@extends('adminlte::page')

@section('title', 'Tahun Pelajaran')

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
              <h3 class="card-title"><i class="fas fa-calendar-week"></i> {{$title}}</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modal-tambah">
                  <i class="fas fa-plus"></i>
                </button>
              </div>
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <table id="example1" class="table table-striped table-valign-middle table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Tahun Pelajaran</th>
                      <th>Semester</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 0; ?>
                    @foreach($data_tapel as $tapel)
                    <?php $no++; ?>
                    <tr>
                      <td>{{$no}}</td>
                      <td>{{$tapel->tahun_pelajaran}}</td>
                      <td>
                        @if($tapel->semester == 1)
                        Semester Ganjil
                        @else
                        Semester Genap
                        @endif
                      </td>
                      <td>
                      <form action="{{ route('tahun-pelajaran.destroy', $tapel->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="button" class="btn btn-primary btn-sm mt-1" data-toggle="modal" data-target="#modal-edit{{$tapel->id}}">
                            <i class="fas fa-pencil-alt"></i> Edit
                          </button>
                          <button type="submit" class="btn btn-danger btn-sm mt-1" onclick="return confirm('Hapus Tahun Pelajaran ?')">
                            <i class="fas fa-trash-alt"></i> Hapus
                          </button>
                        </form>
                      </td>@include('admin.tapel.edit')
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
@include('admin.tapel.create')
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