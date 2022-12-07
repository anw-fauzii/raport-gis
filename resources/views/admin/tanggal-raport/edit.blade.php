<!-- Modal edit  -->
<div class="modal fade" id="modal-edit{{$tgl_raport->id}}">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Edit {{$title}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <form action="{{ route('tanggal-raport.update', $tgl_raport->id) }}" method="POST">
        {{ method_field('PATCH') }}
        @csrf
        <div class="modal-body">
            <div class="form-group row">
            <label for="tapel_id" class="col-sm-3 col-form-label">Tahun Pelajaran</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="tapel_id" value="{{$tgl_raport->tapel->tahun_pelajaran}} {{$tgl_raport->tapel->semester}}" readonly>
            </div>
            </div>
            <div class="form-group row">
            <label for="tempat_penerbitan" class="col-sm-3 col-form-label">Tempat Penerbitan</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="tempat_penerbitan" name="tempat_penerbitan" value="{{$tgl_raport->tempat_penerbitan}}">
            </div>
            </div>
            <div class="form-group row">
            <label for="tanggal_pembagian" class="col-sm-3 col-form-label">Tanggal Pembagian</label>
            <div class="col-sm-9">
                <input type="date" class="form-control" id="tanggal_pembagian" name="tanggal_pembagian" value="{{$tgl_raport->tanggal_pembagian->format('Y-m-d')}}">
            </div>
            </div>
        </div>
        <div class="modal-footer justify-content-end">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <button type="submit" onclick="submitForm(this);" class="btn btn-primary">Simpan</button>
        </div>
        </form>
    </div>
    </div>
</div>
<!-- End Modal edit -->