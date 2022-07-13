<?php

 include 'include/header.php';
 $product = new auth();
 
 
 if (isset($_GET['p_id'])) {
         
    $edit_id = $_GET['p_id'];
    $row = $product->select_products($edit_id);
}
 
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
            <div class="row mt-4">
                        <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h3>Add Product</h3>
                                        </div>                                                                        
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form action="include/process.php" method="POST" enctype="multipart/form-data">
                                          <input type="hidden" name="p_hidden" hidden value="<?php echo $row['id']; ?>">
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-6">
                                                <label for="category">Category</label>
                                                <select class="form-control" name="category" id="category">
                                                <?php   
                                                  $cat = new auth();
                                                   foreach($cat->select_sub_category_single() as $cat_n)
                                                    {
                                                    ?>
                                                    <option value="<?php echo $cat_n['id']?>"><?php echo $cat_n['cat_name']?></option>
                                               
                                                <?php } ?>   
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="subcategory">Sub-Category</label>
                                                <select class="form-control" name="sub_category" id="sub_category">
                                                    <option value="">--SELECT--</option>
                                                </select>

                                            </div>=
                                        </div>


                                        <div class="form-group mb-4">
                                            <label for="inputAddress">Product Name</label>
                                            <input type="text" name="p_name" value="<?php echo $row['p_name']?>" require class="form-control" id="tittle" placeholder="Enter Your Product Name">
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="inputAddress2">Specification Of Product </label>
                                            <textarea  name="p_description" class="form-control"  cols="30" rows="4"><?php echo $row['p_description']?></textarea>
                                        </div>
                                        <div class="form-p_row mb-4">
                                            <div class="form-group col-md-4">
                                                <label for="inputCity">Discount Price</label>
                                                <input type="number" name="p_discount" value="<?php echo $row['p_discount']?>" placeholder="Example : 50000" class="form-control" id="inputCity" require>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="inputCity">Product Price</label>
                                                <input type="number" name="p_price" value="<?php echo $row['p_price']?>" class="form-control" placeholder="Example : 20000" id="inputCity" require>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputState">Quantity</label>
                                                <input type="number" name="p_quantity" value="<?php echo $row['quantity']?>" class="form-control" placeholder="Example : 100" id="inputCity" max="200" min="0" require>

                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputZip">Choose Color</label>
                                                <select class="form-control" name="p_color" id="">
                                                    <option value="<?php echo $row['p_colour']?>"><?php echo $row['p_colour']?></option>
                                                    <option value="Multicolor">Multicolor</option>
                                                    <option value="Black">Black</option>
                                                    <option value="Blue">Blue</option>
                                                    <option value="Pink">Pink</option>
                                                    <option value="Grey">Grey</option>
                                                    <option value="white">white</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-8">
                                                <label for="inputZip">Product Image</label>
                                                <input type="file" multiple name="img[]" class="form-control" id="inputZip">
                                            </div>
                                        </div>
                         
                                      <input type="submit" class="btn btn-primary float-right mt-1" name="update_product" value="Publish Product">
                                    </form
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
       
        <!-- END CONTENT AREA -->
            <?php
             include 'include/footer.php';
            ?>
            <script>
                $("#category").on('change',function(){
                   let id =  $("#category").val();

                    $.ajax({
                        type: "POST",
                        url: "./include/process.php",
                        data: "call_id="+id, // serializes the form's elements.
                        success: function(data)
                        {
                            $("#sub_category").html(data); // show response from the php script.
                        }
                    });

                })
                
                CKEDITOR.replace( 'editor1' );

            </script>