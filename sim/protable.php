<?php

include('connection.php'); 
include 'session.php';
$username = $_SESSION['user'];


$query ="SELECT * FROM `orders` WHERE Status='0' and Installed='0'";
 $results = mysqli_query($con, $query);

 
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
             <title><?php echo $username; ?></title>
             <link rel="icon" href="cyrus logo.png" type="image/icon type">
             <!-- Bootstrap core CSS -->
             <link href="bootstrap/css/bootstrap.css" rel="stylesheet">  
        <link rel="stylesheet" type="text/css" href="datatable/jquery.dataTables.min.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css"> 
<link rel="stylesheet" type="text/css" href="css/style.css"> 
<link href='https://fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>

      </head>  
      <body>  

<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #E0E1DE;" id="nav">
  <div class="container-fluid" align="center">
    <a class="navbar-brand" href="index.html"><img src="cyrus logo.png" alt="cyrus.com" width="50" height="60">Cyrus Electronics</a>
    <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-md-center" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="protable.php">Home</a>
        </li>
      <li class="nav-item">
        <a class="nav-link" href="viewproduction.php">View Filled Data</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>
      </ul>
    </div>
  </div>
</nav>


           <div class="container"> 
<br><br> 
                <h3 align="center">Orders Data for Production</h3>  
                <br />  
                <div class="table-responsive">  
                     <table class="table-hover bordered" id="example" class="display nowrap"> 
                          <thead> 
                              <tr> 
                                  <th>Bank</th> 
                                  <th>Zone</th> 
                                  <th>Branch</th>
                                  <th>Order ID</th> 
                                  <th>Gadget</th>
                                  <th>Sim Provider</th> 
                                  <th>Sim Type</th> 
                                  <th>Operator</th> 
                                  <th>Voice Message</th>
                                  <th>Executive</th>
                                  <th>Remark</th>
                                  <th>Action</th>
                              </tr>                     
                          </thead>                 
                          <tbody> 
                          <?php  
                          while ($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){ 
                          {  

                                $BranchCode=$row["BranchCode"];
                                $GadgetID=$row["GadgetID"];
                                $OrderID=$row["OrderID"];
                                $OperatorID=$row["OperatorID"];
                                $Provider=$row["SimProvider"];

                                $queryBranch ="SELECT * FROM `branchs` WHERE BranchCode=$BranchCode";
                                $resultBranch = mysqli_query($con2, $queryBranch);
                                $row4=mysqli_fetch_array($resultBranch,MYSQLI_ASSOC);
                                $Branch=$row4["BranchName"];
                                //$BranchCode=$row4["BranchCode"];
                                $ZoneCode= $row4["ZoneRegionCode"];

                                $queryZone ="SELECT * FROM `zoneregions` WHERE ZoneRegionCode=$ZoneCode";
                                $resultZone = mysqli_query($con2, $queryZone);
                                $row2=mysqli_fetch_array($resultZone,MYSQLI_ASSOC);             
                                $Zone=$row2["ZoneRegionName"];
                                $BankCode=$row2["BankCode"];

                                $queryBank ="SELECT * FROM `bank` WHERE BankCode=$BankCode";
                                $resultBank = mysqli_query($con2, $queryBank);
                                $row3=mysqli_fetch_array($resultBank,MYSQLI_ASSOC);
                                $Bank=$row3["BankName"];


                                $queryGadget ="SELECT Gadget FROM `gadget` WHERE GadgetID=$GadgetID";
                                $resultGadget = mysqli_query($con, $queryGadget);
                                $row5=mysqli_fetch_array($resultGadget,MYSQLI_ASSOC);
                                $Gadget=$row5["Gadget"];

                                $queryO ="SELECT * FROM `operators` WHERE OperatorID=$OperatorID";
                                $resultsO = mysqli_query($con, $queryO);
                                if (empty($resultsO)==false) {
                                    $row7=mysqli_fetch_array($resultsO,MYSQLI_ASSOC);
                                    $Operator = $row7["Operator"];
                                    
                                }elseif(empty($resultsO)==true){
                                    $Operator='';
                                }

                                if ($Provider=='Bank' and empty($OperatorID)==true) {
                                    $Action='<a target="blank" href=production2.php?id='.$row["OrderID"].'>Fill Details</a>';
                                }elseif($Provider=='Bank' and empty($OperatorID)==false){

                                    $Action='<a target="blank" href=production.php?id='.$row["OrderID"].'>Fill Details</a>';
                                }else{

                                    $Action='<a target="blank" href=production.php?id='.$row["OrderID"].'>Fill Details</a>';
                                }
                                
                               echo '  
                               <tr> 
                                    <td>'.$Bank.'</td>
                                    <td>'.$Zone.'</td>  
                                    <td>'.$Branch.'</td>
                                    <td>'.$row["OrderID"].'</td>  
                                    <td>'.$Gadget.'</td> 
                                    <td>'.$Provider.'</td>
                                    <td>'.$row["SimType"].'</td>   
                                    <td>'.$Operator.'</td>  
                                    <td>'.$row["VoiceMessage"].'</td>  
                                    <td>'.$row["Executive"].'</td>
                                    <td>'.$row["Remark"].'</td>
                                    <td>'.$Action.'</td>
                               </tr>  
                               ';  
                          }}  
            

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
<?php 
  $con -> close();
  $con2 -> close();
 ?>