@extends('adminlte::page')

@section('title', 'Interval KKM')

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
            <h3 class="card-title"><i class="fas fa-columns"></i> {{$title}}</h3>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="example1" class="table table-striped table-valign-middle table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Mata Pelajaran</th>
                    <th>Tingkat</th>
                    <th>Batas Bawah Predikat C</th>
                    <th>Batas Bawah Predikat B</th>
                    <th>Batas Bawah Predikat A</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 0; ?>
                  @foreach($data_kkm as $kkm)
                  <?php $no++; ?>
                  <tr>
                    <td>{{$no}}</td>
                    <td>{{$kkm->mapel->nama_mapel}}</td>
                    <td>{{$kkm->tingkat}}</td>
                    <td>{{$kkm->predikat_c}}</td>
                    <td>{{$kkm->predikat_b}}</td>
                    <td>{{$kkm->predikat_a}}</td>
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
<link rel="stylesheet" href="{{asset('vendor/datatables/css/dataTables.bootstrap4.css')}}">
@stop

@section('js')
<script src="{{asset('vendor/datatables/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('vendor/datatables/js/dataTables.bootstrap4.js')}}"></script>

<script>
  $(function () {
    $("#example1").DataTable();
  });
  function submitForm(btn) {
    btn.disabled = true;  
    btn.form.submit();
  }
</script>
@stop