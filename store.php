<?php 

 include 'include/header.php';
 $product = new auth();
 $result = $product->products_fetch();
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
							<li><a href="#">All Categories</a></li>
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
	          
			
				<!-- ASIDE -->
					<div id="aside" class="col-md-2">
						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Categories</h3>
							<div class="checkbox-filter">
                           <?php
						     $categories = $product->select_cat();
							 foreach($categories as $category)
							 {
						   ?>
								<div class="input-checkbox">
									<label for="category-1">
										<span></span>
										<a href="store.php?cat_id=<?php echo $category['id']?>"><?php echo $category['cat_name']?></a>
										
									</label>
								</div>
                            <?php }?>
								
							
							</div>
						</div>
						<!-- /aside Widget -->

						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Price</h3>
							<div class="price-filter">
								<div id="price-slider"></div>
								<div class="input-number price-min">
									<input id="price-min" type="number">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
								<span>-</span>
								<div class="input-number price-max">
									<input id="price-max" type="number">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
							</div>
						</div>
						<!-- /aside Widget -->
					</div>
					<!-- /ASIDE -->

					<!-- STORE -->
					<div id="store" class="col-md-10">
								
						<!-- /store top filter -->
						<!-- store products -->
						<div class="row">
							<!-- product -->
							<?php
							     
								 if (isset($_GET['cat_id']))
								  {
									 $cat_id = $_GET['cat_id'];
									 $cat = $product->fetchByCategory($cat_id);
									
									 foreach($cat as $row)
									 {
									   
                                       $images = $row['images'];  
									   $new_images = explode(",", $images);
                                    							
									?>
							<div class="col-md-4 col-xs-6">
							<a href="product.php?p_id=<?php echo $row['id']?>">	
							<div class="product">
									<div class="product-img">
										<img width="100px" height="280px" src="./uploads/<?php echo $new_images[0]?>" alt="">
										<div class="product-label">
											<?php $percent = ( ($row['p_discount'] - $row['p_price'] ) * 100) / $row['p_discount'];?>
											<span class="sale"><?php echo ceil($percent);?>%</span>
											<span class="new">NEW</span>
										</div>
									</div>
									<div class="product-body">
										<p class="product-category">Category</p>
										<h3 class="product-name"><a href="#">product name goes here</a></h3>
										<h4 class="product-price">$<?php echo $row['p_price']?> <del class="product-old-price">$<?php echo $row['p_discount']?></del></h4>
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
										
										<div class="product-btns">
											<a href="product.php?p_id=<?php echo $row['id']?>" class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp"></span></a>
										</div>
									</div>
									<div class="add-to-cart">
										<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
									</div>
								</div>
							</div>
							</a>
							<?php
							 }
							
								 }elseif(isset($_GET['search']))
								 {
                                    $search = $_GET['search'];
                                    $s = $cuser->search_form($search);
									foreach($s as $row)
									{
									  
									  $images = $row['images'];  
									  $new_images = explode(",", $images);
															   
								   ?>
						   <div class="col-md-4 col-xs-6">
						   <a href="product.php?p_id=<?php echo $row['id']?>">	
						   <div class="product">
								   <div class="product-img">
									   <img width="100px" height="280px" src="./uploads/<?php echo $new_images[0]?>" alt="">
									   <div class="product-label">
										   <?php $percent = ( ($row['p_discount'] - $row['p_price'] ) * 100) / $row['p_discount'];?>
										   <span class="sale"><?php echo ceil($percent);?>%</span>
										   <span class="new">NEW</span>
									   </div>
								   </div>
								   <div class="product-body">
									   <p class="product-category">Category</p>
									   <h3 class="product-name"><a href="#">product name goes here</a></h3>
									   <h4 class="product-price">$<?php echo $row['p_price']?> <del class="product-old-price">$<?php echo $row['p_discount']?></del></h4>
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
									   
									   <div class="product-btns">
										   <a href="product.php?p_id=<?php echo $row['id']?>" class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp"></span></a>
									   </div>
								   </div>
								   <div class="add-to-cart">
									   <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
								   </div>
							   </div>
						   </div>
						   </a>
						   <?php
							}
						   
								 }
								  else{
						
									 foreach($result as $row)
									 {
									   
                                       $images = $row['images'];  
									   $new_images = explode(",", $images);
                                    							
									?>
							<div  class="col-md-4 col-xs-6">
							<a href="product.php?p_id=<?php echo $row['id']?>">	
							<div class="product">
									<div class="product-img">
										<img src="./uploads/<?php echo $new_images[0]?>" alt="">
										<div class="product-label">
											<?php $percent = ( ($row['p_discount'] - $row['p_price'] ) * 100) / $row['p_discount'];?>
											<span class="sale"><?php echo ceil($percent);?>%</span>
											<span class="new">NEW</span>
										</div>
									</div>
									<div class="product-body">
										<p class="product-category">Category</p>
										<h3 class="product-name"><a href="#">product name goes here</a></h3>
										<h4 class="product-price">$<?php echo $row['p_price']?> <del class="product-old-price">$<?php echo $row['p_discount']?></del></h4>
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
										
										<div class="product-btns">
											<a href="product.php?p_id=<?php echo $row['id']?>" class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp"></span></a>
										</div>
									</div>
									<!-- <div class="add-to-cart">
										<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
									</div> -->
								</div>
							</div>
							</a>
							<?php
							 }}
							?>
							<!-- /product -->

							
						</div>
						<!-- /store products -->

						
					</div>
					<!-- /STORE -->
				</div>
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
								<li>
									<a href="#"><i class="fa fa-pinterest"></i></a>
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

	</body>
</html>
