@extends('adminlte::page')

@section('title', 'Nilai Tahsin dan Tahfidz')

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
                <th>Tingkat Kelas</th>
                <th>Jumlah Rencana Penilaian</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 0; ?>
              @foreach($data_rencana_penilaian as $penilaian)
              <?php $no++; ?>
              <tr>
                <td>{{$no}}</td>
                <td>Tingkat {{$penilaian->tingkat}}</td>
                <td>
                  @if($cek_nilai->where('tingkat',$penilaian->tingkat)->where('tahsin_nilai', !NULL)->count() == 0)
                  <span class="badge badge-danger">Belum Ada yang di nilai</span>
                  @else
                  <span class="badge badge-success">Sudah Dinilai</span>
                  @endif
                </td>
                <td>
                    <a href="{{ route('penilaian-tahsin.edit', $penilaian->tingkat) }}" type="button" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i>
                    </a>
                </td>
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
  function submitForm(btn) {
    btn.disabled = true;  
    btn.form.submit();
  }
</script>
@stop