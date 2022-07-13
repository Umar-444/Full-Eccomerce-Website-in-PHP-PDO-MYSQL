<?php
 include 'include/header.php';
  $cuser = new auth();
  $user_id = $_SESSION['uid'];
  $result = $cuser->checkOut_fetch($user_id);
  $result1 = $cuser->checkOut_product($user_id);
//   print_r($result1);
//   exit();
?>
		<!-- /NAVIGATION -->

		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<h3 class="breadcrumb-header">Checkout</h3>
						<ul class="breadcrumb-tree">
							<li><a href="index.php">Home</a></li>
							<li class="active">Checkout</li>
						</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<form id="order_place">
				<div class="row">

					<div class="col-md-7">
						<!-- Billing Details -->
						<div class="billing-details">
							<div class="section-title">
								<h3 class="title">Billing address</h3>
							</div>
							<div class="form-group">
								<input class="input" type="text" readonly name="name" value="<?php echo $result['name']?>" placeholder="First Name">
							</div>
							<div class="form-group">
								<input class="input" type="email" readonly name="email" value="<?php echo $result['email']?>" placeholder="Email">
							</div>
							<div class="form-group">
								<input class="input" type="text" readonly value="<?php echo $result['address']?>" name="address" placeholder="Address">
							</div>
							<div class="form-group">
								<input class="input" type="text" readonly value="<?php echo $result['city']?>" name="city" placeholder="City">
							</div>
							<div class="form-group">
								<input class="input" type="text" readonly value="<?php echo $result['country']?>" name="country" placeholder="Country">
							</div>
							<div class="form-group">
								<input class="input" type="tel" readonly name="tel" value="<?php echo $result['phone']?>" placeholder="Telephone">
							</div>
							<div class="form-group">
								<div class="input-checkbox">
									<input type="checkbox" id="create-account">
									<label for="create-account">
										<span></span>
										Create Account?
									</label>
									<div class="caption">
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
										<input class="input" type="password" name="password" placeholder="Enter Your Password">
									</div>
								</div>
							</div>
						</div>
						<!-- /Billing Details -->

						<!-- Shiping Details -->
						<div class="shiping-details">
							<div class="section-title">
								<h3 class="title">Shiping address</h3>
							</div>
							<div class="input-checkbox">
								<input type="checkbox" id="shiping-address">
			
								<div class="">
									<div class="form-group">
										<textarea class="input" type="text" name="shipping_address" placeholder="Enter Your Shipping Address" required></textarea>
									</div>
								</div>
							</div>
						</div>
				</div>

					<!-- Order Details -->
					<div class="col-md-5 order-details">
						<div class="section-title text-center">
							<h3 class="title">Your Order</h3>
						</div>
						<div class="order-summary">
							<div class="order-col">
								<div><strong>PRODUCT</strong></div>
								<div><strong>TOTAL</strong></div>
							</div>
							<div class="order-products">
								<?php
								 $cart_total = 0 ;
								 $output='';
								 foreach($result1 as $row){	
									 $output.=$row['product_id'].'-'.$row['p_qty'].',';
									 
									
									$product_price = $row['p_price'];
									$product_qty = $row['p_qty'];
									$total = $product_price * $product_qty;	
									 $cart_total = $cart_total + ($row['p_price'] * $row['p_qty']);	
								?>
								<div class="order-col">
									<div> <?php echo $row['p_name']?></div>
									<div><?php echo $product_qty;?> x Rs : <?php echo $row['p_price']?> = <?php echo $total;?></div>
								</div>
							<?php
								 }
								 
								$result3 = substr($output,0,-1);
								// echo $result3;
								// exit();
								 
							?>
							<input type="hidden" name="total_price" value="<?php echo $cart_total;?>">
							<input type="hidden" name="p_id" value="<?php echo $result3?>">
							</div>
							<div class="order-col">
								<div><h4>Delivery Charges </h4></div>
								<div><strong>FREE</strong></div>
							</div>
							<div class="order-col">
								<div><strong>TOTAL</strong></div>
								<div><strong class="order-total">Rs : <?php echo $cart_total;?></strong></div>
							</div>
						</div>
						<!-- <div class="payment-method">
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-1">
								<label for="payment-1">
									<span></span>
									Direct Bank Transfer
								</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-2">
								<label for="payment-2">
									<span></span>
									Cheque Payment
								</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-3">
								<label for="payment-3">
									<span></span>
									Paypal System
								</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
						</div> -->
						<div class="input-checkbox">
							<input type="checkbox" id="terms">
							<label for="terms">
								<span></span>
								I've read and accept the <a href="#">terms & conditions</a>
							</label>
						</div>
						<input type="submit"  class="primary-btn btn-block order-submit" value="Place Order">
					</div>
					<!-- /Order Details -->
				</div>
				</form>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- NEWSLETTER -->
		<div id="newsletter" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- <div class="col-md-12">
						<div class="newsletter">
							<p>Sign Up for the <strong>NEWSLETTER</strong></p>
							<form>
								<input class="input" type="email" placeholder="Enter Your Email">
								<button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
							</form>
							<ul class="newsletter-follow">
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-instagram"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-pinterest"></i></a>
								</li>
							</ul>
						</div>
					</div> -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /NEWSLETTER -->

		<!-- FOOTER -->
		<?php
		 include 'include/footer.php';
		?>
		<!-- /FOOTER -->

		<!-- jQuery Plugins -->
		<script src="js/jquery.min.js"></script>
		<script>
			$('#order_place').on('submit',(e)=>{
				e.preventDefault();

				$.ajax({
					method: "POST",
					url: "../admin/include/process.php",
					data: "Mode=order_place&" + $('#order_place').serialize(),
					success: function (data) {
						swal("Good Job!" , data , "success");
						 $('.swal-button--confirm').on('click',()=>window.location.reload())
					}
				});
			})
    
</script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/slick.min.js"></script>
		<script src="js/nouislider.min.js"></script>
		<script src="js/jquery.zoom.min.js"></script>
		<script src="js/main.js"></script>

	</body>
</html>
