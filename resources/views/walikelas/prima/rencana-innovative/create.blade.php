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
        <form action="{{route('rencana-innovative.store')}}" method="POST">
            @csrf
            <div class="modal-body">
            <input type="hidden" name="kelas_id" value="{{$kelas->id}}">
            <div class="table-responsive">
                  <table class="table table-bordered table-hover">
                    <thead class="bg-primary">
                      <tr>
                        <th class="text-center">Butir Sikap Spiritual</th>
                        <th class="text-center">Pilih</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($data_butir_sikap as $sikap)
                      <tr>
                        <td><b>{{$sikap->kode}}</b> {{$sikap->butir_sikap}}</td>
                        <td class="text-center">
                          <input type="checkbox" name="butir_sikap_id[]" value="{{$sikap->id}}" class="form-check-input mx-0">
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
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
<!-- End Modal tambah -->