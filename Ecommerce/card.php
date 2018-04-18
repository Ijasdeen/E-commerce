<?php

require_once('Includes/header.php');

//If the session is not set, it would redirect the page to index.php. 
//Users can not open this page directly. 

if(!isset($_SESSION['user_id']))
{
    header("location:index.php");
   
}
?>


<div class="container">
 
 <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12" id="testarea">
        
            <div class="cart-area">
            
            <h3 class="text-info">YOUR SHOPPING CART ITEMS</h3>
            <br><br>
            <div id="cartMessage">
                
            </div>
             <br>
              <div class="table-responsive" id="tableArea">
                 <table class="table table-responsive text-center" id="cartTable">
                     <thead>
                         
                     </thead>
                     <tbody>
                         <?php
                         if(isset($_SESSION["user_id"]))
                         {
                             $user_id=$_SESSION["user_id"];
                         }
                         $query="SELECT a.product_id, a.product_title,a.product_price,a.product_image,b.id,b.qty,b.total FROM products a,cart b where a.product_id=b.p_id AND b.user_id='$user_id'";
                         $result=mysqli_query($connection,$query);
                         if(mysqli_num_rows($result)>0)
                         {
                             while($row=mysqli_fetch_array($result))
                             {
                                 ?>
                               <tr>
                                    <td class="d-none d-sm-block"><img src="product_images/<?php echo $row["product_image"]?>" alt="<?php echo $row["product_title"]?>" class="img-responsive"></td>
                                    
                                <td><strong><?php echo $row["product_title"]?></strong></td>
                                
                                <td>Rs. <?php echo number_format($row["product_price"])?>&nbsp;&nbsp;&nbsp;<span class="text-muted">x</span></td>
                                
                                <td><input type="text" value="<?php echo $row['qty']?>" class="form-control qty text-center" id="qty" size="4" pr="<?php echo $row["product_price"]?>">
                                <br><a href="javascript:void(0);" class="btn btn-primary btn-sm updatePrice" pid="<?php echo $row[0]?>" price="<?php echo $row["product_price"]?>" qty="1">
                                 
                                
                                <i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;Update</a></td>
                                
                                <td><a href="javascript:void(0);" class="text-danger removeItem" deleteId="<?php echo $row[0]?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                               
                                 <?php
                             }
                         }
                         else {
                            echo "<div class='alert alert-info'>Shopping cart is empty</div>";
                         }
                         ?>
                         </tr>
                               
                                <tr>
                                <td colspan="1"><a href="javascript:void(0)" class="text-danger emptycart"><i class="fa fa-trash"></i> Empty your cart.</a></td>
                                <td align="right" colspan="4">Subtotal&nbsp; Rs. <span id="subTotal" class="font-weight-bold subTotal"></span></td>
                                </tr>
                                 
                                 
                        <tr><td colspan="4"><a href="https://www.sandbox.paypal.com/webapps/hermes?token=0KL96844XT045452Y&useraction=commit&mfid=1523969935870_d3aa59a0d189" class="btn btn-primary" id="finalCheckout">Check out with paypal&nbsp;<i class="fa fa-paypal" aria-hidden="true"></i>
</a></td></tr>
                         
                     </tbody>
                 </table>
             </div>
          
        </div>
        
        
    </div>
     
    
     
<!--      Row finishes herer-->
   
</div>    
   
        
        
        
  
   
    
    
     
    
    
</div> 
<?php
require_once('Includes/footer.php');
?>