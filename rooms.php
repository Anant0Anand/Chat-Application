<?php

$roomname=$_GET['roomname'];

include 'db_connect.php';

$sql = "SELECT * FROM `rooms` WHERE roomname= '$roomname'";
$result=mysqli_query($conn,$sql);
if($result)
{
  if(mysqli_num_rows($result)==0)
  {
    $message = "This room does not exist";
      echo '<script language="javascript">';
      echo 'alert("'.$message.'");';
      echo 'window.location="http://localhost/chatroom";';
      echo '</script>';

  }
}
else
{
  echo "Error :".mysqli_error($conn);
}

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">


<link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/product/">

    

<!-- Bootstrap core CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

<link href="css/product.css" rel="stylesheet">

<!-- Favicons -->
<link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico">
<meta name="theme-color" content="#7952b3">




<style>
body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
}

.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}

.anyclass{
  height: 350px;
  overflow-y:scroll;
}

</style>
</head>
<body>
<h2>Chat Messages- <?php echo $roomname; ?></h2>

<div class="container">
<div class="anyclass">
 
  </div>
</div>



<input type="text" class =" form-control" name="usermsg" id="usermsg" placeholder="Add message"></br>
<button type="btn btn-default" name="submitmsg" id="submitmsg">Send</button>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>



<script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>


<script type="text/javascript">

setInterval(runFunction,1000);
function runFunction()
{
  $.post("htcont.php",{room:'<?php echo $roomname ?>'},
  function(data,status)
  {
    document.getElementsByClassName('anyclass')[0].innerHTML=data;
  }
  )
}


var input=document.getElementById("usermsg");
input.addEventListener("keyup",function(event){
  if(event.keyCode === 13)
  {
    event.preventDefault();
    document.getElementById("submitmsg").click();
  }
});



$("#submitmsg").click(function(){
  var clientmsg=$("#usermsg").val();
  $.post("postmsg.php", {text:clientmsg ,room:'<?php echo $roomname ?>',ip:'<?php echo $_SERVER['REMOTE_ADDR']?>'},

  function(data,status){
    document.getElementsByClassName('anyclass')[0].innerHTML=data;});
    $("#usermsg").val("");
  return false;
});
</script>

</body>
</html>
