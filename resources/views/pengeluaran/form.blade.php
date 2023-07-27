<div class="modal fade" id="modal-form" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="post" class="needs-validation" novalidate>
        {{ csrf_field() }}  {{ method_field('POST') }}
        
        <div class="modal-header">
          <h4 class="modal-title"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="card card-primary">
            <div class="card-body">
                <input type="hidden" id="id" name="id"/>

                <div class="row">
                  <label for="jenis" class="col-sm-2 col-form-label">Jenis Pengeluaran</label>
                  <div class="col-sm-10 from-group">
                    <input class="form-control" id="jenis" type="text" name="jenis" required autofocus >
                    <div class="invalid-feedback">
                      Jenis pengeluaran masih kosong
                    </div>
                  </div>
                </div>
                &nbsp;&nbsp;
                <div class="row">
                  <label for="nominal" class="col-sm-2 col-form-label">Nominal</label>
                  <div class="col-sm-10 from-group">
                    <input class="form-control" id="nominal" type="number" name="nominal" onkeypress="return isNumber(event)" required>
                    <div class="invalid-feedback">
                        Nominal masih kosong 
                    </div>
                  </div>
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