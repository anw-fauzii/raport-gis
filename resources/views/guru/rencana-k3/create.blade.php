<!-- Modal tambah  -->
<div class="modal fade" id="modal-tambah{{$penilaian->id}}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Rencana {{$title}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{route('rencana-k3.store')}}" method="POST">
            @csrf
            <div class="modal-body">
            <input type="hidden" name="kelas_id" value="">
            @foreach($data_kd_mapel->where('mapel_id', $penilaian->mapel_id) as $kd_mapel)
            <div class="row">
              <div class="col-md-10"><strong>{{$kd_mapel->kode_kd}} </strong>{{$kd_mapel->kompetensi_dasar}}</div>
              <div class="col-md-2 text-center">
                          <input type="checkbox" name="butir_sikap_id[]" value="{{$kd_mapel->id}}" class="form-check-input mx-0">
            </div>
            @endforeach
            <div class="modal-footer justify-content-end">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- End Modal tambah -->