<div class="modal fade" id="modal-produk" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Cari Produk</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="card card-primary">
            <div class="card-body">
              <div class="col-sm-12">
                {{ csrf_field() }}
                <table id="tblProduk" class="table table-bordered table-striped tabel-produk" width="100%">
                  <thead>
                    <tr>
                      <th>Kode Produk</th>
                      <th>Nama Produk</th>
                      <th>Harga Beli</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($produk as $data)
                    <tr>
                      <th>{{ $data->kode_produk }}</th>
                      <th>{{ $data->nama_produk }}</th>
                      <th>Rp. {{ format_uang($data->harga_beli) }}</th>
                      <th><a onclick="selectItem( {{$data->kode_produk}})" class="btn btn-primary"><i class="fas fa-check-circle"></i>Pilih</a></th>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
          </div>
            <!-- /.card-body -->
          <!-- /.card -->
        </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>