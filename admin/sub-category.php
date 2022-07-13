<?php
  include 'include/header.php';
  $cuser= new auth();
  $row=$cuser->select_cat_subcat();
  
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
                        <a href="add-sub-category.php" class="btn btn-primary float-right mt-3">Add Sub-Category</a>
                        <table id="zero-config" class="table dt-table-hover" style="width:100%">
                            <thead>
                                <tr>
                                <th>ID</th>
                                    <th>Category Name</th>
                                    <th>Sub-category Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php   foreach($row as $result){

                                 
                                  
                                  
?>
                                <tr>
                                 
                                    <td><?php echo $result['cat_id'];  ?></td>
                                    <td><?php echo $result['cat_name'];  ?></td>
                                    <td><?php echo $result['sub_cat_name'];  ?></td>
                                   
                                  
                                    
                                    <td>
                                        <button type="submit" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $result['cat_id']; ?>">
                                      Update
                                       </button>  <a href="include/process.php?sub_id=<?php echo $result['cat_id'];?>" class="btn btn-danger btn-sm">Delete</a></td>
                                 </tr>
                                 
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal<?php echo $result['cat_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                          <div class="col-md-12 mb-4">
                                                <label for="fullName">Category</label>
                                                <select name="select_cat_id" class="form-control">
                                                <option selected disabled>Select One</option>
                                            
                                                <?php
                                                  $sub_cat = new auth();
                                                   foreach($sub_cat->select_sub_category_single() as $row)
                                                    {
                                                    ?>
                                                    <option  value="<?php echo $row['id']?>"><?php echo $row['cat_name']?></option>
                                               
                                                <?php } ?>
                                               
                                              
                                                </select>
                                                  </div>

                                             <div class="col-md-12 mb-4">
                                             <label for="">Sub-category Name</label>     
                                            <input type="text" class="form-control" value="<?php echo $result['sub_cat_name']; ?>" name="update_sub_cat" >
                                            <input type="hidden" value="<?php echo $result['cat_id']; ?>" name="sub_cat_id">
                                             </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="submit" name="update_sub_category" class="btn btn-primary">Save changes</button>
                                        </form>
                                      </div>
                                      <?php  }?>
                                    </div>
                                  </div>
                                </div>
                                
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