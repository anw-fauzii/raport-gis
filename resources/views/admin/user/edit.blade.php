@extends('adminlte::page')

@section('title', 'Ganti Password')

@section('content_header')
    
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Ganti Password</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item "><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item active">Reset Akun</li>
      </ol>
    </div><!-- /.col -->
  </div><!-- /.row -->
</div><!-- /.container-fluid -->

@stop

@section('content')
    
<div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-key"></i> Ganti Password</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('user.update', Auth::user()->id) }}" method="post" enctype="multipart/form-data"> 
                    @csrf
                    @method('put')
                    <div class="position-relative row form-group"><label class="col-sm-3 col-form-label" for="nama">Password Lama</label>
                        <div class="col-sm-9"><input placeholder="Masukan Password Lama" type="password" name="old_password" class="form-control">
                            </div>
                    </div>
                    <div class="position-relative row form-group"><label class="col-sm-3 col-form-label" for="nama">Password Baru</label>
                        <div class="col-sm-9"><input placeholder="Masukan Password Baru" type="password" name="new_password" class="form-control">
                            </div>
                    </div>
                    <div class="position-relative row form-group"><label class="col-sm-3 col-form-label" for="nama">Konfirmasi Password Baru</label>
                        <div class="col-sm-9"><input placeholder="Masukan Konfirmasi Password Baru" type="password" name="confirm_password" class="form-control">
                            </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary btn-sm">
                            <i class="pe-7s-paper-plane"></i> Simpan
                        </button>
                    </div> 
                </form>
            </div>
          </div>
          <!-- /.card -->
        </div>

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
</script>
@stop
