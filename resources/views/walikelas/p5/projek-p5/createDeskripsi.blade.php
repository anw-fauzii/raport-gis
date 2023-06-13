<!-- Modal tambah  -->
<div class="modal fade" id="modal-tambah{{$data->id}}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{$data->judul}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
            @csrf
            <div class="modal-body">

                <form id="deskripsi_p5" action="{{ route('deskripsi-p5.store') }}" method="POST">
                @csrf
                <input type="hidden" name="p5_id" value="{{$data->id}}">
                <div class="form-group row">
                    <label for="dimensi" class="col-sm-2 col-form-label">Dimensi</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="dimensi" name="dimensi" placeholder="Masukan Dimensi" value="{{old('dimensi')}}">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                        <th style="width: 40%;">Sub Elemen</th>
                        <th style="width: 50%;">Capaian Fase</th>
                        <th style="width: 10%;">Baris</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--  -->
                    </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer clearfix">
                <button type="submit" onclick="submitForm(this);" class="btn btn-primary float-right">Simpan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal tambah -->