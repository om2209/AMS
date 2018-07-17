<?php 
      include 'includes/auth.inc.php'; 
      if(isset($_POST['mark'])){
            $course = $_POST['course'];
            $date = $_POST['date'];
            $i=0;
            $x=0;
            if(!empty($_POST['attendance'])) {
                foreach ($_POST['attendance'] as $id) {
                    $x++;
                    $reg_id = explode('-', $id);
                    $roll = $reg_id[1];
                    $sql = "INSERT INTO attendance(`reg_id`,`papercode`,`dates`) VALUES('$roll','$course','$date')";
                    if(mysqli_query($connect,$sql)) $i++;
                }
            }
            if($i == $x) echo '<script type="text/javascript">alert("attendance marked");</script>';
            else echo '<script type="text/javascript">alert("attendance already marked or there is some error");</script>';
      }
      echo '<script>window.history.back();</script>'
?>