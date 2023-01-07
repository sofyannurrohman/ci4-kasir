<div class="col-lg-4   col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $total_produk[0]->id; ?></h3>

                <p>Produk</p>
              </div>
              <div class="icon">
                <i class="fas fa-boxes"></i>
              </div>
              <a href="/produk" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $total_transaksi[0]->id; ?></h3>

                <p>Transaksi</p>
              </div>
              <div class="icon">
                <i class="fas fa-list"></i>
              </div>
              <a href="/transaksi" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
    
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= $total_user[0]->id; ?></h3>

                <p>User</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <div class="d-flex justify-content-center">
        <div class="col-lg-12">
            <!-- Info Boxes Style 2 -->
            <div class="info-box mb-3 bg-navy">
              <span class="info-box-icon"><i class="fas fa-money-bill-wave"></i></span>

              <div class="info-box-content">
                <span class="info-box-text text-lg">Total Pendapatan </span>
                <span class="info-box-number text-lg">Rp.<?= number_format($total_pendapatan['0']->grand_total); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </div>
        </div>

       