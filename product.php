<?php
 include 'include/header.php';
 $product = new auth();

 if (isset($_GET['p_id']))
  {
     $product_id = $_GET['p_id'];
     $row = $product->single_product($product_id);
  }

 
?>

		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<ul class="breadcrumb-tree">
							<li><a href="index.php">Home</a></li>
							<li class="active"><?php echo $row['p_name']?></li>
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
				<div class="row">
					<!-- Product main img -->
					<div class="col-md-5 col-md-push-2">
						<div id="product-main-img">
							<?php
						    // foreach($row as $r){
								$image = $row['images'];
								$my_images = explode(",", $image);
								// print_r($my_images);


							?>
							<div class="product-preview">
								<img src="uploads/<?php echo $my_images[0];?>" alt="">
							</div>
							<div class="product-preview">
								<img src="uploads/<?php echo $my_images[1];?>" alt="">
							</div>
							<div class="product-preview">
								<img src="uploads/<?php echo $my_images[2];?>" alt="">
							</div>
							<div class="product-preview">
								<img src="uploads/<?php echo $my_images[3];?>" alt="">
							</div>
							<div class="product-preview">
								<img src="uploads/<?php echo $my_images[4];?>" alt="">
							</div>
						
						</div>
					</div>
					<!-- /Product main img -->

					<!-- Product thumb imgs -->
					<div class="col-md-2  col-md-pull-5">
						<div id="product-imgs">
							<div class="product-preview">
							<img src="uploads/<?php echo $my_images[0];?>" alt="">
							</div>

							<div class="product-preview">
							<img src="uploads/<?php echo $my_images[1];?>" alt="">
							</div>

							<div class="product-preview">
							<img src="uploads/<?php echo $my_images[2];?>" alt="">
							</div>

							<div class="product-preview">
							<img src="uploads/<?php echo $my_images[3];?>" alt="">
							</div>
						</div>
					</div>
					<!-- /Product thumb imgs -->

					<!-- Product details -->
					<div class="col-md-5">
						<div class="product-details">
							<h2 class="product-name"><?php echo $row['p_name']?></h2>
							<div>
							<?php
									$p_id = $row['id'];
									$result1 = $product->total_reviews($p_id);
									$result2=round($result1['avg']);
									for ($i=1; $i < 6; $i++) { 
										if($result2 >= $i)
										 {
											echo '<span value="'.$i.'"></span><i style="color:red;" class="fa fa-star checked"></i>';
										 }
										else
										  {
                                            echo '';
										  }
									}
									?>
								<a class="review-link" href="#">10 Review(s) | Add your review</a>
							</div>
							<div>
								<h3 class="product-price">Rs : <?php echo $row['p_price']?> <del class="product-old-price">Rs : <?php echo $row['p_discount']?></del></h3>
								<?php 
								 if($row['quantity'] >=0){
									 echo "<span class='product-available'>In Stock</span>";
								 }
								 else{
									echo "<span class='product-available'>Out Of Stock</span>";
								 }
								?>
								
							</div>

							<div class="product-options">
								<label>
									Color : <span class=""> <?php echo $row['p_colour']?></span> 
								</label>
							</div>
							<div class="product-options">
								<label>
									Total Quantity : <span class=""> <?php echo $row['quantity']?></span> 
								</label>
							</div>

							<div class="add-to-cart">
								<?php 
								   $p_id = $row['id'];
								   if (!isset($_SESSION['username']))
								    {
										echo '<a href="login.php" class="add-to-cart-btn" title="Add to cart"><i class="fa fa-shopping-basket"></i>Add to cart</a>';

								       
									}else{
										echo '<form id="formdata">				
									<input type="hidden" name="product_id" value="'.$p_id.'">
									<div class="qty-label">
									Qty
									<div class="input-number">
										<input type="number" name="qty" min="1" value="1" max="10">
										<span class="qty-up">+</span>
										<span class="qty-down">-</span>
									</div>
								</div>
									<input type="submit" value="Add to cart" class="add-to-cart-btn">
								</form>';
									}
								
								?>
								
								<!-- <a href="../admin/include/process.php?action=add_to_cart&product_id=" class="add-to-cart-btn" title="Add to cart"><i class="fa fa-shopping-basket"></i>Add to cart</a> -->
								<!-- <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button> -->
							</div>

							<!-- <ul class="product-btns">
								<li><a href="#"><i class="fa fa-heart-o"></i> add to wishlist</a></li>
								<li><a href="#"><i class="fa fa-exchange"></i> add to compare</a></li>
							</ul>

							<ul class="product-links">
								<li>Category:</li>
								<li><a href="#">Headphones</a></li>
								<li><a href="#">Accessories</a></li>
							</ul> -->

							<ul class="product-links">
								<li>Share:</li>
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="#"><i class="fa fa-envelope"></i></a></li>
							</ul>

						</div>
					</div>
					<!-- /Product details -->

					<!-- Product tab -->
					<div class="col-md-12">
						<div id="product-tab">
							<!-- product tab nav -->
							<ul class="tab-nav">
								<li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
								<li><a data-toggle="tab" href="#tab3">Reviews (3)</a></li>
							</ul>
							<!-- /product tab nav -->

							<!-- product tab content -->
							<div class="tab-content">
								<!-- tab1  -->
								<div id="tab1" class="tab-pane fade in active">
									<div class="row">
										<div class="col-md-8">
											<p><?php echo strip_tags($row["p_description"])?></p>
										</div>
									</div>
								</div>
								<!-- /tab1  -->

								<!-- tab3  -->
								<div id="tab3" class="tab-pane fade in">
									<div class="row">
										<!-- Rating -->
										<div class="col-md-3">
											<div id="rating">
												<div class="rating-avg">
													<span>4.5</span>
													<div class="rating-stars">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star-o"></i>
													</div>
												</div>
												<ul class="rating">
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
														</div>
														<div class="rating-progress">
															<div style="width: 80%;"></div>
														</div>
														<span class="sum">3</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div style="width: 60%;"></div>
														</div>
														<span class="sum">2</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div></div>
														</div>
														<span class="sum">0</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div></div>
														</div>
														<span class="sum">0</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div></div>
														</div>
														<span class="sum">0</span>
													</li>
												</ul>
											</div>
										</div>
										<!-- /Rating -->

										<!-- Reviews -->
										<div class="col-md-6">
											<div id="reviews">
												<ul class="reviews">
												<?php 
												 $product_ID = $row['id'];	 
												 $reviews_fetch = $cuser->fetch_reviews($product_ID);
												 foreach($reviews_fetch as $review)
												 {
												?>
												 
												 <?php 
												  $c_review = $review['review_stars'];
												  for ($i=1; $i < 6 ; $i++) {
													  if($c_review >= $i) {
													echo '<span class="" value"'.$i.'"><i style="color:red;" class="fa d-flex fa-star"></i></span>';
											        }
																		  
												  }
												 ?>
													<li>
														<div class="review-heading">
															<h5 class="name"><?php echo $review['name']?></h5>
															<p class="date"><?php echo $review['created_at']?></p>
															
														</div>
														<div class="review-body">
															<p><?php echo $review['comments']?></p>
														</div>
													</li>
													<?php }?>
												</ul>
												<ul class="reviews-pagination">
													<li class="active">1</li>
													<li><a href="#">2</a></li>
													<li><a href="#">3</a></li>
													<li><a href="#">4</a></li>
													<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
												</ul>
											</div>
										</div>
										<!-- /Reviews -->

										<?php
										 if (isset($_SESSION['isClient']))
										  {	
										?>
										<!-- Review Form -->
										<div class="col-md-3">
											<div id="review-form">
												<form class="review-form" id="form_review">
													<input class="input" type="hidden" name="user_id" value="<?php echo $_SESSION['uid']?>">
													<input class="input" type="hidden" name="product_id" value="<?php echo $row['id']?>">
													<textarea class="input" name="review_comment" placeholder="Your Review"></textarea>
													<div class="input-rating">
														<span>Your Rating: </span>
														<div class="stars">
															<input id="star5" name="rating" value="5" type="radio"><label for="star5"></label>
															<input id="star4" name="rating" value="4" type="radio"><label for="star4"></label>
															<input id="star3" name="rating" value="3" type="radio"><label for="star3"></label>
															<input id="star2" name="rating" value="2" type="radio"><label for="star2"></label>
															<input id="star1" name="rating" value="1" type="radio"><label for="star1"></label>
															
														</div>
													</div>
													<input type="submit" class="primary-btn">
												</form>
											</div>
										</div>
										<?php  }?>
										<!-- /Review Form -->
									</div>
								</div>
								<!-- /tab3  -->
							</div>
							<!-- /product tab content  -->
						</div>
					</div>
					<!-- /product tab -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- Section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

				<!-- section title -->
				<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Recomended Products</h3>
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12">				
						<!-- store products -->
						<div class="row mb-5">
							<!-- product -->

							<?php
							$result11=$cuser->recomended_products();
							
									 foreach($result11 as $row)
									 {
                                       $images = $row['images'];  
									   $new_images = explode(",", $images);
                                    							
									?>
							<div class="col-md-3 col-xs-6">
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
									$result4=round($result1['avg']);
									for ($i=1; $i < 6; $i++) { 
										if($result2 >= $i)
										 {
											echo '<span value="'.$i.'"></span><i style="color:red;" class="fa fa-star checked"></i>';
										 }
										else
										  {
                                            echo '';
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
							</div>
							</a>
							<?php
							 }
							?>
							<!-- /product -->

							
						</div>
						<!-- /store products -->

						
					     
					</div>
					<!-- /section title -->

	
					<!-- /product -->

				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /Section -->

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
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/slick.min.js"></script>
		<script src="js/nouislider.min.js"></script>
		<script src="js/jquery.zoom.min.js"></script>
		<script src="js/main.js"></script>
		<script>
    $('#formdata').on('submit',(e)=>{
		e.preventDefault();
		$.ajax({
			method: "POST",
			url: "../admin/include/process.php",
			data: "Mode=formdata&" + $('#formdata').serialize(),
			success: function (data) {
				swal("Good Job!" , data , "success");
				$('.swal-button--confirm').on('click',()=>window.location.reload())
			}
		});
	})
    

	$('#form_review').on('submit',(e)=>{
		e.preventDefault();
		$.ajax({
			method: "POST",
			url: "admin/include/process.php",
			data: "Mode=form_review&" + $('#form_review').serialize(),
			success: function (data) {
				swal("Good Job!" , data , "success");
				// $('.swal-button--confirm').on('click',()=>window.location.reload())
			}
		});
	})
    


</script>

	</body>
</html>
