@extends('layouts.app')

@section('title')
  Member
@endsection

@section('breadcrumb')
  @parent
  <li class="breadcrumb-item active">Member</li>
@endsection

@section('content')
<div class="container-fluid">
 
 <div class="card">
   <div class="card-header">
   <div class="row mb-2">
     <div class="col-4">
       <h3>Daftar Member</h3>
     </div>
     <div class="col-8 btnFlex">
       <button class="btn btn-success btn-sm pull-right" onclick="addForm()"><i class="fas fa-plus-circle"> </i>
        Tambah</button>
       <button class="btn btn-info btn-sm pull-right" onclick="printCard()"><i class="fas fa-credit-card"></i> Cetak Kartu</button>
     </div>
   </div>
   </div>
   <div class="card-body">
     <div class="col-sm-12">
      <form method="post" id="form-member">
        {{ csrf_field() }}
        <table id="tblMember" class="table table-bordered table-striped" width="100%">
          <thead>
            <tr>
              <th width="20">
                <input type="checkbox" value="1" id="select-all">
              </th>
              <th width="20">No</th>
              <th>Kode Member</th>
              <th>Nama Member</th>
              <th>Alamat</th>
              <th>Telpon</th>
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

@include('member.form')
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
          "url": "{{ route('member.data') }}",
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

          if(save_method == "add") url = "{{ route('member.store') }}";
          else url = "member/"+id;

          $.ajax({
            url: url,
            type: "POST",
            data: $('#modal-form form').serialize(),
            dataType: "JSON",
            success: function(data) {
              if(data.msg == "error") {
                alert("Kode member sudah digunakan!");
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
    $('.modal-title').text('Tambah Member');
    $('#kode').attr('readonly', false);
  }

  //Menampilkan form edit data
  function editForm(id) {
    save_method = "edit";
    $('input[name=_method').val("PATCH");
    $('#modal-form form')[0].reset();
    $.ajax({
      url: "member/"+id+"/edit",
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        $('#modal-form').modal('show');
        $('.modal-title').text('Edit Member');
        
        $('#id').val(data.id_member);
        $('#kode').val(data.kode_member).attr('readonly', true);
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
        url: "member/"+id,
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

  //Mencetak barcode ketika tombol cetak Barcode diklik
  function printCard() {
    if($('input:checked').length < 1) {
      alert('Plih data yang akan dicetak!');
    } else {
      $('#form-member').attr('target', '_blank').attr('action', "member/cetak").submit();
    }
  }
</script>
@endsection