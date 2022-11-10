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
            <form action="{{ route('ekstrakulikuler.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                <div class="form-group row">
                    <label for="tahun_pelajaran" class="col-sm-3 col-form-label">Tahun Pelajaran</label>
                    <div class="col-sm-9">
                    @if($tapel->semester == 1)
                    <input type="text" name="tahun_pelajaran" class="form-control" value="{{$tapel->tahun_pelajaran}} Semester Ganjil" readonly>
                    @else
                    <input type="text" name="tahun_pelajaran" class="form-control" value="{{$tapel->tahun_pelajaran}} Semester Genap" readonly>
                    @endif </div>
                </div>
                <div class="form-group row">
                    <label for="nama_ekstrakulikuler" class="col-sm-3 col-form-label">Nama ekstrakulikuler</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" id="nama_ekstrakulikuler" name="nama_ekstrakulikuler" placeholder="Nama ekstrakulikuler" value="{{old('nama_ekstrakulikuler')}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="guru_id" class="col-sm-3 col-form-label">Pembimbing</label>
                    <div class="col-sm-9">
                    <select class="form-control select2" name="guru_id" style="width: 100%;" required>
                        <option value="">-- Pilih Wali Kelas --</option>
                        @foreach($data_guru as $guru)
                        <option value="{{$guru->id}}">{{$guru->nama_lengkap}}, {{$guru->gelar}}</option>
                        @endforeach
                    </select>
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