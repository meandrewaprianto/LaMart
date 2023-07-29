@extends('layouts.app')

@section('title')
  Transaksi Pembelian
@endsection

@section('breadcrumb')
  @parent
  <li class="breadcrumb-item">Pembelian</li>
  <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')
<div class="container-fluid">
 <div class="card">
   <div class="card-body">
     <div class="col-lg-12">
        <table id="tblPembelian" class="table table-bordered table-striped" width="100%">
          <tr>
            <td width="150">Supplier</td>
            <td><b>{{ $supplier->nama }} </b></td>
          </tr>
          <tr>
            <td width="150">Alamat</td>
            <td><b>{{ $supplier->alamat }} </b></td>
          </tr>
          <tr>
            <td width="150">Telpon</td>
            <td><b>{{ $supplier->telpon }} </b></td>
          </tr>
        </table>
        <hr>

        <form method="post" class="form-produk needs-validation" novalidate>
        {{ csrf_field() }} 

          <div class="card card-primary">
              <div class="card-body">
                  <input type="hidden" id="idpembelian" name="idpembelian" value="{{ $idpembelian }} "/>
                  <div class="row">
                    <label for="kode" class="col-sm-2 col-form-label">Kode Produk</label>
                    <div class="col-sm-10 form-group">
                      <input class="form-control" id="kode" type="text" name="kode" required autofocus />
                      <span class="input-group-btn">
                        <button onclick="showProduct()" type="button" class="btn btn-info" style="margin-top: 8px;" >...</button>
                      </span>
                    </div>
                  </div>
              </div>
          </div>
        </form>
     </div>

     <div class="col-lg-12">
        <form method="post" class="form-keranjang needs-validation" novalidate>
          {{ csrf_field() }} {{ method_field('PATCH') }}
            <table id="tblPembelianDetail" class="table table-bordered table-striped tabel-pembelian" width="100%">
              <thead>
                <tr>
                  <th width="30">No</th>
                  <th>Kode Produk</th>
                  <th>Nama Produk</th>
                  <th align="right">Harga</th>
                  <th>Jumlah</th>
                  <th align="right">Sub Total</th>
                  <th width="100">Aksi</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
        </form>
      
        <div class="row">
          <div class="col-md-8">
            <div id="tampil-bayar" style="background: #dd4b39; color: #fff; font-size: 80px; text-align: center;"></div>
            <div id="tampil-terbilang" style="background: #3c8dbc; color: #fff; font-weight: bold; padding: 10px"></div>
          </div>

          <div class="col-md-4">
            <form action="{{ route('pembelian.store') }}" class="form-pembelian" method="post">
              {{ csrf_field() }}
              <input type="hidden" name="idpembelian" value="{{ $idpembelian }}">
              <input type="hidden" name="total" id="total">
              <input type="hidden" name="totalitem" id="totalitem">
              <input type="hidden" name="bayar" id="bayar">

              <div class="row">
                <label for="totalrp" class="col-sm-2 col-form-label">Total</label>
                <div class="col-sm-10 form-group">
                  <input class="form-control" id="totalrp" type="text" readonly >
                </div>
              </div>
        
              <div class="row">
                <label for="diskon" class="col-sm-2 col-form-label">Diskon</label>
                <div class="col-sm-10 form-group">
                  <input class="form-control" id="diskon" type="number" name="diskon" value="0" >
                </div>
              </div>

              <div class="row">
                <label for="bayarrp" class="col-sm-2 col-form-label">Bayar</label>
                <div class="col-sm-10 form-group">
                  <input class="form-control" id="bayarrp" type="text" readonly >
                </div>
              </div>

            </form>
          </div>
        </div>

        <div class="row" style="justify-content: end">
          <button class="simpan btn btn-primary pull-right" type="submit"><i class="fas fa-floppy-o"></i>Simpan Transaksi</button>
        </div>
     </div>
 </div>
</div>


@include('pembelian_detail.produk')
@endsection

@section('script')
<script type="text/javascript">
  var table;

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
     $('.tabel-produk').DataTable();

     table = $('#tblPembelianDetail').DataTable({
        "dom": 'Brt',
        "bSort": false,
        "responsive": true,
        "processing": true,
        "ajax": {
          "url": "{{ route('pembelian_detail.data', $idpembelian) }}",
          "type": "GET"
        },
      }).on('draw.dt', function(){
        loadForm($('#diskon').val());
      });

      //Menghindari submit form saat dienter pada kode produk dan jumlah
      $('.form-produk').on('submit', function() {
        return false;
      });

      $('.form-keranjang').on('submit', function(){
        return false;
      });

      //Proses ketika kode produk atau diskon diubah
      $('#kode').change(function() {
        addItem();
      });

      $('#diskon').change(function() {
        if($(this).val() == "") $(this).val(0).select();
        loadForm($(this).val());
      });

      //Menyimpan form transaksi saat tombol simpan diklik
      $('.simpan').click(function(){
        $('.form-pembelian').submit();
      });
    });

    function addItem() {
      $.ajax({
        url: "{{ route('pembelian_detail.store') }}",
        type: "POST",
        data: $('.form-produk').serialize(),
        success: function(data) {
          $('#kode').val('').focus();
          table.ajax.reload(function(){
            loadForm($('#diskon').val());
          });
        },
        error: function() {
          alert("Tidak dapat menyimpan data!");
        }
      });
    }

    function selectItem(kode) {
      $('#kode').val(kode);
      $('#modal-produk').modal('hide');
      addItem();
    }

    function changeCount(id) {
      $.ajax({
        url: "pembelian_detail/"+id,
        type: "POST",
        data: $('.form-keranjang').serialize(),
        success: function(data) {
          $('#kode').val('').focus();
          table.ajax.reload(function(){
            loadForm($('#diskon').val());
          });
        },
        error: function() {
          alert("Tidak dapat menyimpan data");
        }
      });
    }

    function showProduct() {
      $('#modal-produk').modal('show');
    }

  //Menghapus data
  function deleteItem(id) {
    if(confirm("Apakah yakin data akan dihapus?")) {
      $.ajax({
        url: "pembelian_detail/"+id,
        type: "POST",
        data: {'_method' : 'DELETE', '_token' : $('meta[name=csrf-token]').attr('content')},
        success: function(data) {
          table.ajax.reload(function(){
            loadForm($('#diskon').val());
          });
        },
        error: function() {
          alert("Tidak dapat menghapus data!");
        } 
      });
    }
  }

    function loadForm(diskon=0){
      $('#total').val($('.total').text());
      $('#totalitem').val($('.totalitem').text());

      $.ajax({
        url: "pembelian_detail/loadForm/"+diskon+"/"+$('.total').text(),
        type: "GET",
        dataType: "JSON",
        success: function(data) {
          $('#totalrp').val("Rp. "+data.totalrp);
          $('#bayarrp').val("Rp. "+data.bayarrp);
          $('#bayar').val(data.bayar);
          $('#tampil-bayar').text("Rp. "+data.bayarrp);
          $('#tampil-terbilang').text(data.terbilang);
        },
        error: function() {
          alert("Tidak dapat menampilakn data");
        }
      });
    }
</script>
@endsection