<!--
author: W3layouts
author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>Sanal Market</title>
<body>
<?php
session_start();
require 'dbcon.php';
require 'header.php';
?>
<?php
$msg = '';
if (isset($_POST['Name']) && isset($_POST['Mobile']) && isset($_POST['msg'])) {
    $n = $_POST['Name'];
    $m = $_POST['Mobile'];
    $p = $_POST['msg'];
    $sql = "INSERT INTO feedback (`name`, `mobile`, `msg`) VALUES ('$n', '$m' ,'$p')";

    if ($conn->query($sql)) {
        $msg = 'Mesajınız Gönderildi';
    } else {
        $msg = 'Error: '.$conn->error;
    }
}
?>
		<div class="w3l_banner_nav_right">
<!-- mail -->
		<div class="mail">
			<h3>Bize Ulaşın</h3>
			<div class="agileinfo_mail_grids">
				<div class="col-md-4 agileinfo_mail_grid_left">
					<ul>
						<li><i class="fa fa-home" aria-hidden="true"></i></li>
						<li>Adres<span></span></li>
					</ul>
					<ul>
						<li><i class="fa fa-envelope" aria-hidden="true"></i></li>
						<li>email<span><a href="mailto:Oguzhan@sanalmarket.com">Oguzhan@sanalmarket.com</a></span></li>
					</ul>
					<ul>
						<li><i class="fa fa-phone" aria-hidden="true"></i></li>
						<li>Aramak İçin<span><a href="tel:03442551417">(0344) 255 14 17</a></span></li>
					</ul>
				</div>
				<div class="col-md-8 agileinfo_mail_grid_right">
					<form action="" method="post">
                        <div><?php echo $msg; ?></div>
                        
						<div class="col-md-6 wthree_contact_left_grid">
							<input type="text" name="Name" value="İsim*" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name*';}" required="">
							
						</div>
						<div class="col-md-6 wthree_contact_left_grid">
							<input type="text" name="Mobile" value="Telefon" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Telephone*';}" required="">
                        </div>
						<div class="clearfix"> </div>
						<textarea  name="msg" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Message...';}" required>Mesaj...</textarea>

                        <input type="submit"  name="submit" value="Gönder">
						<input type="reset" value="TEMİZLE">
					</form>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
<!-- //mail -->
		</div>
		<div class="clearfix"></div>
	</div>
<!-- //banner -->
<!-- map -->
	<div class="map">
		</div>
<!-- //map -->
<!-- newsletter -->
	<div class="newsletter">
		<div class="container">
			
			<div class="clearfix"> </div>
		</div>
	</div>
<?php include 'footer.php'?>
</body>
</html>