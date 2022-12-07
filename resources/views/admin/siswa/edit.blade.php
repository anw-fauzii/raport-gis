<!-- Modal edit  -->
<div class="modal fade" id="modal-edit{{$siswa->id}}">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit {{$title}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ route('siswa.update', $siswa->id) }}" method="POST">
            {{ method_field('PATCH') }}
            @csrf
            <div class="modal-body">
            <div class="form-group row">
                <label for="nama_lengkap" class="col-sm-3 col-form-label">Nama Siswa</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Siswa" value="{{$siswa->nama_lengkap}}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-9 pt-1">
                <label class="form-check-label mr-3"><input type="radio" name="jenis_kelamin" value="L" @if ($siswa->jenis_kelamin=='L' ) checked @endif required> Laki-Laki</label>
                <label class="form-check-label mr-3"><input type="radio" name="jenis_kelamin" value="P" @if ($siswa->jenis_kelamin=='P' ) checked @endif required> Perempuan</label>
                </div>
            </div>
            <div class="form-group row">
                <label for="nis" class="col-sm-3 col-form-label">NIS</label>
                <div class="col-sm-3">
                <input type="number" class="form-control" id="nis" name="nis" placeholder="NIS" value="{{$siswa->nis}}">
                </div>
                <label for="nisn" class="col-sm-2 col-form-label">NISN <small><i>(Opsional)</i></small></label>
                <div class="col-sm-4">
                <input type="number" class="form-control" id="nisn" name="nisn" placeholder="NISN" value="{{$siswa->nisn}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="tempat_lahir" class="col-sm-3 col-form-label">Tempat Lahir</label>
                <div class="col-sm-3">
                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" value="{{$siswa->tempat_lahir}}">
                </div>
                <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-4">
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{$siswa->tanggal_lahir->format('Y-m-d')}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="agama" class="col-sm-3 col-form-label">Agama</label>
                <div class="col-sm-3">
                <select class="form-control" name="agama" required>
                    <option value="{{$siswa->agama}}" selected>
                    @if($siswa->agama == 1)
                    Islam
                    @elseif($siswa->agama == 2)
                    Protestan
                    @elseif($siswa->agama == 3)
                    Katolik
                    @elseif($siswa->agama == 4)
                    Hindu
                    @elseif($siswa->agama == 5)
                    Budha
                    @elseif($siswa->agama == 6)
                    Khonghucu
                    @elseif($siswa->agama == 7)
                    Kepercayaan
                    @endif
                    </option>
                    <option value="1">Islam</option>
                    <option value="2">Protestan</option>
                    <option value="3">Katolik</option>
                    <option value="4">Hindu</option>
                    <option value="5">Budha</option>
                    <option value="6">Khonghucu</option>
                    <option value="7">Kepercayaan</option>
                </select>
                </div>
                <label for="anak_ke" class="col-sm-2 col-form-label">Anak Ke</label>
                <div class="col-sm-4">
                <input type="number" class="form-control" id="anak_ke" name="anak_ke" value="{{$siswa->anak_ke}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="status_dalam_keluarga" class="col-sm-3 col-form-label">Status Dalam Keluarga</label>
                <div class="col-sm-9 pt-1">
                <label class="form-check-label mr-3"><input type="radio" name="status_dalam_keluarga" value="1" @if ($siswa->status_dalam_keluarga=='1' ) checked @endif required> Anak Kandung</label>
                <label class="form-check-label mr-3"><input type="radio" name="status_dalam_keluarga" value="2" @if ($siswa->status_dalam_keluarga=='2' ) checked @endif required> Anak Angkat</label>
                <label class="form-check-label mr-3"><input type="radio" name="status_dalam_keluarga" value="3" @if ($siswa->status_dalam_keluarga=='3' ) checked @endif required> Anak Tiri</label>
                </div>
            </div>
            <div class="form-group row">
                <label for="nuptk" class="col-sm-3 col-form-label">Alamat</label>
                <div class="col-sm-9">
                <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat lengkap">{{$siswa->alamat}}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="nomor_hp" class="col-sm-3 col-form-label">Nomor HP <small><i>(opsional)</i></small></label>
                <div class="col-sm-9">
                <input type="number" class="form-control" id="nomor_hp" name="nomor_hp" placeholder="Nomor HP" value="{{$siswa->nomor_hp}}">
                </div>
            </div>

            <div class="form-group row">
                <label for="nama_ayah" class="col-sm-3 col-form-label">Nama Ayah</label>
                <div class="col-sm-3">
                <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" placeholder="Nama Ayah" value="{{$siswa->nama_ayah}}">
                </div>
                <label for="nama_ibu" class="col-sm-2 col-form-label">Nama Ibu</label>
                <div class="col-sm-4">
                <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" placeholder="Nama Ibu" value="{{$siswa->nama_ibu}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="pekerjaan_ayah" class="col-sm-3 col-form-label">Pekerjaan Ayah</label>
                <div class="col-sm-3">
                <input type="text" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah" placeholder="Pekerjaan Ayah" value="{{$siswa->pekerjaan_ayah}}">
                </div>
                <label for="pekerjaan_ibu" class="col-sm-2 col-form-label">Pekerjaan Ibu</label>
                <div class="col-sm-4">
                <input type="text" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu" placeholder="Pekerjaan Ibu" value="{{$siswa->pekerjaan_ibu}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="nama_wali" class="col-sm-3 col-form-label">Nama Wali <small><i>(Opsional)</i></small></label>
                <div class="col-sm-3">
                <input type="text" class="form-control" id="nama_wali" name="nama_wali" placeholder="Nama Wali" value="{{$siswa->nama_wali}}">
                </div>
                <label for="pekerjaan_wali" class="col-sm-2 col-form-label">Pekerjaan Wali <small><i>(Opsional)</i></small></label>
                <div class="col-sm-4">
                <input type="text" class="form-control" id="pekerjaan_wali" name="pekerjaan_wali" placeholder="Pekerjaan Wali" value="{{$siswa->pekerjaan_wali}}">
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
<!-- End Modal edit -->