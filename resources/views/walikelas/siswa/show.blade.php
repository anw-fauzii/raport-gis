@extends('adminlte::page')

@section('title', 'Data Siswa')

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
<section class="content">
<div class="container-fluid">
  <div class="row">
    <div class="col-md-4">
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          <div class="text-center">
          <img class="profile-user-img img-fluid img-circle" src="{{asset('storage/logo/user.png')}}" alt="User profile picture">
          </div>
          <h3 class="profile-username text-center">{{$siswa->nama_lengkap}}</h3>
          <table class="table">
            <tr>
              <td>Kelas</td>
              <td>:</td>
              <td>{{$siswa->kelas->nama_kelas}}</td>
            </tr>
            <tr>
              <td>Wali Kelas</td> 
              <td>:</td>
              <td>{{$siswa->kelas->guru->nama_lengkap}}, {{$siswa->kelas->guru->gelar}}</td>
            </tr>
            <tr>
              <td>Pembimbing T2Q</td>
              <td>:</td>
              <td>{{$siswa->guru->nama_lengkap}}, {{$siswa->guru->gelar}}</td>
            </tr>
            <tr><td colspan="3"></td></tr>
          </table>
        </div>

      </div>
    </div>
    <div class="col-md-8">
      <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
          <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
            <li class="nav-item">
            <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Biodata Siswa</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Ayah</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Ibu</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Wali</a>
            </li>
          </ul>
        </div>
        <div class="card-body">
          <div class="tab-content" id="custom-tabs-four-tabContent">
            <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
            <table class="table table-striped">
              <tr>
                <td>NIS</td>
                <td>:</td>
                <td>{{$siswa->nis}}</td>
                <td>NISN</td>
                <td>:</td>
                <td>{{$siswa->nisn}}</td>
              </tr>
              <tr>
                <td>NIK</td>
                <td>:</td>
                <td colspan="4">{{$siswa->nik}}</td>
              </tr>
              <tr>
                <td>Nama Lengkap</td>
                <td>:</td>
                <td colspan="4">{{$siswa->nama_lengkap}}</td>
              </tr>
              <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td>{{$siswa->jk}}</td>
                <td>Agama</td>
                <td>:</td>
                <td>Islam</td>
              </tr>
              <tr>
                <td>Tempat Lahir</td>
                <td>:</td>
                <td>{{$siswa->tempat_lahir}}</td>
                <td>Tanggal Lahir</td>
                <td>:</td>
                <td>{{$siswa->tanggal_lahir}}</td>
              </tr>
              <tr>
                <td>Nama Lengkap</td>
                <td>:</td>
                <td colspan="4">{{$siswa->nama_lengkap}}</td>
              </tr>
            </table>
            </div>
            <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
            Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam.
            </div>
            <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
            Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
            </div>
            <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
            Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@stop

@section('css')

@stop

@section('js')

@stop