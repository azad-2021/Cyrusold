<?php

include('connection.php'); 
include 'session.php';

$EmployeeID=$_GET['empid'];;
$query ="SELECT * FROM `approval` Where EmployeeID='$EmployeeID' and posted='0'";

 $results = mysqli_query($con, $query); 

 $query2 ="SELECT * FROM `employees` Where EmployeeCode='$EmployeeID'";
 $results2 = mysqli_query($con, $query2);
$row2=mysqli_fetch_array($results2);
$EmployeeName = $row2["Employee Name"]; 


?>

 <!DOCTYPE html>  
 <html>  
      <head>   
             <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
             <meta charset="utf-8">
             <meta http-equiv="X-UA-Compatible" content="IE=edge">
             <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
             <meta name="description" content="">
             <meta name="author" content="Anant Singh Suryavanshi">
             <title><?php echo $_SESSION['user']; ?></title>
             <!-- Bootstrap core CSS -->
             <link href="bootstrap/css/bootstrap.css" rel="stylesheet">  
        <link rel="stylesheet" type="text/css" href="datatable/jquery.dataTables.min.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">  
      </head>  
      <body>  
           <br /><br />  
           <div class="container"> 
           <br>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #eeeeee;">
  <a class="navbar-brand" href="reporting.php?">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item">
        <a class="nav-link" href="logout.php"><strong>Logout</strong></a>
      </li>
    </ul>
  </div>
</nav>
<br><br> 
                <h3 align="center">Approvals Data of <?php echo$EmployeeName; ?></h3>  
                <br />  
                <div class="table-responsive">  
                     <table class="table-hover table-sm border" id="example" class="display nowrap"> 
                          <thead> 
                              <tr> 
                                  <th>Branch</th>
                                  <th>Order ID</th>
                                  <th>Complaint ID</th>
                                  <th>Date of Visit</th>  
                                  <th>Status</th> 
                                  <th>Action</th>
                              </tr>                     
                          </thead>                 
                          <tbody> 
                          <?php  
                          while ($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){ 
                          {  
                            $BranchCode=$row["BranchCode"];
                            $query ="SELECT * FROM `branchs` Where BranchCode='$BranchCode'";
                            $result = mysqli_query($con, $query);
                            $row1=mysqli_fetch_array($result);

                            $orgDate = $row["VisitDate"];  
                            $date = str_replace('-"', '/', $orgDate);  
                            $Visit = date("d/m/Y", strtotime($date));

                            $Status=$row["Status"];
                            if ($Status==1) {
                                $Status='OK';
                            }else{
                                $Status='NOT Ok';
                            }

                               echo '  
                                   <td>'.$row1["BranchName"].'</td>
                                   <td>'.$row["OrderID"].'</td>
                                   <td>'.$row["ComplaintID"].'</td>
                                   <td>'.$Visit.'</td> 
                                    <td>'.$Status.'</td>                                
                                    <td><a target="blank" href=verify.php?apid='.$row["ApprovalID"].'>Verify Details</a></td> 
                               </tr>  
                               ';  
                          $Visit='';}}  
            

                          ?> 

                     </table>  
                </div>  
           </div>  
     
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="//cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js
"></script>

    <script>

        $(document).ready(function() {
            var table = $('#example').DataTable( {
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                responsive: true
            } );
        } );

    </script>


</body>
</html>