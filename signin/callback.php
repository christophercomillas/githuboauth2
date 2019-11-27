<?php
    $code = $_GET['code'];
    if($code == "")
    {
        header('Location: http://lvh.me/GithubOAuth2/');
        exit();
    }
    $CLIENT_ID = "7026cfd9463f46df2135";
    $CLIENT_SECRET = "a8d996502ee0c0aa5b45ad093105008d1b3b80f8";
    $URL = "https://github.com/login/oauth/access_token"; 
    $postParams = [
        'client_id'     => $CLIENT_ID,
        'client_secret' => $CLIENT_SECRET,
        'code'          => $code
    ];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $URL);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postParams);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Accept: application/json',
        'X-OAuth-Scopes: repo, user',
        'X-Accepted-OAuth-Scopes: user'
    ));
    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response);

    //echo $data['access_token'];
    if($data->access_token !="")
    {
        session_start();
        $_SESSION['access_token'] = $data->access_token;
        header('Location: http://lvh.me/GithubOAuth2/');
        exit();
    }

