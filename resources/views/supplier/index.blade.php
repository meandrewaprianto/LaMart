@extends('layouts.app')

@section('title')
  Supplier
@endsection

@section('breadcrumb')
  @parent
  <li class="breadcrumb-item active">Supplier</li>
@endsection

@section('content')
<div class="container-fluid">
 
 <div class="card">
   <div class="card-header">
   <div class="row mb-2">
     <div class="col-4">
       <h3>Daftar Supplier</h3>
     </div>
     <div class="col-8 btnFlex">
       <button class="btn btn-success btn-sm pull-right" onclick="addForm()"><i class="fas fa-plus-circle"> </i>
        Tambah</button>
     </div>
   </div>
   </div>
   <div class="card-body">
     <div class="col-sm-12">
        {{ csrf_field() }}
        <table id="tblSupplier" class="table table-bordered table-striped" width="100%">
          <thead>
            <tr>
              <th width="20">No</th>
              <th>Nama Supplier</th>
              <th>Alamat</th>
              <th>Telpon</th>
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

@include('supplier.form')
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

    $(function(){
     table = $('.table').DataTable({
        "responsive": true,
        "processing": true,
        "ajax": {
          "url": "{{ route('supplier.data') }}",
          "type": "GET"
        },
      });
    
      //Menyimpan data dari form tambah/edit
      $('#modal-form form').on('submit', function(e){
        if(!e.isDefaultPrevented()) {
          var id = $('#id').val();

          if(save_method == "add") url = "{{ route('supplier.store') }}";
          else url = "supplier/"+id;

          $.ajax({
            url: url,
            type: "POST",
            data: $('#modal-form form').serialize(),
            success: function(data) {
                $('#modal-form').modal('hide');
                table.ajax.reload();
            },
            error: function() {
              alert("Tidak dapat menyimpan data!");
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
    $('.modal-title').text('Tambah Supplier');
  }

  //Menampilkan form edit data
  function editForm(id) {
    save_method = "edit";
    $('input[name=_method').val("PATCH");
    $('#modal-form form')[0].reset();
    $.ajax({
      url: "supplier/"+id+"/edit",
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        $('#modal-form').modal('show');
        $('.modal-title').text('Edit Supplier');
        
        $('#id').val(data.id_supplier);
        $('#nama').val(data.nama);
        $('#alamat').val(data.alamat);
        $('#telpon').val(data.telpon);
      },
      error: function() {
        alert("Tidak dapat menampilkan data!");
      }
    });
  }

  //Menghapus data
  function deleteData(id) {
    if(confirm("Apakah yakin data akan dihapus?")) {
      $.ajax({
        url: "supplier/"+id,
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