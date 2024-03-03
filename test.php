<?php

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
