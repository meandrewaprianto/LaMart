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
                  <label for="kode" class="col-sm-2 col-form-label">Kode Member</label>
                  <div class="col-sm-10 from-group">
                    <input class="form-control" id="kode" type="text" name="kode" required autofocus onkeypress="return isNumber(event)" maxLength="12" minLength="12">
                    <div class="invalid-feedback">
                      Kode Member masih Kosong atau Kurang dari 12 Karakter 
                    </div>
                  </div>
                </div>
                &nbsp;&nbsp;
                <div class="row">
                  <label for="nama" class="col-sm-2 col-form-label">Nama Member</label>
                  <div class="col-sm-10 from-group">
                    <input class="form-control" id="nama" type="text" name="nama" required autofocus >
                    <div class="invalid-feedback">
                      Nama Member masih kosong
                    </div>
                  </div>
                </div>
                &nbsp;&nbsp;
                <div class="row">
                  <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                  <div class="col-sm-10 from-group">
                    <input class="form-control" id="alamat" type="text" name="alamat" required>
                    <div class="invalid-feedback">
                        Alamat masih kosong 
                    </div>
                  </div>
                </div>
                &nbsp;&nbsp;
                <div class="row">
                  <label for="telpon" class="col-sm-2 col-form-label">Telpon</label>
                  <div class="col-sm-10 from-group">
                    <input class="form-control" id="telpon" type="text" name="telpon" required >
                    <div class="invalid-feedback">
                      Telpon masih kosong
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