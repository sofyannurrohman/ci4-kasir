<?php if(session()->getFlashData('pesan')): ?>
                <div class="alert alert-success" style="width: 300px;" role="alert">
                    <?= session()->getFlashData('pesan'); ?>
                </div>
                <?php endif; ?>
<div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
              
                <h3 class="card-title"><?= $subjudul; ?></h3>
               
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">No</th>
                      <th class="text-center">Nama Kasir</th>
                      <th class="text-center">Nama Pembeli</th>
                      <th class="text-center">ID Produk</th>
                      <th class="text-center">Nama Produk</th>
                      <th class="text-center">Jumlah</th>
                      <th class="text-center">Grand Total</th>
                      <th class="text-center">Tanggal Transaksi</th>
                      <th class="text-center" style="width: 300px;">Aksi</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no =1; $i=0;
                    foreach ($transaksi as $key =>$value) {?>
                        <?php $items= json_decode($value['items']) ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $value['nama_kasir']; ?></td>
                            <td><?= $value['nama_pembeli']; ?></td>
                            <td>
                              <ul>
                                <?php foreach ($items as $i) {?> 
                                  <li>
                                    <?php echo $i->id_produk; ?>
                                  </li>
                                  <?php } ?>
                                </ul>
                              </td>
                            <td>
                              <ul>
                                <?php foreach ($items as $i) {?> 
                                  <li>
                                    <?php echo $i->nama_barang; ?>
                                  </li>
                                  <?php } ?>
                                </ul>
                              </td>
                              <td>
                                <ul>

                                
                              <?php foreach ($items as $i) {?> 
                                <li>
                                <?php echo $i->qty; ?>
                                </li>
                                <?php } ?>
                                </ul>
                              </td>
                            <td class="text-center">Rp.<?= number_format($value['grand_total'],0); ?></td>
                            <td><?= $value['created_at']; ?></td>
                            <td class="text-center">
                                <form action="/transaksi/<?= $value['id']; ?>" method="POST" class="d-inline">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin mendelete transaksi <?= $value['nama_pembeli']; ?> ?') "><i class="fas fa-trash mr-1"></i>Delete</button>
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

      <?php foreach ($transaksi as $key => $value) {?>
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
                <form class="form-group" action="/transaksi/update/<?= $value['id']; ?>" method="POST">
                    <label for="transaksi">Nama Pembeli</label>
                    <input type="text" name="nama_pembeli" value="<?= $value['nama_pembeli']; ?>" class="form-control" placeholder="pembeli" required>
                    <label for="Items">Items</label>
                    <input type="text" name="nama_pembeli" value="<?= $value['nama_pembeli']; ?>" class="form-control" placeholder="pembeli" required>
                <label for="grand_total">Grand Total</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Rp</span>
                      <input type="number" id="grand_total" name="grand_total" value="<?= $value['grand_total']; ?>" class="form-control" placeholder="grand total">
                    </div>
                </div>
                    <label for="created_at">Tanggal Transaksi</label>
                    <input type="number" name="created_at" value="<?= $value['created_at']; ?>" class="form-control" placeholder="tanggal transaksi">
                    
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

new AutoNumeric('#grand_total', { 
  digitGroupSeparator : ",",
  decimalPlaces: 0
 });
new AutoNumeric('#harga_jual', { digitGroupSeparator : ",",
  decimalPlaces: 0 });
</script>