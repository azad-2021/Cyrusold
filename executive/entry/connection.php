<?php      
    $host = "localhost";  
    $user = "root";  
    $password = '';
    $db = "backend";
    //$db_3 = "billing";
  
/*
   $con = mysqli_connect($host, $user, $password, $db);  
   if(mysqli_connect_errno()) {  
      die("Failed to connect with MySQL: ". mysqli_connect_error());  
   }

   $con3 = mysqli_connect($host, $user, $password, $db_3);  
   if(mysqli_connect_errno()) {  
      die("Failed to connect with MySQL: ". mysqli_connect_error());  
   }
   */ 
   $con = mysqli_connect('192.168.1.1:9916', "Ashok", "cyrus@123", "cyrusbackend");  
   if(mysqli_connect_errno()) {  
      die("Failed to connect with MySQL: ". mysqli_connect_error());  
   } 


?>  