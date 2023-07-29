<div class="modal fade" id="modal-detail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Detail Pembelian</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="card card-primary">
            <div class="card-body">
              <div class="col-sm-12">
                {{ csrf_field() }}
                <table id="tblSupplier" class="table table-bordered table-striped tabel-detail" width="100%">
                  <thead>
                    <tr>
                      <th width="30">No</th>
                      <th>Kode Produk</th>
                      <th>Nama Produk</th>
                      <th align="right">Harga</th>
                      <th>Jumlah</th>
                      <th align="right">Sub Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    
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