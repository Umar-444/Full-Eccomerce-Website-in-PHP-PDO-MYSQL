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
                        <table id="zero-config" class="table dt-table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <!-- <th>ID</th> -->
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Product Price</th>
                                    <th>Product Quantity</th>
                                    <th>Sub-Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php 
                                   $cuser= new auth();

                                if (isset($_GET['orderId']) & isset($_SESSION['uid'])) {

                                    $order_id = $_GET['orderId'];
                                    // $usersId = $_SESSION['id'];

                                   $viewOrders = $cuser->view_Order_details($order_id);
                                }
                                    $product = $viewOrders['product_id'];
                                    $product_2 = explode(",", $product);
                                    $total = 0;

                                   foreach($product_2 as $key => $values)
                                   {
                                    $values_1 = explode("-", $values);
                                    $product_id = $values_1[0];
                                    $get_data = $cuser->select_product_data($product_id);
                                    $new_total = $get_data['p_price'] * $values_1[1];
                                    $total += $new_total;
                                    $images = $get_data['images'];
                                    $new_img = explode(",", $images);
                                    
                                 ?>
                                 <?php
								 $cart_total = 0 ;				
									$product_price = $get_data['p_price'];
									$product_qty = $get_data['quantity'];
									$total = $product_price * $product_qty;	
									 $cart_total = $cart_total + ($get_data['p_price'] * $values_1[1]);	
								?>
                                            <td class="text-center">
                                                <img width="100" height="100" src="./uploads/<?php echo $new_img[0];?>" alt="img" class="profile-img">
                                            </td>                                    
                                    <td><?php echo $get_data['p_name'];?></td>
                                
                                    <td><?php echo $get_data['p_price'];?></td>
                                    <td><?php echo $values_1[1];?> </td>
                                    <td><?php echo $cart_total;?></td>

                                    
                                 </tr>
                                <?php  
                                   } 
                                ?>
                            </tbody>
                            <tfoot>
                             <tr>
                                      <th>Image</th>
                                      <th>Product Name</th>
                                     <th>Product Price</th>
                                      <th>Product Quantity</th>
                                 <td ><h5 class="text-danger">Total Price =<?php echo $viewOrders['total_price']?></h5></td>
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