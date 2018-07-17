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
  <div class="container mainin">
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12 center" id="qstns">
        <form method="post" action="marka.php"> 
          <?php
             $sql = "SELECT * FROM temp";
             $res = mysqli_query($connect,$sql);
             $ress = mysqli_fetch_assoc($res);
             if(mysqli_num_rows($res)!=1) echo '<script type="text/javascript">alert("Some error");</script>'; 
             else echo '<label >Course code</label><br>
                  <input type = "hidden" name="course" value="'.$ress['ccode'].'"><input type = "text" name="courses" placeholder="'.$ress['ccode'].'" readonly><br>
                   <label>Date</label><br>
                   <input type = "hidden" name="date" value = "'.$ress['dates'].'"><input type = "text" name="dates" placeholder = "'.$ress['dates'].'" readonly><br><br>';
            $course = $ress['ccode']; 
            $sql = "SELECT reg_id FROM course_stud WHERE c_code = '$course' ";
            $res = mysqli_query($connect,$sql);
            echo '<table class="table-bordered"><thead><tr><th>Registration ID</th><th>Check if present</th></tr></thead><tbody>';
            while($row = mysqli_fetch_assoc($res)) {
                echo '<tr>';
                echo '<td>'.$row['reg_id'].'</td><td><input type="checkbox" name="attendance[]" value ="p-'.$row['reg_id'].'">Present</td>';
                echo '</tr>';
            }
            echo '</tbody></table>';
          ?>
          <button type ="submit" name ="mark">Mark Attendance</button>
        </form>
      
    </div>
      
    </div>
    <div class="row center">
        <a href="logout.php"><button>Logout</button></a>
        <a href="getlist.php"><button>Back</button></a>
    </div>
   
  </div>
</div>
</body>
</html>
