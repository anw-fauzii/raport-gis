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
        <form action="{{ route('mapel.store') }}" method="POST">
            @csrf
            <div class="modal-body">
            <input type="hidden" name="tapel_id" value="{{$tapel->id}}">
            <div class="form-group row">
                <label for="kategori_mapel" class="col-sm-3 col-form-label">Kategori</label>
                <div class="col-sm-9">
                <select class="form-control select2" name="kategori_mapel_id" style="width: 100%;" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategori_mapel as $kat_mapel)
                        <option value="{{$kat_mapel->id}}">{{$kat_mapel->kategori}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="nama_mapel" class="col-sm-3 col-form-label">Nama Mata Pelajaran</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" id="nama_mapel" name="nama_mapel" placeholder="Nama Mata Pelajaran" value="{{old('nama_mapel')}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="ringkasan_mapel" class="col-sm-3 col-form-label">Ringkasan</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" id="ringkasan_mapel" name="ringkasan_mapel" placeholder="Ringkasan Mapel" value="{{old('ringkasan_mapel')}}">
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