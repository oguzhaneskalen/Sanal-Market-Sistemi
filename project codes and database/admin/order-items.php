<?php
session_start();
if (!isset($_SESSION['ADMIN_ID']) || empty($_SESSION['ADMIN_ID'])) {
    header('Location: login.php');
    exit;
}

require '../dbcon.php';

if (!isset($_GET['id']) || empty($_GET['id'])) { 
    header('Location: orders.php');
    exit;
}
$oid = (int) $_GET['id'];

$result = $conn->query('SELECT * FROM `order_items` WHERE `oid` = '.$oid);
$total_items = $result->num_rows;

$order = $conn->query('SELECT * FROM `ord` WHERE `oid` = '.$oid)
              ->fetch_assoc();

$user = $conn->query('SELECT * FROM `user` WHERE `uid` = '.$order['uid'])
              ->fetch_assoc();

$ord_state = $conn->query('SELECT `ord_state` FROM `ord` WHERE `oid` = '.$_GET['id'])
              ->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php
    $title = 'Siparişler | Admin';
    require 'include/head.php';
?>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
<?php
    require 'include/sidebar.php';
?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
<?php
    require 'include/topbar.php';
?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Sipariş İçeriği (<?=$total_items?>)</h1>
            <!--<a href="category-add.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            	<i class="fa fa-plus-circle"></i> Create New
            </a>-->
          </div>

          <!-- Content Row -->
            <div class="row">
                <!-- column -->
                <div class="col-12">
                    <div class="form-group m-t-40">
                        <?php
                        if (!isset($_SESSION['msg']) || $_SESSION['msg'] == '') {
                        } else {
                            ?>
				        <div class="alert alert-<?=$_SESSION['msg']['type']?> alert-dismissable">
					        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					        <?=$_SESSION['msg']['msg']?>
				        </div>
                        <?php
                            $_SESSION['msg'] = '';
                            unset($_SESSION['msg']);
                        }
                        ?>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title" style="color:black;">
                                Sipariş ID: <b><?=$oid?></b><br>
                                Kullanıcı: <b><?=ucwords($user['name'])?></b><br>
                                Adres: <b><?=ucwords($user['address1'])?></b><br><hr>
                                <span style="color:green;">Toplam Tutar: <b>₺ <?=$order['total']?></b></span><hr>
                            </h4>
                            <form action="include/save-state.php" method="post">
                            <h4><b>Sipariş Durumu: </b><?php 
                            if(ucwords($ord_state['ord_state'])==0){echo '<span style="color:#000;text-align:center;">Sipariş Alındı</span>';}
                            if(ucwords($ord_state['ord_state'])==1){echo '<span style="color:#000099;text-align:center;">Sipariş Hazırlanıyor</span>';}
                            if(ucwords($ord_state['ord_state'])==2){echo '<span style="color:#990099;text-align:center;">Sipariş Yolda</span>';}
                            if(ucwords($ord_state['ord_state'])==3){echo '<span style="color:#006600;text-align:center;">Sipariş Teslim Edildi</span>';}
                            ?> <br><br>
                            <select name="ord_state">
                                <option selected disabled>Durum Seçin</option>
                                <option value="0">Sipariş Alındı</option>
                                <option value="1">Sipariş Hazırlanıyor</option>
                                <option value="2">Sipariş Yolda</option>
                                <option value="3">Sipariş Teslim Edildi</option> 
                            </select>
                            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                            <button class='btn btn-primary'>Güncelle</button>
                            </form>
                            </h4>
                            
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Ürün Kalemi ID</th>
                                            <th>Ürün Resmi</th>
                                            <th>Ürün İsmi</th>
                                            <th>Adet</th>
                                            <th>Adet Fiyatı</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($total_items) {
                                            while ($row = $result->fetch_assoc()) {
                                                $product = $conn->query("SELECT `name`, `pic` FROM `product` WHERE `pid` = $row[pid]")
                                                    ->fetch_assoc(); ?>
                                        <tr>
                                            <td><?=$row['item_id']?></td>
                                            <td><img src="../<?=$product['pic']?>" width="100"></td>
                                            <td><?=ucwords($product['name'])?></td>
                                            <td><?=$row['quantity']?></td>
                                            <td><?=$row['amount']?> ₺</td>
                                        </tr>
										<?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- column -->
            </div>

        </div>
        <!-- /.container-fluid -->

         </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Sanal Market 2021</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

<?php
    require 'include/javascript.php';
?>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
