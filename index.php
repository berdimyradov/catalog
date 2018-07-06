
<?php
//https://github.com/berdimyradov/catalog

require "CreateBase.php";
include "Classes.php";
$jsonData = file_get_contents('php://input');

$address = trim(mb_strtolower($_SERVER['REQUEST_URI']), '/');
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "POST") {
    $pr = new Product();
    $cat = new Category();
    switch ($address) {
        case 'products/insert':
            $pr->Insert($jsonData);
            break;
        case 'products/update':
            $pr->Update($jsonData);
            break;
        case 'products/delete':
            $pr->Delete($jsonData);
            break;
        case 'products/ListByCategory':
            $pr->ListByCategory($jsonData);
            break;
        case 'categories/insert':
            $cat->Insert($jsonData);
            break;
        case 'categories/update':
            $cat->Update($jsonData);
            break;
        case 'categories/delete':
            $cat->Delete($jsonData);
            break;
        case 'categories':
            $cat->ListAll($jsonData);
            break;
        // Everything else
        default:
            header('HTTP/1.0 404 Not Found');
            echo "404 Not Found";
            break;
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

?>

<form action="/" method="post">
Username: <input type="text" name="login" />
Password: <input type="password" name="password" />
<input type="submit" value="Login" name="log_in" />

</form>