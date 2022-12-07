<!-- Modal Registrasi  -->
@if($siswa->kelas_id != null)
<div class="modal fade" id="modal-registrasi{{$siswa->id}}">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Registrasi Siswa Keluar</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ route('siswa.registrasi') }}" method="POST">
            @csrf
            <div class="modal-body">
            <div class="callout callout-info">
                <h5>Diisi saat siswa keluar dari sekolah</h5>
                <p>Siswa yang dapat diluluskan hanyalah siswa yang berada pada kelas tingkat akhir pada semester genap.</p>
            </div>
            <input type="hidden" name="siswa_id" value="{{$siswa->id}}">
            <div class="form-group row">
                <label for="nama_lengkap" class="col-sm-3 col-form-label">Nama Siswa</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Siswa" value="{{$siswa->nama_lengkap}}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="keluar_karena" class="col-sm-3 col-form-label">Keluar Karena</label>
                <div class="col-sm-9 pt-1">
                <select class="form-control select2" name="keluar_karena" style="width: 100%;" required>
                    <option value="">-- Pilih Jenis Keluar --</option>
                    @if($siswa->kelas->tingkatan_kelas == $tingkatan_akhir && $siswa->kelas->tapel->semester == 2)
                    <option value="Lulus">Lulus</option>
                    @endif
                    <option value="Mutasi">Mutasi</option>
                    <option value="Dikeluarkan">Dikeluarkan</option>
                    <option value="Mengundurkan Diri">Mengundurkan Diri</option>
                    <option value="Putus Sekolah">Putus Sekolah</option>
                    <option value="Wafat">Wafat</option>
                    <option value="Hilang">Hilang</option>
                </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="tanggal_keluar" class="col-sm-3 col-form-label">Tanggal Keluar Sekolah</label>
                <div class="col-sm-9">
                <input type="date" class="form-control" id="tanggal_keluar" name="tanggal_keluar">
                </div>
            </div>

            <div class="form-group row">
                <label for="alasan_keluar" class="col-sm-3 col-form-label">Alasan Keluar</label>
                <div class="col-sm-9">
                <textarea class="form-control" id="alasan_keluar" name="alasan_keluar" placeholder="Alasan Keluar"></textarea>
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
@endif
<!-- End Modal Registrasi -->