<!-- Modal tambah  -->
<div class="modal fade" id="modal-show{{$penilaian->id}}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Rencana {{$title}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="#" method="POST">
            @csrf
            <div class="modal-body">
                <input type="hidden" name="pembelajaran_id" value="{{$penilaian->id}}">
                  <table class="table table-bordered table-hover">
                    <thead class="bg-primary">
                      <tr>
                        <th class="text-center">Butir Sikap Spiritual</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($ren_penilaian->where('pembelajaran_id', $penilaian->id) as $kd_mapel)
                      <tr>
                        <td><strong>{{$kd_mapel->kd_mapel->kode_kd}} </strong>{{$kd_mapel->kd_mapel->kompetensi_dasar}}</td>
                        <td class="text-center"><form action="{{ route('rencana-kokulikuler.destroy', $kd_mapel->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm mt-1" onclick="return confirm('Hapus {{$title}} ?')">
                      <i class="fas fa-trash-alt"></i>
                    </button>
                  </form></td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
            <div class="modal-footer justify-content-end">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- End Modal tambah -->