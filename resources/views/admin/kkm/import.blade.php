<!-- Modal import  -->
<div class="modal fade" id="modal-import">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Import {{$title}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form name="contact-form" action="{{ route('kkm.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="callout callout-info">
                <h5>Download format import</h5>
                <p>Silahkan download file format import melalui tombol dibawah ini.</p>
                <a href="{{ route('kkm.create') }}" class="btn btn-primary text-white" style="text-decoration:none"><i class="fas fa-file-download"></i> Download</a>
                </div>
                <div class="form-group row pt-2">
                <label for="file_import" class="col-sm-2 col-form-label">File Import</label>
                <div class="col-sm-10">
                    <div class="custom-file">
                    <input type="file" class="custom-file-input" name="file_import" id="customFile" accept="application/vnd.ms-excel">
                    <label class="custom-file-label" for="customFile">Pilih file</label>
                    </div>
                </div>
                </div>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Import</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal import -->