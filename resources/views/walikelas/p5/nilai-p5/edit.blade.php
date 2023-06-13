@extends('adminlte::page')

@section('title', 'Nilai KI-3 / Pengetahuan')

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
          <a href="#" onclick="return confirm('Reset Nilai ?')" type="button" class="btn btn-tool btn-sm">
            <i class="fas fa-trash-alt"></i>
          </a>
        </div>
      </div>

      <div class="card-body">
        <form action="{{ route('nilai-p5.update', $pembelajaran->id) }}" method="POST">
        {{ method_field('PATCH') }}
        @csrf
        <input type="hidden" name="pembelajaran_id" value="{{$pembelajaran->id}}">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead class="bg-primary">
                <tr>
                  <th class="text-center" style="width: 100px;">No</th>
                  <th class="text-center">Nama Siswa</th>
                  <th class="text-center">KD</th>
                  <th class="text-center">PH</th>
                  @foreach($data_kd_nilai as $rencana_penilaian)
                  <input type="hidden" name="p5_id[]" value="{{$rencana_penilaian->p5_deskripsi_id}}">
                  @endforeach
                </tr>
              </thead>
              <tbody>
                <?php $no = 0; ?>
                @foreach($data_anggota_kelas->sortBy('siswa.nama_lengkap') as $anggota_kelas)
                <?php $no++; ?>
                <tr>
                  <td rowspan="{{$count_kd + 1}}" class="text-center">{{$no}}</td>
                  <td rowspan="{{$count_kd + 1}}">{{$anggota_kelas->siswa->nama_lengkap}}</td>
                  <input type="hidden" name="anggota_kelas_id[]" value="{{$anggota_kelas->id}}">
                </tr>
                <?php $i = -1; ?>
                  @foreach($anggota_kelas->data_nilai as $nilai)
                  <?php $i++; ?>
                  <tr>
                  <td><a href="#" type="button"  class="btn btn-sm btn-light" data-toggle="tooltip" title="{{$nilai->p5_deskripsi->judul}}"><strong>{{$nilai->p5_deskripsi->judul}}</strong></a></td>
                  <td>
                      <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="nilai[{{ $anggota_kelas->id }}][{{ $i }}]" value="1" id="1" {{ $nilai->nilai == '1' ? 'checked' : '' }}>
                          <label class="form-check-label" for="1">MB</label>
                      </div>
                      <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="nilai[{{ $anggota_kelas->id }}][{{ $i }}]" value="2" id="2" {{ $nilai->nilai == '2' ? 'checked' : '' }}>
                          <label class="form-check-label" for="2">SB</label>
                      </div>
                      <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="nilai[{{ $anggota_kelas->id }}][{{ $i }}]" value="3" id="3" {{ $nilai->nilai == '3' ? 'checked' : '' }}>
                          <label class="form-check-label" for="3">BSH</label>
                      </div>
                      <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="nilai[{{ $anggota_kelas->id }}][{{ $i }}]" value="4" id="4" {{ $nilai->nilai == '4' ? 'checked' : '' }}>
                          <label class="form-check-label" for="4">SAB</label>
                      </div>
                  </td>
                  </td>
                  </tr>
                  @endforeach
                  
                @endforeach
                
              </tbody>
            </table>
          </div>
      </div>

      <div class="card-footer clearfix">
        <button type="submit" onclick="submitForm(this);" class="btn btn-primary float-right">Simpan</button>
        <a href="{{ route('nilai-p5.index') }}" class="btn btn-default float-right mr-2">Batal</a>
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