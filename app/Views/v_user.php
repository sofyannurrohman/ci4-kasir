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
                      <th>Nama User</th>
                      <th>Email</th>
                      <th>Password</th>
                      <th>Level</th>
                      <th style="width: 300px;">Aksi</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no =1;
                    foreach ($user as $key =>$value) {?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $value['nama_user']; ?></td>
                            <td><?= $value['email']; ?></td>
                            <td class="text-center"><?= $value['password']; ?></td>
                            <td class="text-center"><?php if ($value['level']==1) {?>
                                <span class="badge bg-success">Admin</span>
                            <?php }  else {?>
                                <span class="badge bg-primary">Kasir</span>
                                <?php } ?>
                            </td>

                            <td>
                                <button class="btn btn-warning mr-2"data-toggle="modal" data-target="#edit-data<?= $value['id'] ?>"><i class="fas fa-pencil-alt"></i>Edit</button>
                                <form action="/user/<?= $value['id']; ?>" method="POST" class="d-inline">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin mendelete <?= $value['nama_user']; ?> ?') "><i class="fas fa-trash mr-1"></i>Delete</button>
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
                <form class="form-group" action="/user/create" method="POST">
                    <label for="user">Nama user</label>
                    <input type="text" name="nama_user" class="form-control" placeholder="user" required>
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="email" required>
                    <label for="password">Password</label>
                    <input type="text" name="password" class="form-control" placeholder="password" required>
                    <label for="user">Level</label>
                    <div>
                    <select name="level" id="level" >
                    <option value="1">Admin</option>
                    <option value="2">Kasir</option>
                    </select>
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

      <?php foreach ($user as $key => $value) {?>
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
                <form class="form-group" action="/user/update/<?= $value['id']; ?>" method="POST">
                    <label for="user">Nama user</label>
                    <input type="text" name="nama_user" value="<?= $value['nama_user']; ?>" class="form-control" placeholder="user" required>
                    <label for="email">Email</label>
                    <input type="email" name="email" value="<?= $value['email']; ?>" class="form-control" placeholder="email" required>
                    <label for="password">Password</label>
                    <input type="text" name="password" value="<?= $value['password']; ?>" class="form-control" placeholder="password" readonly>
                    <label for="level">Level</label>
                    <div>
                    <select name="level" id="level" >
                    <option value="1" <?= $value['level'] == 1 ? 'Selected' :''; ?>>Admin</option>
                    <option value="2" <?= $value['level'] == 2 ? 'Selected' :''; ?>>Kasir</option>
                    </select>
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