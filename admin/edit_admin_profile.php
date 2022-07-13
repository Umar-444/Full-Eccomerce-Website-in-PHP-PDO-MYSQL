<?php
  
 include 'include/header.php';
?>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">
        <div class="overlay"></div>
        
        <div class="search-overlay"></div>
        <!--  BEGIN SIDEBAR  -->
       <?php
        include 'include/sidebar.php';
       ?>
        <!--  END SIDEBAR  -->
        
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
            <div class="account-settings-container layout-top-spacing">

           <div class="account-content card">
    <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                <form id="contact" action="include/process.php" method="POST" class="section contact">
                <div class="row card">
                    <div class="card-header">
                        <h3>Change Password</h3>
                    </div>  
                            <div class="col-md-11 card-body mx-auto">  
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="degree2">Old Password</label>
                                                <input type="password" name="name" class="form-control mb-4"  value="">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label >New Password</label>
                                                <input type="password" name="username" class="form-control mb-4"  value="">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="degree3">Confirm Password</label>
                                                        <input type="password" class="form-control mb-4" value="">
                                                    </div>
                                                      </div>
                                                
                                               <div class="col-md-12">
                                                   <input type="submit" class="btn btn-primary btn-sm float-lg-right" value="Update Profile">
                                               </div>
                                            </div>
                                        </div>
                                  </div>
                             </div>
                        </div>
                  </form>
               </div>
            </div>
          </div>
       </div>
    </div>
</div>
       
        <!-- END CONTENT AREA -->
            <?php
             include 'include/footer.php';
            ?>