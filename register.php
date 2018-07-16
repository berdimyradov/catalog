<?php
$username = $_POST["username"];
$password = $_POST["password"];
$bearer = $_SERVER['HTTP_AUTHORIZATION'];
$bearer = explode(' ', $bearer);
if (isset($bearer[1])) {
    $decoded = JWT::decode($bearer[1], $authKey, array('RS256'));
    $decoded_array = (array) $decoded;
    if (mb_strtolower($username) === mb_strtolower($decoded_array["Username"])
        && $password === $decoded_array["Password"]) {
        if (userExists($username, $password)) {
            $error = array();
            $error["error"] = "Username already exists";
            die(json_encode($error));
        } else {
            registerUser($username, $password);
            $userInfo = getUser($username, $password);
            echo json_encode($userInfo);
        }

    } else { $error = array();
        $error['error'] = "It is not this user's token.";
        echo json_encode($error);
    }

} else
if (!userExists($username, $password)) {
    $now = strtotime(date('Y-m-d H:i:s'));
    $exp = date('Y-m-d H:i:s', $now + $jwtExp);
    $token = array();
    $token["Token"] = maketoken($username, $password, $exp);
    die(json_encode($token));
} else {
    $error = array();
    $error["error"] = "Username already exists";
    die(json_encode($error));
}
