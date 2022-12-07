@extends('adminlte::page')

@section('title', 'Data Ekstrakulikuler')

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
        <h3 class="card-title"><i class="fas fa-layer-group"></i> {{$title}}</h3>
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
                <th>Tahun Ajaran</th>
                <th>Ekstrakulikuler</th>
                <th>Pendamping</th>
                <th>Jml Anggota</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 0; ?>
              @foreach($data_ekstrakulikuler as $ekstrakulikuler)
              <?php $no++; ?>
              <tr>
                <td>{{$no}}</td>
                <td>{{$ekstrakulikuler->tapel->tahun_pelajaran}}
                  @if($ekstrakulikuler->tapel->semester == 1)
                  Ganjil
                  @else
                  Genap
                  @endif
                </td>
                <td>{{$ekstrakulikuler->nama_ekstrakulikuler}}</td>
                <td>{{$ekstrakulikuler->guru->nama_lengkap}}, {{$ekstrakulikuler->guru->gelar}}</td>
                <td>
                  <a href="{{ route('ekstrakulikuler.show', $ekstrakulikuler->id) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-list"></i> {{$ekstrakulikuler->jumlah_anggota}} Siswa
                  </a>
                </td>
                <td>
                  <form action="{{ route('ekstrakulikuler.destroy', $ekstrakulikuler->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-warning btn-sm mt-1" data-toggle="modal" data-target="#modal-edit{{$ekstrakulikuler->id}}">
                      <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button type="submit" class="btn btn-danger btn-sm mt-1" onclick="return confirm('Hapus {{$title}} ?')">
                      <i class="fas fa-trash-alt"></i>
                    </button>
                  </form>
                </td>
              </tr>
              @include('admin.ekstrakulikuler.edit')
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- /.card -->
  </div>

</div>
@include('admin.ekstrakulikuler.create')
@stop

@section('css')
<link rel="stylesheet" href="{{asset('vendor/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/datatables/css/dataTables.bootstrap4.css')}}">
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
    })
  });
  function submitForm(btn) {
    btn.disabled = true;  
    btn.form.submit();
  }
</script>
@stop