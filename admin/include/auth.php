<?php
session_start();
require_once 'config.php';

class auth extends database{
    
 
        public function login_user($username,$password){
          //join query will be used
          $query = $this->conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
            $query->execute(array($username , $password));
            $control= $query->fetch(PDO::FETCH_ASSOC);
            $control_2 =$query->rowCount();
            if($control_2  > 0)
            {
           
// echo $control['role'];
              if($control['role'] == 1){
                if (isset($_SESSION['isClient'])) {
                  unset($_SESSION['isClient']); 
                  unset($_SESSION['username']); 
                  unset($_SESSION['uid']);
                  }
                    $_SESSION["username"] = $username;
                    $_SESSION["role"] = $control['role'];
                    $_SESSION["uid"] = $control['id'];
                    $_SESSION['isAdmin'] = true;
                header('location: ../index.php');
              }else{
                if (isset($_SESSION['isAdmin'])) {
                  unset($_SESSION['isAdmin']);
                  unset($_SESSION['username']);
                  unset($_SESSION['uid']);
                  }
                  $_SESSION["username"] = $username;
                  $_SESSION["uid"] = $control['id'];
                  $_SESSION["role"] = $control['role'];
                  $_SESSION['isClient'] = true;
                header('location: ../../index.php');
              }
            }
      }

 
    // COde FOr Validation For Login and Register
      
    public function session_user($username)
    {
          $sql="SELECT id,email,address,phone from users where username=:username";
          $stmt=$this->conn->prepare($sql);
          $stmt->bindParam(":username",$username);
          $stmt->execute();
          $result=$stmt->fetch(PDO::FETCH_ASSOC);
         return $result;
    }

    public function test_input($data){
        $data= trim($data);
        $data= stripslashes($data);
        $data= htmlspecialchars($data);
        return $data;
        }

     // Function For Register New User   

    
    // Function For Register New User   

    public function registeruser($name ,$username ,$email ,$address ,$phone ,$password, $city = '', $country = '')
    {
        
        $sql = "INSERT INTO users(name,username,email,address,city,country,phone,password) VALUES (:name,:username,:email,:address,:city,:country,:phone,:password)";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':name', $name ,PDO::PARAM_STR);
        $stmt->bindParam(':username', $username ,PDO::PARAM_STR);
        $stmt->bindParam(':email', $email ,PDO::PARAM_STR);
        $stmt->bindParam(':address', $address ,PDO::PARAM_STR);
        $stmt->bindParam(':city', $city ,PDO::PARAM_STR);
        $stmt->bindParam(':country', $country ,PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone ,PDO::PARAM_STR);
        $stmt->bindParam(':password', $password ,PDO::PARAM_STR);
        $result = $stmt->execute();
        if($result)
        {
          echo "<script>alert('Insert Successfully');</script>";
          header('location:../index.php');
          } 
          
    }

         // Function For front-end Register New User   

         public function front_end_registeruser($name ,$username ,$email ,$address ,$phone ,$password, $city = '', $country = '')
         {
             
             $sql = "INSERT INTO users(name,username,email,address,city,country,phone,password) VALUES (:name,:username,:email,:address,:city,:country,:phone,:password)";
             $stmt = $this->conn->prepare($sql);
             $stmt->bindParam(':name', $name ,PDO::PARAM_STR);
             $stmt->bindParam(':username', $username ,PDO::PARAM_STR);
             $stmt->bindParam(':email', $email ,PDO::PARAM_STR);
             $stmt->bindParam(':address', $address ,PDO::PARAM_STR);
             $stmt->bindParam(':city', $city ,PDO::PARAM_STR);
             $stmt->bindParam(':country', $country ,PDO::PARAM_STR);
             $stmt->bindParam(':phone', $phone ,PDO::PARAM_STR);
             $stmt->bindParam(':password', $password ,PDO::PARAM_STR);
             $result = $stmt->execute();
            
             if($result)
             {
               echo "<script>alert('Insert Successfully');</script>";
               header('location:./../login.php');
               } 
               
         }

    public function check_pass($username, $password)
    {
        $sql = "SELECT * from users WHERE username =:username && password=:password";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':password' => $password,':username' => $username]);
        $count =  $stmt->rowCount();
        return $count;
    }


    public function update_pass($password,$username)
    {
        $sql = "UPDATE users SET password =:password WHERE username=:username";
        $stmt = $this->conn->prepare($sql);
        if ($stmt->execute(['password' => $password,'username' => $username])) {
            return "1";
        } else {
            echo "0";
        }
    }


          public function RegisterUsers(){
            $sql = "SELECT * FROM users where role = 2";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
           }

        public function admin(){
          $sql = "SELECT * FROM users where role = 1";
          $stmt=$this->conn->prepare($sql);
          $stmt->execute();
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          return $result;
           }


        public function delete_user($u_id)
        {
          $sql = "DELETE FROM users WHERE id=:u_id"; 
          $stmt=$this->conn->prepare($sql);
          $stmt->bindParam(':u_id' ,$u_id ,PDO::PARAM_STR);
          $stmt->execute();
          return true ;
        }


    // INSERT Category To Database 

    public function insert_cat($catname)
    {
        $sql= "INSERT INTO category(cat_name) VALUES(:catname)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':catname', $catname ,PDO::PARAM_STR);
        $result = $stmt->execute();
        if($result)
        {
           echo "<script>alert('Insert Successfully');</script>";
           header('location:../category.php');
        }
    }

    // SELECT Category From Database 

    public function select_cat()
    {
        $sql = "SELECT * FROM category";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $userRow=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $userRow;
    }


    public function fetchByCategory($cat_id){
      $sql ="SELECT products.*, category.id from products inner join category on products.category_id = category.id where category.id = $cat_id";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }

    // Update Category to Database

        public function update_category($id,$cat_name)
        {
            
            $sql="UPDATE category set cat_name=:cat_name where id=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->bindParam(':id', $id,PDO::PARAM_INT);
            $stmt->bindParam(':cat_name', $cat_name , PDO::PARAM_STR);
            $stmt->execute();
            
            return true;

        }
 
    // DELETE Category to Database 

        public function delete_category($cat_id)
        {
           $sql = "DELETE FROM category WHERE id=:cat_id"; 
           $stmt=$this->conn->prepare($sql);
           $stmt->bindParam(':cat_id' ,$cat_id ,PDO::PARAM_STR);
           $stmt->execute();
           return true ;
        }










    // BRANDS START FROM HERE 

    // SELECT QUERY for BRANDS

    public function select_brand()
    {
        $sql = "SELECT * FROM brands";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $userRow=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $userRow;
    }

    // INSERT QUERY for BRANDS

    public function insert_brand($brand_name)
    {
        $sql = "INSERT INTO brands(brand_name) VALUES(:brand_name)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':brand_name',$brand_name ,PDO::PARAM_STR);
        $result = $stmt->execute();
        if($result)
        {
           echo "<script>alert('Insert Successfully');</script>";
           header('location:../brand.php');
        }
    }

    //  UPDATE QUERY for BRANDS


    public function update_brand($id,$brand_name)
    {
        
        $sql="UPDATE brands set brand_name=:brand_name where id=:id";
        $stmt=$this->conn->prepare($sql);
        $stmt->bindParam(':id', $id,PDO::PARAM_INT);
        $stmt->bindParam(':brand_name', $brand_name , PDO::PARAM_STR);
        $stmt->execute();
       
        return true;

    }

    public function delete_brand($brand_id)
    {
       $sql = "DELETE FROM brands WHERE id=:brand_id"; 
       $stmt=$this->conn->prepare($sql);
       $stmt->bindParam(':brand_id' ,$brand_id ,PDO::PARAM_STR);
       $stmt->execute();
       return true ;
    }






                          // SUB_CATEGORY Start FROM Here

    //  SELECT Sub-category SINGLE DATA From Database

    public function select_sub_category_single()
    {
       $sql = "SELECT * FROM category";
       $stmt = $this->conn->prepare($sql);
       $stmt->execute();
       $sub_cat=$stmt->fetchAll(PDO::FETCH_ASSOC);
       return $sub_cat;
    }
 

    // // SELECT Sub-category ALL DATA From Database 

    // public function select_sub_category($sub_cat_id)
    // {
    //    $sql = "SELECT * FROM category INNER JOIN sub_category ON category.id = sub_category.category_id";
    //    $stmt = $this->conn->prepare($sql);
    //    $stmt->execute();
    //    $sub_cat=$stmt->fetchAll(PDO::FETCH_ASSOC);
    //    return $sub_cat;
    // }

    public function insert_sub_category($cat_name,$subcat_name)
    {
        $sql = "INSERT INTO sub_category(category_id,sub_cat_name) VALUES(:cat_name,:subcat_name)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':cat_name',$cat_name,PDO::PARAM_INT);
        $stmt->bindParam(':subcat_name',$subcat_name,PDO::PARAM_STR);
        $result = $stmt->execute();
        if ($result)
        {
          header("location:../sub-category.php");
        }

    }
    public function select_cat_subcat(){
        $sql="SELECT category.cat_name as cat_name, sub_category.id as cat_id, sub_category.sub_cat_name as sub_cat_name,sub_category.category_id as category_id from category inner join sub_category on category.id=sub_category.category_id";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // Update Sub Category To Database

        public function update_sub_cat($cat_id,$update_sub_cat,$sub_cat_id)
      {
        $sql = "UPDATE sub_category SET category_id=:cat_id , sub_cat_name=:update_sub_cat where id=:sub_cat_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':cat_id',$cat_id,PDO::PARAM_INT);
        $stmt->bindParam(':sub_cat_id',$sub_cat_id,PDO::PARAM_INT);
        $stmt->bindParam(':update_sub_cat',$update_sub_cat,PDO::PARAM_STR);
        $result = $stmt->execute();
        return $result;
      }

      // Delete Sub-Category From Database

      public function delete_sub_category($sub_id)
      {
         $sql = "DELETE FROM sub_category WHERE id=:sub_id"; 
         $stmt=$this->conn->prepare($sql);
         $stmt->bindParam(':sub_id' ,$sub_id ,PDO::PARAM_STR);
         $stmt->execute();
         return true ;
      }


      
          // PRODUCTS START FROM HERE 


     // FETCH Category to Product From Database On AJax Request
    
      public function fetch_category($call_id)
      {
         $sql = "SELECT * FROM sub_category WHERE category_id = :category_id";
         $stmt=$this->conn->prepare($sql);
         $stmt->bindParam(':category_id' ,$call_id ,PDO::PARAM_INT);
         $stmt->execute();
         $category=$stmt->fetchAll(PDO::FETCH_ASSOC);
         return $category;
      }


     // INSERT PRODUCT into Database 
     
     public function insert_product($cat_id,$sub_cat_id,$p_name,$p_description,$p_discount,$p_price,$p_quantity,$p_color,$img)
     {
         $sql= "INSERT INTO products(category_id,
                                    sub_category_id,
                                    p_name,
                                    p_description,
                                    p_discount,
                                    p_price,
                                    quantity,
                                    p_colour,
                                    images)
                                            VALUES(:cat_id,
                                                    :sub_cat_id,
                                                    :p_name,
                                                    :p_description,
                                                    :p_discount,
                                                    :p_price,
                                                    :p_quantity,
                                                    :p_color,
                                                    :img)";

           $stmt = $this->conn->prepare($sql);
           $stmt->bindParam(':cat_id',$cat_id,PDO::PARAM_INT);                                         
           $stmt->bindParam(':sub_cat_id',$sub_cat_id,PDO::PARAM_INT);                                         
           $stmt->bindParam(':p_name',$p_name,PDO::PARAM_STR);                                         
           $stmt->bindParam(':p_description',$p_description,PDO::PARAM_STR);                       
           $stmt->bindParam(':p_discount',$p_discount,PDO::PARAM_INT);                                         
           $stmt->bindParam(':p_price',$p_price,PDO::PARAM_INT);                                         
           $stmt->bindParam(':p_quantity',$p_quantity,PDO::PARAM_INT);                                         
           $stmt->bindParam(':p_color',$p_color,PDO::PARAM_STR);    
           $stmt->bindParam(':img',$img,PDO::PARAM_STR);    
           $success = $stmt->execute();
           
           return $success;

     }

     //  SELECT PRoDUCTS from database 
     
      public function fetch_products()
      {
          $sql = "SELECT * FROM products";
          $stmt = $this->conn->prepare($sql);
          $stmt->execute();
          $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
          return $result;

      }

      public function recomended_products()
      {
          $sql = "SELECT DISTINCT(products.id) as product_id , products.p_name as p_name, products.p_price as p_price , products.p_discount as p_discount,products.images FROM products inner join reviews on products.id=reviews.product_id where review_stars>4";
          $stmt = $this->conn->prepare($sql);
          $stmt->execute();
          $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
          return $result;

      }

      public function select_products($edit_id)
      {
          $sql = "SELECT * FROM products WHERE id = $edit_id";
          $stmt = $this->conn->prepare($sql);
          $stmt->execute();
          $result=$stmt->fetch(PDO::FETCH_ASSOC);
          return $result;
        //   var_dump($row);
      }  

      public function location_fetch(){
        $sql = "SELECT * FROM locationw";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
      }


      public function update_location($hidden_id,$name,$street,$city,$phone,$email,$description){
        $sql = "UPDATE locationW SET name=:name , street =:street , city =:city , phone =:phone , email =:email , description =:description where id=:hidden_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':hidden_id',$hidden_id);
        $stmt->bindParam(':name',$name);
        $stmt->bindParam(':street',$street);
        $stmt->bindParam(':city',$city);
        $stmt->bindParam(':phone',$phone);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':description',$description);
        $result = $stmt->execute();
        return $result; 
      }

      public function location_fetch_by_id($l_id){
        $sql = "SELECT * FROM locationw where id = :l_id";
        $stmt=$this->conn->prepare($sql);
        $stmt->bindParam(':l_id' ,$l_id ,PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
      }

      // add location

      public function insert_location($name,$street,$city,$phone,$email,$description){
        $sql = "INSERT INTO locationw(name,street,city,phone,email,description) VALUES (:name,:street,:city,:phone,:email,:description)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name',$name);
        $stmt->bindParam(':street',$street);
        $stmt->bindParam(':city',$city);
        $stmt->bindParam(':phone',$phone);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':description',$description);
        $stmt->execute();
      }   
      
      public function delete_product($product_id)
      {
         $sql = "DELETE FROM products WHERE id=:product_id"; 
         $stmt=$this->conn->prepare($sql);
         $stmt->bindParam(':product_id' ,$product_id ,PDO::PARAM_STR);
         $stmt->execute();
         return true ;
      }

      public function update_product($product_id,$cat_id,$sub_cat_id,$p_name,$p_description,$p_discount,$p_price,$p_quantity,$p_color,$img_2)
      {
        $sql = "UPDATE products SET category_id=:cat_id , sub_category_id =:sub_cat_id , p_name =:p_name , p_description =:p_description , p_discount =:p_discount ,p_price =:p_price , quantity =:p_quantity , p_colour=:p_color , images=:img_2 where id=:product_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':product_id',$product_id,PDO::PARAM_INT);
        $stmt->bindParam(':cat_id',$cat_id,PDO::PARAM_INT);
        $stmt->bindParam(':sub_cat_id',$sub_cat_id,PDO::PARAM_INT);
        $stmt->bindParam(':p_name',$p_name,PDO::PARAM_STR);
        $stmt->bindParam(':p_description',$p_description,PDO::PARAM_STR);
        $stmt->bindParam(':p_discount',$p_discount,PDO::PARAM_INT);
        $stmt->bindParam(':p_price',$p_price,PDO::PARAM_INT);
        $stmt->bindParam(':p_quantity',$p_quantity,PDO::PARAM_INT);
        $stmt->bindParam(':p_color',$p_color,PDO::PARAM_STR);
        $stmt->bindParam(':img_2',$img_2,PDO::PARAM_STR);
        $result = $stmt->execute();
        return $result; 
        
      }


      public function pendingCancel($cancel_Id){
        $sql = "UPDATE orders set status = '2' where id = :cancel_Id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':cancel_Id', $cancel_Id,PDO::PARAM_INT);
        $stmt->execute();
        return true;
      }

            public function CountpendingOrders(){
              $sql = "SELECT * from orders where status = 0";
              $stmt = $this->conn->prepare($sql);
              $stmt->execute();
              $result= $stmt->rowCount();
              return $result;
        }

        public function CountCompletedOrders(){
          $sql = "SELECT * from orders where status = 1";
          $stmt = $this->conn->prepare($sql);
          $stmt->execute();
          $result= $stmt->rowCount();
          return $result;
      }

      public function CountCanceledOrders(){
        $sql = "SELECT * from orders where status = 2";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result= $stmt->rowCount();
        return $result;
      }

      public function view_Orders(){
        $sql = "SELECT orders.*, users.name,users.phone from `orders` inner join users on orders.user_id = users.id";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
      }


      public function view_Order_details($order_id){
        $sql = "SELECT * from orders where id = :order_id";
        $stmt=$this->conn->prepare($sql);
        $stmt->bindParam(':order_id' ,$order_id ,PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
      }

      public function select_product_data($product_id)
      {
          $sql = "SELECT * from products where id = $product_id";
          $stmt = $this->conn->prepare($sql);
          $stmt->execute();
          $result=$stmt->fetch(PDO::FETCH_ASSOC);
          return $result;
      }



      public function delete_view_orders($order_id){
        $sql = "DELETE from orders where id = :order_id";
        $stmt=$this->conn->prepare($sql);
        $stmt->bindParam(':order_id' ,$order_id ,PDO::PARAM_STR);
        $stmt->execute();
        return true ;
      }

      public function pendingOrders(){
            $sql = "SELECT orders.*,   products.p_name, users.name FROM `orders` INNER JOIN products on orders.product_id = products.id INNER JOIN users on orders.user_id = users.id where orders.status = 0";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
      }

      public function completedOrders(){
          $sql = "SELECT orders.*,   products.p_name, users.name FROM `orders` INNER JOIN products on orders.product_id = products.id INNER JOIN users on orders.user_id = users.id where orders.status = 1";
          $stmt=$this->conn->prepare($sql);
          $stmt->execute();
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          return $result;
  }

  public function Canceled_Orders(){
    $sql = "SELECT orders.*,   products.p_name, users.name FROM `orders` INNER JOIN products on orders.product_id = products.id INNER JOIN users on orders.user_id = users.id where orders.status = 2";
    $stmt=$this->conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}


  public function delete_complete_orders($co_id)
  {
    $sql = "DELETE FROM orders WHERE id=:co_id"; 
    $stmt=$this->conn->prepare($sql);
    $stmt->bindParam(':co_id' ,$co_id ,PDO::PARAM_STR);
    $stmt->execute();
    return true ;
  }

  public function delete_cancel_orders($cancel_id)
  {
    $sql = "DELETE FROM orders WHERE id=:cancel_id"; 
    $stmt=$this->conn->prepare($sql);
    $stmt->bindParam(':cancel_id' ,$cancel_id ,PDO::PARAM_STR);
    $stmt->execute();
    return true ;
  }

  public function pending_changed($pending_change)
  {
    $sql = "UPDATE orders set status='1' where id='$pending_change'";
    $stmt=$this->conn->prepare($sql);
    $stmt->bindParam(':pending_change', $pending_change,PDO::PARAM_INT);
    $stmt->execute();    
    return true;
  }

  public function delete_pending_orders($po_id)
  {
    $sql = "DELETE FROM orders WHERE id=:po_id"; 
    $stmt=$this->conn->prepare($sql);
    $stmt->bindParam(':po_id' ,$po_id ,PDO::PARAM_STR);
    $stmt->execute();
    return true ;
  }

  public function delete_canceled_orders($cco_id)
  {
    $sql = "DELETE FROM orders WHERE id=:cco_id"; 
    $stmt=$this->conn->prepare($sql);
    $stmt->bindParam(':cco_id' ,$cco_id ,PDO::PARAM_STR);
    $stmt->execute();
    return true ;
  }



      public function notification_fetch(){
        $sql = "SELECT * FROM notification";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
      }


      public function delete_notification($n_id)
      {
        $sql = "DELETE FROM notification WHERE id=:n_id"; 
        $stmt=$this->conn->prepare($sql);
        $stmt->bindParam(':n_id' ,$n_id ,PDO::PARAM_STR);
        $stmt->execute();
        return true ;
      }

      



       



















                      // frontend function start from here
                
                
                      public function products_fetch()
                   {
                        $sql = "SELECT * FROM products";
                        $stmt = $this->conn->prepare($sql);
                        $stmt->execute();
                        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
                        return $result;
                   }
                  

                   public function single_product($product_id)
                   {
                        $sql = "SELECT * FROM products WHERE id = $product_id";
                        $stmt = $this->conn->prepare($sql);
                        $stmt->execute();
                        $result=$stmt->fetch(PDO::FETCH_ASSOC);
                        return $result;
                   }

                   public function add_to_cart_insertion($user_id,$product_id,$qty)
                   { 
                       
                      $normalizedQty = max(1, (int)$qty);
                      // Check if item already exists in cart
                      $checkSql = "SELECT id, p_qty FROM cart WHERE user_id = :user_id AND product_id = :product_id LIMIT 1";
                      $checkStmt = $this->conn->prepare($checkSql);
                      $checkStmt->bindParam(':user_id',$user_id ,PDO::PARAM_INT);
                      $checkStmt->bindParam(':product_id',$product_id ,PDO::PARAM_INT);
                      $checkStmt->execute();
                      $existing = $checkStmt->fetch(PDO::FETCH_ASSOC);

                      if ($existing) {
                        $updateSql = "UPDATE cart SET p_qty = p_qty + :qty WHERE id = :id";
                        $updateStmt = $this->conn->prepare($updateSql);
                        $updateStmt->bindParam(':qty',$normalizedQty ,PDO::PARAM_INT);
                        $updateStmt->bindParam(':id',$existing['id'] ,PDO::PARAM_INT);
                        $ok = $updateStmt->execute();
                        echo $ok ? 'Quantity updated in your cart' : 'Something went Wrong';
                        return;
                      }

                      $sql = "INSERT INTO cart(user_id,product_id,p_qty) VALUES(:user_id , :product_id , :qty)";
                      $stmt = $this->conn->prepare($sql);
                      $stmt->bindParam(':user_id',$user_id ,PDO::PARAM_INT);
                      $stmt->bindParam(':product_id',$product_id ,PDO::PARAM_INT);
                      $stmt->bindParam(':qty',$normalizedQty ,PDO::PARAM_INT);
                      $result = $stmt->execute();
                      if($result)
                      {
                        echo 'Your Product is Added to Cart';
                      }
                      else{
                        echo 'Something went Wrong';
                      }

                  
                   }


                   public function select_cart_to_header($user_id)
                    {
                      $sql = "SELECT cart.user_id,cart.product_id,cart.p_qty , products.id,products.p_price,products.p_name,products.images from products inner join cart on cart.product_id=products.id inner join users where users.id='$user_id'";
                      $stmt=$this->conn->prepare($sql);
                      $stmt->execute();
                      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                      return $result; 
                    }

                    
                   public function count_cart_to_header($user_id)
                   {
                     $sql = "SELECT COUNT(product_id) as count from cart where user_id=:user_id";  
                     $stmt=$this->conn->prepare($sql);
                     $stmt->bindParam(':user_id',$user_id);
                     $stmt->execute();
                     $result = $stmt->fetch(PDO::FETCH_ASSOC);
                     return $result; 
                   }


                  public function checkOut_fetch($user_id)
                  {
                    $sql = "SELECT users.* , cart.user_id,cart.product_id,cart.p_qty , products.id,products.p_price,products.p_name,products.images from products inner join cart on cart.product_id=products.id inner join users where users.id='$user_id'";
                    $stmt=$this->conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    return $result;
                  } 

                  public function checkOut_product($user_id)
                  {
                    $sql = "SELECT users.* , cart.user_id,cart.product_id,cart.p_qty , products.id,products.p_price,products.p_name,products.images from products inner join cart on cart.product_id=products.id inner join users where users.id='$user_id'";
                    $stmt=$this->conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    return $result;
                  } 

                  public function order_place($product_id,$user_id,$shipping_address,$total)
                  {
                    $sql = "INSERT INTO orders(product_id,user_id,shipping_address,total_price) VALUES(:product_id , :user_id , :shipping_address,:total)";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->bindParam(':product_id',$product_id,PDO::PARAM_STR);
                    $stmt->bindParam(':user_id',$user_id ,PDO::PARAM_INT);
                    $stmt->bindParam(':shipping_address',$shipping_address ,PDO::PARAM_STR);
                    $stmt->bindParam(':total',$total ,PDO::PARAM_INT);
                    $result = $stmt->execute();
                    if($result)
                    {
                      $sql2 = "DELETE FROM cart WHERE user_id= '$user_id'";
                      $stmt=$this->conn->prepare($sql2);
                      $stmt->bindParam(':user_id' ,$user_id ,PDO::PARAM_INT);
                      $stmt->execute();
                       echo 'Your Product Has Been Placed';
                    }
                    else{
                      echo 'Something went Wrong';
                    }
                  }
             
                  public function fetch_reviews($product_ID){
                    $sql = "SELECT * FROM `users` INNER JOIN reviews on users.id = reviews.user_id INNER JOIN products on products.id = reviews.product_id where reviews.product_id = :product_ID order by reviews.id DESC";
                    $stmt=$this->conn->prepare($sql);
                    $stmt->bindParam(':product_ID',$product_ID);
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    return $result;
                  }

                  public function total_reviews($p_id)
                  {
                    $sql = "SELECT AVG(review_stars) as avg from reviews where product_id = :p_id";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->bindParam(':p_id',$p_id);
                    $stmt->execute();
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    return $result;
                  }

                  public function review_insertion($user_id,$product_id,$review_comment,$rating)
                  {
                    $sql = "INSERT INTO reviews(user_id,product_id,comments,review_stars) VALUES(:user_id , :product_id , :review_comment,:rating)";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->bindParam(':user_id',$user_id ,PDO::PARAM_INT);
                    $stmt->bindParam(':product_id',$product_id,PDO::PARAM_STR);                   
                    $stmt->bindParam(':review_comment',$review_comment ,PDO::PARAM_STR);
                    $stmt->bindParam(':rating',$rating ,PDO::PARAM_INT);
                    $result = $stmt->execute();
                    if($result)
                    {
                       echo 'Your Review is Send to Admin';
                    }
                    else{
                      echo 'Something went Wrong';
                    }
                  }


                  public function select_footer_data()
                  {
                      $sql = "SELECT * from locationw";
                      $stmt = $this->conn->prepare($sql);
                      $stmt->execute();
                      $result=$stmt->fetch(PDO::FETCH_ASSOC);
                      return $result;
                  }

                  public function delete_footer_data($l_id)
                  {
                    $sql = "DELETE FROM locationw WHERE id=:l_id"; 
                    $stmt=$this->conn->prepare($sql);
                    $stmt->bindParam(':l_id' ,$l_id ,PDO::PARAM_STR);
                    $stmt->execute();
                    return true ;
                  }

                  public function search_form($query)
                  {
                    $sql = "SELECT * FROM products WHERE p_name LIKE '%$query%' or p_price LIKE '%query%'";
                    $stmt =$this->conn->prepare($sql);
                    $stmt->bindParam(':query',$query);
				            $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    return $result ;
                  }
          
                  
                      
}


   
?>