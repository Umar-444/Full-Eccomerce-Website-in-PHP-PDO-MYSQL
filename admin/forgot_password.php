<?php
  include 'include/header.php';
  $username = $_SESSION['username'];
  $active = '1';
  $cuser = new auth();
  
  
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
                    <div class="card">
                        <div class="card-body">
                          
                     <form method="post" id="forgot_form">
                                <div class="form-group">
                                    <label for="p-text" class="">Current Password</label>
                                    <input id="p-text" type="password" name="Pass"
                                        class="form-control" required="">
                                    
                                </div>
                                <div class="form-group">
                                    <label for="new_pass" class="">New Password</label>
                                    <input id="new_pass" type="password" name="New_Pass"
                                        class="form-control" required="">


                                </div>
                                <div class="form-group">
                                    <label for="conirf_pass" class="">Confirm Password</label>
                                    <input id="conirf_pass" type="password" name="Confirm_Pass"
                                        class="form-control" required="">
                                </div>

                                <div class="text-right"> 
                                    <input type="submit" onclick="saveNext()" name="password" class="mt-4 btn btn-primary"> </div>
                            </form>
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
                $("#forgot_form").submit(function(event) {
                    event.preventDefault();
                });
                function saveNext() {
                    $.ajax({
                        type: "POST",
                        url: "include/process.php",
                        data: "MODE=password_change&" + $('#forgot_form').serialize(),
                        success: function(data) {
                            $("#msg").html(`
                            <div class="alert alert-arrow-left alert-icon-left alert-light-primary mb-4" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" data-dismiss="alert" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg> 
                                                    ${data}.
                                                </div>
                            `).fadeIn("slow");;
                            if(data ==="Password Updated"){
                                setTimeout(function(){ 
                                    window.location.replace("index.php");
                                }, 1000);
                            }
                        }
                    });
                }
            </script>        