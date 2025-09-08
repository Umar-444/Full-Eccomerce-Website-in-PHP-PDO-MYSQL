<?php
 include 'admin/include/auth.php';
 $cuser = new auth();
 if(isset($_SESSION['isClient'])){
 $user_id = $_SESSION['uid'];			
 $result = $cuser->select_cart_to_header($user_id);
 $count = $cuser->count_cart_to_header($user_id);
 }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Zahid Mart |</title>

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>

		<!-- Slick -->
		<link type="text/css" rel="stylesheet" href="css/slick.css"/>
		<link type="text/css" rel="stylesheet" href="css/slick-theme.css"/>

		<!-- nouislider -->
		<link type="text/css" rel="stylesheet" href="css/nouislider.min.css"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="css/font-awesome.min.css">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="css/style.css"/>	
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

    </head>
	<style>
		.logo_font{
			margin-top: 14px;
			color: white;
		}
	</style>
	<body>
		<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<?php 
						//  if (isset($_SESSION['username']))
						//   {
						// 	//   $email = $_SESSION['email'];
						// 	//   $phone = $_SESSION['phone'];
						// 	//   $address = $_SESSION['address'];
						// 	//  echo '<li><a href="#"><i class="fa fa-phone"></i>'.$phone.'</a></li>
						// 	//  <li><a href="#"><i class="fa fa-envelope-o"></i>'.$email.'</a></li>
						// 	//  <li><a href="#"><i class="fa fa-map-marker"></i>'.$address.'</a></li>';
						//  }
						
						?>
						
					</ul>
					<ul class="header-links pull-right">
						
						<?php 
						 if (isset($_SESSION['username']))
						  {
						
						echo '<li><a href="logout.php"><i class="fa fa-user-o"></i>Logout</a></li>';	
				      	}
						  else{
							  echo '<li><a href="login.php"><i class="fa fa-user-o"></i>Login</a></li>   <li><a href="register.php"><i class="fa fa-user"></i>Register</a></li>';
						  }
						
						?>
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="index.php" class="logo">
									<!-- <img src="./img/logo.png" alt=""> -->
									<h2 class="logo_font mb-3"><i class="fa fa-shopping-cart"></i>Umar-Mart</h2>
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form action="./../admin/include/process.php">
									<input class="input" name="search_input" placeholder="Search here">
									<input type="submit" class="search-btn btn" name="search"  value="Search">
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								<!-- Wishlist -->
								<!-- <div>
									<a href="#">
										<i class="fa fa-heart-o"></i>
									/	<span>Your Wishlist</span>
										<div class="qty">2</div>
									</a>
								</div> -->
								<!-- /Wishlist -->
								<?php
								if(isset($_SESSION['isClient'])){
								?> 
								<!-- Cart -->
								<div class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-shopping-cart"></i>
										<span>Your Cart</span>
										<div class="qty"><?php
										 
										echo $count['count'];
										?></div>
									</a>
									<div class="cart-dropdown">
										<div class="cart-list">
											<?php 
											  
											//  print_r($result);
											 $cart_total = 0 ;
											
						
										     foreach($result as $row)
											 {		
												$product_price = $row['p_price'];
												$product_qty = $row['p_qty'];
												$total = $product_price * $product_qty;	
												 $cart_total = $cart_total + ($row['p_price'] * $row['p_qty']);
                                                 
											?>
											<div class="product-widget">
												<div class="product-img">
													<img src="./img/product01.png" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="product.php?p_id=<?php echo $row['id']?>"><?php echo $row['p_name']?></a></h3>
													<h4 class="product-price"><span class="qty"><?php echo $row['p_qty']?>x</span><?php echo $row['p_price']?> = <?php echo $total; ?></h4>
												</div>
												<button class="delete"><i class="fa fa-close"></i></button>
											</div>
											<?php
											 }
											 ?>
										</div>
										<div class="cart-summary">
											<small><?php echo $count['count']?> Item(s) selected</small>
											<h5>SUBTOTAL: <?php echo $cart_total;?></h5>
										</div>
										<div class="cart-btns">
											<a href="#">View Cart</a>
											<a href="checkout.php">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div>
								</div>
								<!-- /Cart -->
								<?php }?>
								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->

		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li class="active"><a href="index.php">Home</a></li>

					
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>