<?php if(session()->getFlashData('pesan')): ?>
                <div class="alert alert-success" style="width: 300px;" role="alert">
                    <?= session()->getFlashData('pesan'); ?>
                </div>
                <?php endif; ?>
<div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
              
                <h3 class="card-title"><?= $subjudul; ?></h3>
                <div class="card-tools">
                  <button class="btn btn-tool" data-toggle="modal" data-target="#add-data"><i class="fas fa-plus" ></i><b>Tambah Data</b></button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">No</th>
                      <th class="text-center">Nama Produk</th>
                      <th class="text-center">Satuan</th>
                      <th class="text-center">Harga Beli</th>
                      <th class="text-center">Harga Jual</th>
                      <th class="text-center" style="width: 300px;">Aksi</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no =1;
                    foreach ($produk as $key =>$value) {?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $value['nama_produk']; ?></td>
                            <td class="text-center"><?php if ($value['id_satuan']==1) {?>
                                <span>Buah</span>
                            <?php }  elseif($value['id_satuan']==2) {?>
                                <span>Box</span>
                                <?php } ?>
                            </td>
                            
                            <td class="text-center">Rp.<?= number_format($value['harga_beli'],0); ?></td>
                            <td class="text-center">Rp.<?= number_format($value['harga_jual'],0); ?></td>
                            <td class="text-center">
                                <button class="btn btn-warning mr-2"data-toggle="modal" data-target="#edit-data<?= $value['id'] ?>"><i class="fas fa-pencil-alt"></i>Edit</button>
                                <form action="/produk/<?= $value['id']; ?>" method="POST" class="d-inline">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin mendelete <?= $value['nama_produk']; ?> ?') "><i class="fas fa-trash mr-1"></i>Delete</button>
                                </form>
                        </td>
                        </tr>
                 <?php   } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
    
          <div class="modal fade" id="add-data">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Data <?= $subjudul; ?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
            <div class="modal-body">
                <form class="form-group" action="/produk/create" method="POST">
                    <label for="produk">Nama produk</label>
                    <input type="text" name="nama_produk" class="form-control" placeholder="Produk" required>
                    <label for="satuan">Satuan</label>
                    <div >
                    <select style="width: 200px; height: 40px;" name="id_satuan" id="id_satuan" >
                    <option value="1">Buah</option>
                    <option value="2">Box</option>
                    <option value="3">Bungkus</option>
                    </select>
                    </div>
                    <label for="harga beli">Harga Beli</label>
                    <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">Rp</span>
                    <input type="number" id="harga_beli" name="harga_beli" class="form-control" placeholder="Harga Beli" required>
                    </div>
                    </div>
                    <label for="harga_jual">Harga Jual</label>
                    <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Rp</span>
                    <input type="number" id="harga_jual" name="harga_jual" class="form-control" placeholder="Harga Jual" required>
                    </div>
                    </div>
                    
                    
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <?php foreach ($produk as $key => $value) {?>
        <div class="modal fade" id="edit-data<?= $value['id'];?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Ubah Data <?= $subjudul; ?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
            <div class="modal-body">
                <form class="form-group" action="/produk/update/<?= $value['id']; ?>" method="POST">
                    <label for="produk">Nama produk</label>
                    <input type="text" name="nama_produk" value="<?= $value['nama_produk']; ?>" class="form-control" placeholder="produk" required>
                    <label for="satuan">satuan</label>
                    <div>
                    <select name="id_satuan" id="id_satuan" >
                    <option value="1" <?= $value['id_satuan'] == 1 ? 'Selected' :''; ?>>buah</option>
                    <option value="2" <?= $value['id_satuan'] == 2 ? 'Selected' :''; ?>>box</option>
                    <option value="3" <?= $value['id_satuan'] == 3 ? 'Selected' :''; ?>>bungkus</option>
                    </select>
                </div>
                <label for="harga_beli">Harga Beli</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Rp</span>
                      <input type="number" id="harga_beli" name="harga_beli" value="<?= $value['harga_beli']; ?>" class="form-control" placeholder="harga beli">
                    </div>
                </div>
                <label for="harga_jual">Harga Jual</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Rp</span>
                      <input type="number" id="harga_jual"  name="harga_jual" value="<?= $value['harga_jual']; ?>" class="form-control" placeholder="harga_jual">
                    </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>


        <?php }?>
        <script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
      "paging" : true,
      "ordering" : true
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });

new AutoNumeric('#harga_beli', { 
  digitGroupSeparator : ",",
  decimalPlaces: 0
 });
new AutoNumeric('#harga_jual', { digitGroupSeparator : ",",
  decimalPlaces: 0 });
</script>