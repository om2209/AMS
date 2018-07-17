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
   <div class="container-fluid center head">
      <h1>Attendance Management System</h1>
   </div>
   <div class="container-fluid center mainin">
    <div id = "log">
       <form action="registers.php" method="post">
         <label>Registration Id</label><br>
         <input type = "text" name="regist_id"><br>
         <label>Department</label><br>
         <select style="width: 20%;padding: 5px;background: white;outline: none;font-size: 16px;" name="dept">
          <option value="CE"> Civil</option>
          <option value="CSE"> Computer Science</option>
          <option value="ME"> Mechanical</option>
          <option value="EEE"> Electrical</option>
          <option value="ECE"> Electronics</option>
          <option value="MME"> Metallurgy</option>
          <option value="PIE"> Production</option>
          <option value="DCA"> MCA</option>
         </select><br>
         <label style="color:white;">Semester </label><br>
          <select style="width: 20%;padding: 5px;background: white;outline: none;font-size: 16px;" name="semester">
          <option value="I"> I</option>
          <option value="II"> II</option>
          <option value="III"> III</option>
          <option value="IV"> IV</option>
          <option value="V"> V</option>
          <option value="VI"> VI</option>
          <option value="VII"> VII</option>
          <option value="VIII"> VIII</option>
         </select><br>
         <label>Password</label><br>
         <input type = "password" name="pass"><br>
         <label>Confirm Password</label><br>
         <input type = "password" name="cpass"><br>
         <button type="submit" name="submit">Register</button>
       </form>
       <a href="index.php"><button>Home Page</button></a>
       <a href="final.php"><button>Assign Courses</button></a>
       <?php
           if(isset($_POST['submit'])){
              include 'includes/auth.inc.php';
              $regi_id = strtoupper($_POST['regist_id']);
              $dept = $_POST['dept'];
              $semester = $_POST['semester'] ;  
              $pass = $_POST['pass'];
              $cfpass = $_POST['cpass']; 
              if(strcmp($pass,$cfpass))  {
                 echo '<p>Both passwords do not match. Please enter correct passwords.</p>';
                 exit();
              }
              $pass = md5($pass);
              if(strlen($regi_id)<11) {
                 echo '<p>Please enter your correct registration id.</p>';
                 exit();
              }
              $sql = "SELECT dept_name FROM student WHERE  reg_id = '$regi_id' ";
           $result = mysqli_query($connect,$sql);
           if($result){
               if(mysqli_num_rows($result)==0){
                  $query = "INSERT INTO `student` (`reg_id`,`dept_name`, `sem`,`password`) VALUES ('$regi_id', '$dept', '$semester','$pass')";
                $res = mysqli_query($connect, $query);
                if(!$res ) {
                  echo '<script type="text/javascript">alert("Could not enter data!");</script>';
                  exit();
                }
                 else echo '<script type="text/javascript">alert("Successfully registered!");</script>';
               }
               else echo '<script type="text/javascript">alert("Already registered!");</script>';
             }
             else echo '<script type="text/javascript">alert("Some error!");</script>';
           }
        ?>
    </div>
   </div>
</div>
</body>
</html>