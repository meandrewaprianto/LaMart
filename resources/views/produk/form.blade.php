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
                  <label for="kode" class="col-sm-2 col-form-label">Kode Produk</label>
                  <div class="col-sm-10 from-group">
                    <input class="form-control" id="kode" type="text" name="kode" required autofocus onkeypress="return isNumber(event)" maxLength="8" minLength="8">
                    <div class="invalid-feedback">
                      Kode Produk masih Kosong atau Kurang dari 8 Karakter 
                    </div>
                  </div>
                </div>
                &nbsp;&nbsp;
                <div class="row">
                  <label for="nama" class="col-sm-2 col-form-label">Nama Produk</label>
                  <div class="col-sm-10 from-group">
                    <input class="form-control" id="nama" type="text" name="nama" required autofocus >
                    <div class="invalid-feedback">
                      Nama Produk masih kosong
                    </div>
                  </div>
                </div>
                &nbsp;&nbsp;
                <div class="row">
                  <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                  <div class="col-sm-10 from-group">
                    <select id="kategori" class="form-control" name="kategori" required>
                      <option value=""> -- Pilih Kategori -- </option>
                      @foreach($kategori as $list)
                        <option value="{{ $list->id_kategori }}">{{ $list->nama_kategori }}</option>
                      @endforeach
                    </select>
                    <div class="invalid-feedback">
                      Jenis Kategori belum dipilih
                    </div>
                  </div>
                </div>
                &nbsp;&nbsp;
                <div class="row">
                  <label for="merk" class="col-sm-2 col-form-label">Merk</label>
                  <div class="col-sm-10 from-group">
                    <input class="form-control" id="merk" type="text" name="merk" required>
                    <div class="invalid-feedback">
                        Nama Merk masih kosong 
                    </div>
                  </div>
                </div>
                &nbsp;&nbsp;
                <div class="row">
                  <label for="harga_beli" class="col-sm-2 col-form-label">Harga Beli</label>
                  <div class="col-sm-10 from-group">
                    <input class="form-control" id="harga_beli" type="text" name="harga_beli" required >
                    <div class="invalid-feedback">
                      Harga Beli masih kosong
                    </div>
                  </div>
                </div>
                &nbsp;&nbsp;
                <div class="row">
                  <label for="diskon" class="col-sm-2 col-form-label">Diskon</label>
                  <div class="col-sm-10 from-group">
                    <input class="form-control" id="diskon" type="text" name="diskon" required >
                    <div class="invalid-feedback">
                      Diskon masih kosong 
                    </div>
                  </div>
                </div>
                &nbsp;&nbsp;
                <div class="row">
                  <label for="harga_jual" class="col-sm-2 col-form-label">Harga Jual</label>
                  <div class="col-sm-10 from-group">
                    <input class="form-control" id="harga_jual" type="text" name="harga_jual" required>
                    <div class="invalid-feedback">
                      Harga Jual masih kosong 
                    </div>
                  </div>
                </div>
                &nbsp;&nbsp;
                <div class="row">
                  <label for="stok" class="col-sm-2 col-form-label">Stok</label>
                  <div class="col-sm-10 from-group">
                    <input class="form-control" id="stok" type="text" name="stok" required >
                    <div class="invalid-feedback">
                      Stok masih kosong
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