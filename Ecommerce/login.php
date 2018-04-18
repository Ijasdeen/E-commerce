<?php
require_once('connection.php');
session_start();
 

       if(isset($_POST["checkList"]))
       {
          echo "Data passed";
           exit();
       }

 
  if(isset($_POST["email"]) && isset($_POST["password"]))
  {
   
      
      
      $email=mysqli_real_escape_string($connection,$_POST["email"]);
      $password=mysqli_real_escape_string($connection,md5($_POST["password"]));
      
      $query="select * from user_info where email='$email' and password='$password'";
      $result=mysqli_query($connection,$query);
      if(mysqli_num_rows($result)>0)
      {
          $row=mysqli_fetch_array($result);
          $_SESSION["user_name"]=$row["first_name"];
          $_SESSION["user_id"] = $row["user_id"];
          $_SESSION["login_message"]="1"; //It is sent to dom for showing modal to give message
        
           echo "success";
      }
      else {
          $_SESSION["login_message"]="0";
          echo "fail";
          
      }
      
      
  }
 
    

//If the request method is not "POST";
else {
    header("location:index.php");
    exit();
}

?>