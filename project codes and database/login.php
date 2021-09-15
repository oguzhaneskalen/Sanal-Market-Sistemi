<?php
include 'dbcon.php';
session_start();
if (isset($_GET['page']) && !empty($_GET['page'])) {
    $page = $_GET['page'].'.php';
} else {
    $page = 'index.php';
}

if (isset($_SESSION['USER_ID']) && !empty($_SESSION['USER_ID'])) {
    header("Location: $page");
    exit;
}
$msg = '';

if (isset($_POST['submit'])) {
    $n = $_POST['Name'];
    $m = $_POST['Mobile'];
    $a1 = $_POST['Address'];

    $c = $_POST['City'];
    $g = $_POST['Gn'];
    $u = $_POST['Username'];
    $p = $_POST['Password'];

    $sql = "INSERT INTO user(name, mobile, address1, gender, username, password) 
    VALUES ('$n', '$m' ,'$a1','$g','$u','$p')";

    if ($conn->query($sql)) {
        header('Location:login.php');
        exit;
    } else {
        echo 'Error: '.$sql.'<br>'.$conn->error;
    }
}

if (isset($_POST['login'])) {
    $un = $_POST['User'];
    $pw = $_POST['Pass'];
    $sql = "SELECT uid, password FROM user WHERE username = '$un'";
    $result = $conn->query($sql);
    if ($result->num_rows) {
        $row = $result->fetch_assoc();
        if ($row['password'] != $pw) {
            $msg = 'Wrong Password';
        } else {
            $_SESSION['USER_ID'] = $row['uid'];
            $_SESSION['USER_NAME'] = $un;
            header("Location: $page");
            exit;
        }
    } else {
        $msg = 'Yanlış Kullanıcı Adı!';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Sanal Market</title>
<body><?php include 'header.php' ?>
		
		<div class="w3l_banner_nav_right">
<!-- login -->

		<div class="w3_login">
			<h3>Oturum Aç & Kaydol</h3>
			<div class="w3_login_module">
				<div class="module form-module">
                    <div class="toggle"><i class="fa fa-times fa-pencil"></i>
                        <div class="tooltip">kaydol</div>
                    </div>

                    <div class="form">
                        <h2>Hesabınla Oturum Aç</h2>
                        <span class="text-danger"><?=$msg?></span>
                        <form action="" method="post">
                            <input type="text" name="User" placeholder="Kullanıcı Adı" required>
                            <input type="password" name="Pass" placeholder="Şifre" required>
                            <input type="submit" value="Oturum Aç" name="login">
                        </form>
                
                    </div>

                    <div class="form">
                        <h2>Hesap Oluştur</h2>
                        <span class="text-danger"><?=$msg?></span>
                        <form action="" method="post">
                            <input type="text" name="Name" placeholder="İsim" required title="İsim Girmen Gerekli">
                            <input type="text" name="Mobile" placeholder="Telefon" required pattern="[0-9]{10}" title="10 karakterden oluşmalı">
                            <input type="text" name="Address" placeholder="Adres" required>

                            <input type="text" name="City" placeholder="City" required value="Kahramanmaraş" readonly style="text-align:center:">
                            <input type="radio" name="Gn" placeholder="" required>Erkek
                            <input type="radio" name="Gn" placeholder="" required>Kadın

                            <input type="text" name="Username" placeholder="Kullanıcı Adı" required>
                            <input type="password" name="Password" placeholder="Şifre">
                            <input type="submit" value="Kaydı Tamamla" name="submit">
                        </form>
                    </div>
				</div>
			</div>
                       
			<script>
				$('.toggle').click(function(){
				  // Switches the Icon
				  $(this).children('i').toggleClass('fa-pencil');
				  // Switches the forms  
				  $('.form').animate({
					height: "toggle",
					'padding-top': 'toggle',
					'padding-bottom': 'toggle',
					opacity: "toggle"
				  }, "slow");
				});
			</script>
		</div>
        
<!-- //login -->
		</div>
		<div class="clearfix"></div>
	</div>
<?php include 'footer.php' ?>
</body>
</html>