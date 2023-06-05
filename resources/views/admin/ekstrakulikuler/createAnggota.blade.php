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
        <form action="{{ route('ekstrakulikuler.anggota') }}" method="POST">
            @csrf
            <div class="modal-body">
            <div class="row">
                <div class="col-12">
                <div class="form-group">
                    <div class="callout callout-info">
                    <label>
                    {{$ekstrakulikuler->nama_ekstrakulikuler}} {{$ekstrakulikuler->tapel->tahun_pelajaran}} Semester
                        @if($ekstrakulikuler->tapel->semester ==1)
                            Ganjil
                        @else
                            Genap
                        @endif
                    </label>
                    <p>Untuk menambahkan anggota kelas, silahkan pindahkan nama siswa ke kolom sebelah kanan lalu klik tombol simpan.</p>
                    </div>
                    <input type="hidden" name="ekstrakulikuler_id" value="{{$ekstrakulikuler->id}}">
                    <select class="duallistbox" multiple="multiple" name="siswa_id[]">
                        @foreach($siswa_belum_masuk_ekstrakulikuler as $belum_masuk_ekstrakulikuler)
                        <option value="{{$belum_masuk_ekstrakulikuler->anggota_kelas}}">{{$belum_masuk_ekstrakulikuler->nis}} | {{$belum_masuk_ekstrakulikuler->nisn}} | {{$belum_masuk_ekstrakulikuler->nama_lengkap}} ({{$belum_masuk_ekstrakulikuler->kelas->nama_kelas}})</option>
                        @endforeach
                    </select>
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