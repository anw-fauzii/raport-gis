@extends('layouts.app')

@section('title')
    <title>Reset Akun</title>
@endsection

@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit"></i>
                </div>
                <div>
                    <h3>Reset Akun</h3>
                </div>
            </div>  
        </div> 
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3 card">
                <div class="card-header-tab card-header-tab-animation card-header">
                    <div class="card-header-title">
                        Data User
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-user">
                                <thead>
                                    <tr class="text-center">
                                        <th width="">No</th>
                                        <th width="">NIPY</th>
                                        <th width="">Nama</th>
                                        <th>Status</th>
                                        <th>Terakhir Dilihat</th>
                                        <th width="">Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div> 
            </div>
        </div>    
    </div>
</div>
<script>
$(function () {
 
 $.ajaxSetup({
     headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
 });  
//Tabel bulan
 var table = $('.table-user').DataTable({
     "lengthMenu": [
         [ 25, 50, 100, 1000, -1 ],
         [ '25', '50', '100', '1000', 'All' ]
     ],
     processing: true,
     serverSide: true,
     responsive: true,
     autoWidth: false,
     retrieve: true,
     ajax: "",
     columns: [
         {data: 'DT_RowIndex', name: 'DT_RowIndex'},
         {data: 'email', name: 'email'},
         {data: 'name', name: 'name'},
         {data: 'status', name: 'status'},
         {data: 'last_seen', name: 'last_seen'},
         {data: 'action', name: 'action', orderable: false, searchable: false},
     ]
 });

 $('body').on('click', '.resetAkun', function (){
        var id = $(this).data("id");
        var result = Swal.fire({
            title: 'Peringatan!', 
            text: 'Apakah anda yakin?', 
            icon: 'warning',
            showCancelButton: true,
        }).then((result) =>{
                if (result.isConfirmed){
                    $.ajax({
                    type: "POST",
                    url: "user-reset"+'/'+id,
                    success: function (data) {
                        table.draw();
                        Swal.fire("Sukes!", "Akun Berhasil Direset!", "success");
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }
        })
    });
});
</script>    
@endsection