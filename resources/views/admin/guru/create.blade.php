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
            <form action="{{ route('guru.store') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group row">
                <label for="nama_lengkap" class="col-sm-3 col-form-label">Nama Lengkap</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap" value="{{old('nama_lengkap')}}">
                </div>
                </div>
                <div class="form-group row">
                <label for="gelar" class="col-sm-3 col-form-label">Gelar</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="gelar" name="gelar" placeholder="Gelar" value="{{old('gelar')}}">
                </div>
                </div>
                <div class="form-group row">
                <label for="nip" class="col-sm-3 col-form-label">NIPY</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="nip" name="nip" placeholder="NIPY" value="{{old('nip')}}">
                </div>
                </div>
                <div class="form-group row">
                <label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-9 pt-1">
                    <label class="form-check-label mr-3"><input type="radio" name="jenis_kelamin" value="L" @if (old('jenis_kelamin')=='L' ) checked @endif required> Laki-Laki</label>
                    <label class="form-check-label mr-3"><input type="radio" name="jenis_kelamin" value="P" @if (old('jenis_kelamin')=='P' ) checked @endif required> Perempuan</label>
                </div>
                </div>
                <div class="form-group row">
                <label for="tempat_lahir" class="col-sm-3 col-form-label">Tempat Lahir</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" value="{{old('tempat_lahir')}}">
                </div>
                </div>
                <div class="form-group row">
                <label for="tanggal_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-9">
                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{old('tanggal_lahir')}}">
                </div>
                </div>
                <div class="form-group row">
                <label for="nuptk" class="col-sm-3 col-form-label">NUPTK <small><i>(opsional)</i></small></label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="nuptk" name="nuptk" placeholder="NUPTK" value="{{old('nuptk')}}">
                </div>
                </div>
                <div class="form-group row">
                <label for="nuptk" class="col-sm-3 col-form-label">Alamat</label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat">{{old('alamat')}}</textarea>
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