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
<!-- ./row -->
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><i class="fas fa-list-ol"></i> {{$title}}</h3>
      </div>

      <div class="card-body">

        <form action="{{ route('penilaian-tahsin.store') }}" method="POST">
          @csrf

          <div class="table-responsive">
            <table class="table table-bordered table-hover" width=100%">
              <thead class="bg-primary">
                <tr>
                  <th rowspan="2" style="vertical-align: middle;" class="text-center" style="width: 5%;">No</th>
                  <th rowspan="2" style="vertical-align: middle;" class="text-center" style="width: 25%;">Nama Siswa</th>
                  <th colspan="5" class="text-center">Tahsin</th>
                </tr>
                <tr class="text-center">
                  <td style="width: 10%;"><a href="#" type="button"  class="btn btn-sm btn-primary" data-toggle="tooltip" title="Jilid-Surah"><b>3.1</b></a></td>
                  <td style="width: 10%;"><a href="#" type="button"  class="btn btn-sm btn-primary" data-toggle="tooltip" title="Halaman/Ayat"><b>3.2</b></a></td>
                  <td style="width: 20%;"><a href="#" type="button"  class="btn btn-sm btn-primary" data-toggle="tooltip" title="Kekurangan"><b>3.3</b></a></td>
                  <td style="width: 20%;"><a href="#" type="button"  class="btn btn-sm btn-primary" data-toggle="tooltip" title="Kelebihan"><b>3.4</b></a></td>
                  <td style="width: 10%;"><a href="#" type="button"  class="btn btn-sm btn-primary" data-toggle="tooltip" title="Nilai"><b>3.5</b></a></td>
                </tr>
              </thead>
              <tbody>
                <?php $i = 0; ?>
                @foreach($data_anggota_kelas->sortBy('siswa.nama_lengkap') as $anggota_kelas)
                <?php $i++; ?>
                <tr>
                  <td class="text-center">{{$i}}</td>
                  <td>{{$anggota_kelas->anggota_kelas->siswa->nama_lengkap}}</td>
                  <td>
                    <input type="hidden" name="anggota_kelas_id[{{$i}}]" value="{{$anggota_kelas->anggota_kelas_id}}">
                    <select id="category{{$i}}" data-category="{{$i}}" class="form-control select2" name="tahsin_jilid[{{$i}}]" style="width: 100%;" required>
                      <option value="">-- Jilid / Surah --</option>
                      <option value="Jilid 1">Jilid 1</option>
                      <option value="Jilid 2">Jilid 2</option>
                      <option value="Jilid 3">Jilid 3</option>
                      <option value="Jilid 4">Jilid 4</option>
                      <option value="Tallaqi Juz 1-5">Tallaqi Juz 1-5</option>
                      <option value="Tallaqi Juz 30">Tallaqi Juz 30</option>
                      <option value="Ghorib 1">Ghorib 1</option>
                      <option value="Ghorib 2">Ghorib 2</option>
                      <option value="Tajwid 1">Tajwid 1</option>
                      <option value="Tajwid 2">Tajwid 2</option>
                      <option value="Al-Qur'an">Al-Qur'an</option>
                    </select>
                  </td>
                  <td>
                    <input type="text" class="form-control" name="tahsin_halaman[{{$i}}]" min="0" max="100" required>
                  </td>
                  <td>
                    <select id="tahsin_kekurangan[{{$i}}]"" data-category="{{$i}}" class="form-control select2" name="tahsin_kekurangan[{{$i}}]"" style="width: 100%;" required>
                      <option value="">-- Perbaikan --</option>
                      @foreach($komentar as $data)
                      <option value="{{$data->id}}">{{$data->jenis}} - {{$data->komentar}}</option>
                      @endforeach
                    </select>
                  </td>
                  <td>
                    <select id="tahsin_kelebihan[{{$i}}]"" data-category="{{$i}}" class="form-control select2" name="tahsin_kekurangan[{{$i}}]"" style="width: 100%;" required>
                      <option value="">-- Sudah Bagus --</option>
                      @foreach($komentar as $data)
                      <option value="{{$data->id}}">{{$data->jenis}} - {{$data->komentar}}</option>
                      @endforeach
                    </select>
                  </td>
                  <td>
                    <input type="number" class="form-control" name="tahsin_nilai[{{$i}}]" min="0" max="100" required oninvalid="this.setCustomValidity('Nilai harus berisi antara 0 s/d 100')" oninput="setCustomValidity('')">
                  </td>
                </tr>
                @endforeach
                <input type="hidden" name="jumlah" value="{{count($data_anggota_kelas)}}">
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
</script>
@stop