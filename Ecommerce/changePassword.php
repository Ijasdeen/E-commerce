<?php
require_once('connection.php');
session_start();
if(isset($_POST["oldPassword"]) && isset($_POST["newPassword"]) && isset($_POST["confirmPassword"]) && isset($_SESSION["user_id"]))
{
    $oldPassword=mysqli_real_escape_string($connection,md5($_POST["oldPassword"]));
    $newPassword=mysqli_real_escape_string($connection,md5($_POST["newPassword"]));
    $confirmPassowrd=mysqli_real_escape_string($connection,md5($_POST["confirmPassword"]));
    $user_id=$_SESSION["user_id"];
    
    
    $checkQuery="select * from user_info where user_id='$user_id' and password='$oldPassword'";
    $result=mysqli_query($connection,$checkQuery);
    if(mysqli_num_rows($result)>0)
    {
         $updateQuery="update user_info set password='$confirmPassowrd' where user_id='$user_id'";
        $executeQuery=mysqli_query($connection,$updateQuery);
        if($executeQuery)
        {
            $_SESSION["updatedSuccessfully"]="1";
            echo "updated";
        }
    }
    else {
        echo "mismatch_old_passowrd";
    }
  
         
  
}
 
mysqli_close($connection);
?>