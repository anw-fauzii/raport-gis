@extends('adminlte::page')

@section('title', 'Catatan Wali Kelas')

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
        <form action="{{ route('kenaikan-siswa.store') }}" method="POST">
            @csrf
            <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                <thead class="bg-info">
                    <tr>
                    <th class="text-center" style="width: 5%;">No</th>
                    <th class="text-center" style="width: 5%;">NIS</th>
                    <th class="text-center" style="width: 35%;">Nama Siswa</th>
                    <th class="text-center" style="width: 5%;">L/P</th>
                    <th class="text-center" style="width: 50%;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0; ?>
                    @foreach($data_anggota_kelas->sortBy('anggota_kelas.id') as $anggota_kelas)
                    <?php $no++; ?>
                    <tr>
                    <input type="hidden" name="anggota_kelas_id[]" value="{{$anggota_kelas->id}}">
                    <td class="text-center">{{$no}}</td>
                    <td class="text-center">{{$anggota_kelas->siswa->nis}}</td>
                    <td>{{$anggota_kelas->siswa->nama_lengkap}}</td>
                    <td class="text-center">{{$anggota_kelas->siswa->jenis_kelamin}}</td>
                    <td>
                      <select class="form-control" name="status[]" style="width: 100%;" required oninvalid="this.setCustomValidity('silakan pilih item dalam daftar')" oninput="setCustomValidity('')">
                        <option value="1" @if($anggota_kelas->status==1) selected @endif>Naik Kelas</option>
                        <option value="0" @if($anggota_kelas->status==0) selected @endif>Tinggal Kelas</option>
                      </select>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
            </div>
            <div class="card-footer clearfix">
            <button type="submit" onclick="submitForm(this);" class="btn btn-primary float-right">Simpan</button>
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
  function submitForm(btn) {
    btn.disabled = true;  
    btn.form.submit();
  }
</script>
@stop