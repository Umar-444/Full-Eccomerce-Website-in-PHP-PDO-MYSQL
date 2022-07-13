<?php
     include "auth.php" ;
    $cuser = new auth();


            if(isset($_POST['login']) )
            {
            if($_POST["username"]=="" or $_POST["password"]==""){
                echo "<center><h1>User Name , Email and Password Cannot be Empty...!</h1></center>";
            }
                else{
                    $username =strip_tags(trim($_POST["username"]));
                    $password =strip_tags(trim($_POST["password"]));
                    $result = $cuser->login_user($username,$password);
                }
            }

// Register User Code

        if(isset($_POST['register']))
        {
            $name = $cuser->test_input($_POST['name']);
            $username = $cuser->test_input($_POST['username']);
            $email = $cuser->test_input($_POST['email']);
            $address = $cuser->test_input($_POST['address']);
            $phone = $cuser->test_input($_POST['phone']);
            $password = $cuser->test_input($_POST['password']);
            $result = $cuser->registeruser($name ,$username ,$email ,$address ,$phone ,$password);
        }

        // front-end Register User Code

        if(isset($_POST['front_register']))
        {
            $name = $cuser->test_input($_POST['name']);
            $username = $cuser->test_input($_POST['username']);
            $email = $cuser->test_input($_POST['email']);
            $address = $cuser->test_input($_POST['address']);
            $phone = $cuser->test_input($_POST['phone']);
            $password = $cuser->test_input($_POST['password']);
            $result = $cuser->front_end_registeruser($name ,$username ,$email ,$address ,$phone ,$password);
        }






   // Insert Category To Database 

     if(isset($_POST['catSubmit']))
     {
         $catname =$cuser->test_input($_POST['catname']);
         $result = $cuser->insert_cat($catname);
         
     }


   // Update Category To Database

    if (isset($_POST['update_category']))
     {
       $cat_id = $cuser->test_input($_POST['cat_id']);
       $cat_name = $cuser->test_input($_POST['cat_name']);

       $result = $cuser->update_category($cat_id ,$cat_name);
       if($result){
        header("location: ../category.php"); }
    }

   // DELETE Category From Database

    if(isset($_GET['id']))
    {
       $cat_id = $_GET['id'];
       $result = $cuser->delete_category($cat_id);

       if ($result)
        {
           header("location:../category.php");
       }
    }






                              // BRAND START FROM HERE
        
    // insert BRANDS to Database
     
    if (isset($_POST['brandSubmit']))
     {
        $brand_name = $cuser->test_input($_POST['brandname']);
        $result = $cuser->insert_brand($brand_name);  
     }


    // Update BRANDS to Database

     if (isset($_POST['update_brand']))
     {
        $brand_name = $cuser->test_input($_POST['update_brand_name']);
        $brand_id = $cuser->test_input($_POST['brand_id']);

        $result = $cuser->update_brand($brand_id,$brand_name);
       
        if($result){
        header("location: ../brand.php"); }
     }

     // DELETE BRANDS FROM Database 

     if(isset($_GET['b_id']))
    {
       $brand_id = $_GET['b_id'];
       $result = $cuser->delete_brand($brand_id);

       if ($result)
        {
           header("location:../brand.php");
       }
    }
  

    // INSERT SUB_CATEGORY to Database  

    
    if (isset($_POST['Sub_cat_Submit']))
    {
      $cat_name = $cuser->test_input($_POST['cat_name']); 
      $subcat_name = $cuser->test_input($_POST['subcat_name']); 
      $result = $cuser->insert_sub_category($cat_name,$subcat_name);

    }

    // Update 

    if (isset($_POST['update_sub_category']))
     {
       $cat_id=$cuser->test_input($_POST["select_cat_id"]);
       $update_sub_cat = $cuser->test_input($_POST['update_sub_cat']);
       $sub_cat_id = $cuser->test_input($_POST['sub_cat_id']);
       $result = $cuser->update_sub_cat($cat_id,$update_sub_cat,$sub_cat_id);
       if ($result)
        {
          header('location:../sub-category.php');
        }
    }
    

    if(isset($_GET['sub_id']))
    {
       $sub_id = $_GET['sub_id'];
       $result = $cuser->delete_sub_category($sub_id);

       if ($result)
        {
           header("location:../sub-category.php");
       }
    }

    

               // PRODUCT START FROM HERE


    // FETCH sub-category ON AJAx For Product

      if (isset($_POST['call_id']))
          {
            $call_id=$cuser->test_input($_POST["call_id"]);
            $result = $cuser->fetch_category($call_id);
            if(empty($result)){
                echo '<option>Null</option>';
            }else{
            foreach($result as $row){
                echo "<option value=".$row['id'].">".$row['sub_cat_name']."</option>";
            }}
            
         }      
         
    // INSERT Product into Database 
    
        if (isset($_POST['submit_product']))
        {
            $cat_id = $cuser->test_input($_POST['category']);
            $sub_cat_id = $cuser->test_input($_POST['sub_category']);
            $p_name = $cuser->test_input($_POST['p_name']);
            $p_description = $cuser->test_input($_POST['editor1']);
            $p_discount = $cuser->test_input($_POST['p_discount']);
            $p_price = $cuser->test_input($_POST['p_price']);
            $p_quantity = $cuser->test_input($_POST['p_quantity']);
            $p_color = $cuser->test_input($_POST['p_color']);
            $img_2 = "";
            // count total files
            foreach ($_FILES['img']['tmp_name'] as $key => $val) {
              $img_name = $_FILES['img']['name'][$key];
              $img_size = $_FILES['img']['size'][$key];
              $img_tmp = $_FILES['img']['tmp_name'][$key];
              $img_type = $_FILES['img']['type'][$key];
  
              $tmp = explode('.', $_FILES['img']['name'][$key]);
              $img_ext = strtolower(end($tmp));
  
              $extensions = array("jpeg", "jpg", "png");
  
              if (in_array($img_ext, $extensions) === false) {
                  header("Location: profile.php?alert=invalid_type");
              }
  
              if ($img_size > 5 * 1024 * 1024) {
                  header("Location: profile.php?alert=Too_Big_img");
              }
  
              if (empty($errors) == true) {
                  $img = "../../uploads/" . uniqid("img_") . "." . $img_ext;
                  move_uploaded_file($img_tmp, $img);
                  $img_2 .= $img . ',';
              }
          }
          $img_2 = substr($img_2, 0, -1);
            
                $result =  $cuser->insert_product($cat_id,
                                             $sub_cat_id,
                                             $p_name,
                                             $p_description,
                                             $p_discount,
                                             $p_price,
                                             $p_quantity,
                                             $p_color,
                                             $img_2);
                                             

             if($result)
             {
                 header('location:../product.php');
             }                                
        }

   
        // PRODUCT UPDATE from DATABASE

       
        if(isset($_GET['pd_id']))
        {
           $product_id = $_GET['pd_id'];
           $result = $cuser->delete_product($product_id);
    
           if ($result)
            {
               header("location:../product.php");
           }
        }
       
        if (isset($_GET['p_id'])) {
         
            $edit_id = $_GET['p_id'];
            
            $result = $cuser->select_products($edit_id);
            
            if ($result) {
               header("location:../update-product.php");
            }
        }

        if (isset($_POST['update_product']))
         { 
            $product_id = $cuser->test_input($_POST['p_hidden']);
            $cat_id = $cuser->test_input($_POST['category']);
            $sub_cat_id = $cuser->test_input($_POST['sub_category']);
            $p_name = $cuser->test_input($_POST['p_name']);
            $p_description = $cuser->test_input($_POST['p_description']);
        
            $p_discount = $cuser->test_input($_POST['p_discount']);
            $p_price = $cuser->test_input($_POST['p_price']);
            $p_quantity = $cuser->test_input($_POST['p_quantity']);
            $p_color = $cuser->test_input($_POST['p_color']);
            $img_2 = "";
            // count total files
            foreach ($_FILES['img']['tmp_name'] as $key => $val) {
              $img_name = $_FILES['img']['name'][$key];
              $img_size = $_FILES['img']['size'][$key];
              $img_tmp = $_FILES['img']['tmp_name'][$key];
              $img_type = $_FILES['img']['type'][$key];
  
              $tmp = explode('.', $_FILES['img']['name'][$key]);
              $img_ext = strtolower(end($tmp));
  
              $extensions = array("jpeg", "jpg", "png");
  
              if (in_array($img_ext, $extensions) === false) {
                  header("Location: profile.php?alert=invalid_type");
              }
  
              if ($img_size > 5 * 1024 * 1024) {
                  header("Location: profile.php?alert=Too_Big_img");
              }
  
              if (empty($errors) == true) {
                  $img = "../../uploads/" . uniqid("img_") . "." . $img_ext;
                  move_uploaded_file($img_tmp, $img);
                  $img_2 .= $img . ',';
              }
          }
                $img_2 = substr($img_2, 0, -1);
                $result = $cuser->update_product($product_id,
                                             $cat_id,
                                             $sub_cat_id,
                                             $p_name,
                                             $p_description,
                                             $p_discount,
                                             $p_price,
                                             $p_quantity,
                                             $p_color,
                                             $img_2);
               if($result)
               {
                header("location:../product.php");
               }                              
             }

             if(isset($_GET['pending_change']))
             {
                $pending_change = $_GET['pending_change'];
                $result = $cuser->pending_changed($pending_change);            
                if ($result)
                 {
                    header("location:../pending_orders.php");
                }

             }

             if(isset($_GET['cancel_Id'])){
                $cancel_Id = $_GET['cancel_Id'];
                $result = $cuser->pendingCancel($cancel_Id);
                if ($result) {
                  
                  header("location:../pending_orders.php");
                }

              }


             if(isset($_GET['co_id']))
             {
                $co_id = $_GET['co_id'];
                $result = $cuser->delete_complete_orders($co_id);
         
                if ($result)
                 { 
                    header("location:../complete_orders.php");
                }

                if(isset($_GET['cancel_id']))
                {
                   $cancel_id = $_GET['cancel_id'];
                   $result = $cuser->delete_cancel_orders($cancel_id);
            
                   if ($result)
                    { 
                       header("location:../canceled_orders.php");
                   }
   
                }
               

                if(isset($_GET['po_id']))
                {
                   $po_id = $_GET['po_id'];
                   $result = $cuser->delete_pending_orders($po_id);
            
                   if ($result)
                    {
                       header("location:../pending_orders.php");
                   }


                   if(isset($_GET['cco_id']))
                   {
                      $cco_id = $_GET['cco_id'];
                      $result = $cuser->delete_complete_orders($cco_id);
               
                      if ($result)
                       {
                          header("location:../canceled_orders.php");
                      }
                    }
                }
            }


            if(isset($_GET['u_id']))
            {
               $u_id = $_GET['u_id'];
               $result = $cuser->delete_user($u_id);
        
               if ($result)
                {
                   header("location:../users.php");
               }
              }


            if(isset($_GET['n_id']))
            {
               $n_id = $_GET['n_id'];
               $result = $cuser->delete_notification($n_id);
        
               if ($result)
                {
                   header("location:../notification.php");
               }
              }

              if(isset($_POST['Mode']) && $_POST['Mode'] == "formdata")
              {
                 $user_id = $_SESSION['uid'];
                 $product_id = $cuser->test_input($_POST['product_id']);
                 $qty = $cuser->test_input($_POST['qty']);
                 $result = $cuser->add_to_cart_insertion($user_id,$product_id,$qty);

              }

              
              if(isset($_POST['Mode']) && $_POST['Mode'] == "order_place")
              {
                 $product_id = $cuser->test_input($_POST['p_id']);
                 $user_id = $_SESSION['uid'];
                 $shipping_address = $cuser->test_input($_POST['shipping_address']);
                 $total = $cuser->test_input($_POST['total_price']);
               
                 $result = $cuser->order_place($product_id,$user_id,$shipping_address,$total);
               

              }


              if(isset($_POST['Mode']) && $_POST['Mode'] == "form_review")
              {
                $user_id = $_SESSION['uid'];
                $product_id = $cuser->test_input($_POST['product_id']);
                 $review_comment = $cuser->test_input($_POST['review_comment']);
                 $rating = $cuser->test_input($_POST['rating']);
               
                 $result = $cuser->review_insertion($user_id,$product_id,$review_comment,$rating);
               

              }

              // location insertion
              if (isset($_POST['add_location'])) {

                $name = $cuser->test_input($_POST['name']);
                $street = $cuser->test_input($_POST['street']);
                $city = $cuser->test_input($_POST['city']);
                $phone = $cuser->test_input($_POST['phone']);
                $email = $cuser->test_input($_POST['email']);
                $description = $cuser->test_input($_POST['description']);       
                $cuser->insert_location($name, $street, $city, $phone, $email,$description);
                  header("location:../notification.php");
      
            }


            if(isset($_POST['update_location']))
                {
                   $hidden_id = $cuser->test_input($_POST['update_id']);
                   $name = $cuser->test_input($_POST['name']);
                   $street = $cuser->test_input($_POST['street']);
                   $city = $cuser->test_input($_POST['city']);
                   $phone = $cuser->test_input($_POST['phone']);
                   $email = $cuser->test_input($_POST['email']);
                   $description = $cuser->test_input($_POST['description']);

                   $result = $cuser->update_location($hidden_id,$name,$street,$city,$phone,$email,$description);
            
                   if ($result)
                    {
                       header("location:../notification.php");
                   }
                  }


                  if(isset($_GET['order_Id'])){
                    $order_id = $_GET['order_Id'];
                    $result = $cuser->delete_view_orders($order_id);
                    if ($result) {
                      
                      header("location:../view_orders.php");
                    }
    
                  }

                  if(isset($_GET['l_id']))
                  {
                     $l_id = $_GET['l_id'];
                     $result = $cuser->delete_footer_data($l_id);
              
                     if ($result)
                      {
                         header("location:../notification.php");
                     }
                    }

                    if (isset($_GET['search']) && (!empty($_GET['search'])))
                     {
                        $query = $_GET['search_input'];
                        $result = $cuser->search_form($query);
                        if ($result) {
                            header('location:./../store.php');
                        }
                    }



                    if (isset($_POST['MODE']) && $_POST['MODE'] == "password_change") {
                        $username = $_SESSION['username'];  
                        $password = $_POST['Pass'];
                        $New_password = $_POST['New_Pass'];
                        $Confirm_Password = $_POST['Confirm_Pass'];
                        $result = $cuser->check_pass($username, $password);
                        if($result > 0){
                            if($New_password == $Confirm_Password){
                               $forgot = $cuser->update_pass($New_password,$username);
                               if($forgot == '1'){
                                   echo "Password Updated";
                               }else{
                                   echo "Something Went Worng";
                               }
                            }else{
                                echo "New Password and Confirmed Password didn't Matched";
                            }
                        }else{
                            echo "Invaild Password";
                        }
                    }
?>