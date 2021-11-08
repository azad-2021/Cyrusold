
<?php 

  include 'connection.php';
  include 'session.php';
  //$queryTech="SELECT * FROM pass order by `UserName`"; 
  //$resultTech=mysqli_query($con,$queryTech);
  $EXEID=$_SESSION['userid'];
  $queryTechnicianList= "SELECT * FROM reporting WHERE ExecutiveID=$EXEID";
  $resultTechnicianList=mysqli_query($con,$queryTechnicianList);

?>





<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php echo $_SESSION['user']; ?></title>
    <link rel="icon" href="cyrus logo.png" type="image/icon type">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <script src="/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="datatable/jquery.dataTables.min.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
 <link rel="stylesheet" type="text/css" href="css/style.css"> 
 <link href='https://fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
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
<?php 
  include 'navbar.php';
?>
<br><br>
<div class="container"> 
        <div class="col-lg-12">   
          <div class="col-lg-12 table-responsive">
            <table id="userTable2" class="table table-hover table-bordered border-primary">
              <thead>
                <tr>
                  <th scope="col">Name</th>
                  <th scope="col">Contact Number</th>
                  <th scope="col">Total Jobcards</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                    while($data=mysqli_fetch_assoc($resultTechnicianList)){
                      $ID =$data['EmployeeID'];
                      $query= "SELECT * FROM employees WHERE EmployeeCode=$ID";
                      $result=mysqli_query($con,$query);
                      $data1=mysqli_fetch_assoc($result);  
                 ?>
                  <tr>
                    <td >
                      <?php echo $data1['Employee Name']; ?>
                    </td>
                    <td >
                      <?php echo $data1['Phone']; ?>
                    </td>

                    <td >
                      <?php
                      $queryA= "SELECT * FROM approval WHERE EmployeeID=$ID and posted=0";
                      $resultA=mysqli_query($con,$queryA);
                      $c=1;

                      
                      while($d=mysqli_fetch_assoc($resultA)){
                        $c++;
                      
                      
                    }
                      $toatalCards=$c;
                      if ($toatalCards==1) {
                        // code...
                        echo 0;
                      }else{
                       echo $toatalCards-1;
                        }
                        $EmployeeID=base64_encode($data1['EmployeeCode']);
                        ?>
                    </td>

                    <td>
                    <a target="blank" href="vexecutive.php?empid=<?php echo $EmployeeID; ?>">See Details</a></td>
                  </tr>
                <?php $toatalCards=0;} ?>
              </tbody>
            </table>  
            <br>
          </div>
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
                "lengthMenu": [[10, 50, 100, -1], [10, 25, 50, "All"]],
                responsive: true
                
            } );
        } );

    </script> 
  </body>
</html>
