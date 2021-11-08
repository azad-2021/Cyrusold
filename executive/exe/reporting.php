
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
                        ?>
                    </td>

                    <td>
                    <a target="blank" href="vexecutive.php?empid=<?php echo $data1['EmployeeCode']; ?>">See Details</a></td>
                  </tr>
                <?php $toatalCards=0;} ?>
              </tbody>
            </table> 
           
            <br><br>  
              <center>
                
                <input type="submit"  class=" btn btn-success" value="submit" name="submit"></input>
              </center> 
                  </form>      
            <br>
          </div>
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
