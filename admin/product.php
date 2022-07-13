<?php
 include 'include/header.php';
?>
    <!--  END NAVBAR  -->
<style>
    .product_sm_img{
        width: 70%;
        display: block;
        margin: auto;
        border-radius: 30px;
        overflow: hidden;
    }
    .product_sm_img img {
        width: 100%;
    }
</style>
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
            <div class="row layout-spacing">
                    <div class="col-lg-12">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-content widget-content-area">
                                <a href="add-product.php" class="btn btn-primary float-right mt-3">Add Product</a>
                                <table id="style-3" class="table style-3  table-hover">
                                    <thead>
                                        <tr>
                                            <th class="checkbox-column text-center"> Product Id </th>
                                            <th class="text-center">Product Image</th>
                                            <th>Product Name</th>
                                            <th>Product Price</th>
                                            <th>Quantity</th>
                                            <th>colour</th>
                                            <!-- <th class="text-center">Status</th> -->
                                            <th class="text-center dt-no-sorting">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                        $product = new auth();
                                       $result = $product->fetch_products();
                                       
                                        foreach($result as $row)
                                        {

                                             $images = $row['images'];
                                             $new_img = explode(",", $images);
                                             
                                       ?>
                                       
                                        <tr>
                                            <td><?php echo $row['id'];?></td>
                                            <td class="text-center">
                                            <!-- <img width="100" height="100" src="./uploads/../../uploads/img_61138629d99bb.png" alt="img" class="profile-img"> -->
                                                <img width="100" height="100" src="./uploads/<?php echo $new_img[0];?>" alt="img" class="profile-img">
                                            </td>
                                            <td><?php echo $row['p_name'];?></td>
                                            <td><?php echo $row['p_price'];?></td>
                                            <td><?php echo $row['quantity'];?></td>
                                            <td><?php echo $row['p_colour'];?></td>
                                            <!-- <td class="text-center"><span class="shadow-none badge badge-danger">Closed</span></td> -->
                                            <td class="text-center">
                                               <a href="./update-product.php?p_id=<?php echo $row['id'];?>" class="btn btn-primary btn-sm">Update</a> 
                                               <a href="include/process.php?pd_id=<?php echo $row['id'];?>"class="btn btn-danger btn-sm">Delete</a> 
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <!-- END CONTENT AREA -->
            <?php
             include 'include/footer.php';
            ?>