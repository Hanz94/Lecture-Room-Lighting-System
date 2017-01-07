<?php
    include 'header.php';
    require 'connect.php';
    if(isset($_POST['unschedule'])){
         $id = $_POST['unschedule'];
         $query = "UPDATE `scheduler`.`schedule` SET `booked` = '0',`module_name` = '',`lecturer_name` = '' WHERE `schedule`.`id` =". $id;
                    if($query_run = mysql_query($query)){
                        header('Location: http://localhost/Demo2/view.php');
                    }
    }
    else if(isset($_POST['schedule'])){
        $id = $_POST['schedule'];
        echo "<br><br><br><div class='container'>
             <div class='jumbotron'><form method='get' action='form.php'>
  <div class='form-group'>
    <label>Module Code</label>
    <input type='text' class='form-control' placeholder='Module code' maxlength='6'' name ='module'>
  </div>
  <div class='form-group'>
    <label>Lecturer Name</label>
    <input type='text' class='form-control' id='exampleInputPassword1' placeholder='Lecturer Name'  name ='lecturer'>
    <input type='hidden' value='$id' name = 'id'>
  </div>
  <input type='submit' class='btn btn-default' value='Schedule'/>
</form></div> </div>";
    }
    if(isset($_GET['module']) && isset($_GET['lecturer'])){
            $module = $_GET['module'];
            $lecturer = $_GET['lecturer'];
            $id = $_GET['id'];
            $query ="UPDATE `scheduler`.`schedule` SET `booked` = '1',`module_name` = '$module',`lecturer_name` = '$lecturer' WHERE `schedule`.`id` =$id";
            if($query_run = mysql_query($query)){
                        header('Location: http://localhost/Demo2/view.php');
                    }
    }else{
        echo "<script>
    alert('Please fill the both Fields ');
</script>";
    }

    

?>