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
       <form action="final.php" method="post">
         <label style="color:white;">Assigning to</label><br>
          <select style="width: 20%;padding: 5px;background: white;outline: none;font-size: 16px;" name="role">
          <option value="teacher"> Teacher</option>
          <option value="student"> Student</option>
         </select><br>
        <label >Username</label><br>
         <input type = "text" name="uname"><br>
         <label>Course code</label><br>
         <input type = "text" name="cid"><br>
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
         </select><br><br>
         <button type="submit" name="register">Assign</button>
       </form>
       <a href="index.php"><button>Home Page</button></a>
      <?php
           if(isset($_POST['register'])){
               include 'includes/auth.inc.php';
               include 'includes/allfunctions.inc.php';
               $role = $_POST['role'];
               $fac = $_POST['uname'];
               $ccode = strtoupper($_POST['cid']);
               $semester = $_POST['semester']; 

               if(user_exists($fac,$role)){
                if($role=='student') $sql = "SELECT * FROM course_stud WHERE c_code = '$ccode' and  reg_id = '$fac' ";
                else $sql = "SELECT * FROM course WHERE courseid = '$ccode' and  faculty = '$fac' ";
                $result = mysqli_query($connect,$sql);
               
               if($result){
                
               if(mysqli_num_rows($result) == 0){
                
                    if($role=='teacher') $query = "INSERT INTO `course` (`courseid`, `sem`, `faculty`) VALUES ('$ccode','$semester', '$fac')";
                    else $query = "INSERT INTO `course_stud` (`c_code`, `reg_id`) VALUES ('$ccode', '$fac')";
                    $res = mysqli_query($connect, $query);
                    if(!$res ) {
                      echo '<script type="text/javascript">alert("Could not assign the course!");</script>';
                      
                       exit();
                    }
                    else{
                       echo '<script type="text/javascript">alert("Course assigned!");</script>';
                    }
                  }
                  else echo '<script type="text/javascript">alert("Course is already assigned!");</script>';
              }
              else echo '<script type="text/javascript">alert("Some unknown error!");</script>'; 
               }
               else echo '<script type="text/javascript">alert("Assignee is not registered on the portal!");</script>';
           }

        ?> 
    </div>
   </div>
</div>
</body>
</html>