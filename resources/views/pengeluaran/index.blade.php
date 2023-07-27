@extends('layouts.app')

@section('title')
  Pengeluaran
@endsection

@section('breadcrumb')
  @parent
  <li class="breadcrumb-item active">Pengeluaran</li>
@endsection

@section('content')
<div class="container-fluid">
 
 <div class="card">
   <div class="card-header">
   <div class="row mb-2">
     <div class="col-4">
       <h3>Daftar Pengeluaran</h3>
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
        <table id="tblPengeluaran" class="table table-bordered table-striped" width="100%">
          <thead>
            <tr>
              <th width="30">No</th>
              <th>Tanggal</th>
              <th>Jenis Pengeluaran</th>
              <th>Nominal</th>
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

@include('pengeluaran.form')
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
          "url": "{{ route('pengeluaran.data') }}",
          "type": "GET"
        },
      });
    
      //Menyimpan data dari form tambah/edit
      $('#modal-form form').on('submit', function(e){
        if(!e.isDefaultPrevented()) {
          var id = $('#id').val();

          if(save_method == "add") url = "{{ route('pengeluaran.store') }}";
          else url = "pengeluaran/"+id;
          

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
    $('.modal-title').text('Tambah Pengeluaran');
  }

  //Menampilkan form edit data
  function editForm(id) {
    save_method = "edit";
    $('input[name=_method').val("PATCH");
    $('#modal-form form')[0].reset();
    $.ajax({
      url: "pengeluaran/"+id+"/edit",
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        $('#modal-form').modal('show');
        $('.modal-title').text('Edit Pengeluaran');
        
        $('#id').val(data.id_pengeluaran);
        $('#jenis').val(data.jenis_pengeluaran);
        $('#nominal').val(data.nominal);
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
        url: "pengeluaran/"+id,
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