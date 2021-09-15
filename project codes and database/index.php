<?php
session_start();
require 'dbcon.php';
$result = $conn->query('SELECT * FROM `product` LIMIT 8');
?>

<!DOCTYPE html>
<html>
<head>
<title>Sanal Market </title>
<body>
<?php include 'header.php'?>
            <div class="w3l_banner_nav_right">
                <section class="slider">
                    <div class="flexslider">
                        <ul class="slides">
                            <li>
                                <div class="w3l_banner_nav_right_banner">
                                    <h3>MUHTEŞEM<span>YEMEKLER YAP</span> YAP!</h3>
                                    <div class="more">
                                        <a href="products.php" class="button--saqui button--round-l button--text-thick" data-text="ALIŞVERİŞE BAŞLA">ALIŞVERİŞE BAŞLA</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="w3l_banner_nav_right_banner1">
                                    <h3>LEZİZ<span>YİYECEKLERLE</span> MUTLU OL!</h3>
                                    <div class="more">
                                        <a href="products.php" class="button--saqui button--round-l button--text-thick" data-text="ALIŞVERİŞE BAŞLA">ALIŞVERİŞE BAŞLA</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="w3l_banner_nav_right_banner2">
                                <!-- <h3>süper İNDİRİMLERLE SAHİP OL<br><i>%50</h3> -->
                                    <div class="more">
                                        <a href="products.php" class="button--saqui button--round-l button--text-thick" data-text="ALIŞVERİŞE BAŞLA">ALIŞVERİŞE BAŞLA</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </section>
                <!-- flexSlider -->
                    <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" property="" />
                    <script defer src="js/jquery.flexslider.js"></script>
                    <script type="text/javascript">
                    $(window).load(function(){
                      $('.flexslider').flexslider({
                        animation: "slide",
                        start: function(slider){
                          $('body').removeClass('loading');
                        }
                      });
                    });
                  </script>
                <!-- //flexSlider -->
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- banner -->
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
</div>

<!-- top-brands -->
<div class="top-brands">
    <div class="container">
        <h3>Tercih Ürünleri</h3>
        <div class="agile_top_brands_grids">
            <?php
            if ($result->num_rows) {
                while ($product = $result->fetch_assoc()) {
                    $pid = $product['pid'];
                    $name = $product['name'];
                    $weight = trim($product['weight'], '()');
                    $pic = $product['pic'];
                    $price = $product['price'];
                    $discount = $product['discount'];
                    $discount_money = $price * ($product['discount'] / 100);
                    $new_price = $discount == 0
                        ? $price
                        : $product['price'] * (1 - ($product['discount'] / 100)); ?>
            <div class="col-md-3 top_brand_left" style="margin-bottom:15px">
                <div class="hover14 column">
                    <div class="agile_top_brand_left_grid">
                        
                        <div class="agile_top_brand_left_grid1">
                            <figure>
                                <div class="snipcart-item block" >
                                    <div class="snipcart-thumb">
                                            <a>
                                            <img title="<?php echo $name; ?>" alt="<?php echo $name; ?>" src="<?php echo $pic; ?>" width="140">
                                            </a>    	
                                        <p>
                                            <?php echo $name.($weight ? " ($weight)" : ''); ?>
                                        </p>
                                        <h4>
                                            <i class="fa fa-try"></i> <?php echo $new_price; ?>
                                            <span>
                                                <?php if ($discount) { ?>
                                                <i class="fa fa-try"></i> <?php echo $product['price']; } ?>
                                            </span>
                                        </h4>
                                    </div>
                                    <div class="snipcart-details top_brand_home_details">
                                        <form action="checkout.php" method="post">
                                            <fieldset>
                                                <input type="hidden" name="pid" value="<?php echo $pid; ?>" />
                                                <input type="hidden" name="cmd" value="_cart" />
                                                <input type="hidden" name="add" value="1" />
                                                <input type="hidden" name="business" value="" />
                                                <input type="hidden" name="item_name" value="<?php echo $name; ?>" />
                                                <input type="hidden" name="amount" value="<?php echo $price; ?>" />
                                                <input type="hidden" name="discount_amount" value="<?php echo $discount_money; ?>" />
                                                <input type="hidden" name="currency_code" value="INR" />
                                                <input type="hidden" name="return" value="" />
                                                <input type="hidden" name="cancel_return" value="" />
                                                <input type="submit" name="submit" value="Sepete Ekle" class="button" />
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                }
            }
            ?>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>

<?php include 'footer.php'?>
    
</body>
</html>
