<div class="modal fade" id="modal-supplier" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="post" class="needs-validation" novalidate>
        {{ csrf_field() }}  {{ method_field('POST') }}
        
        <div class="modal-header">
          <h4 class="modal-title">Pilih Supplier</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="card card-primary">
            <div class="card-body">
              <div class="col-sm-12">
                {{ csrf_field() }}
                <table id="tblSupplier" class="table table-bordered table-striped tabel-supplier" width="100%">
                  <thead>
                    <tr>
                      <th>Nama Supplier</th>
                      <th>Alamat</th>
                      <th>Telpon</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($supplier as $data)
                    <tr>
                      <th>{{ $data->nama }}</th>
                      <th>{{ $data->alamat }}</th>
                      <th>{{ $data->telpon }}</th>
                      <th>
                        <a href="pembelian/{{ $data->id_supplier }}/tambah" class="btn btn-primary">
                          <i class="fas fa-check-circle"></i> Pilih
                        </a>
                      </th>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card-body -->
          <!-- /.card -->
          </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>