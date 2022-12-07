@extends('adminlte::page')

@section('title', 'Nilai Responsible')

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

        <form action="{{ route('penilaian-responsible.update', $kelas->id) }}" method="POST">
          {{ method_field('PATCH') }}
          @csrf

          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead class="bg-primary">
                <tr>
                  <th rowspan="2" style="vertical-align: middle;" class="text-center" style="width: 100px;">No</th>
                  <th rowspan="2" style="vertical-align: middle;" class="text-center">Nama Siswa</th>
                  <th colspan="{{$count_kd_nilai}}" class="text-center">Kompetensi Dasar / Indikator Sikap Spiritual</th>
                </tr>
                <tr>
                  @foreach($data_kd_nilai as $kd_nilai)
                  <input type="hidden" name="rencana_responsible_id[]" value="{{$kd_nilai->rencana_responsible_id}}">
                  <td class="text-center" style="width: 200px;"><a href="#" type="button"  class="btn btn-sm btn-primary" data-toggle="tooltip" title="{{$kd_nilai->rencana_responsible->butir_sikap->butir_sikap}}"><b>{{$kd_nilai->rencana_responsible->butir_sikap->kode}}</b></a></td>
                  @endforeach
                </tr>
              </thead>
              <tbody>
                <?php $no = 0; ?>
                @foreach($data_anggota_kelas->sortBy('siswa.nama_lengkap') as $anggota_kelas)
                <?php $no++; ?>
                <tr>
                  <td class="text-center">{{$no}}</td>
                  <td>{{$anggota_kelas->siswa->nama_lengkap}}</td>
                  <input type="hidden" name="anggota_kelas_id[]" value="{{$anggota_kelas->id}}">

                  <?php $i = -1; ?>
                  @foreach($anggota_kelas->data_nilai as $nilai)
                  <?php $i++; ?>
                  <td>
                    <select class="form-control" name="nilai[{{$i}}][]" style="width: 100%;" required oninvalid="this.setCustomValidity('silakan pilih item dalam daftar')" oninput="setCustomValidity('')">
                      <option value="4" @if($nilai->nilai==4) selected @endif>Sangat Baik</option>
                      <option value="3" @if($nilai->nilai==3) selected @endif>Baik</option>
                      <option value="2" @if($nilai->nilai==2) selected @endif>Cukup</option>
                      <option value="1" @if($nilai->nilai==1) selected @endif>Kurang</option>
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
        <a href="{{ route('penilaian-responsible.index') }}" class="btn btn-default float-right mr-2">Batal</a>
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