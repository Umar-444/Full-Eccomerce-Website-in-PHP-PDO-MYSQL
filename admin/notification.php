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
                    <form id="location_form" action="include/process.php" method="POST" class="p-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" class="form-control" name="name"  aria-describedby="emailHelp" placeholder="Enter name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Street</label>
                            <input type="text" class="form-control" name="street"  aria-describedby="emailHelp" placeholder="Enter street">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">City</label>
                            <input type="text" class="form-control" name="city"  aria-describedby="emailHelp" placeholder="Enter city">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Phone</label>
                            <input type="number" class="form-control"name="phone"  aria-describedby="emailHelp" placeholder="Enter phone">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Email</label>
                            <input type="email" class="form-control" name="email"  aria-describedby="emailHelp" placeholder="Enter email">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Description</label>
                            <input type="text" class="form-control" name="description"  aria-describedby="emailHelp" placeholder="Enter email">
                        </div>

                        <div class="form-group">
                            <input type="submit" name="add_location" class="btn btn-primary" value="Add">
                        </div>
                    </form>
                    </div>

                   <div class="locationTable p-5">
                   <table class="table table-striped">
                       <h2>Your Location</h2>
                        <thead>
                            <tr>
                            <th scope="col">id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Street</th>
                            <th scope="col">City</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                    $cuser = new auth();
                                    foreach ($cuser->location_fetch() as $location) {
                                        
                                
                            ?>
                            <tr>
                                <th scope="row"><?php echo $location['id']?></th>
                                <td><?php echo $location['name']?></td>
                                <td><?php echo $location['street']?></td>
                                <td><?php echo $location['city']?></td>
                                <td><?php echo $location['phone']?></td>
                                <td><?php echo $location['email']?></td>
                                <td></button><a href="update_location.php?l_id=<?php echo $location['id'];?>" class="btn btn-info btn-sm">Update</a></td></td>
                                <td></button><a href="include/process.php?l_id=<?php echo $location['id'];?>" class="btn btn-danger btn-sm">Delete</a></td></td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                   </div>
                </div>

            </div>
        </div>
        


  
     
        <!-- END CONTENT AREA -->
            <?php
             include 'include/footer.php';
            ?>