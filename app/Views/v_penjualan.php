
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kasir</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<body onload="startTime()" class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="/penjualan" class="navbar-brand">
       
        <span class="brand-text font-weight-light"><i class="fas fa-shopping-cart text-success mr-3"></i><b>Transaksi Penjualan</b></span>
      </a>
      <a class="nav-link" data-slide="true" href="/logout" >
          <i class="fas fa-sign-out-alt"></i> Log Out
        </a>
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
          
          <!-- /.col-md-6 -->
          <div class="col-lg-7">
            <div class="card card-primary card-outline">
              
              <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                        <label for="Tanggal">Tanggal</label>
                        <label class="form-control form-control-lg"><?= date('d M Y'); ?></label>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                        <script>
function startTime() {
  const today = new Date();
  let h = today.getHours();
  let m = today.getMinutes();
  let s = today.getSeconds();
  m = checkTime(m);
  s = checkTime(s);
  document.getElementById('time').innerHTML =  h + ":" + m + ":" + s;
  setTimeout(startTime, 1000);
}

function checkTime(i) {
  if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
  return i;
}
</script>

<label for="Tanggal">Jam</label>
                                 <p id="time" class="form-control form-control-lg">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                        <label for="Tanggal">Nama Kasir</label>
                        <label class="form-control form-control-lg"><?= session()->get('nama_user'); ?></label>
                        </div>
                    </div>
                </div>
                
              </div>
            </div>
            
          </div>
          <div class="col-lg-5">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="card-title m-0">Total</h5>
              </div>
              <div class="card-body text-center">
                <label class="display-4 text-green">Rp.<?= number_format($grand[0]->total, 0); ?></label>
              </div>
        </div>
      </div>
      
      <div class="col-lg-12">
        <div class="card card-primary card-outline">
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <div class="row d-flex align-items-end">

                <form  action="/penjualan/cart" method="POST" class="d-flex align-items-end mx-2">
                <div class="mx-2 text-md" >
                    <select style="width:200px; height: 40px;" name="id_produk" id="nama-barang">
                            <option>Select Produk</option>
                      <?php foreach ($product as $key => $value) {?>
                            <option  value="<?= $value['id']; ?>"><?= $value['nama_produk']; ?></option>
                            <?php }?>
                          </select>
                        </div>
                        <script>
  $('#nama-barang').on('change',(event) => {
    console.log();
    getBarang(event.target.value).then(produk =>{
      $('#nama_produk').val(produk.nama_produk);
      $('#harga').val(produk.harga_jual);
      $('#satuan').val(produk.satuan);
    });
  });
  async function getBarang(id){
    let response = await fetch('/api/penjualan/' + id)
    let data = await response.json();
    return data;
  }
</script>
                    
<input name="nama_barang" type="text" id="nama_produk" hidden required class="form-control">
                  <div class="mx-2">
                    <label for="">Harga</label>
                    <input name="harga" type="text" id="harga" readonly required class="form-control">

                  </div>
                 
                    <div class="mx-2">
                      <label for="">Jumlah</label>
                      <input name="qty" id="qty"  type="number" min="1" class="form-control" placeholder="Qty">
                    </div>
                    <script>
    document.getElementById('harga').addEventListener('change',hitung);
    document.getElementById('qty').addEventListener('change',hitung);
    function hitung(){
      let harga = document.getElementById("harga").value;
      let jumlah = document.getElementById("qty").value;
      let total = document.getElementById("total");
      total.value = harga*jumlah;
    }
    
    </script>
                    <div class="mx-2">
                      <label for="">Sub Total</label>
                      <input name="total" value="total" id="total" type="number"  class="form-control" readonly style="width:160px;">
                    </div>

                  
                    
                      <button type="submit" class="btn btn-primary mx-2"style="height: 40px;"><i class="fas mr-2 fa-cart-plus"></i>Add</button>                 
                    </form>
                    <button class="btn btn-success mx-1 mt-3" style="height: 39px;" data-toggle="modal" data-target="#add-transaksi"><i class="fas mr-2 fa-cash-register"></i>Bayar</button>    
                  </div>
            </div>
             
              <div class="col-12">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Id Produk</th>
                      <th>Nama Produk</th>
                      <th>Harga</th>
                      <th>Qty</th>
                      <th>Total Harga</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>

                      <?php $i=0 ;foreach ($cart as $key => $value) { ?>
                        
                        <tr>
                        <td><?= $value['id_produk']; ?></td>
                        <td><?= $nama_produk[$i]->nama_produk; ?></td>
                        <td>Rp.<?= number_format($value['harga'],0); ?></td>
                        <td><?= $value['qty']; ?></td>
                        <td>Rp.<?= number_format($value['total'],0); ?></td>
                        <td>  
                          <form action="/penjualan/cart/<?= $value['id']; ?>" method="POST" class="d-inline">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin mendelete <?= $value['id_produk']; ?> ?') "><i class="fas fa-trash mr-1"></i></button>
                          </form>
                        </td>
                        </tr>
                        <?php $i+=1; ?>
                      <?php  } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

</div>

<div class="modal fade" id="add-transaksi">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Transaksi</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
            <div class="modal-body">
                <form class="form-group" action="/penjualan/transaksi" method="POST">
                    <label for="pembeli">Nama Kasir</label>
                    <input type="text" name="nama_kasir" id="nama_kasir" class="form-control" value="<?= session()->get('nama_user'); ?>" readonly required>
                    <label for="pembeli">Nama Pembeli</label>
                    <input type="text" name="nama_pembeli" id="nama_pembeli" class="form-control" placeholder="Masukkan Nama Pembeli" required>
                    <label for="grand-total">Grand Total</label>
                    <input type="number" name="grand" id="grand" class="form-control" value="<?= $grand[0]->total; ?>" readonly required>
                    <label for="Uang Bayar">Uang Bayar</label>
                    <input type="text" name="bayar" id="bayar" class="form-control" placeholder="Uang Bayar" required>
                    <script>
    document.getElementById('bayar').addEventListener('change',hitung);
    document.getElementById('grand').addEventListener('change',hitung);
    function hitung(){
      let bayar = document.getElementById("bayar").value;
      let grand = document.getElementById("grand").value;
      let kembalian = document.getElementById("kembalian");
      kembalian.value = bayar-grand;
    }
    </script>
                    <label for="Uang Bayar">Kembalian</label>
                    <input type="text" name="number" id="kembalian" class=" form-control" readonly>
                    
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Selesai</button>
                </div>
            </form>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
<!-- ./wrapper --

<!-- jQuery -->

<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
