@extends('adminlte::page')

@section('title', 'Data Kelas Dan Pembimbing')

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
        <h3 class="card-title"><i class="fas fa-users"></i> {{$title}} {{$kelas->nama_kelas}} {{$kelas->tapel->tahun_pelajaran}} Semester
          @if($kelas->tapel->semester ==1)
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

      @include('admin.kelas.createAnggota')  

      <div class="card-body">
        <div class="table-responsive">
          <table id="example1" class="table table-striped table-valign-middle table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>NIS</th>
                <th>NISN</th>
                <th>Nama Siswa</th>
                <th>Tanggal Lahir</th>
                <th>L/P</th>
                <th>Pendaftaran</th>
                <th>Hapus Anggota</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 0; ?>
              @foreach($anggota_kelas as $anggota)
              <?php $no++; ?>
              <tr>
                <td>{{$no}}</td>
                <td>{{$anggota->siswa->nis}}</td>
                <td>{{$anggota->siswa->nisn}}</td>
                <td>{{$anggota->siswa->nama_lengkap}}</td>
                <td>{{$anggota->siswa->tanggal_lahir}}</td>
                <td>{{$anggota->siswa->jenis_kelamin}}</td>
                <td>
                  @if ($anggota->pendaftaran == 1)
                  Siswa Baru
                  @elseif ($anggota->pendaftaran == 2)
                  Pindahan
                  @elseif ($anggota->pendaftaran == 3)
                  Naik Kelas
                  @elseif ($anggota->pendaftaran == 4)
                  Naik Kelas
                  @elseif ($anggota->pendaftaran == 5)
                  Mengulang
                  @endif
                </td>
                <td>
                  <form action="{{ route('kelas.anggota.delete', $anggota->id) }}" method="POST">
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
  function submitForm(btn) {
    btn.disabled = true;  
    btn.form.submit();
  }
</script>
@stop