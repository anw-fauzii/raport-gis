@extends('adminlte::page')

@section('title', 'Peserta Didik')

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
        <h3 class="card-title"><i class="fas fa-users"></i> {{$title}}</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modal-tambah">
            <i class="fas fa-plus"></i>
          </button>
          <button type="button" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modal-import">
            <i class="fas fa-upload"></i>
          </button>
          <a href="{{ route('siswa.show', 1) }}" class="btn btn-tool btn-sm">
            <i class="fas fa-download"></i>
          </a>
        </div>
      </div>

      @include('admin.siswa.import')

      @include('admin.siswa.create')

      <div class="card-body">
        <div class="table-responsive">
          <table id="example1" class="table table-striped table-valign-middle table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>NIS / NISN</th>
                <th>Nama Siswa</th>
                <th>Tanggal Lahir</th>
                <th>L/P</th>
                <th>Kelas Saat Ini</th>
                <th>Pembimbing T2Q</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 0; ?>
              @foreach($data_siswa as $siswa)
              <?php $no++; ?>
              <tr>
                <td>{{$no}}</td>
                <td>{{$siswa->nis}} / {{$siswa->nisn}}</td>
                <td>{{$siswa->nama_lengkap}}</td>
                <td>{{$siswa->tanggal_lahir->format('d-M-Y')}}</td>
                <td>{{$siswa->jenis_kelamin}}</td>
                <td>
                  @if($siswa->kelas_id == null)
                  <span class="badge light badge-warning">Belum masuk anggota kelas</span>
                  @else
                  {{$siswa->kelas->nama_kelas}}
                  @endif
                </td>
                <td>
                  @if($siswa->guru_id == null)
                  <span class="badge light badge-warning">Belum masuk anggota T2Q</span>
                  @else
                  {{$siswa->guru->nama_lengkap}}, {{$siswa->guru->gelar}}
                  @endif
                </td>
                <td>
                  <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    @if($siswa->kelas_id != null)
                    <button type="button" class="btn btn-primary btn-sm mt-1" data-toggle="modal" data-target="#modal-registrasi{{$siswa->id}}" title="Registrasi Siswa">
                      <i class="fas fa-user-cog"></i>
                    </button>
                    @else
                    <button type="button" class="btn btn-primary btn-sm mt-1" data-toggle="modal" data-target="#modal-registrasi{{$siswa->id}}" title="Registrasi Siswa" disabled>
                      <i class="fas fa-user-cog"></i>
                    </button>
                    @endif
                    <button type="button" class="btn btn-warning btn-sm mt-1" data-toggle="modal" data-target="#modal-edit{{$siswa->id}}">
                      <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button type="submit" class="btn btn-danger btn-sm mt-1" onclick="return confirm('Hapus {{$title}} ?')">
                      <i class="fas fa-trash-alt"></i>
                    </button>
                  </form>
                </td>
              </tr>

              @include('admin.siswa.registrasi')
              @include('admin.siswa.edit')
              
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
@include('admin.guru.create')
@stop

@section('css')
<link rel="stylesheet" href="{{asset('vendor/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/datatables/css/dataTables.bootstrap4.css')}}">
@stop

@section('js')
<script src="{{asset('vendor/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('vendor/datatables/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('vendor/datatables/js/dataTables.bootstrap4.js')}}"></script>

<script>
  $(function () {
    $("#example1").DataTable();
    $('.select2').select2({
      theme : 'bootstrap4',
    })
  });
</script>
@stop