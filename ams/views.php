<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="custom.css">
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
 <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
  <?php include 'fonts.php';?>-->
  <title>Attendance Management System</title>
</head>
<body>
<div class="container">
  <div class="container head">
     <div class="row">
      <div class="col-sm-9 col-md-9 col-lg-9 center">
          <h1>Attendance Management System</h1>
      </div>
      <div class="col-sm-3 col-md-3 col-lg-3 center">
         <div class="row" style= "margin-top: 30px;">
           <div class="col-sm-12 col-md-12 col-lg-12 center"></div>
            <?php
              include 'includes/auth.inc.php';
              include 'includes/allfunctions.inc.php';
              $id = $_SESSION['user_id'];
              if( !already_logged() ){
                header('Location: login.php');
                exit();
              }
              echo '<b style="color:white; font-size: 16px;">Welcome <span style="color:yellow;">'.$id.' !</span></b>';
            ?>
            
          </div>
          </div>
         </div>
      </div>
     </div>
  </div>
  <div class="container mainin">
    <div class="row">
      <div class="col-sm-8 col-md-8 col-lg-8 center" id="qstns">
         <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
         <label>Course code</label><br>
            <select style="width: 20%;padding: 5px;background: white;outline: none;font-size: 16px;" name="cid">
              <?php
                  $sql = "SELECT c_code FROM course_stud WHERE reg_id = '$id' ";
                  $res = mysqli_query($connect,$sql);
                  echo '<option value="none">Select course</option>';
                  while($row=mysqli_fetch_assoc($res)) {
                      echo '<option value="'.$row['c_code'].'">'.$row['c_code'].'</option>';
                  }
              ?>
            </select><br><br>
         <button type="submit" name="view" >View</button>
       </form>
      </div>
      <div class="col-sm-4 col-md-4 col-lg-4 center" style="margin-top: 80px;">
        <a href="logout.php"><button>Logout</button></a>
      </div>
    </div>
    <div class="row center">
      <?php
         if(isset($_POST['view'])){
           $ccode = strtoupper($_POST['cid']);
          $sql = "SELECT dates FROM attendance WHERE papercode = '$ccode' and reg_id = '$id' ";
          $res = mysqli_query($connect,$sql);
          if(!$res) die('Error in query!');
          if(!mysqli_num_rows($res)){
            echo '<script type="text/javascript">alert("You have not attended any class in this course!");</script>';
          }
          else {
              echo '<table class="table-bordered"><thead><tr><th>Serial No.</th><th>Date of Presentance</th></tr></thead><tbody>';
              $i = 1;
              while( $row = mysqli_fetch_assoc($res)){
                   foreach ( $row as $value) {
                       echo '<tr><td>'.$i.'</td>'.'<td>'.$value.'</td></tr>';
                       $i++;
                   }
               }
              echo '</tbody></table>';
              $query = "SELECT COUNT(dates) as present FROM attendance WHERE papercode = '$ccode' and reg_id = '$id' ";
              $res = mysqli_query($connect,$query);
              if(!$res) die('Error!');
              $ress = mysqli_fetch_assoc($res);
              echo '<p style="color: white;">*Total number of classes attended yet in the course '.$ccode.' = '.$ress['present'].' </p>';

          }
         }
      ?>
    </div>
  </div>
</div
</body>
</html>