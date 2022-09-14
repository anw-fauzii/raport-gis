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
            </div>

            <div class="card-body">
              <form action="{{ route('penilaian-k3.store') }}" method="POST">
                @csrf

                <div class="table-responsive">
                  <table class="table table-bordered table-hover">
                    <thead class="bg-primary">
                      <tr>
                        <th class="text-center" style="width: 100px;">No</th>
                        <th class="text-center">Nama Siswa</th>
                        <th class="text-center">KD</th>
                        <th class="text-center">PH</th>
                        <th class="text-center">NPTS</th>
                        <th class="text-center">NPAS</th>
                        @foreach($data_rencana_penilaian as $rencana_penilaian)
                        <input type="hidden" name="rencana_nilai_k3_id[]" value="{{$rencana_penilaian->id}}">
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
                        @foreach($data_rencana_penilaian as $rencana_penilaian)
                        <?php $i++; ?>
                        <tr>
                        <td class="text-center"><a href="#" type="button"  class="btn btn-sm btn-light" data-toggle="tooltip" title="{{$rencana_penilaian->kd_mapel->kompetensi_dasar}}"><strong>{{$rencana_penilaian->kd_mapel->kode_kd}}</strong></a></td>
                        <td>
                          <input type="number" class="form-control" name="nilai_ph[{{$i}}][]" min="0" max="100" required oninvalid="this.setCustomValidity('Nilai harus berisi antara 0 s/d 100')" oninput="setCustomValidity('')">
                        </td>
                        <td>
                          <input type="number" class="form-control" name="nilai_npts[{{$i}}][]" min="0" max="100" required oninvalid="this.setCustomValidity('Nilai harus berisi antara 0 s/d 100')" oninput="setCustomValidity('')">
                        </td>
                        <td>
                          <input type="number" class="form-control" name="nilai_npas[{{$i}}][]" min="0" max="100" required oninvalid="this.setCustomValidity('Nilai harus berisi antara 0 s/d 100')" oninput="setCustomValidity('')">
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
              <button type="submit" class="btn btn-primary float-right">Simpan</button>
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
</script>
@stop