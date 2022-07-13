<?php
  include 'include/header.php';
  $cuser= new auth();
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
                        <a href="add-brand.php" class="btn btn-primary float-right mt-3">Add Category</a>
                        <table id="zero-config" class="table dt-table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Brand Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $brand = new auth();
                                 foreach($brand->select_brand() as $row)
                                 {
                                 ?>
                                <tr>
                                    <td><?php echo $row['id'];?></td>
                                    <td><?php echo $row['brand_name'];?></td>
                                  
                                    
                                    <td>
                                        <button type="submit" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $row['id']?>">
                                      Update
                                       </button>  <a href="include/process.php?b_id=<?php echo $row['id'];?>" class="btn btn-danger btn-sm">Delete</a></td>
                                 </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal<?php echo $row['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        
                                          <form action="include/process.php" method="POST">
                                            <label for="">Brand Name</label>     
                                            <input type="text" value="<?php echo $row['brand_name']?>" name="update_brand_name" >
                                            <input type="hidden" value="<?php echo $row['id']?>" name="brand_id">
                                      </div>
                                      <div class="modal-footer">
                                        <button type="submit" name="update_brand" class="btn btn-primary">Save changes</button>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <?php
                                
                                 }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Brand Name</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        


  
     
        <!-- END CONTENT AREA -->
            <?php
             include 'include/footer.php';
            ?>