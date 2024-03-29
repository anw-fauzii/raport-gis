@extends('adminlte::page')

@section('title', 'Nilai Ekstrakulikuler')

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
                <th>Nama Ekstrakulikuler</th>
                <th>Status Penilaian</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 0; ?>
              @forelse($data_ekstrakulikuler as $ekstrakulikuler)
              <?php $no++; ?>
              <tr>
                <td>{{$no}}</td>
                <td>{{$ekstrakulikuler->nama_ekstrakulikuler}}</td>
                <td>
                  @if($cek_nilai->where('ekstrakulikuler_id',$ekstrakulikuler->id)->count() == 0)
                  <span class="badge badge-danger">Belum Ada yang di nilai</span>
                  @else
                  <span class="badge badge-success">Sudah Dinilai</span>
                  @endif
                </td>
                <td>
                    <a href="{{ route('penilaian-ekstrakulikuler.edit', Crypt::encrypt($ekstrakulikuler->id)) }}" type="button" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i>
                    </a>
                </td>
              </tr>      
              @empty
              <tr>
                <td colspan="4" class="text-center">Tidak ada data</td>
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