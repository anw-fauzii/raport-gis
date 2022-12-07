
<!-- Modal edit  -->
<div class="modal fade" id="modal-edit{{$pengumuman->id}}">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit {{$title}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('pengumuman.update', $pengumuman->id) }}" method="POST">
                {{ method_field('PATCH') }}
                @csrf
                <div class="modal-body">
                <div class="form-group">
                    <label>Judul Pengumuman</label>
                    <input type="text" class="form-control" name="judul" value="{{$pengumuman->judul}}" readonly>
                </div>
                <div class="form-group">
                    <label>Isi Pengumuman</label>
                    <textarea id="summernoteedit" name="isi" style="width: 100%; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 5px;" required>{!! $pengumuman->isi !!}</textarea>
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