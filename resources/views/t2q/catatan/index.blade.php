@extends('adminlte::page')

@section('title', 'Catatan T2Q Siswa')

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
        </div>
        <form action="{{ route('catatan-t2q.store') }}" method="POST">
            @csrf
            <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                <thead class="bg-info">
                    <tr>
                    <th class="text-center" style="width: 5%;">No</th>
                    <th class="text-center" style="width: 5%;">NIS</th>
                    <th class="text-center" style="width: 30%;">Nama Siswa</th>
                    <th class="text-center" style="width: 5%;">Kelas</th>
                    <th class="text-center" style="width: 5%;">L/P</th>
                    <th class="text-center" style="width: 50%;">Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0; ?>
                    @foreach($data_anggota_kelas as $anggota_kelas)
                    <?php $no++; ?>
                    <tr>
                    <input type="hidden" name="anggota_kelas_id[]" value="{{$anggota_kelas->id}}">
                    <td class="text-center">{{$no}}</td>
                    <td class="text-center">{{$anggota_kelas->anggota_kelas->siswa->nis}}</td>
                    <td>{{$anggota_kelas->anggota_kelas->siswa->nama_lengkap}}</td>
                    <td class="text-center">{{$anggota_kelas->anggota_kelas->siswa->kelas->nama_kelas}}</td>
                    <td class="text-center">{{$anggota_kelas->anggota_kelas->siswa->jenis_kelamin}}</td>
                    <td>
                      <textarea class="form-control" name="catatan[]" id="" oninvalid="this.setCustomValidity('Isian tidak boleh kosong')" oninput="setCustomValidity('')">{{$anggota_kelas->catatan}}</textarea>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
            </div>
            <div class="card-footer clearfix">
            <button type="submit" class="btn btn-primary float-right">Simpan</button>
            </div>
        </form>
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