@extends('adminlte::page')

@section('title', 'Nilai Modest')

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

        <form action="{{ route('penilaian-modest.store') }}" method="POST">
          @csrf

          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead class="bg-primary">
                <tr>
                  <th rowspan="2" style="vertical-align: middle;" class="text-center" style="width: 100px;">No</th>
                  <th rowspan="2" style="vertical-align: middle;" class="text-center">Nama Siswa</th>
                  <th colspan="{{$count_kd}}" class="text-center">Kompetensi Dasar / Indikator Sikap Spiritual</th>
                </tr>
                <tr>
                  @foreach($data_rencana_penilaian as $rencana_penilaian)
                  <input type="hidden" name="rencana_modest_id[]" value="{{$rencana_penilaian->id}}">
                  <td class="text-center" style="width: 200px;"><a href="#" type="button"  class="btn btn-sm btn-primary" data-toggle="tooltip" title="{{$rencana_penilaian->butir_sikap->butir_sikap}}"><b>{{$rencana_penilaian->butir_sikap->kode}}</b></a></td>
                  @endforeach
                </tr>
              </thead>
              <tbody>
                <?php $no = 0; ?>
                @foreach($data_anggota_kelas->sortBy('anggota_kelas.id') as $anggota_kelas)
                <?php $no++; ?>
                <tr>
                  <td class="text-center">{{$no}}</td>
                  <td>{{$anggota_kelas->siswa->nama_lengkap}}</td>
                  <input type="hidden" name="anggota_kelas_id[]" value="{{$anggota_kelas->id}}">

                  <?php $i = -1; ?>
                  @foreach($data_rencana_penilaian as $rencana_penilaian)
                  <?php $i++; ?>
                  <td>
                    <select class="form-control" name="nilai[{{$i}}][]" style="width: 100%;" required oninvalid="this.setCustomValidity('silakan pilih item dalam daftar')" oninput="setCustomValidity('')">
                      <option value="4">Sangat Baik</option>
                      <option value="3" selected>Baik</option>
                      <option value="2">Cukup</option>
                      <option value="1">Kurang</option>
                    </select>
                  </td>
                  @endforeach

                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <p id="demo"></p>
      </div>

      <div class="card-footer clearfix">
        <button type="submit" onclick="submitForm(this);" class="btn btn-primary float-right">Simpan</button>
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
  function submitForm(btn) {
    btn.disabled = true;  
    btn.form.submit();
  }
</script>
@stop