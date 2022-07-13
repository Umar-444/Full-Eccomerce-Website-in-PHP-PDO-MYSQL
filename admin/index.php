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
            <div style="height: 50vh;" class="anotherDiv d-flex justify-content-around align-items-center">
            <div class="card" style="width: 18rem;">
            <?php 
                                $cuser = new auth();
                                $countPending = $cuser->CountpendingOrders();
                                $countCompleted = $cuser->CountCompletedOrders();
                                $countCanceled = $cuser->CountCanceledOrders();
            ?>
                <div class="card-body bg-light">
                    <h5 class="card-title">Pending Orders</h5>
                    <h5 class="card-title"><?php echo $countPending?></h5>
                    <a href="pending_orders.php" class="btn btn-primary">Go</a>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <div class="card-body bg-light">
                    <h5 class="card-title">Completed Orders</h5>
                    <h5 class="card-title"><?php echo $countCompleted?></h5>
                    <a href="completed_orders.php" class="btn btn-success">Go</a>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <div class="card-body bg-light">
                    <h5 class="card-title">Canceled Orders</h5>
                    <h5 class="card-title"><?php echo $countCanceled?></h5>
                    <a href="canceled_orders.php" class="btn btn-danger">Go</a>
                </div>
            </div>
        </div>
            </div>
       
        <!-- END CONTENT AREA -->
            <?php
             include 'include/footer.php';
            ?>