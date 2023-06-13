<!-- Modal tambah  -->
<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Rencana {{$title}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
            @csrf
            <div class="modal-body">

                <form id="dynamic_form" action="{{ route('projek-p5.store') }}" method="POST">
                @csrf
                <input type="hidden" name="kelas_id" value="{{$kelas->id}}">

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                        <th style="width: 40%;">Projek P5</th>
                        <th style="width: 50%;">Deskripsi</th>
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