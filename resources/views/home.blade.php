@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    
<div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">HAHAHAHAHAHAHA</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item "><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active">HAHAHAHAHAHA</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->

@stop

@section('content')
    
<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">Card Tools</h3>

    <div class="card-tools">
      <!-- This will cause the card to maximize when clicked -->
      <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
      <!-- This will cause the card to collapse when clicked -->
      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
      <!-- This will cause the card to be removed when clicked -->
      <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
    </div>
    <!-- /.card-tools -->
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    The body of the card
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->

@stop

@section('css')
    
@stop

@section('js')
    
@stop