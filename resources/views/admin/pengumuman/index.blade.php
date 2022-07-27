@extends('adminlte::page')

@section('title', 'Pengumuman')

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
          <h3 class="card-title"><i class="fas fa-bullhorn"></i> {{$title}}</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modal-tambah">
              <i class="fas fa-plus"></i>
            </button>
          </div>
        </div>

        <div class="card-body">
          <div class="timeline timeline-inverse">
            <!-- timeline time label -->
            <div class="time-label">
              <span class="bg-success">
                Pengumuman Terakhir
              </span>
            </div>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            @foreach($data_pengumuman->sortByDesc('created_at') as $pengumuman)
            <div>
              <i class="fas fa-envelope bg-primary"></i>
              <div class="timeline-item">
                <span class="time"><i class="far fa-clock"></i> {{$pengumuman->created_at}}</span>

                <h3 class="timeline-header"><a href="#">Anwar Fauzi</a> {{$pengumuman->judul}} @if($pengumuman->created_at != $pengumuman->updated_at)<small><i>edited</i></small>@endif</h3>

                <div class="timeline-body">
                  {!! $pengumuman->isi !!}
                </div>
                <div class="timeline-footer">
                  <form action="{{ route('pengumuman.destroy', $pengumuman->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-primary btn-sm mt-1" data-toggle="modal" data-target="#modal-edit{{$pengumuman->id}}">
                      <i class="fas fa-pencil-alt"></i> Edit
                    </button>
                    <button type="submit" class="btn btn-danger btn-sm mt-1" onclick="return confirm('Hapus pengumuman ?')">
                      <i class="fas fa-trash-alt"></i> Hapus
                    </button>
                  </form>
                </div>
              </div>@include('admin.pengumuman.edit')
            </div>
            @endforeach
            <!-- END timeline item -->
            <div>
              <i class="far fa-clock bg-gray"></i>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card -->
    </div>
    @include('admin.pengumuman.create')
  </div>
  <!-- /.row -->
</div>

@stop

@section('css')
<link href="{{asset('vendor/summernote/summernote-bs4.css')}}" rel="stylesheet">
@stop

@section('js')
<script src="{{asset('vendor/summernote/summernote-bs4.min.js')}}"></script>
<script type="text/javascript">
    $('#summernote').summernote({
        height: 300
    });
    $('#summernoteedit').summernote({
        height: 300
    });
</script>
@stop