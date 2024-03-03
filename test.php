<?php 
if(isset($_SESSION["anything"])) {
    $test =$_SESSION["anything"];
    echo "the value in session $test ";

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "https://andruxnet-random-famous-quotes.p.rapidapi.com/?cat=famous&count=1",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_HTTPHEADER => [
        "X-RapidAPI-Host: andruxnet-random-famous-quotes.p.rapidapi.com",
        "X-RapidAPI-Key: 1df49caa24msh5688e2ac5f1fdd7p117ddejsn193c1f37d620"
    ],
]);



$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
}
<<<<<<< HEAD
=======
if(isset($_POST["myinput"])) {
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

<input type = "text" name = "myinput" > </input>
<input type = "submit" value = "test" > </input>
</form>
</body>
</html>
>>>>>>> a1eed4c60c484c5e51d74b19e2a53eca437201ef
