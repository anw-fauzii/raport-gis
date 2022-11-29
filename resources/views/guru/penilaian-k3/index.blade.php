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

<div class="row">
    <div class="col-12">
        <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-list-ol"></i> {{$title}}</h3>
        </div>

        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="bg-success">
                <tr>
                    <th rowspan="2" class="text-center" style="width: 100px;vertical-align: middle;">No</th>
                    <th rowspan="2" class="text-center" style="vertical-align: middle;">Mata Pelajaran</th>
                    <th rowspan="2" class="text-center" style="vertical-align: middle;">Kelas</th>
                    <th colspan="2" class="text-center" style="width: 200px;vertical-align: middle;">Jumlah</th>
                    <th rowspan="2" class="text-center" style="width: 100px;vertical-align: middle;">Input Nilai</th>
                </tr>
                <tr>
                    <th class="text-center" style="width: 100px;">Rencana Penilaian</th>
                    <th class="text-center" style="width: 100px;">Telah Dinilai</th>
                </tr>
                </thead>
                <tbody>
                <?php $no = 0; ?>
                @forelse($data_penilaian as $penilaian)
                <?php $no++; ?>
                <tr>
                    <td class="text-center">{{$no}}</td>
                    <td>{{$penilaian->mapel->nama_mapel}}</td>
                    <td class="text-center">{{$penilaian->kelas->nama_kelas}}</td>

                    @if($penilaian->jumlah_rencana_penilaian == 0)
                    <td class="text-danger text-center"><b>0</b></td>
                    @else
                    <td class="text-success text-center"><b>{{$penilaian->jumlah_rencana_penilaian}}</b></td>
                    @endif

                    @if($penilaian->jumlah_telah_dinilai == 0)
                    <td class="text-danger text-center"><b>0</b></td>
                    @elseif($penilaian->jumlah_telah_dinilai == $penilaian->jumlah_rencana_penilaian)
                    <td class="text-success text-center"><b>{{$penilaian->jumlah_telah_dinilai}}</b></td>
                    @else
                    <td class="text-warning text-center"><b>{{$penilaian->jumlah_telah_dinilai}}</b></td>
                    @endif

                    @if($penilaian->jumlah_rencana_penilaian != 0)
                    <td class="text-center">
                    <a href="{{ route('penilaian-k3.edit', Crypt::encrypt($penilaian->id)) }}" type="button" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i>
                    </a>
                    </td>
                    @else
                    <td class="text-center">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-tambah{{$penilaian->id}}" title="Belum ada rencana penilaian" disabled>
                        <i class="fas fa-plus"></i>
                    </button>
                    </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data pembelajaran</td>
                </tr>
                @endforelse
                </tbody>
            </table>
            </div>
        </div>
        </div>
        <!-- /.card -->
    </div>
</div>

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