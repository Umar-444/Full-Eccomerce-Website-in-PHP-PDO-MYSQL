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

                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-6">
                                                <label for="category">Category</label>
                                                <select class="form-control" name="category" id="category">
                                                    <option value="0" selected>Select Category</option>
                                                <?php
                                                  $cat = new auth();
                                                   foreach($cat->select_sub_category_single() as $row)
                                                    {
                                                    ?>
                                                    <option value="<?php echo $row['id']?>"><?php echo $row['cat_name']?></option>
                                               
                                                <?php } ?>   
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="subcategory">Sub-Category</label>
                                                <select class="form-control" name="sub_category" id="sub_category">
                                                    <option value="">--SELECT--</option>
                                                </select>

                                            </div>
                                        </div>


                                        <div class="form-group mb-4">
                                            <label for="inputAddress">Product Name</label>
                                            <input type="text" name="p_name" require class="form-control" id="tittle" placeholder="Enter Your Product Name">
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="inputAddress2">Specification Of Product </label>
                                            <textarea name="editor1" class="form-control" id="" cols="30" rows="4" placeholder="ENter YOur Product Description"></textarea>
                                        </div>
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-4">
                                                <label for="inputCity">Discount Price</label>
                                                <input type="number" name="p_discount" placeholder="Example : 50000" class="form-control" id="inputCity" require>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="inputCity">Product Price</label>
                                                <input type="number" name="p_price" class="form-control" placeholder="Example : 20000" id="inputCity" require>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputState">Quantity</label>
                                                <input type="number" name="p_quantity" class="form-control" placeholder="Example : 100" id="inputCity" max="200" min="0" require>

                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputZip">Choose Color</label>
                                                <select class="form-control" name="p_color" id="">
                                                    <option value="Multicolor">Multicolor</option>
                                                    <option value="Black">Black</option>
                                                    <option value="Blue">Blue</option>
                                                    <option value="Pink">Pink</option>
                                                    <option value="Grey">Grey</option>
                                                    <option value="white">white</option>
                                                    <option value="White">White</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-8">
                                                <label for="inputZip">Product Image</label>
                                                <input type="file" multiple name="img[]" class="form-control" id="inputZip">
                                            </div>
                                        </div>
                            
                                      <input type="submit" class="btn btn-primary float-right mt-1" name="submit_product" value="Publish Product">
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
                });

                CKEDITOR.replace( 'editor1' );

            </script>