
<?php 

  include 'connection.php';
  include 'session.php';
  $EXEID=$_SESSION['userid'];
  $ApprovalID = $_GET['apid'];

  $sql = "SELECT * from pbills where ApprovalID = '$ApprovalID'";  
  $resultB = mysqli_query($con2, $sql);  

  $Sub=0;

?>





<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Material Consumed</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="datatable/jquery.dataTables.min.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
        <style type="text/css">
    <style>
      fieldset {
        background-color: #eeeeee;
        margin: 10px;
      }

      legend {
        background-color: #26082F;
        color: white;
        padding: 5px 10px;
      }

      .r {
        margin: 5px;
      }
    </style>

  </head>

  <body>
    <br>


    <div class="container">
      <!-- Add technician Section -->
      <fieldset > 
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
        <div class="col-lg-12">
            <form method="post" action="" name="sub">     
          <div class="col-lg-12 table-responsive">
            <table id="userTable2" class="display nowrap table-striped table-hover table-sm" id="exampleFormControlSelect2" class="form-control">
              <thead>
                <tr>
                  <th scope="col">Name</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Used As</th>
                  <th scope="col">Unit Price</th>
                  <th scope="col">Amount</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                    while($rowB = mysqli_fetch_assoc($resultB)){
                      $RateID=$rowB["RateID"];
                      $UsedAs=$rowB["UsedAs"];
                      $Qty=$rowB["Qty"]; 

                      $queryProduct="SELECT * FROM rates Where RateID=$RateID"; 
                      $resultP = mysqli_query($con2, $queryProduct);  
                      $rowP = mysqli_fetch_assoc($resultP);
                      $UnitRate=$rowP["Rate"];
                      $Description=$rowP["Description"];
                      if ($UsedAs=='Waranty') {
                        // code...
                        $Rate=0;
                      }else{
                      $Rate=$rowP["Rate"];
                    }
                       
                 ?>
                  <tr>
                    <td>
                      <?php echo $Description;  ?>
                    </td>
                    <td >
                      <?php echo $Qty; ?>
                    </td>
                    <td >
                      <?php echo $UsedAs; ?>
                    </td>

                    <td >
                      <?php echo $UnitRate; ?>
                    </td>
                    <td >
                      <?php echo $SubTotal = $Rate*$Qty; ?>
                    </td>
                  </tr>
                <?php  $Sub = $Sub + $SubTotal;  } ?>
              </tbody>
            </table>    
          </div>
        <br>
        <div align="right"><strong>Total Price: <?php echo $Sub; ?></strong></div>
        <br><br>
      </fieldset>
    </div> 
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="//cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js
"></script>

    <script type="text/javascript">
      
        $(document).ready(function() {
             var table = $('#userTable2').DataTable( {
                rowReorder: {
                selector: 'td:nth-child(2)'
                },
                responsive: true
                
            } );
        } );

    </script> 
  </body>
</html>
