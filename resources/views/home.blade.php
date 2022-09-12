@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    
<div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->

@stop

@section('content')
<div class="container-fluid">
    <!-- Info -->
    <div class="callout callout-success">
    <h5>{{$sekolah->nama_sekolah}}</h5>
    <p>Tahun Pelajaran {{$tapel->tahun_pelajaran}}
      @if($tapel->semester == 1)
      Semester Ganjil
      @else
      Semester Genap
      @endif
    </p>
  </div>
  <!-- End Info  -->

  <div class="row">
    <div class="col-lg-3 col-6">
      <div class="small-box bg-info shadow">
        <div class="inner">
        <h3>{{$kelas}}</h3>
        <p>Rombel</p>
        </div>
        <div class="icon">
        <i class="fas fa-layer-group"></i>
        </div>
        <a href="{{route('kelas.index')}}" class="small-box-footer">
        More info <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <div class="small-box bg-success shadow">
        <div class="inner">
        <h3>{{$siswa}}</h3>
        <p>Peserta Didik</p>
        </div>
        <div class="icon">
        <i class="fas fa-users"></i>
        </div>
        <a href="{{route('siswa.index')}}" class="small-box-footer">
        More info <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <div class="small-box bg-warning shadow">
        <div class="inner">
        <h3>{{$guru}}</h3>
        <p>Guru dan Tendik</p>
        </div>
        <div class="icon">
        <i class="fas fa-user-tie"></i>
        </div>
        <a href="#" class="small-box-footer">
        More info <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <div class="small-box bg-danger shadow">
        <div class="inner">
        <h3>{{$kelas}}</h3>
        <p>Ruang Kelas</p>
        </div>
        <div class="icon">
        <i class="fas fa-building"></i>
        </div>
        <a href="{{route('kelas.index')}}" class="small-box-footer">
        More info <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
  </div>
  <!-- Main row -->
  <div class="row">
    <!-- Left col -->
    <div class="col-md-7">
      <!-- MAP & BOX PANE -->
      <div class="card card-success shadow">
        <div class="card-header">
          <h3 class="card-title"><i class="fas fa-bullhorn"></i> Pengumuman</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body pr-1">
          <div class="row">
            <div class="col-md-12">
              <!-- The time line -->
              <div class="timeline">
                <!-- timeline time label -->
                <div class="time-label">
                  <span class="bg-success">Pengumuman Terakhir</span>
                </div>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                @foreach($data_pengumuman->sortByDesc('created_at') as $pengumuman)
                <div>
                  <i class="fas fa-envelope bg-primary"></i>
                  <div class="timeline-item">
                    <span class="time"><i class="far fa-clock"></i> {{$pengumuman->created_at}}</span>

                    <h3 class="timeline-header"><a href="#">{{$pengumuman->user->name}}</a> {{$pengumuman->judul}} @if($pengumuman->created_at != $pengumuman->updated_at)<small><i>edited</i></small>@endif</h3>

                    <div class="timeline-body">
                      {!! $pengumuman->isi !!}
                    </div>
                  </div>
                </div>
                @endforeach
                <!-- END timeline item -->
                <div>
                  <i class="fas fa-clock bg-gray"></i>
                </div>
              </div>
            </div>
            <!-- /.col -->
          </div>
        </div>
        <!-- /.card-body -->
      </div>

    </div>
    <!-- /.col -->

    <div class="col-md-5">
      <!-- PRODUCT LIST -->
      <div class="card card-info shadow">
        <div class="card-header">
          <h3 class="card-title"><i class="fas fa-school"></i> Informasi Sekolah</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body pr-1">
          <table>
            <tr>
              <td>NPSN</td>
              <td>:</td>
              <td>{{$sekolah->npsn}}</td>
            </tr>
            <tr>
              <td>Sekolah</td>
              <td>:</td>
              <td>{{$sekolah->nama_sekolah}}</td>
            </tr>
            <tr>
              <td>Kepala Sekolah</td>
              <td>:</td>
              <td>{{$sekolah->kepala_sekolah}}</td>
            </tr>
            <tr>
              <td>NRKS.</td>
              <td>:</td>
              <td>{{$sekolah->nip_kepala_sekolah}}</td>
            </tr>
            <tr>
              <td>Email</td>
              <td>:</td>
              <td>{{$sekolah->email}}</td>
            </tr>
            <tr>
              <td>Website</td>
              <td>:</td>
              <td>{{$sekolah->website}}</td>
            </tr><tr>
              <td>Alamat</td>
              <td>:</td>
              <td>{{$sekolah->alamat}}</td>
            </tr>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</div>


</div>
<!--/. container-fluid -->

@stop

@section('css')
    
@stop

@section('js')
    
@stop