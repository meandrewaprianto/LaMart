@extends('layouts.app')

@section('title')
  Kategori
@endsection

@section('breadcrumb')
  @parent
  <li class="breadcrumb-item active">Kategori</li>
@endsection

@section('content')
<div class="container-fluid">
 
 <div class="card">
   <div class="card-header">
   <div class="row mb-2">
     <div class="col-10">
       <h3>Daftar Kategori</h3>
     </div>
     <div class="col-2 btnFlex">
       <button class="btn btn-success pull-right" onclick="addForm()">Tambah</button>
     </div>
   </div>
   </div>
   <div class="card-body">
     <div class="col-sm-12">
       <table id="tblKategori" class="table table-bordered table-striped" width="100%">
       <thead>
         <tr>
           <th width="30">No</th>
           <th>Nama Kategori</th>
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

@include('kategori.form')
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

  $(function() {
    table = $('.table').DataTable({
      "responsive": true,
      "processing": true,
      "searching": true,
      "ajax": {
        "url": "{{ route('kategori.data') }}",
        "type": "GET"
      }
    });

    //Menyimpan data form tambah/edit beserta validasinya
    $('#modal-form form').on('submit', function(e){
      if(!e.isDefaultPrevented()) {
        var id = $('#id').val();
        if(save_method == "add") url = "{{ route('kategori.store') }}";
        else url = "kategori/"+id;
        
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

  function addForm() {
    save_method = "add";
    $('input[name=_method]').val('POST');
    $('#modal-form').modal('show');
    $('#modal-form form')[0].reset();
    $('.modal-title').text('Tambah Kategori');
  }

  //Menampilakn form edit dan menampilak data pada form tersebut
  function editForm(id) {
    save_method = "edit";
    $('input[name=_method]').val('PATCH');
    $('#modal-form form')[0].reset();
    $.ajax({
      url: "kategori/"+id+"/edit",
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        $('#modal-form').modal('show');
        $('.modal-title').text('Edit Kategori');

        $('#id').val(data.id_kategori);
        $('#nama').val(data.nama_kategori);
      },
      error: function(){
        alert("Tidak dapat menampilkan data!");
      }
    });
  }

  //Menghapus data
  function deleteData(id){
    if(confirm('Apakah yakin data akan dihapus?')) {
      $.ajax({
        url: "kategori/"+id,
        type: "POST",
        data: { '_method' : 'DELETE', '_token' : $('meta[name=csrf-token]').attr('content') },
        success: function(data) {
          table.ajax.reload();
        },
        error: function() {
          alert('Tidak dapat menghapus data!');
        }
      });
    }
  }
</script>
@endsection