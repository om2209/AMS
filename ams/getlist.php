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
   <div class="container-fluid center mainin">
    <div id = "log">
       <form action="getlist.php" method="post">
         <label>Course code</label><br>
            <select style="width: 20%;padding: 5px;background: white;outline: none;font-size: 16px;" name="cid">
              <?php
                  $sql = "SELECT courseid FROM course WHERE faculty = '$id' ";
                  $res = mysqli_query($connect,$sql);
                  echo '<option value="none">Select course</option>';
                  while($row=mysqli_fetch_assoc($res)) {
                      echo '<option value="'.$row['courseid'].'">'.$row['courseid'].'</option>';
                  }
              ?>
            </select><br><br>
         <label>Date(dd/mm/yyyy)</label><br>
         <label>Day</label>
         <select style="padding: 5px;background: white;outline: none;font-size: 16px;" name="day">
            <?php
               $i=1;
               while($i<10) {
                  echo '<option value="0'.$i.'">0'.$i.'</option>';
                  $i++;
               }
               while($i<32) {
                  echo '<option value="'.$i.'">'.$i.'</option>';
                  $i++;
               }
            ?>
        </select>
        <label>Month</label>
         <select style="padding: 5px;background: white;outline: none;font-size: 16px;" name="month">
            <?php
               $i=1;
               while($i<10) {
                  echo '<option value="0'.$i.'">0'.$i.'</option>';
                  $i++;
               }
               while($i<13) {
                  echo '<option value="'.$i.'">'.$i.'</option>';
                  $i++;
               }
            ?>
        </select>
        <label>Year</label>
         <select style="padding: 5px;background: white;outline: none;font-size: 16px;" name="year">
            <?php
               $i = 0;
               $d = date("Y");
               while($i<10) {
                  echo '<option value="'.$d.'">'.$d.'</option>';
                  $i++;
                  $d--;
               }
            ?>
        </select><br>
         <button type="submit" name="getlist">Next</button>
       </form>
       <a href="index.php"><button>Home Page</button></a>
    </div>


    <?php

       if(isset($_POST['getlist'])){
           $ccode = strtoupper($_POST['cid']);
           $day = $_POST['day'];
           $month = $_POST['month'];
           $year = $_POST['year'];
           if((($month==4)||($month==6)||($month==9)||($month==11))&& ($day==31)) echo '<script type="text/javascript">alert("Enter correct date!");</script>';
           else if(($month==2) && ($day>29)) echo '<script type="text/javascript">alert("Enter correct date!");</script>';
           else {
               $date = $day.'/'.$month.'/'.$year;
               $sql = "TRUNCATE TABLE temp";
               $res = mysqli_query($connect,$sql);
               if(!$res) echo '<script type="text/javascript">alert("Some error");</script>';
               else {
                  $sql = "INSERT INTO temp(`ccode`,`dates`) VALUES('$ccode','$date')";
                  if(!mysqli_query($connect,$sql)) echo '<script type="text/javascript">alert("Error");</script>';
               }
           }
           echo '<script>window.location.assign("mark.php");</script>';
       }
    ?>
   </div>
</div>
</body>
</html>