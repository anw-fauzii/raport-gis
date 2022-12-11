@extends('adminlte::page')

@section('title', 'Nilai Tahfidz')

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
        <h3 class="card-title"><i class="fas fa-list-ol"></i> {{$title}}</h3>
          <div class="card-tools">
            <span class="badge light badge-success">Data Sudah Tersimpan Sebelumnya</span>
          </div>
      </div>

      <div class="card-body">

        <form action="{{ route('penilaian-t2q.update', Auth::user()->id) }}" method="POST">
          {{ method_field('PATCH') }}
          @csrf
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead class="bg-primary">
                <tr>
                  <th rowspan="2" style="vertical-align: middle;" class="text-center" style="width: 100px;">No</th>
                  <th rowspan="2" style="vertical-align: middle;" class="text-center">Nama Siswa</th>
                  <th rowspan="2" style="vertical-align: middle;" class="text-center">Kelas</th>
                  <th colspan="4" class="text-center">Tahfidz</th>
                </tr>
                <tr class="text-center">
                  <td style="width: 25%;"><a href="#" type="button"  class="btn btn-sm btn-primary" data-toggle="tooltip" title="Surah"><b>4.1</b></a></td>
                  <td style="width: 20%;"><a href="#" type="button"  class="btn btn-sm btn-primary" data-toggle="tooltip" title="Kekurangan"><b>4.2</b></a></td>
                  <td style="width: 20%;"><a href="#" type="button"  class="btn btn-sm btn-primary" data-toggle="tooltip" title="Kelebihan"><b>4.2</b></a></td>
                  <td style="width: 10%;"><a href="#" type="button"  class="btn btn-sm btn-primary" data-toggle="tooltip" title="Nilai"><b>4.3</b></a></td>
                </tr>
              </thead>
              <tbody>
                <?php $i = 0; ?>
                @foreach($data_anggota_kelas->sortBy('siswa.nama_lengkap') as $anggota_kelas)
                <?php $i++; ?>
                @foreach($anggota_kelas->data_nilai as $nilai)
                <tr>
                  <td class="text-center">{{$i}}</td>
                  <td>{{$anggota_kelas->anggota_kelas->siswa->nama_lengkap}}</td>
                  <td class="text-center">{{$anggota_kelas->anggota_kelas->siswa->kelas->nama_kelas}}</td>
                  <td>
                    <input type="hidden" name="anggota_kelas_id[{{$i}}]" value="{{$anggota_kelas->anggota_kelas_id}}">
                    <input type="text" class="form-control" name="tahfidz_surah[{{$i}}]" value="{{$nilai->tahfidz_surah}}" min="0" max="100" required>
                  </td>
                  <td>
                    <select class="form-control select2" multiple="multiple" name="tahfidz_kekurangan[{{$i}}][]" style="width: 100%;" required>
                      <option value="" disable="true" disabled>-- Perbaikan --</option>
                      @foreach($komentar as $data)
                      <option value="{{$data->komentar}}" {{in_array($data->komentar, explode(", ",$nilai->tahfidz_kekurangan)) ? 'selected' : '' }}>{{$data->komentar}}</option>
                      @endforeach
                    </select>
                  </td>
                  <td>
                    <select class="form-control select2" multiple="multiple" name="tahfidz_kelebihan[{{$i}}][]" style="width: 100%;" required>
                      <option value="" disable="true" disabled>-- Sudah Bagus --</option>
                      @foreach($komentar as $data)
                      <option value="{{$data->komentar}}" {{in_array($data->komentar, explode(", ",$nilai->tahfidz_kelebihan)) ? 'selected' : '' }}>{{$data->komentar}}</option>
                      @endforeach
                    </select>
                  </td>
                  <td>
                    <input type="number" class="form-control" name="tahfidz_nilai[{{$i}}]" value="{{$nilai->tahfidz_nilai}}" min="0" max="100" required oninvalid="this.setCustomValidity('Nilai harus berisi antara 0 s/d 100')" oninput="setCustomValidity('')">
                  </td>
                </tr>
                @endforeach
                @endforeach
                <input type="hidden" name="jumlah" value="{{count($data_anggota_kelas)}}">
              </tbody>
            </table>
          </div>
      </div>

      <div class="card-footer clearfix">
        <button type="submit" onclick="submitForm(this);" class="btn btn-primary float-right">Simpan</button>
        <a href="{{ route('penilaian-sholat.index') }}" class="btn btn-default float-right mr-2">Batal</a>
      </div>
      </form>
    </div>
    <!-- /.card -->
  </div>

</div>
<!-- /.row -->

@stop

@section('css')
<link rel="stylesheet" href="{{asset('vendor/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/datatables/css/dataTables.bootstrap4.css')}}">
@stop

@section('js')
<script src="{{asset('vendor/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('vendor/datatables/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('vendor/datatables/js/dataTables.bootstrap4.js')}}"></script>

<script>
  $(function () {
    $("#example1").DataTable();
    $('.select2').select2({
      theme : 'bootstrap4',
    })
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