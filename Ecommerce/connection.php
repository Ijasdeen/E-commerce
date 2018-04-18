<?php
$connection=mysqli_connect("localhost","root","","ecommerce");
if(!$connection)
{
    echo "<script>alert('Please contact the admin...Something has gone wrong')</script>";
}
?>