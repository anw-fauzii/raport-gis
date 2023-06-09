@extends('adminlte::page')

@section('title', 'Projek P5')

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
<style>
    .justified-text {
        text-align: justify;
        text-justify: inter-word;
    }
</style>
<div class="row">
    <div class="col-12">
        <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-user-check"></i> {{$title}}</h3>
            <div class="card-tools">
            <button type="button" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modal-tambah">
              <i class="fas fa-plus"></i>
            </button>
          </div>
        </div>
            @csrf
            <div class="card-body">
              @forelse($p5 as $data)
              <div class="card">
                <div class="card-body">
                <strong>Projek Profil {{$data->no}} | {{$data->judul}}</strong> <br>
                <div class="justified-text">{{$data->deskripsi}}</div> <br>
                @foreach($data->p5_deskripsi->groupBy('dimensi') as $dimensi => $deskripsiGroup)
                    <div>
                        <strong>{{ $dimensi }}</strong><br>
                        <ul>
                            @foreach($deskripsiGroup as $deskripsi)
                                <li class="justified-text"><strong>{{ $deskripsi->judul }}.</strong> {{ $deskripsi->deskripsi }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
                </div>
                <div class="card-footer">
                  <form action="{{ route('projek-p5.destroy', $data->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-warning btn-sm mt-1" data-toggle="modal" data-target="#modal-tambah{{$data->id}}">
                      <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button type="submit" class="btn btn-danger btn-sm mt-1" onclick="return confirm('Hapus {{$title}} ?')">
                      <i class="fas fa-trash-alt"></i>
                    </button>
                  </form>
                </div>
              </div>
              @include('walikelas.p5.projek-p5.createDeskripsi')
              @empty
              <div class="text-center">Belum ada data</div>
              @endforelse
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
@include('walikelas.p5.projek-p5.create')
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
  function toggleSelectAll() {
    var checkboxes = document.getElementsByName('butir_sikap_id[]');
    var selectAllCheckbox = document.getElementById('select_all_checkbox');
    for (var i = 0; i < checkboxes.length; i++) {
      checkboxes[i].checked = selectAllCheckbox.checked;
    }
  }
</script>
<script type="text/javascript">
  $(document).ready(function() {

    var count = 1;

    dynamic_field(count);

    function dynamic_field(number) {
      html = '<tr>';
      html += `<td>
                  <textarea class="form-control" name="judul[]" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')"></textarea>
              </td>`;
      html += `<td>
                  <textarea class="form-control" name="deskripsi[]" rows="4" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')"></textarea>
              </td>`;
      if (number > 1) {
        html += '<td><button type="button" name="remove" class="btn btn-danger shadow btn-xs sharp remove"><i class="fa fa-trash"></i></button></td></tr>';
        $('tbody').append(html);
      } else {
        html += '<td><button type="button" name="add" id="add" class="btn btn-primary shadow btn-xs sharp"><i class="fa fa-plus"></i></button></td></tr>';
        $('tbody').html(html);
      }
    }

    $(document).on('click', '#add', function() {
      count++;
      dynamic_field(count);
    });

    $(document).on('click', '.remove', function() {
      count--;
      $(this).closest("tr").remove();
    });

  });
</script>
@stop