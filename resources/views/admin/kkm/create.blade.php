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
            <form action="{{ route('kkm.store') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group row">
                <label for="mapel_id" class="col-sm-3 col-form-label">Mata Pelajaran</label>
                <div class="col-sm-9">
                    <select class="form-control select2" name="mapel_id" style="width: 100%;" required>
                    <option value="">-- Pilih Mata Pelajaran -- </option>
                    @foreach($data_mapel as $mapel)
                    <option value="{{$mapel->id}}"> {{$mapel->nama_mapel}}</option>
                    @endforeach
                    </select> </div>
                </div>
                <div class="form-group row">
                <label for="kelas_id" class="col-sm-3 col-form-label">Kelas</label>
                <div class="col-sm-9">
                    <select class="form-control select2" name="kelas_id" style="width: 100%;" required>
                    <!--  -->
                    </select>
                </div>
                </div>
                <div class="form-group row">
                <label for="kkm" class="col-sm-3 col-form-label">KKM</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="kkm" name="kkm">
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