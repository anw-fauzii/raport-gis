<!-- Modal tambah  -->
<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Input {{$title}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <form action="{{ route('tanggal-raport.store') }}" method="POST">
        @csrf
        <div class="modal-body">
            <div class="form-group row">
            <label for="tapel_id" class="col-sm-3 col-form-label">Tahun Pelajaran</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" value="{{$tapel->tahun_pelajaran}} {{$tapel->semester}}" readonly>
                <input type="hidden" class="form-control" name="tapel_id" value="{{$tapel->id}}" readonly>
            </div>
            </div>
            <div class="form-group row">
            <label for="tempat_penerbitan" class="col-sm-3 col-form-label">Tempat Penerbitan</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="tempat_penerbitan">
            </div>
            </div>
            <div class="form-group row">
            <label for="tanggal_pembagian" class="col-sm-3 col-form-label">Tanggal Pembagian</label>
            <div class="col-sm-9">
                <input type="date" class="form-control" name="tanggal_pembagian">
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