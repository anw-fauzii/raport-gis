<!-- Modal tambah  -->
<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Tambah {{$title}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ route('kelas.anggota') }}" method="POST">
            @csrf
            <div class="modal-body">
            <div class="row">
                <div class="col-12">
                <div class="form-group">
                    <div class="callout callout-info">
                    <label>
                        {{$kelas->nama_kelas}} {{$kelas->tapel->tahun_pelajaran}} Semester
                        @if($kelas->tapel->semester ==1)
                        Ganjil
                        @else
                        Genap
                        @endif
                    </label>
                    <p>Untuk menambahkan anggota kelas, silahkan pindahkan nama siswa ke kolom sebelah kanan lalu klik tombol simpan.</p>
                    </div>
                    <input type="hidden" name="kelas_id" value="{{$kelas->id}}">
                    <select class="duallistbox" multiple="multiple" name="siswa_id[]">
                    @foreach($siswa_belum_masuk_kelas as $belum_masuk_kelas)
                    <option value="{{$belum_masuk_kelas->id}}">{{$belum_masuk_kelas->nis}} | {{$belum_masuk_kelas->nisn}} | {{$belum_masuk_kelas->nama_lengkap}} ({{$belum_masuk_kelas->kelas_sebelumhya}})</option>
                    @endforeach
                    </select>
                    <div class="form-group row pt-3 pb-0 justify-content-end">
                    <label for="pendaftaran" class="col-sm-2 col-form-label">Jenis Pendaftaran</label>
                    <div class="col-sm-4">
                        <select class="form-control" name="pendaftaran" required>
                        <option value="">-- Pilih Jenis Pendaftaran --</option>
                        <option value="2">Pindahan</option>
                        @if($kelas->tapel->semester == 1)
                        <option value="1">Siswa Baru</option>
                        <option value="3">Naik Kelas</option>
                        <option value="5">Mengulang</option>
                        @else
                        <option value="4">Lanjutan Semester</option>
                        @endif
                        </select>
                    </div>
                    </div>
                </div>
                <!-- /.form-group -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
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