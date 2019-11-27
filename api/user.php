<?php 
    function error($msg)
    {
        $response = [];
        $response['success'] = false;
        $response['message'] = $msg;
        return json_encode($response);
    }

    session_start();
    $access_token = $_SESSION['access_token'];
    if($access_token =="")
    {
        die(error("Error: Invalid access token."));
    }
    $URL = "https://api.github.com/user";
    $authHeader = "Authorization: token ".$access_token;
    $userAgentHeader = "User-Agent: Demo";
    echo $authHeader ."<br />";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$URL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', $authHeader, $userAgentHeader));
    $response = curl_exec($ch);
    $data = json_decode($response,true);
    echo "<pre>";
    var_dump($data);

    die();
    echo $data->login;
    echo "<br />";

    print_r("<pre>");
    var_dump($response);
    


    curl_close($ch);
