<?php
require_once('connection.php');//Datbase connection
session_start();// Starting the session;
$ip_add = getenv("REMOTE_ADDR");
 
     
//<Brand>
if(isset($_POST["brand"]))
{
    $brand_query="select  * from brands";
    $result=mysqli_query($connection,$brand_query);
    if(mysqli_num_rows($result) >0)
    {
        echo '<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">';
        echo '<a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" role="tab" aria-controls="v-pills-home" aria-selected="true"><h4>Brands</h4></a>';
        while($row=mysqli_fetch_array($result))
        {
            $brand_id=$row["brand_id"];
            $brand_name=$row["brand_title"];
            echo '<a class="nav-link select-brand" id="myclick" data-toggle="pill" href="" bid='.$brand_id.'>'.$brand_name.'</a>';
            
        }
        echo '</div>';
    }
}

//<//Brand>

 
//<Selecting Brand>
if(isset($_POST["selectBrand"]) || isset($_POST["get_seleted_Category"]) ||isset($_POST["searchBox"]))
{
    
     if(isset($_POST["selectBrand"]))
    {
      $id=$_POST["brandId"];
    $query="select * from products where product_brand='$id'";

    }
    else if(isset($_POST["get_seleted_Category"]))
    {
        $id=$_POST["cat_id"];
        $query="select * from products where product_cat='$id'";
    }
   else if(isset($_POST["searchBox"]))
    {
        $name = $_POST["productName"];
        $query="select * from products where product_title like '%$name%'";   
    }
    $result=mysqli_query($connection,$query);
    if(mysqli_num_rows($result) >0)
    {
        
        while($row=mysqli_fetch_array($result))
        {
        
            $pro_id    = $row['product_id'];        
			$pro_cat   = $row['product_cat'];
			$pro_brand = $row['product_brand'];
			$pro_title = $row['product_title'];
			$pro_price = $row['product_price'];
			$pro_image = $row['product_image'];
            
            $dummyPrice=250;
            $P_total=($pro_price+$dummyPrice);
            
            echo '
             <div class="col-md-4">
            <div class="mymenu text-center">
                                    <form action="#" method="POST">
                                          <div class="card">    
  <img class="card-img-top img-thumbnail" src="product_images/'.$pro_image.'" alt="'.$pro_title.'">
  <div class="card-body">
    <h4 class="card-title">'.$pro_title.'</h4>
    <p class="card-text">
    <span class="text-danger"><strike>Rs .'.$P_total.'.00</strike></span>
    <span class="text-info">Rs .'.$pro_price.'.00</span>
    </p>
    <a href="#" class="btn btn-outline-primary addProduct" id="addProduct"  pid='.$pro_id.' itemPrice='.$pro_price.'>Add to cart</a>
  </div>
</div>
                                    </form>
                                </div>
                                 </div>';
        }
    }
    else {
        echo "<b class='text-danger text-uppercase'>Product not found...</b>";
        exit();
    }
}
/* <//Selecting Brand>*/

/*<Selecting categories>*/
if(isset($_POST["category"]))
{
    $category_query="select * from categories";
    $cat_result=mysqli_query($connection,$category_query);
    if(mysqli_num_rows($cat_result) >0)
    {
        echo '<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">';
        echo '<a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" role="tab" aria-controls="v-pills-home" aria-selected="true"><h4>Categories</h4></a>';
        while($row=mysqli_fetch_array($cat_result))
        {
            $cid=$row["cat_id"];
           $cat_name = $row["cat_title"];
            echo '<a class="nav-link category"  data-toggle="pill" href="" cid='.$cid.'>'.$cat_name.'</a>';
            
        }
        echo '</div>';
    }
}

/*<//Selecting categories>*/

/*<Retrieving products from db>*/

if(isset($_POST["show"]))
{
    $query="select * from products limit 0,6";
    $result=mysqli_query($connection,$query);
    if($result)
    {
        while($row=mysqli_fetch_array($result))
        {  
            
              $pro_id    = $row['product_id'];        
			$pro_cat   = $row['product_cat'];
			$pro_brand = $row['product_brand'];
			$pro_title = $row['product_title'];
			$pro_price = $row['product_price'];
			$pro_image = $row['product_image'];
            
            $dummyPrice=250;
            $P_total=($pro_price+$dummyPrice);
            
            echo '
             <div class="col-md-4">
            <div class="mymenu text-center">
                                    <form action="#" method="POST">
                                          <div class="card">    
  <img class="card-img-top img-thumbnail" src="product_images/'.$pro_image.'" alt="'.$pro_title.'">
  <div class="card-body">
    <h4 class="card-title">'.$pro_title.'</h4>
    <p class="card-text">
    <span class="text-danger"><strike>Rs .'.$P_total.'.00</strike></span>
    <span class="text-info">Rs .'.$pro_price.'.00</span>
    </p>
       <a href="#" class="btn btn-outline-primary addProduct" pid='.$pro_id.' itemPrice='.$pro_price.'>Add to cart</a>

  </div>
</div>
                                    </form>
                                </div>
                                 </div>';
            
            
            
         
        }
    }
}


/*<//Retrieving products from db>*/

// <Adding into cart>

if(isset($_POST["addToCart"]))
{
    if(isset( $_SESSION["user_name"]))
    {
       $user_id=$_SESSION["user_id"];
      $productId=$_POST["proId"];
      $itemPrice=$_POST["itemPrice"];
        
     $temId=$ip_add;
     
    $query="select id from cart where ip_add='$temId' and p_id='$productId' and user_id='$user_id'";
    $result=mysqli_query($connection,$query);
    if(mysqli_num_rows($result) >0)
    {
        echo 'No';
        exit();
    }
    else {
        $query="insert into cart(p_id,ip_add,user_id,qty,total,status) values('$productId','$temId','$user_id','1','$itemPrice','pending')";
         if(mysqli_query($connection,$query))
         {
             echo 'Yes';
 
             exit();
         }
    }
        
    }
    else {
        echo 'NotLogin';
    }
    
    
}

// <//Adding into cart>

//<Counting total item to show on badge in header.php>
if(isset($_POST["count_item"]))
{
    if(isset($_SESSION["user_id"]))
    {
        $user_id=$_SESSION["user_id"];
         $query="select count(*) as counted_item from cart where user_id='$user_id'";
    $result=mysqli_query($connection,$query);
     
    if(mysqli_num_rows($result))
    {
        $row=mysqli_fetch_array($result);
     echo $row['counted_item'];
        exit();
    }
        
    }
    //When the session is not set, which means after logging out. 
    else {
        echo '0';
        exit();
       
    }
     
      
}
//<Counting total item to show on badge in header.php>
 


//<Checking Email from Signup form>
if(isset($_POST["checkEmail"]) && isset($_POST['email']))
{ 
    $myEmail=mysqli_real_escape_string($connection,$_POST["email"]);
    if(filter_var($myEmail,FILTER_VALIDATE_EMAIL))
    {
         $query="select email from user_info where email='$myEmail'";
    $result=mysqli_query($connection,$query);
    if(mysqli_num_rows($result) >0)
    {
        echo "no";
    }
    else {
        echo "yes";
    }
        
    }
    else {
        echo "<b class='text-danger'>Invalid Email</b>";
    }
    
   
}
//<Checking Email from signup form>

//<Validating Email and checking If the email already exist>
 if(isset($_POST["checkEmail"]) && isset($_POST["myemail"]))
{
   $CheckEmail=mysqli_real_escape_string($connection,$_POST["myemail"]);
    if(!filter_var($CheckEmail,FILTER_VALIDATE_EMAIL))
    {
        echo "<b class='text-warning'>Invalid email address</b>";
        exit();
    }
    else {
        if($CheckEmail!="")
    {
        $query="select email from user_info where email='$CheckEmail'";
        $result=mysqli_query($connection,$query);
        if(mysqli_num_rows($result)>0)
        {
            echo "<b class='text-danger'>Email already exist</b>";
        }
        else {
            echo "<b class='text-success'>Ok</b>";
        }
    }
     else {
         echo "";
     }
    }
     
}
// <//Validating Email and checking If the email already exist>
 
//<Quantity updating card.php>
if(isset($_POST["activeCart"]) && isset($_POST['qty']) && isset($_SESSION["user_id"]) && isset($_POST["productId"]) && isset($_POST["selectedItemPrice"]))
{
    
    
   $user_id=$_SESSION["user_id"];
   $quantity=mysqli_real_escape_string($connection,$_POST["qty"]);
   $p_id=$_POST["productId"];
   $price=$_POST["selectedItemPrice"];
    
    $total=($quantity*$price);
    
    $query="update cart set qty='$quantity', total='$total' where user_id='$user_id' and p_id='$p_id'";
    $result=mysqli_query($connection,$query);
    if($result)
    {
        echo "<div class='alert alert-success'>Updated successfully</div>";
    }
    else {
        echo "<div class='alert alert-danger'>Not updated..</div>";
    }
    
}
//< //Quantity updating from card.php>

 //<Adding total from database and showing by AJAX)
if(isset($_POST["accessSubTotal"]) && isset($_SESSION["user_id"]))
{
    $userId=$_SESSION["user_id"];
     
   $runquery="SELECT SUM(total) FROM cart where user_id='$userId'";
   $result=mysqli_query($connection,$runquery);
    
    if($result)
    {
        while($row=mysqli_fetch_array($result))
        {
            echo number_format($row[0]);
        }
    }
      
}
// <//Adding total from database and showing by AJAX)


//<Delete particular item from cart.php by AJAX> 
if(isset($_POST["deleteItemEnable"]) && isset($_POST["deleteItemId"]) && isset($_SESSION["user_id"]))
{
     $itemId=$_POST["deleteItemId"];
     $myuserId=$_SESSION['user_id'];
    
    $myquery="delete from cart where user_id='$myuserId' and p_id='$itemId'";
    $deleteResult=mysqli_query($connection,$myquery);
    if($deleteResult)
    {
        echo "<div class='alert alert-danger'>Deleted successfully</div>";
        
    }
    else {
        echo "<div class='alert alert-warning'>Could not delete</div>";
    }

}

// <//Delete particular item from cart.php by AJAX> 


//<Deleting all data from cart in database>
 if(isset($_POST['activeEmptyCart']) && isset($_SESSION['user_id']))
 {
         $myuserId=$_SESSION['user_id'];
    $deleteAllQuery="delete from cart where user_id='$myuserId'";
     $executeResult=mysqli_query($connection,$deleteAllQuery);
     if($executeResult)
     {
        echo "yes";
     }
     else {
         echo "<div class='alert alert-warning'>Could not delete all data.</div>";
     }
    
 }
// <//Deleting all data from cart in database> 

 
 //<Final checkOut>
if(isset($_POST['enableFinalCheckOut']) && isset($_SESSION['user_id']))
{
   $userId=$_SESSION['user_id'];
   $checkOutQuery="update cart set status='completed' where user_id='$userId'";
   $result=mysqli_query($connection,$checkOutQuery);
    if(!$result)
    {
        echo 'no';
    }
   
    
}
// </Final CheckOut>


//
mysqli_close($connection);
?>