<footer id="footer">

<?php 
 $cuser = new auth();
 $result = $cuser->select_footer_data();
?>
<!-- top footer -->
			<div class="section">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">About Us</h3>
								<p><?php echo $result['description']?></p>
								<ul class="footer-links">
									<li><a href="#"><i class="fa fa-map-marker"></i><?php echo $result['street']?></a></li>
									<li><a href="#"><i class="fa fa-map-marker"></i><?php echo $result['city']?></a></li>
									<li><a href="#"><i class="fa fa-phone"></i><?php echo $result['phone']?></a></li>
									<li><a href="#"><i class="fa fa-envelope-o"></i><?php echo $result['email']?></a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-2 col-xs-4">
							<div class="footer">
								<h3 class="footer-title">Categories</h3>
								<ul class="footer-links">
								      <?php
									   $cuser = new auth();
										$categories = $cuser->select_cat();
										$count = 0;
										foreach($categories as $category)
										{
											if ($count >= 5) break;
						                ?>
									<li><a href="store.php?cat_id=<?php echo $category['id']?>"><?php echo $category['cat_name']?></a></li>
									<?php 
											$count++;
										} 
									?>
								</ul>
							</div>
						</div>

						<div class="clearfix visible-xs"></div>

						<div id="map" style="width: 650px; height: 350px;" class="col-md-2 col-xs-4">
							
						</div>
						
					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /top footer -->

			<!-- bottom footer -->
			<div id="bottom-footer" class="section">
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-12 text-center">
							<span class="copyright">
								 <a target="_blank" href="https://www.orbailix.com">Orbailix</a>
							</span>
						</div>
					</div>
						<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /bottom footer -->
		</footer>
		<script type="text/javascript">
      function myMap() {
        var positionMap = {lat: 34.0006, lng: 71.5067};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 10,
          center: positionMap
        });
        var marker = new google.maps.Marker({
          position: positionMap,
          map: map,
          animation:google.maps.Animation.BOUNCE

        });
        var infowindow = new google.maps.InfoWindow({
    content: "Orbailix Compony.!"
  });
  infowindow.open(map,marker);

      }
    </script>
	
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTbYZF_kDxKNopcvej6oh-eVs1z9Xq2J0&callback=myMap"></script>
