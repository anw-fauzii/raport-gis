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
        <form action="{{ route('t2q.store') }}" method="POST">
            @csrf
            <div class="modal-body">
            <div class="row">
                <div class="col-12">
                <div class="form-group">
                    <div class="callout callout-info">
                    <label>
                        {{$guru->nama_lengkap}}
                    </label>
                    <p>Untuk menambahkan anggota kelas, silahkan pindahkan nama siswa ke kolom sebelah kanan lalu klik tombol simpan.</p>
                    </div>
                    <input type="hidden" name="guru_id" value="{{$guru->id}}">
                    <div class="form-group row">
                    <label for="semester" class="col-sm-2 col-form-label">Tingkat</label>
                    <div class="col-sm-10">
                            <select class="form-control select2" name="tingkat" style="width: 100%;" required>
                                <option value="" disabled>-- Pilih Tingkat Kelas --</option>
                                @for ($i = 1; $i <= 6; $i++) <option value="{{$i}}">{{$i}}</option> @endfor
                            </select>
                        </div>
                        </div>
                    <select class="duallistbox" multiple="multiple" name="siswa_id[]">
                    @foreach($siswa_belum_masuk_kelas as $belum_masuk_kelas)
                    <option value="{{$belum_masuk_kelas->id}}">{{$belum_masuk_kelas->siswa->nis}} | {{$belum_masuk_kelas->siswa->nisn}} | {{$belum_masuk_kelas->siswa->nama_lengkap}} ({{$belum_masuk_kelas->siswa->kelas->nama_kelas}})</option>
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
            <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- End Modal tambah -->