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

<!-- ./row -->
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header bg-primary">
        <h3 class="card-title"><i class="fas fa-book-reader"></i> Nilai Ekstrakulikuler</h3>
      </div>
      <form action="{{ route('penilaian-ekstrakulikuler.store') }}" method="POST">
        @csrf
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead class="bg-info">
                <tr>
                  <th class="text-center" style="width: 4%;">No</th>
                  <th class="text-center" style="width: 25%;">Nama Siswa</th>
                  <th class="text-center" style="width: 4%;">L/P</th>
                  <th class="text-center" style="width: 7%;">Kelas</th>
                  <th class="text-center" style="width: 10%;">Ekstrakulikuler</th>
                  <th class="text-center" style="width: 10%;">Nilai</th>
                  <th class="text-center">Deskripsi</th>
                </tr>
              </thead>
              <tbody>
                <input type="hidden" name="ekstrakulikuler_id" value="{{$ekstrakulikuler->id}}">

                <?php $no = 0; ?>
                @foreach($data_anggota_ekstrakulikuler->sortBy('anggota_kelas.kelas_id') as $anggota_ekstrakulikuler)
                <?php $no++; ?>
                <input type="hidden" name="anggota_ekstrakulikuler_id[]" value="{{$anggota_ekstrakulikuler->id}}">
                <tr>
                  <td class="text-center">{{$no}}</td>
                  <td>{{$anggota_ekstrakulikuler->anggota_kelas->siswa->nama_lengkap}}</td>
                  <td class="text-center">{{$anggota_ekstrakulikuler->anggota_kelas->siswa->jenis_kelamin}}</td>
                  <td class="text-center">{{$anggota_ekstrakulikuler->anggota_kelas->kelas->nama_kelas}}</td>
                  <td class="text-center">{{$anggota_ekstrakulikuler->ekstrakulikuler->nama_ekstrakulikuler}}</td>
                  <td>
                    <select class="form-control" name="nilai[]" style="width: 100%;" required oninvalid="this.setCustomValidity('silakan pilih item dalam daftar')" oninput="setCustomValidity('')">
                      @if(is_null($anggota_ekstrakulikuler->nilai))
                      <option value="4">Sangat Baik</option>
                      <option value="3" selected>Baik</option>
                      <option value="2">Cukup</option>
                      <option value="1">Kurang</option>
                      @else
                      <option value="4" @if($anggota_ekstrakulikuler->nilai == 4) selected @endif>Sangat Baik</option>
                      <option value="3" @if($anggota_ekstrakulikuler->nilai == 3) selected @endif>Baik</option>
                      <option value="2" @if($anggota_ekstrakulikuler->nilai == 2) selected @endif>Cukup</option>
                      <option value="1" @if($anggota_ekstrakulikuler->nilai == 1) selected @endif>Kurang</option>
                      @endif
                    </select>
                    <td><textarea name="deskripsi[]" class="form-control">{{$anggota_ekstrakulikuler->deskripsi}}</textarea></td>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer clearfix">
          <button type="submit" onclick="submitForm(this);" class="btn btn-primary float-right">Simpan</button>
          <a href="{{ route('penilaian-ekstrakulikuler.index') }}" class="btn btn-default float-right mr-2">Batal</a>
        </div>
      </form>
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
  $(document).ready(function() {
    $("body").tooltip({ selector: '[data-toggle=tooltip]' });
  });
  function submitForm(btn) {
    btn.disabled = true;  
    btn.form.submit();
  }
</script>
@stop