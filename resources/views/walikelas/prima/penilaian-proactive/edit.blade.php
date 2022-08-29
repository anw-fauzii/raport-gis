@extends('adminlte::page')

@section('title', 'Data Guru')

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

        <form action="{{ route('penilaian-proactive.update', $kelas->id) }}" method="POST">
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
                  <input type="hidden" name="rencana_proactive_id[]" value="{{$kd_nilai->rencana_proactive_id}}">
                  <td class="text-center" style="width: 200px;"><small></small> <button type="" class="btn btn-sm btn-primary" title="{{$kd_nilai->rencana_proactive->butir_sikap->butir_sikap}}">
                        <b>{{$kd_nilai->rencana_proactive->butir_sikap->kode}}</b>
                          </button></td>
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
                    <input type="number" class="form-control" name="nilai[{{$i}}][]" min="0" value="{{$nilai->nilai}}" max="100" required oninvalid="this.setCustomValidity('Nilai harus berisi antara 0 s/d 100')" oninput="setCustomValidity('')">
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
        <button type="submit" class="btn btn-primary float-right">Simpan</button>
        <a href="{{ route('penilaian-proactive.index') }}" class="btn btn-default float-right mr-2">Batal</a>
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
</script>
@stop