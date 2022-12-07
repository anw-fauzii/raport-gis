<!-- Modal edit  -->
<div class="modal fade" id="modal-edit{{$kkm->id}}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Edit {{$title}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form action="{{ route('kkm.update', $kkm->id) }}" method="POST">
            {{ method_field('PATCH') }}
            @csrf
            <div class="modal-body">
                <div class="form-group row">
                <label for="mapel_id" class="col-sm-3 col-form-label">Mata Pelajaran</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="mapel_id" value="{{$kkm->mapel->nama_mapel}}" readonly>
                </div>
                </div>
                <div class="form-group row">
                <label for="kelas_id" class="col-sm-3 col-form-label">Kelas</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="kelas_id" value="{{$kkm->tingkat}}" readonly>
                </div>
                </div>
                <div class="form-group row">
                <label for="kkm" class="col-sm-3 col-form-label">KKM</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="kkm" name="kkm" value="{{$kkm->kkm}}">
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