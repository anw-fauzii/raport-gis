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

              <form class="multiple-submits" action="{{ route('penilaian-t2q.store') }}" method="POST">
                @csrf

                <div class="table-responsive">
                  <table class="table table-bordered table-hover">
                    <thead class="bg-primary">
                      <tr>
                        <th rowspan="2" style="vertical-align: middle;" class="text-center" style="width: 100px;">No</th>
                        <th rowspan="2" style="vertical-align: middle;" class="text-center">Nama Siswa</th>
                        <th rowspan="2" style="vertical-align: middle;" class="text-center">Kelas</th>
                        <th colspan="3" class="text-center">Tahfidz</th>
                      </tr>
                      <tr class="text-center">
                        <td><a href="#" type="button"  class="btn btn-sm btn-primary" data-toggle="tooltip" title="Surah"><b>4.1</b></a></td>
                        <td><a href="#" type="button"  class="btn btn-sm btn-primary" data-toggle="tooltip" title="Ayat"><b>4.2</b></a></td>
                        <td><a href="#" type="button"  class="btn btn-sm btn-primary" data-toggle="tooltip" title="Nilai"><b>4.3</b></a></td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i = 0; ?>
                      @foreach($data_anggota_kelas->sortBy('siswa.nama_lengkap') as $anggota_kelas)
                      <?php $i++; ?>
                      <tr>
                        <td class="text-center">{{$i}}</td>
                        <td>{{$anggota_kelas->anggota_kelas->siswa->nama_lengkap}}</td>
                        <td class="text-center">{{$anggota_kelas->anggota_kelas->siswa->kelas->nama_kelas}}</td>
                        <td>
                          <input type="hidden" name="anggota_kelas_id[{{$i}}]" value="{{$anggota_kelas->anggota_kelas_id}}">
                          <input type="text" class="form-control" name="tahfidz_surah[{{$i}}]" min="0" max="100" required>
                        </td>
                        <td>
                          <input type="text" class="form-control" name="tahfidz_ayat[{{$i}}]" min="0" max="100" required>
                        </td>
                        <td>
                          <input type="number" class="form-control" name="tahfidz_nilai[{{$i}}]" min="0" max="100" required oninvalid="this.setCustomValidity('Nilai harus berisi antara 0 s/d 100')" oninput="setCustomValidity('')">
                        </td>
                      </tr>
                      @endforeach
                      <input type="hidden" name="jumlah" value="{{count($data_anggota_kelas)}}">
                    </tbody>
                  </table>
                </div>
            </div>

            <div class="card-footer clearfix">
              <button type="submit"  class="btn btn-primary float-right  multiple-submits">Simpan</button>
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
  (function(){
    $('.multiple-submits').on('submit', function(){
        $('.multiple-submits').attr('disabled','true');
    })
  })();
</script>
@stop