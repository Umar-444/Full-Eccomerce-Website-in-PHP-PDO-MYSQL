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
                                            <h4>Add Category</h4>
                                        </div>                 
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form class="simple-example" action="include/process.php" method="POST">
                                        <div class="form-row">
                                            <div class="col-md-12 mb-4">
                                                <label for="fullName">Category Name</label>
                                                <input type="text" name="catname" class="form-control" id="fullName" placeholder="" value="" required>
                                               
                                            </div>
                                        </div>
                                        <button class="btn btn-primary submit-fn mt-2" name="catSubmit" type="submit">Submit form</button>
                                    </form>
                                </div>
                            </div>
                        </div>

            </div>
        <!-- END CONTENT AREA -->
            <?php
             include 'include/footer.php';
            ?>