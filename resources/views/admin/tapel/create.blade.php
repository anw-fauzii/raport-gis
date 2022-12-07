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
        <form action="{{ route('tahun-pelajaran.store') }}" method="POST">
        @csrf
        <div class="modal-body">
            <div class="form-group row">
            <label for="tahun_pelajaran" class="col-sm-3 col-form-label">Tahun Pelajaran</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="tahun_pelajaran" name="tahun_pelajaran" placeholder="Tahun Pelajaran" value="{{old('tahun_pelajaran')}}">
            </div>
            </div>
            <div class="form-group row">
            <label for="semester" class="col-sm-3 col-form-label">Semester</label>
            <div class="col-sm-9 pt-1">
                <label class="radio-inline mr-3"><input type="radio" name="semester" value="1" @if (old('semester')=='1' ) checked @endif required> Semester Ganjil</label>
                <label class="radio-inline mr-3"><input type="radio" name="semester" value="2" @if (old('semester')=='2' ) checked @endif required> Semester Genap</label>
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
<!-- End Modal tambah -->