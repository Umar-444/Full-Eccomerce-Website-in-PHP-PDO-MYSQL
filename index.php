<?php
 include 'include/header.php';
 $product = new auth();
 $result = $product->products_fetch();
?>
<style>
	#clock {
  font-family: 'Orbitron', sans-serif;
  color: #212833;
  font-size: 34px;
  font-weight: bold;
}
</style>
		<!-- /NAVIGATION -->
	
		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- shop -->
					<div class="col-md-4 col-xs-6">
						<div class="shop">
							<div class="shop-img">
								<img src="./img/shop01.png" alt="">
							</div>
							<div class="shop-body">
								<h3>Laptop<br>Collection</h3>
								<a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- /shop -->

					<!-- shop -->
					<div class="col-md-4 col-xs-6">
						<div class="shop">
							<div class="shop-img">
								<img src="./img/shop03.png" alt="">
							</div>
							<div class="shop-body">
								<h3>Accessories<br>Collection</h3>
								<a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- /shop -->

					<!-- shop -->
					<div class="col-md-4 col-xs-6">
						<div class="shop">
							<div class="shop-img">
								<img src="./img/shop02.png" alt="">
							</div>
							<div class="shop-body">
								<h3>Cameras<br>Collection</h3>
								<a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- /shop -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Latest Products</h3>
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12">
						<!-- store products -->
						<div class="row mb-5" id="latest-products-row">
							<!-- product -->
							<?php
								$count = 0;
								foreach($result as $row)
								{
									$images = $row['images'];  
									$new_images = explode(",", $images);

									// Fix: Check if at least one image exists, fallback to first if not
									$product_image = '';
									if (isset($new_images[1]) && !empty($new_images[1])) {
										$product_image = $new_images[1];
									} elseif (isset($new_images[0]) && !empty($new_images[0])) {
										$product_image = $new_images[0];
									} else {
										$product_image = 'default.png'; // fallback image
									}
							?>
							<div class="col-md-3 col-xs-6 product-item" <?php if($count >= 16) echo 'style="display:none;"'; ?>>
								<a href="product.php?p_id=<?php echo $row['id']?>">	
									<div class="product">
										<div class="product-img">
											<img width="100px" height="280px" src="uploads/<?php echo htmlspecialchars($product_image); ?>" alt="">
											<div class="product-label">
												<?php 
													// Fix: Prevent division by zero
													if ($row['p_discount'] > 0) {
														$percent = ( ($row['p_discount'] - $row['p_price'] ) * 100) / $row['p_discount'];
														$percent = ceil($percent);
													} else {
														$percent = 0;
													}
												?>
												<span class="sale"><?php echo $percent;?>%</span>
											</div>
										</div>
										<div class="product-body">
											<h3 class="product-name"><a href="product.php?p_id=<?php echo $row['id']?>"><?php echo htmlspecialchars($row['p_name'])?></a></h3>
											<h4 class="product-price">Rs : <?php echo htmlspecialchars($row['p_price'])?> <del class="product-old-price">Rs : <?php echo htmlspecialchars($row['p_discount'])?></del></h4>
											<?php
												$p_id = $row['id'];
												$result1 = $product->total_reviews($p_id);
												$result2 = isset($result1['avg']) ? round($result1['avg']) : 0;
												for ($i=1; $i < 6; $i++) { 
													if($result2 >= $i) {
														echo '<span value="'.$i.'"></span><i style="color:red;" class="fa fa-star checked"></i>';
													} else {
														echo '<i class="fa fa-star checked"></i>';
													}
												}
											?>
											<div class="product-btns">
												<a href="product.php?p_id=<?php echo $row['id']?>" class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp"></span></a>
											</div>
										</div>
										<!-- <div class="add-to-cart">
											<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
										</div> -->
									</div>
								</a>
							</div>
							<?php
									$count++;
								}
								$total_products = is_countable($result) ? count($result) : $count;
								if ($total_products > 16) {
							?>
							<div class="col-md-12 text-center" id="load-more-container">
								<button id="load-more-btn" class="primary-btn" style="margin-top:30px;">Load More</button>
							</div>
							<?php } ?>
							<!-- /product -->
						</div>
						<!-- /store products -->
					</div>
					<!-- Products tab & slick -->

					<script>
					document.addEventListener('DOMContentLoaded', function() {
						var loadMoreBtn = document.getElementById('load-more-btn');
						if (!loadMoreBtn) return;
						var products = document.querySelectorAll('#latest-products-row .product-item');
						var productsPerRow = 4;
						var shown = 16;

						loadMoreBtn.addEventListener('click', function() {
							for (var i = shown; i < shown + productsPerRow && i < products.length; i++) {
								products[i].style.display = '';
							}
							shown += productsPerRow;
							if (shown >= products.length) {
								loadMoreBtn.style.display = 'none';
							}
						});
					});
					</script>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- HOT DEAL SECTION -->
		<div id="hot-deal" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="hot-deal">
							<ul class="hot-deal-countdown">
								<li style="width: 300px !important;">							
									<div  id="clock"></div>
								</li>
							</ul>
							<h2 class="text-uppercase">hot deal this week</h2>
							<p>New Collection Up to 50% OFF</p>
							<a class="primary-btn cta-btn" href="store.php">Shop now</a>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /HOT DEAL SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Top Selling</h3>
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12">				
						<!-- store products -->
						<div class="row mb-5" id="top-selling-products-list">
							<!-- product -->
							<?php
							$result11 = $cuser->recomended_products();
							$max_initial = 8; // Number of products to show initially
							$count = 0;
							foreach($result11 as $row) {
								$images = $row['images'];  
								$new_images = explode(",", $images);
								$hidden_class = ($count >= $max_initial) ? ' style="display:none;"' : '';
							?>
							<div class="col-md-3 col-xs-6 top-selling-product-item"<?php echo $hidden_class; ?>>
								<a href="product.php?p_id=<?php echo $row['product_id']?>">	
								<div class="product">
									<div class="product-img">
										<img width="100px" height="280px" src="./uploads/<?php echo $new_images[0]?>" alt="">
										<div class="product-label">
											<?php $percent = ( ($row['p_discount'] - $row['p_price'] ) * 100) / $row['p_discount'];?>
											<span class="sale"><?php echo ceil($percent);?>%</span>
										</div>
									</div>
									<div class="product-body">
										<h3 class="product-name"><a href="product.php?p_id=<?php echo $row['product_id']?>"><?php echo $row['p_name']?></a></h3>
										<h4 class="product-price">Rs : <?php echo $row['p_price']?> <del class="product-old-price">Rs : <?php echo $row['p_discount']?></del></h4>
										<?php
										$p_id = $row['product_id'];
										$result3 = $product->total_reviews($p_id);
										$result4 = round($result3['avg']);
										for ($i=1; $i < 6; $i++) { 
											if($result4 >= $i) {
												echo '<span value="'.$i.'"></span><i style="color:red;" class="fa fa-star checked"></i>';
											} else {
												echo '<i style=";" class="fa fa-star checked"></i>';
											}
										}
										?>
										<div class="product-btns">
											<a href="product.php?p_id=<?php echo $row['product_id']?>" class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp"></span></a>
										</div>
									</div>
									<!-- <div class="add-to-cart">
										<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
									</div> -->
								</div>
								</a>
							</div>
							<?php
								$count++;
							}
							?>
							<!-- /product -->
						</div>
						<!-- /store products -->
						<?php if ($count > $max_initial): ?>
						<div class="row">
							<div class="col-md-12 text-center">
								<button id="load-more-top-selling" class="primary-btn cta-btn" style="margin-top:20px;">Load More</button>
							</div>
						</div>
						<?php endif; ?>
						<script>
						document.addEventListener("DOMContentLoaded", function() {
							var loadMoreBtn = document.getElementById('load-more-top-selling');
							if (loadMoreBtn) {
								loadMoreBtn.addEventListener('click', function() {
									var items = document.querySelectorAll('.top-selling-product-item[style*="display:none"]');
									var showCount = 8;
									var shown = 0;
									for (var i = 0; i < items.length && shown < showCount; i++, shown++) {
										items[i].style.display = '';
									}
									// If no more hidden items, hide the button
									if (document.querySelectorAll('.top-selling-product-item[style*="display:none"]').length === 0) {
										loadMoreBtn.style.display = 'none';
									}
								});
							}
						});
						</script>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
				
					<!-- /Products tab & slick -->
				</div>
					<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- SECTION -->
	
		<!-- /SECTION -->

		<!-- NEWSLETTER -->
		<div id="newsletter" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
					<div class="row">
					<div class="col-md-12">
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
							</ul>
						</div>
					</div>
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
		<script>

	function currentTime() {
  var date = new Date(); /* creating object of Date class */
  var hour = date.getHours();
  var min = date.getMinutes();
  var sec = date.getSeconds();
  hour = updateTime(hour);
  min = updateTime(min);
  sec = updateTime(sec);
  document.getElementById("clock").innerText = hour + " : " + min + " : " + sec; /* adding time to the div */
    var t = setTimeout(function(){ currentTime() }, 1000); /* setting timer */
}

function updateTime(k) {
  if (k < 10) {
    return "0" + k;
  }
  else {
    return k;
  }
}

currentTime(); /* calling currentTime() function to initiate the process */
		</script>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/slick.min.js"></script>
		<script src="js/nouislider.min.js"></script>
		<script src="js/jquery.zoom.min.js"></script>
		<script src="js/main.js"></script>

	</body>
</html>
