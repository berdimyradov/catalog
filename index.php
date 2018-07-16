
<?php
//https://github.com/berdimyradov/catalog
//$token = JWT::decode('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjEyMzQ1In0.2fKNoVpPxwEdh1-_8GKN7zGO5f8u1HXKdsBlMasJlFM', $authKey);
//echo $token->id;

require "CreateBase.php";
include "Classes.php";
$jsonData = file_get_contents('php://input');

$address = trim(mb_strtolower($_SERVER['REQUEST_URI']), '/');
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "POST") {
    $pr = new Product();
    $cat = new Category();
    switch ($address) {
        case 'login':
            require 'login.php';
            die();
        case 'register':
            require "register.php";
            die();
        case 'products/insert':
            $pr->Insert($jsonData);
            die();
        case 'products/update':
            $pr->Update($jsonData);
            die();
        case 'products/delete':
            $pr->Delete($jsonData);
            die();
        case 'products/ListByCategory':
            $pr->ListByCategory($jsonData);
            die();
        case 'categories/insert':
            $cat->Insert($jsonData);
            die();
        case 'categories/update':
            $cat->Update($jsonData);
            die();
        case 'categories/delete':
            $cat->Delete($jsonData);
            die();
        case 'categories':
            $cat->ListAll($jsonData);
            die();
        // Everything else
        default:
            header('HTTP/1.0 404 Not Found');
            die("404 Not Found");
    }
} else
if ($method == "GET") {
    switch ($address) {
        case '':
            break;
        default:
            header('HTTP/1.0 404 Not Found');
            die('404 not Found');
    }
}
//$n = strtotime(date('Y-m-d H:i:s'));
//$now = date('Y-m-d H:i:s', $n + $jwtExp);
//echo maketoken('kerim', '5555', $now);
//$decoded = JWT::decode('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJVc2VybmFtZSI6ImtlcmltIiwiUGFzc3dvcmQiOiI1NTU1IiwiZXhwIjoiMjAxOC0wNy0xNiAwNToxNzo1NCJ9.5RVF3Ye0x3zxn40xyzoPZ_m2edYQ5_3a1rb4pjtU76k', 'berkgulp', array('RS256'));
//$decoded_array = (array) $decoded;
//echo "Decode:\n" . print_r($decoded_array, true) . "\n";
?>


<form action="/login" method="post">
Username: <input type="text" name="username" /> <br>
Password: <input type="password" name="password" /> <br>
<input type="submit" value="Login" name="log_in" />
</form>

<form action="/register" method="post">
<input type="submit" value="Register" name="register" />
</form>