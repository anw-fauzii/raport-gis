@extends('adminlte::page')

@section('title', 'Data Siswa')

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
        <h3 class="card-title"><i class="fas fa-users"></i> {{$title}}</h3>
      </div>

      <div class="card-body">
        <div class="table-responsive">
          <table id="example1" class="table table-striped table-valign-middle table-hover">
            <thead>
              <tr class="text-center">
                <th>No</th>
                <th>NIS / NISN</th>
                <th>Nama Siswa</th>
                <th>Tanggal Lahir</th>
                <th>L/P</th>
                <th>Pembimbing T2Q</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 0; ?>
              @foreach($data_siswa as $list)
              <?php $no++; ?>
              <tr>
                <td>{{$no}}</td>
                <td>{{$list->siswa->nis}} / {{$list->siswa->nisn}}</td>
                <td>{{$list->siswa->nama_lengkap}}</td>
                <td>{{$list->siswa->tanggal_lahir->format('d-M-Y')}}</td>
                <td>{{$list->siswa->jenis_kelamin}}</td>
                <td>
                  @if($list->siswa->guru_id == null)
                  <span class="badge light badge-warning">Belum masuk anggota T2Q</span>
                  @else
                  {{$list->siswa->guru->nama_lengkap}}, {{$list->siswa->guru->gelar}}
                  @endif
                </td>
                <td>
                  <a href="{{route('detail-siswa',Crypt::encrypt($list->id))}}" type="button"  class="btn btn-sm btn-info" data-toggle="tooltip"><i class="fas fa-user-graduate"></i></a>
                  <a href="{{route('show',Crypt::encrypt($list->id))}}" target="_BLANK" type="button" class="btn btn-sm btn-success" data-toggle="tooltip"><i class="fas fa-paste"></i></a>
                  <a href="{{route('projek-p5.show',Crypt::encrypt($list->id))}}" target="_BLANK" type="button" class="btn btn-sm btn-warning" data-toggle="tooltip"><i class="fas fa-print"></i></a>
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
  function submitForm(btn) {
    btn.disabled = true;  
    btn.form.submit();
  }
</script>
@stop