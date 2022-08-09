<!-- Modal edit  -->
<div class="modal fade" id="modal-edit{{$kd->id}}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit {{$title}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('kd-mapel.update', $kd->id) }}" method="POST">
                {{ method_field('PATCH') }}
                @csrf
                <div class="modal-body">
                <div class="form-group row">
                    <label for="mapel" class="col-sm-3 col-form-label">Mata Pelajaran</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" id="mapel" value="{{$kd->mapel->nama_mapel}}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kode_kd" class="col-sm-3 col-form-label">Kode</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" id="kode_kd" value="{{$kd->kode_kd}}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kompetensi_dasar" class="col-sm-3 col-form-label">Kompetensi Dasar</label>
                    <div class="col-sm-9">
                    <textarea name="kompetensi_dasar" class="form-control" rows="2">{{$kd->kompetensi_dasar}}</textarea>
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