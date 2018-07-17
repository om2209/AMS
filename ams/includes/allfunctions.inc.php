<?php

include 'auth.inc.php';
session_start();

function already_logged(){
   global $connect;
   if( isset($_SESSION['user_id']) ) return true;
   else return false;
}

function user_exists($username,$role){
    global $connect;
    if($username == 'admin' and $role == 'admin') return true;
    else if($role == 'student'){
        $query=" SELECT dept_name FROM student WHERE reg_id='$username' ";
        $result= mysqli_query($connect,$query);
        if(mysqli_num_rows($result)==1) return true;
        else return false;
    }
    else if($role == 'teacher') {
        $query=" SELECT id FROM teacher WHERE username='$username' ";
        $result= mysqli_query($connect,$query);
        if(mysqli_num_rows($result)==1) return true;
        else return false;
    }
}

function login_perform($username,$password,$role){
    global $connect;
    if($username =='admin' and $password == 'admin_123' and $role == 'admin') {
        $_SESSION['user_id']= 'admin';
        $id = $_SESSION['user_id'];
        header('Location: index.php');
    }
    else if ($role == 'student'){
        $password = md5($password);
        $query=" SELECT dept_name FROM student where reg_id = '$username' AND password = '$password' ";
        $result = mysqli_query($connect,$query);
        $idx = mysqli_fetch_assoc($result);
        if(mysqli_num_rows($result)==1){
            $_SESSION['user_id']= $username;
            $id = $_SESSION['user_id'];
            header('Location: index.php');
        }
    }
	else{
        $password = md5($password);
        $query=" SELECT id FROM teacher where username = '$username' AND password = '$password' ";
        $result = mysqli_query($connect,$query);
        $idx = mysqli_fetch_assoc($result);
        if(mysqli_num_rows($result)==1){
            $idd = $idx['id'];
            echo 'error3';
            $sql = "SELECT username FROM teacher WHERE id = $idd ";
            $res = mysqli_query($connect,$sql);
            if(!$res) die('<p>Error in SQL</p>');
            $idt = mysqli_fetch_assoc($res);
            $_SESSION['user_id']= $idt['username'];
            $id = $_SESSION['user_id'];
            header('Location: index.php');
        }
    }

}
function get_uname($id){
    global $connect;
	$query= " SELECT CONCAT(fname,' ',lname) as name FROM usersdata WHERE id = $id ";
	$result= mysqli_query($connect,$query);
    $names = mysqli_fetch_assoc($result);
	return $names['name'];
}
?>