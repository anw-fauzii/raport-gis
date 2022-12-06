@extends('adminlte::page')

@section('title', 'Data Anggota Ekstakulikuler')

@section('content_header')
    
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">{{$title}}</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item "><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item "><a href="{{ route('kelas.index') }}">Kelas</a></li>
        <li class="breadcrumb-item active">{{$title}}</li>
      </ol>
    </div><!-- /.col -->
  </div><!-- /.row -->
</div>

@stop

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><i class="fas fa-users"></i> {{$title}} {{$ekstrakulikuler->nama_ekstrakulikuler}} {{$ekstrakulikuler->tapel->tahun_pelajaran}} Semester
          @if($ekstrakulikuler->tapel->semester ==1)
          Ganjil
          @else
          Genap
          @endif
        </h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modal-tambah">
            <i class="fas fa-plus"></i>
          </button>
        </div>
      </div>

      @include('admin.ekstrakulikuler.createAnggota')  

      <div class="card-body">
        <div class="table-responsive">
          <table id="example1" class="table table-striped table-valign-middle table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>NIS</th>
                <th>NISN</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>L/P</th>
                <th>Hapus Anggota</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 0; ?>
              @foreach($anggota_ekstrakulikuler->sortBy('anggota_kelas.siswa.nama_lengkap') as $anggota)
              <?php $no++; ?>
              <tr>
                <td>{{$no}}</td>
                <td>{{$anggota->anggota_kelas->siswa->nis}}</td>
                <td>{{$anggota->anggota_kelas->siswa->nisn}}</td>
                <td>{{$anggota->anggota_kelas->siswa->nama_lengkap}}</td>
                <td>{{$anggota->anggota_kelas->siswa->kelas->nama_kelas}}</td>
                <td>{{$anggota->anggota_kelas->siswa->jenis_kelamin}}</td>
                <td>
                  <form action="{{ route('ekstrakulikuler.anggota.delete', $anggota->anggota_kelas_id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm mt-1" onclick="return confirm('Hapus {{$title}} ?')">
                      <i class="fas fa-trash-alt"></i>
                    </button>
                  </form>
                </td>
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
@stop

@section('css')
<link rel="stylesheet" href="{{asset('vendor/datatables/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{asset('vendor/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
@stop

@section('js')
<script src="{{asset('vendor/datatables/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('vendor/datatables/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('vendor/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
<script>
  $(function () {
    $("#example1").DataTable();
    $('.duallistbox').bootstrapDualListbox()
  });
</script>
@stop