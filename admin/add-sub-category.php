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
    
            <div id="basic" class="col-lg-12 mt-4 layout-spacing">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-xl-10 col-md-10 col-sm-10 col-10">
                                            <h4>Add Sub-Category</h4>
                                        </div>                 
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form class="simple-example" action="include/process.php" method="POST">
                                        <div class="form-row">
                                           <div class="col-md-12 mb-4">
                                                <label for="fullName">Category</label>
                                                <select name="cat_name" class="form-control" id="">
                                                <option selected disabled>Select One</option>
                                                <?php
                                                  $sub_cat = new auth();
                                                   foreach($sub_cat->select_sub_category_single() as $row)
                                                    {
                                                    ?>
                                                    <option value="<?php echo $row['id']?>"><?php echo $row['cat_name']?></option>
                                               
                                                <?php } ?>
                                                </select>
                                            </div>

                                            <div class="col-md-12 mb-4">
                                                <label for="fullName">Sub-Category Name</label>
                                                <input type="text" name="subcat_name" class="form-control" id="" placeholder="  example : Core i7  , Core i5  ,  Core i3" required>
                                               
                                            </div>
                                        </div>
                                        <button class="btn btn-primary submit-fn mt-2" name="Sub_cat_Submit" type="submit">Add Brand</button>
                                    </form>
                                </div>
                            </div>
                        </div>

            </div>
        <!-- END CONTENT AREA -->
            <?php
             include 'include/footer.php';
            ?>