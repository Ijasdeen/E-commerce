<?php
require_once('connection.php');

session_start();




 //If the method is only post...
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    if($connection)
    {
       
 if(isset($_POST['first_name']) && isset($_POST["last_name"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["address_1"]) && isset($_POST["address_2"]))
 {
     $firstName=mysqli_real_escape_string($connection,$_POST["first_name"]);
     $lastName=mysqli_real_escape_string($connection,$_POST["last_name"]);
     $email =mysqli_real_escape_string($connection,$_POST["email"]);
     $mobile= mysqli_real_escape_string($connection,$_POST["mobile"]);
     $password =mysqli_real_escape_string($connection,md5($_POST["password"])); //md5 = Encrypting the password
     $address1=mysqli_real_escape_string($connection,$_POST["address_1"]);
     $address2=mysqli_real_escape_string($connection,$_POST["address_2"]);
  
     $query="insert into user_info values('','$firstName','$lastName','$email','$password','$mobile','$address1','$address2')";
     $result=mysqli_query($connection,$query);
     if($result)
     {
         $_SESSION["singUpMessage"]="Registered successfully. Please login now";
         header("location:index.php");
     }
     else {
         //When the result goes wrong.
         echo mysqli_error($connection);
         exit();
     }
     
     
     
    
     
 }
else {
    //When data misses from signup form;
    header("location:index.php");   
    exit();
}
    
        
     }
    
    
    else {
        //When database connection is lost..
        header("<script>alert('Could not connect to the database.')</script>");
        exit();
    }
    
    
    
}
else {
    //When the method is not "POST";
    header('location:index.php');
    exit();
}
 
?>