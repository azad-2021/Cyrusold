<?php

include('connection.php'); 
include 'session.php';
$username = $_SESSION['user'];

$Date="2021-10-07 00:00:00";
$query ="SELECT * FROM `jobcardmain` WHERE ServiceDone is null and VisitDate>='$Date' and GadgetID != 0 order by VisitDate";
$results = mysqli_query($con, $query);

?>




<!DOCTYPE html>  
<html>  
  <head>   
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Anant Singh Suryavanshi">
    <title>Home</title>
    <link rel="icon" href="cyrus logo.png" type="image/icon type">
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css"> 
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.bundle.min.js">
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>
    <script src="assets/js/popper.min.js"></script>

  </head>  
  <body> 
    <?php 

        include"navbar.php"
    ?>


    <div class="container">
        <table id="example" class=" table row-border table-dark table-hover table-bordered border-primary" style="width:100%">
            <thead>
                <tr>
                    <th style="text-align:center">Bank</th>
                    <th style="text-align:center">Zone</th>
                    <th style="text-align:center">Branch</th>
                    <th style="text-align:center">Jobcard</th>
                    <th style="text-align:center">Visit Date</th>
                    <th style="text-align:center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php  
                    while ($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){

                        $jobcard=$row["Card Number"];
                        $enJobcard=base64_encode($jobcard);
                        $VisitDate=$row["VisitDate"];
                        $BranchCode=$row["BranchCode"];
                        $enBranchCode=base64_encode($BranchCode);

                        $queryBranch ="SELECT * FROM `branchs` WHERE BranchCode=$BranchCode";
                        $resultBranch = mysqli_query($con, $queryBranch);
                        $row4=mysqli_fetch_array($resultBranch,MYSQLI_ASSOC);
                        $Branch=$row4["BranchName"];
                        //$BranchCode=$row4["BranchCode"];
                        $ZoneCode= $row4["ZoneRegionCode"];

                        $queryZone ="SELECT * FROM `zoneregions` WHERE ZoneRegionCode=$ZoneCode";
                        $resultZone = mysqli_query($con, $queryZone);
                        $row2=mysqli_fetch_array($resultZone,MYSQLI_ASSOC);             
                        $Zone=$row2["ZoneRegionName"];
                        $BankCode=$row2["BankCode"];

                        $queryBank ="SELECT * FROM `bank` WHERE BankCode=$BankCode";
                        $resultBank = mysqli_query($con, $queryBank);
                        $row3=mysqli_fetch_array($resultBank,MYSQLI_ASSOC);
                        $Bank=$row3["BankName"];

                        echo '  
                            <tr> 
                                <td style="text-align:center">'.$Bank.'</td>
                                <td style="text-align:center">'.$Zone.'</td>
                                <td style="text-align:center">'.$Branch.'</td>
                                <td style="text-align:center">'.$jobcard.'</td>
                                <td style="text-align:center">'.$VisitDate.'</td>  
                                <td style="text-align:center"><a href=jobcard.php?cardno='.$enJobcard.'&brcode='.$enBranchCode.'>Fill Details </a></td> 
                            </tr>  
                        ';  
                    } 
                ?>  
            </tbody>
        </table>
        <footer class="my-5 pt-5 text-muted text-center text-small">
                <p class="mb-1">2021 © Cyrus Electronics Pvt. Ltd.</p>
        </footer>
    </div>
    <script type="text/javascript">

        $(document).ready(function() {
            $('#example').DataTable( {
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal( {
                            header: function ( row ) {
                                var data = row.data();
                                return 'Details for '+data[0]+' '+data[1];
                            }
                        } ),
                        renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                            tableClass: 'table'
                        } )
                    }
                }
            } );
        } );

    </script>
</body>
</html>

<?php 
  $con -> close();
  $con2 -> close();
 ?>