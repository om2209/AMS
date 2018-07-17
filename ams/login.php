<?php
include 'includes/auth.inc.php';
include 'includes/allfunctions.inc.php';


if(already_logged() ){
  $id = $_SESSION['user_id'];
  header('Location: index.php?id='.$id.'');
  exit();
}

if(isset($_POST['submit'])){
  $error = " ";
  $role = $_POST['role'];
  $username = $_POST['uname'];
  $password = $_POST['pass'];
  
  if( user_exists($username,$role) ){
      if($username == 'admin' and $password != 'admin_123'){
        $error = "Password incorrect!";
      }
      login_perform($username,$password,$role);    
  }
  else {
    $error = "You are not registered, please contact Admin!";
  }
  
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="custom.css">
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <title>Attendance Management System</title>
</head>
<body>
  <div id="fb-root"></div>
<div class="container">
   <div class="container-fluid center head">
      <h1>Attendance Management System</h1>
   </div>
   <div class="container-fluid center main">
     <p style="color: red; padding-top: 50px; font-size: 18px;"><?php global $error; echo $error; ?></p>
    <div id = "log">
       <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
        <label style="color:white;">Login as </label><br>
          <select style="width: 20%;padding: 5px;background: white;outline: none;font-size: 16px;" name="role">
          <option value="teacher"> Teacher</option>
          <option value="admin"> Admin</option>
          <option value="student"> Student</option>
         </select><br>
         <label>Username</label>(* for students, reg id is username)<br>
         <input type = "text" name="uname"><br>
         <label>Password</label><br>
         <input type = "password" name="pass"><br>
         <button type="submit" name="submit" >Login </button>
       </form>
    </div>
   </div>
</div>
</body>
</html>