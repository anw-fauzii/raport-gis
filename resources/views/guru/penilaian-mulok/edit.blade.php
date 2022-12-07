@extends('adminlte::page')

@section('title', 'Nilai Mulok Khas PI')

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
              <form action="{{ route('penilaian-mulok.update', $pembelajaran->id) }}" method="POST">
              {{ method_field('PATCH') }}
              @csrf
              <input type="hidden" name="pembelajaran_id" value="{{$pembelajaran->id}}">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover">
                    <thead class="bg-primary">
                      <tr>
                        <th class="text-center" style="width: 100px;">No</th>
                        <th class="text-center">Nama Siswa</th>
                        <th class="text-center">NR</th>
                        <th class="text-center">KD</th>
                        <th class="text-center">PH</th>
                        <th class="text-center">NPTS</th>
                        <th class="text-center">NPAS</th>
                        <th class="text-center">NAKD</th>
                        @foreach($data_kd_nilai as $rencana_penilaian)
                        <input type="hidden" name="rencana_mulok_id[]" value="{{$rencana_penilaian->rencana_mulok_id}}">
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
                        @foreach($nilai_rapot->where('anggota_kelas_id',$anggota_kelas->id) as $rapot)
                        <td class="text-center" rowspan="{{$count_kd + 1}}"><strong>{{$rapot->nilai_raport}}</strong></td>
                        @endforeach
                        <input type="hidden" name="anggota_kelas_id[]" value="{{$anggota_kelas->id}}">
                      </tr>
                      <?php $i = -1; ?>
                        @foreach($anggota_kelas->data_nilai as $nilai)
                        <?php $i++; ?>
                        <tr>
                            <td class="text-center"><strong>{{$nilai->rencana_mulok->kd_mapel->kode_kd}}</strong></td>
                        <td>
                          <input type="number" class="form-control" name="nilai_ph[{{$i}}][]" min="0"  max="100" value="{{$nilai->nilai_ph}}" required oninvalid="this.setCustomValidity('Nilai harus berisi antara 0 s/d 100')" oninput="setCustomValidity('')">
                        </td>
                        <td>
                          <input type="number" class="form-control" name="nilai_npts[{{$i}}][]" min="0" max="100" value="{{$nilai->nilai_pts}}" required oninvalid="this.setCustomValidity('Nilai harus berisi antara 0 s/d 100')" oninput="setCustomValidity('')">
                        </td>
                        <td>
                          <input type="number" class="form-control" name="nilai_npas[{{$i}}][]" min="0" max="100" value="{{$nilai->nilai_pas}}" required oninvalid="this.setCustomValidity('Nilai harus berisi antara 0 s/d 100')" oninput="setCustomValidity('')">
                        </td>
                        <td class="text-center">
                          <strong>{{$nilai->nilai_kd}}</strong>
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
              <button type="submit" onclick="submitForm(this);" class="btn btn-primary float-right">Simpan</button>
              <a href="{{ route('penilaian-mulok.index') }}" class="btn btn-default float-right mr-2">Batal</a>
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