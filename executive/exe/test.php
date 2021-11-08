<?php
include('connection.php');

$sql="SELECT EmployeeID FROM approval";

if ($result=mysqli_query($con,$sql))
  {
  // Return the number of fields in result set
  $fieldcount=mysqli_num_fields($result);
  printf("Result set has %d fields.\n",$fieldcount);
  // Free result set
  mysqli_free_result($result);
  }

?>

