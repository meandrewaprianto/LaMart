@extends('layouts.app')

@section('title')
  Produk
@endsection

@section('breadcrumb')
  @parent
  <li class="breadcrumb-item active">Produk</li>
@endsection

@section('content')
<div class="container-fluid">
 
 <div class="card">
   <div class="card-header">
   <div class="row mb-2">
     <div class="col-4">
       <h3>Daftar Produk</h3>
     </div>
     <div class="col-8 btnFlex">
       <button class="btn btn-success btn-sm pull-right" onclick="addForm()"><i class="fas fa-plus-circle"> </i>
        Tambah</button>
       <button class="btn btn-danger btn-sm pull-right" onclick="deleteAll()"><i class="fas fa-trash"></i> Hapus</button>
       <button class="btn btn-info btn-sm pull-right" onclick="printBarcode()"><i class="fas fa-barcode"></i> Cetak Barcode</button>
     </div>
   </div>
   </div>
   <div class="card-body">
     <div class="col-sm-12">
      <form method="post" id="form-produk">
        {{ csrf_field() }}
        <table id="tblProduk" class="table table-bordered table-striped" width="100%">
        <thead>
          <tr>
            <th width="20">
              <input type="checkbox" value="1" id="select-all">
            </th>
            <th width="20">No</th>
            <th>Kode Produk</th>
            <th>Nama Produk</th>
            <th>Kategori</th>
            <th>Merk</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>Diskon</th>
            <th>Stok</th>
            <th width="100">Aksi</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
        </table>
      </form>
     </div>
   </div>
 </div>
</div>

@include('produk.form')
@endsection

@section('script')
<script type="text/javascript">
  var table, save_method;

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

    function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
    }


  $(function(){
    table = $('.table').DataTable({
      "responsive": true,
      "processing": true,
      "ajax": {
        "url": "{{ route('produk.data') }}",
        "type": "GET"
      },
      'columnDefs': [{
        'targets': 0,
        'searchable': false,
        'orderable': false
      }],
      'order': [1, 'asc']
    });
    
    //Centang semua checkbox ketika checkbox dengan id #select-all dicentang
    $('#select-all').click(function(){
      $('input[type="checkbox"]').prop('checked', this.checked);
    });

    //Menyimpan data dari form tambah/edit
    $('#modal-form form').on('submit', function(e){
      if(!e.isDefaultPrevented()) {
        var id = $('#id').val();

        if(save_method == "add") url = "{{ route('produk.store') }}";
        else url = "produk/"+id;

        $.ajax({
          url: url,
          type: "POST",
          data: $('#modal-form form').serialize(),
          dataType: "JSON",
          success: function(data) {
            if(data.msg == "error") {
              alert("Kode Produk sudah digunakan!");
              $('#kode').focus().select();
            } else {
              $('#modal-form').modal('hide');
              table.ajax.reload();
            }
          },
          error: function() {
            alert("Tidak dapat menyimpan data!")
          }
        });
        return false;
      }
    });
  });

  //Menampilkan form tambah data
  function addForm() {
    save_method = "add";
    $('input[name=_method]').val("POST");
    $('#modal-form').modal('show');
    $('#modal-form form')[0].reset();
    $('.modal-title').text('Tambah Produk');
    $('#kode').attr('readonly', false);
  }

  //Menampilkan form edit data
  function editForm(id) {
    save_method = "edit";
    $('input[name=_method').val("PATCH");
    $('#modal-form form')[0].reset();
    $.ajax({
      url: "produk/"+id+"/edit",
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        $('#modal-form').modal('show');
        $('.modal-title').text('Edit Produk');
        
        $('#id').val(data.id_produk);
        $('#kode').val(data.kode_produk).attr('readonly', true);
        $('#nama').val(data.nama_produk);
        $('#kategori').val(data.id_kategori);
        $('#merk').val(data.merk);
        $('#harga_beli').val(data.harga_beli);
        $('#diskon').val(data.diskon);
        $('#harga_jual').val(data.harga_jual);
        $('#stok').val(data.stok);
      },
      error: function() {
        alert("Tidak dapat menampilakn data!");
      }
    });
  }

  //Menghapus data
  function deleteData(id) {
    if(confirm("Apakah yakin data akan dihapus?")) {
      $.ajax({
        url: "produk/"+id,
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

  //Menghapus semua data yang dicentang
  function deleteAll() {
    if($('input:checked').length < 1) {
      alert('Plih data yang akan dihapus!');
    } else if (confirm("Apakah yakin akan menghapus semua data terpilih?")) {
      $.ajax({
        url: "produk/hapus",
        type: "POST",
        data: $('#form-produk').serialize(),
        success: function(data) {
          table.ajax.reload();
        },
        error: function() {
          alert("Tidak dapat menghapus data!");
        }
      });
    }
  }

  //Mencetak barcode ketika tombol cetak Barcode diklik
  function printBarcode() {
    if($('input:checked').length < 1) {
      alert('Plih data yang akan dicetak!');
    } else {
      $('#form-produk').attr('target', '_blank').attr('action', "produk/cetak").submit();
    }
  }
</script>
@endsection