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
              <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">No</th>
                      <th>Satuan</th>
                      <th style="width: 300px;">Aksi</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no =1;
                    foreach ($satuan as $key =>$value) {?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $value['nama_satuan']; ?></td>
                            <td>
                                <button class="btn btn-warning mr-2"data-toggle="modal" data-target="#edit-data<?= $value['id'] ?>"><i class="fas fa-pencil-alt mr-1"></i>Edit</button>
                                <form action="/satuan/<?= $value['id']; ?>" method="POST" class="d-inline">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin mendelete <?= $value['nama_satuan']; ?> ?') "><i class="fas fa-trash mr-1"></i>Delete</button>
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
                <form class="form-group" action="/satuan/create" method="POST">
                    <label for="satuan">Nama Satuan</label>
                    <input type="text" name="nama_satuan" class="form-control" placeholder="Satuan" required>
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

      <?php foreach ($satuan as $key => $value) {?>
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
                <form class="form-group" action="/satuan/update/<?= $value['id']; ?>" method="POST">
                    <label for="satuan">Nama Satuan</label>
                    <input type="text" name="nama_satuan" value="<?= $value['nama_satuan']; ?>" class="form-control" placeholder="Satuan" required>
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