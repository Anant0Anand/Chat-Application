<?php
$room=$_POST['room'];

if(strlen($room)>20 or strlen($room)<2)
 {
$message = "Choose a room-name between 2 t0 20 char";
echo '<script language="javascript">';
 echo 'alert("'.$message.'");';
 echo 'window.location="http://localhost/chatroom";';
 echo '</script>';
}
else if(!ctype_alnum($room))
{
  
  $message = "Choose an alphanumeric room-name";
  echo '<script language="javascript">';
  echo 'alert("'.$message.'");';
  echo 'window.location="http://localhost/chatroom";';
  echo '</script>';

}

else
{
  //connect to the database
  include 'db_connect.php';

}

$sql = "SELECT * FROM `rooms` WHERE roomname= '$room'";
$result=mysqli_query($conn,$sql);
if($result)
{
  if(mysqli_num_rows($result)>0)
  {
        $message = "Already exist so,Choose a different room-name";
      echo '<script language="javascript">';
      echo 'alert("'.$message.'");';
      echo 'window.location="http://localhost/chatSystem";';
      echo '</script>';
  }
  else
  {

     $sql="INSERT INTO `rooms` (`roomname`, `stime`) VALUES ('$room', current_timestamp());";
     if(mysqli_query($conn,$sql))
     {
       $message = "Your room is ready now Go and Chat!!!";
       echo '<script language="javascript">';
       echo 'alert("'.$message.'");';
       echo 'window.location="http://localhost/chatSystem/rooms.php?roomname='.$room.'";';
       echo '</script>'; 
     }

  }
}
else{
  echo "Error:".mysqli_error($conn);
}


?>