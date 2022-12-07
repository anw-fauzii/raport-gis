@extends('adminlte::page')

@section('title', 'KKM Mata Pelajaran')

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
    
<div class="container-fluid">
  <!-- ./row -->
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title"><i class="fas fa-greater-than-equal"></i> {{$title}}</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modal-tambah">
              <i class="fas fa-plus"></i>
            </button>
            <button type="button" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modal-import">
              <i class="fas fa-upload"></i>
            </button>
          </div>
        </div>

        @include('admin.kkm.import')

        @include('admin.kkm.create')

        <div class="card-body">
          <div class="table-responsive">
            <table id="example1" class="table table-striped table-valign-middle table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Mata Pelajaran</th>
                  <th>Semester</th>
                  <th>KKM</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 0; ?>
                @foreach($data_kkm as $kkm)
                <?php $no++; ?>
                <tr>
                  <td>{{$no}}</td>
                  <td>{{$kkm->mapel->nama_mapel}}</td>
                  <td>Tingkat {{$kkm->tingkat}}</td>
                  <td>{{$kkm->kkm}}</td>
                  <td>
                    <form action="{{ route('kkm.destroy', $kkm->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="button" class="btn btn-warning btn-sm mt-1" data-toggle="modal" data-target="#modal-edit{{$kkm->id}}">
                        <i class="fas fa-pencil-alt"></i>
                      </button>
                      <button type="submit" class="btn btn-danger btn-sm mt-1" onclick="return confirm('Hapus {{$title}} ?')">
                        <i class="fas fa-trash-alt"></i>
                      </button>
                    </form>
                  </td>
                </tr>

                @include('admin.kkm.edit')

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
</div>

@stop

@section('css')
<link rel="stylesheet" href="{{asset('vendor/datatables/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{asset('vendor/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@stop

@section('js')
<script src="{{asset('vendor/datatables/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('vendor/datatables/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('vendor/select2/js/select2.full.min.js')}}"></script>

<script>
  $(function () {
    $("#example1").DataTable();
    $('.select2').select2({
      theme : 'bootstrap4',
    });
  });
  function submitForm(btn) {
    btn.disabled = true;  
    btn.form.submit();
  }
</script>
@stop