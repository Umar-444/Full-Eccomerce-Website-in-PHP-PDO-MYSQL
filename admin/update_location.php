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
            <div class="row layout-top-spacing">
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-6">
                        <?php  
                                    $cuser = new auth();

                                              if(isset($_GET['l_id']))
                                              {
                                                 $l_id = $_GET['l_id'];
                                                 $result = $cuser->location_fetch_by_id($l_id);
                                                }
                        ?>
                    <form id="location_form" action="include/process.php" method="POST" class="p-4">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="update_id" value="<?php echo $result['id']?>"  aria-describedby="emailHelp" placeholder="Enter name">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" class="form-control" name="name" value="<?php echo $result['name']?>"  aria-describedby="emailHelp" placeholder="Enter name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Street</label>
                            <input type="text" class="form-control" name="street" value="<?php echo $result['street']?>"  aria-describedby="emailHelp" placeholder="Enter street">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">City</label>
                            <input type="text" class="form-control" name="city" value="<?php echo $result['city']?>"  aria-describedby="emailHelp" placeholder="Enter city">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Phone</label>
                            <input type="number" class="form-control"name="phone" value="<?php echo $result['phone']?>"  aria-describedby="emailHelp" placeholder="Enter phone">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Email</label>
                            <input type="email" class="form-control" name="email" value="<?php echo $result['email']?>"  aria-describedby="emailHelp" placeholder="Enter email">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Description</label>
                            <input type="text" class="form-control" name="description" value="<?php echo $result['description']?>"  aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="update_location" class="btn btn-primary" value="Update">
                        </div>
                    </form>
                    </div>
                </div>

            </div>
        </div>
        


  
     
        <!-- END CONTENT AREA -->
            <?php
             include 'include/footer.php';
            ?>