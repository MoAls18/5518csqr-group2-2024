<?php 
if(isset($_SESSION["anything"])){
$test =$_SESSION["anything"];
 echo "the value in session $test ";

}
if(isset($_POST["myinput"])){
    $myinput = $_POST["myinput"];
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION["anything"] = $myinput;
}


?>

<html>
<body>
<form action = "test.php" method = "post">

<input type = "text" name = "myinput" > 

</input>
<input type = "submit" value = "test" > 

</input>
</from>
</body>
</html>