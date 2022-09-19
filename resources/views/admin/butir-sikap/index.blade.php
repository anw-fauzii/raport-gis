@extends('adminlte::page')

@section('title', 'Butir Sikap')

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
        <h3 class="card-title"><i class="fas fa-clipboard"></i> {{$title}}</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modal-tambah">
            <i class="fas fa-plus"></i>
          </button>
          <button type="button" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modal-import">
            <i class="fas fa-upload"></i>
          </button>
        </div>
      </div>

      <!-- Modal import  -->
      <div class="modal fade" id="modal-import">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Import {{$title}}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form name="contact-form" action="{{ route('butir-sikap.import') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="modal-body">
                <div class="callout callout-info">
                  <h5>Download format import</h5>
                  <p>Silahkan download file format import melalui tombol dibawah ini.</p>
                  <a href="{{ route('butir-sikap.create') }}" class="btn btn-primary text-white" style="text-decoration:none"><i class="fas fa-file-download"></i> Download</a>
                </div>
                <div class="form-group row pt-2">
                  <label for="file_import" class="col-sm-2 col-form-label">File Import</label>
                  <div class="col-sm-10">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="file_import" id="customFile" accept="application/vnd.ms-excel">
                      <label class="custom-file-label" for="customFile">Pilih file</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Import</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- End Modal import -->

      <!-- Modal tambah  -->
      <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Tambah {{$title}}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('butir-sikap.store') }}" method="POST">
              @csrf
              <div class="modal-body">
                <div class="form-group row">
                  <label for="jenis_kompetensi" class="col-sm-3 col-form-label">Jenis Kompetensi</label>
                  <div class="col-sm-9 pt-1">
                    <label class="form-check-label mr-3"><input type="radio" name="jenis_kompetensi" onchange='CheckPendaftaran(this.value);' value="1" @if (old('jenis_kompetensi')=='1' ) checked @endif required> Spiritual</label>
                    <label class="form-check-label mr-3"><input type="radio" name="jenis_kompetensi" onchange='CheckPendaftaran(this.value);' value="2" @if (old('jenis_kompetensi')=='2' ) checked @endif required> Sosial</label>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="kode" class="col-sm-3 col-form-label">Kode Butir Sikap</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="kode" value="{{old('kode')}}">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="butir_sikap" class="col-sm-3 col-form-label">Butir Sikap</label>
                  <div class="col-sm-9">
                    <textarea class="form-control" name="butir_sikap" rows="2">{{old('butir_sikap')}}</textarea>
                  </div>
                </div>
              </div>
              <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- End Modal tambah -->

      <div class="card-body">
        <div class="table-responsive">
          <table id="example1" class="table table-striped table-valign-middle table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>Kompetensi</th>
                <th>Kode Butir Sikap</th>
                <th>Butir-Butir Sikap</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 0; ?>
              @foreach($data_sikap as $sikap)
              <?php $no++; ?>
              <tr>
                <td>{{$no}}</td>
                <td>
                  {{$sikap->kategori->kategori_butir_sikap}}
                </td>
                <td>{{$sikap->kode}}</td>
                <td>{{$sikap->butir_sikap}}</td>

                <td>
                <form action="{{ route('butir-sikap.destroy', $sikap->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="button" class="btn btn-warning btn-sm mt-1" data-toggle="modal" data-target="#modal-edit{{$sikap->id}}">
                        <i class="fas fa-pencil-alt"></i>
                      </button>
                      <button type="submit" class="btn btn-danger btn-sm mt-1" onclick="return confirm('Hapus {{$title}} ?')">
                        <i class="fas fa-trash-alt"></i>
                      </button>
                    </form>
                </td>
              </tr>

              <!-- Modal edit  -->
              <div class="modal fade" id="modal-edit{{$sikap->id}}">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Edit {{$title}}</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="{{ route('butir-sikap.update', $sikap->id) }}" method="POST">
                      {{ method_field('PATCH') }}
                      @csrf
                      <div class="modal-body">
                        <div class="form-group row">
                          <label for="jenis_kompetensi" class="col-sm-3 col-form-label">Jenis Kompetensi</label>
                          <div class="col-sm-9">
                            @if($sikap->jenis_kompetensi == 1)
                            <input type="text" class="form-control" id="jenis_kompetensi" value="Spiritual" readonly>
                            @else
                            <input type="text" class="form-control" id="jenis_kompetensi" value="Sosial" readonly>
                            @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="kode" class="col-sm-3 col-form-label">Kode Butir Sikap</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="kode" id="kode" value="{{$sikap->kode}}">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="butir_sikap" class="col-sm-3 col-form-label">Butir Sikap</label>
                          <div class="col-sm-9">
                            <textarea name="butir_sikap" class="form-control" rows="2">{{$sikap->butir_sikap}}</textarea>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer justify-content-end">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- End Modal edit -->

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