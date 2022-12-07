<!-- Modal edit  -->
<div class="modal fade" id="modal-edit{{$mapel->id}}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit {{$title}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ route('mapel.update', $mapel->id) }}" method="POST">
            {{ method_field('PATCH') }}
            @csrf
            <div class="modal-body">
            <div class="form-group row">
                <label for="nama_mapel" class="col-sm-3 col-form-label">Nama Mata Pelajaran</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" id="nama_mapel" name="nama_mapel" value="{{$mapel->nama_mapel}}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="ringkasan_mapel" class="col-sm-3 col-form-label">Ringkasan</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" id="ringkasan_mapel" name="ringkasan_mapel" value="{{$mapel->ringkasan_mapel}}">
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