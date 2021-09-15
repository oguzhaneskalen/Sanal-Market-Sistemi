<!DOCTYPE html>
<html>
<head>
<title>Grocery Store a Ecommerce Online Shopping Category Flat Bootstrap Responsive Website Template | About Us :: w3layouts</title>
<body><?php
session_start();
require 'dbcon.php';
require 'header.php';

?>
<style>
table {
    font-weight: bold;
    font-size: 1em;
}
th{
    color: #707070;
}
</style>
		<div class="w3l_banner_nav_right">

		<div class="privacy about">
			<h3>Siparişlerim</h3>
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
                            <h4 class="card-title"> </h4>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sipariş ID</th>
                                            <th>Toplam Tutar</th>
                                            <th>Tarih</th>
											<th>Sipariş Durumu</th>
                                            <th class="text-nowrap">Sipariş İçeriği</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
										$user_id = ucwords($_SESSION['USER_ID']);
										$result = $conn->query("SELECT * FROM `ord` WHERE `uid` = $user_id ORDER BY `oid` DESC");
										$total_order = $result->num_rows;
                                        if ($total_order) {
                                            while ($row = $result->fetch_assoc()) {
                                                $result1 = $conn->query("SELECT `name` FROM `user` WHERE `uid` = $row[uid]");
                                                $ord = $result1->fetch_assoc(); ?>
                                        <tr>
                                            <td><?=$row['oid']?></td>
                                            <td><?=$row['total']?> ₺</td>
                                            <td><?=$row['date']?></td>
											<td><?php 
                                            if($row['ord_state']==0){ echo '<span style="color:#000;text-align:center;">Sipariş Alındı</span>';}
                                            else if($row['ord_state']==1){ echo '<span style="color:#000099;text-align:center;">Sipariş Hazırlanıyor</span>';}
                                            else if($row['ord_state']==2){ echo '<span style="color:#990099;text-align:center;">Sipariş Yolda</span>';}
                                            else if($row['ord_state']==3){ echo '<span style="color:#006600;text-align:center;">Sipariş Teslim Edildi</span>';}
                                            ?>
                                            </td>
                                            <td class="text-nowrap">
                                                <a style="
                                                color: #36b9cc; border-color: #36b9cc;
                                                " href="my-orders-items.php?id=<?=$row['oid']?>" class="btn btn-outline-info">
                                                	<i class="fa fa-eye"></i> Göster
                                                </a>
                                            </td>
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

		</div>
		
	<div class="testimonials">
		<div class="container">
			
		</div>
	</div>
<?php include 'footer.php'?>
</body>
</html>