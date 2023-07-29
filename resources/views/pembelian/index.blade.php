@extends('layouts.app')

@section('title')
  Pembelian
@endsection

@section('breadcrumb')
  @parent
  <li class="breadcrumb-item active">Pembelian</li>
@endsection

@section('content')
<div class="container-fluid">
 
 <div class="card">
   <div class="card-header">
   <div class="row mb-2">
     <div class="col-4">
       <h3>Daftar Pembelian</h3>
     </div>
     <div class="col-8 btnFlex">
        <a onclick="addForm()" class="btn btn-success"><i class="fas fa-plus-circle"></i> Transaksi Baru</a>
        @if(!empty(session('idpembelian')))
        <a href="{{ route('pembelian_detail.index') }}" class="btn btn-info"><i class="fas fa-plus-circle"></i> Transaksi Aktif</a>
        @endif
     </div>
   </div>
   </div>
   <div class="card-body">
     <div class="col-sm-12">
        {{ csrf_field() }}
        <table id="tblPembelian" class="table table-bordered table-striped tabel-pembelian" width="100%">
          <thead>
            <tr>
              <th width="30">No</th>
              <th>Supplier</th>
              <th>Total Item</th>
              <th>Total Harga</th>
              <th>Diskon</th>
              <th>Total Bayar</th>
              <th width="100">Aksi</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
     </div>
   </div>
 </div>
</div>

<div>
@include('pembelian.detail')
</div>
@include('pembelian.supplier')

@endsection

@section('script')
<script type="text/javascript">
  var table, save_method, table1;

    (() => {
      'use strict'

      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      const forms = document.querySelectorAll('.needs-validation')

      // Loop over them and prevent submission
      Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
          if (!form.checkValidity()) {
           
            event.preventDefault()
            event.stopPropagation()
          }

          form.classList.add('was-validated')
        }, false)
      })
    })()

    $(function(){
     table = $('.tabel-pembelian').DataTable({
        "responsive": true,
        "processing": true,
        "serverside": true,
        "ajax": {
          "url": "{{ route('pembelian.data') }}",
          "type": "GET"
        },
      });

      table1 = $('.tabel-detail').DataTable({
        "dom": 'Brt',
        "bSort": false,
        "processing": true
      });

      $('.tabel-supplier').DataTable();
    
    });

  //Menampilkan form tambah data
  function addForm() {
    $('#modal-supplier').modal('show');
  }

  //Menampilkan form edit data
  function showDetail(id) {
    $('#modal-detail').modal('show');

    table1.ajax.url("pembelian/"+id+"/lihat");
    table1.ajax.reload();
  }

  //Menghapus data
  function deleteData(id) {
    if(confirm("Apakah yakin data akan dihapus?")) {
      $.ajax({
        url: "pembelian/"+id,
        type: "POST",
        data: {'_method' : 'DELETE', '_token' : $('meta[name=csrf-token]').attr('content')},
        success: function(data) {
          table.ajax.reload();
        },
        error: function() {
          alert("Tidak dapat menghapus data!");
        }
      });
    }
  }
</script>
@endsection