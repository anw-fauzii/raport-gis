@extends('adminlte::page')

@section('title', 'Nilai P5')

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
                <button type="button" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modal-import">
                  <i class="fas fa-upload"></i>
                </button>
              </div>
            </div>

            <div class="card-body">
              <form class="multiple-submits" action="{{ route('nilai-p5.store') }}" method="POST">
                @csrf
                <input type="hidden" name="pembelajaran_id" value="{{$pembelajaran->id}}">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover">
                    <thead class="bg-primary">
                      <tr>
                        <th class="text-center" style="width: 100px;">No</th>
                        <th class="text-center">Nama Siswa</th>
                        <th class="text-center">Projek Pancasila</th>
                        <th class="text-center">Nilai</th>
                        @foreach($data_rencana_penilaian as $rencana_penilaian)
                        <input type="hidden" name="p5_id[]" value="{{$rencana_penilaian->id}}">
                        @endforeach
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 0; ?>
                      @foreach($data_anggota_kelas->sortBy('anggota_kelas.id') as $anggota_kelas)
                      <?php $no++; ?>
                      <tr>
                        <td rowspan="{{$count_kd + 1}}" class="text-center">{{$no}}</td>
                        <td rowspan="{{$count_kd + 1}}"><input type="hidden" name="anggota_kelas_id[]" value="{{$anggota_kelas->id}}">{{$anggota_kelas->siswa->nama_lengkap}}</td>
                      </tr>
                      <?php $i = -1; ?>
                        @foreach($data_rencana_penilaian as $rencana_penilaian)
                        <?php $i++; ?>
                        <tr>
                        <td><a href="#" type="button"  class="btn btn-sm btn-light" data-toggle="tooltip" title="{{$rencana_penilaian->judul}}"><strong>{{$rencana_penilaian->judul}}</strong></a></td>
                        <td>
                          <div class="form-group">
                              <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="nilai[{{ $anggota_kelas->id }}][{{ $rencana_penilaian->id }}]" value="1" id="1">
                                  <label class="form-check-label" for="1">MB</label>
                              </div>
                              <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="nilai[{{ $anggota_kelas->id }}][{{ $rencana_penilaian->id }}]" value="2" id="2">
                                  <label class="form-check-label" for="2">SB</label>
                              </div>
                              <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="nilai[{{ $anggota_kelas->id }}][{{ $rencana_penilaian->id }}]" value="3" id="3" checked>
                                  <label class="form-check-label" for="3">BSH</label>
                              </div>
                              <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="nilai[{{ $anggota_kelas->id }}][{{ $rencana_penilaian->id }}]" value="4" id="4">
                                  <label class="form-check-label" for="4">SAB</label>
                              </div>
                          </div>
                        </td>
                        </tr>
                        @endforeach
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <p id="demo"></p>
            </div>

            <div class="card-footer clearfix">
              <button type="submit" class="btn btn-primary float-right multiple-submits">Simpan</button>
              <a href="{{ route('penilaian-k3.index') }}" class="btn btn-default float-right mr-2">Batal</a>
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
  (function(){
    $('.multiple-submits').on('submit', function(){
        $('.multiple-submits').attr('disabled','true');
    })
  })();
</script>
@stop