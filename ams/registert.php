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
       <form action="registert.php" method="post">
         <label >Username(shoulde be less than 11 characters)</label><br>
         <input type = "text" name="uname"><br>
         <label>Department</label><br>
         <select style="width: 20%;padding: 5px;background: white;outline: none;font-size: 16px;" name="dept">
          <option value="CE"> Civil</option>
          <option value="CSE"> Computer Science</option>
          <option value="ME"> Mechanical</option>
          <option value="EEE"> Electrical</option>
          <option value="ECE"> Electronics</option>
          <option value="MME"> Metallurgy</option>
          <option value="PIE"> Production</option>
         </select><br>
         <label>Password</label><br>
         <input type = "password" name="pass"><br>
         <label>Confirm Password</label><br>
         <input type = "password" name="cpass"><br>
         <button type="submit" name="next">Register</button>
       </form>
       <a href="index.php"><button>Home Page</button></a>
       <a href="final.php"><button>Assign Courses</button></a>
      <?php
           if(isset($_POST['next'])){
               include 'includes/auth.inc.php';
               $username = $_POST['uname'];
               $dept = $_POST['dept'];
               $pass = $_POST['pass'];
               $cfpass = $_POST['cpass']; 
               if(strlen($id)>10)  {
                echo '<p>Enter valid username</p>';
                exit();
               }
               if(strcmp($pass,$cfpass))  {
                 echo '<p>Both passwords do not match. Please enter correct passwords.</p>';
                 exit();
               }
           $pass = md5($pass);
           $sql = "SELECT id FROM teacher WHERE username = '$username' and  deptname = '$dept' ";
           $result = mysqli_query($connect,$sql);
           if($result){
            if(mysqli_num_rows($result) == 0){
              $query = "INSERT INTO `teacher` (`username`, `deptname`, `password`) VALUES ('$username', '$dept','$pass')";

              $res = mysqli_query($connect, $query);
              if(!$res ) {
               echo '<script type="text/javascript">alert("Could not register!");</script>';
               exit();
              }
              else{
                echo '<script type="text/javascript">alert("Successfully Registered!");</script>';
              }
             }
             else echo '<script type="text/javascript">alert("Already Registered!");</script>';
           }
           else echo '<script type="text/javascript">alert("Some unknown error!");</script>'; 
           }

        ?> 
    </div>
   </div>
</div>
</body>
</html>