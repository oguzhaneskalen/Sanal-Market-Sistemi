<!DOCTYPE html>
<html>
<head>
<title>Grocery Store a Ecommerce Online Shopping Category Flat Bootstrap Responsive Website Template | About Us :: w3layouts</title>
<body><?php
session_start();
require 'dbcon.php';
require 'header.php';

?>
		<div class="w3l_banner_nav_right">

		<div class="privacy about">
			<h3>Sipariş Detayı</h3>
			<div class="row">
                <!-- column -->
                <div class="col-12">
                    <div class="form-group m-t-40">
                        <?php
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
                            <h4 class="card-title">
                                Sipariş ID: <b><?=$oid?></b><br><br>
                                Toplam Tutar: <b>₺ <?=$order['total']?></b>
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
                                            <td><img src="<?=$product['pic']?>" width="100"></td>
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
		
	<div class="testimonials">
		<div class="container">
			
		</div>
	</div>
<?php include 'footer.php'?>
</body>
</html>