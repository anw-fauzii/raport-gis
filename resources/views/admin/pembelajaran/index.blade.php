@extends('adminlte::page')

@section('title', 'Pembelajaran')

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
    
<div class="container-fluid">
    <!-- ./row -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-calendar-check"></i> {{$title}}</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modal-settings">
                  <i class="fas fa-cog"></i>
                </button>
                <a href="#" class="btn btn-tool btn-sm">
                  <i class="fas fa-download"></i>
                </a>
              </div>
            </div>

            <!-- Modal settings  -->
            <div class="modal fade" id="modal-settings">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Setting Pembelajaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="form-group row">
                      <label for="kelas_id" class="col-sm-2 col-form-label">Kelas</label>
                      <div class="col-sm-10">
                        <form action="{{route('pembelajaran.setting')}}" method="POST">
                          @csrf
                          <select class="form-control select2" name="kelas_id" style="width: 100%;" required onchange="this.form.submit();">
                          <option value="" disabled="true" selected="true"> -- Pilih Kelas --</option>
                            @foreach($data_kelas as $kelas)
                            <option value="{{$kelas->id}}">{{$kelas->nama_kelas}} ( {{$kelas->tapel->tahun_pelajaran}}
                              @if($kelas->tapel->semester == 1)
                              Ganjil
                              @else
                              Genap
                              @endif)
                            </option>
                            @endforeach
                          </select>
                        </form>
                      </div>
                    </div>
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
                      <th>Semester</th>
                      <th>Kelas</th>
                      <th>Mata Pelajaran</th>
                      <th>Guru</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 0; ?>
                    @foreach($data_pembelajaran as $pembelajaran)
                    <?php $no++; ?>
                    <tr>
                      <td>{{$no}}</td>
                      <td>{{$pembelajaran->kelas->tapel->tahun_pelajaran}}
                        @if($pembelajaran->kelas->tapel->semester == 1)
                        Ganjil
                        @else
                        Genap
                        @endif
                      </td>
                      <td>{{$pembelajaran->kelas->nama_kelas}}</td>
                      <td>{{$pembelajaran->mapel->nama_mapel}}</td>
                      <td>{{$pembelajaran->guru->nama_lengkap}}, {{$pembelajaran->guru->gelar}}</td>
                    </tr>
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
</div>

@stop

@section('css')
<link rel="stylesheet" href="{{asset('vendor/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/datatables/css/dataTables.bootstrap4.css')}}">
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