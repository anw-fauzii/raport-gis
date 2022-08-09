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
        <h3 class="card-title"><i class="fas fa-clipboard-list"></i> {{$title}}</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modal-settings">
            <i class="fas fa-plus"></i>
          </button>
        </div>
      </div>

      <!-- Modal settings  -->
      <div class="modal fade" id="modal-settings">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Tambah Kompetensi Dasar</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{ route('kd-mapel.create') }}" method="GET">
                @csrf
                <div class="form-group row">
                  <label for="mapel_id" class="col-sm-3 col-form-label">Mata Pelajaran</label>
                  <div class="col-sm-9">
                    <select class="form-control select2" name="mapel_id" style="width: 100%;" required>
                      <option value="">-- Pilih Mapel --</option>
                      @foreach($data_mapel as $mapel)
                      <option value="{{$mapel->id}}">{{$mapel->nama_mapel}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="tingkatan_kelas" class="col-sm-3 col-form-label">Tingkatan Kelas</label>
                  <div class="col-sm-9">
                    <select class="form-control" name="tingkatan_kelas" style="width: 100%;" required onchange="this.form.submit();">
                      <option value="">-- Pilih Tingkatan Kelas --</option>
                      @foreach($data_kelas as $kelas)
                      <option value="{{$kelas->tingkatan_kelas}}">{{$kelas->tingkatan_kelas}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- End Modal settings -->

      <div class="card-body">
        <div class="table-responsive">
          <table id="example1" class="table table-striped table-valign-middle table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>Mata Pelajaran</th>
                <th>Kompetensi</th>
                <th>Tingkatan Kelas</th>
                <th>Semester</th>
                <th>Kode</th>
                <th>Kompetensi Dasar</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 0; ?>
              @foreach($data_kd as $kd)
              <?php $no++; ?>
              <tr>
                <td>{{$no}}</td>
                <td>{{$kd->mapel->nama_mapel}}</td>
                <td>
                  @if($kd->jenis_kompetensi == 1)
                  Spiritual
                  @elseif($kd->jenis_kompetensi == 2)
                  Sosial
                  @elseif($kd->jenis_kompetensi == 3)
                  Pengetahuan
                  @elseif($kd->jenis_kompetensi == 4)
                  Keterampilan
                  @endif
                </td>
                <td>{{$kd->tingkatan_kelas}}</td>
                <td>
                  @if($kd->semester == 1)
                  Ganjil
                  @elseif($kd->semester == 2)
                  Genap
                  @endif
                </td>
                <td>{{$kd->kode_kd}}</td>
                <td>{{$kd->kompetensi_dasar}}</td>
                <td>
                  <form action="{{ route('kd-mapel.destroy', $kd->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-warning btn-sm mt-1" data-toggle="modal" data-target="#modal-edit{{$kd->id}}">
                      <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button type="submit" class="btn btn-danger btn-sm mt-1" onclick="return confirm('Hapus {{$title}} ?')">
                      <i class="fas fa-trash-alt"></i>
                    </button>
                  </form>
                </td>
              </tr>

              @include('admin.kd.edit')
              
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- /.card -->
  </div>

</div>
<!-- /.row -->

@stop

@section('css')
<link rel="stylesheet" href="{{asset('vendor/datatables/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{asset('vendor/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@stop

@section('js')
<script src="{{asset('vendor/datatables/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('vendor/datatables/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('vendor/select2/js/select2.full.min.js')}}"></script>

<script>
  $(function () {
    $("#example1").DataTable();
        $('.select2').select2({
      theme : 'bootstrap4',
    })
  });
</script>
@stop