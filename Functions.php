<?php
include 'Const.php';

function connectToDB()
{
    global $Host;
    global $Username;
    global $Password;
    global $DB_Name;
    $con = mysqli_connect($Host, $Username, $Password);
    mysqli_select_db($con, $DB_Name);
    return $con;
}

function CreateDB($host, $user, $pass, $DBName)
{
    $conn = mysqli_connect($host, $user, $pass);

    if (!$conn) {
        mysqli_close($conn);
        die('Server informations is not valid: ' . mysqli_error());
    }

    $sql = 'CREATE DATABASE IF NOT EXISTS ' . $DBName;
    mysqli_query($conn, $sql);
    mysqli_close($conn);
}

function InsertCategory($CategoryName)
{
    $conn = connectToDB();
    $command = "INSERT INTO Categories (Cat_Name) VALUES ('$CategoryName')";
    $res = mysqli_query($conn, $command);
    mysqli_close($conn);
    if ($res) {
        return json_encode(array("Cat_Name:" => $CategoryName));
    } else {
        return json_encode(array("Error:" => "SQL Syntax Error"));
    }

}

function UpdateCategory($Cat_ID, $Category_Name)
{
    $conn = connectToDB();
    $command = "UPDATE categories SET Cat_Name = '$Category_Name' WHERE Cat_ID = $Cat_ID";
    $res = mysqli_query($conn, $command);
    mysqli_close($conn);
    if ($res) {
        return json_encode(array("Updated:" => $Cat_ID));
    }
    ;
}

function DeleteCategory($Cat_ID)
{
    $conn = connectToDB();
    $command = "DELETE FROM categories WHERE Cat_ID = $Cat_ID";
    $res = mysqli_query($conn, $command);
    mysqli_close($conn);
    if ($res) {
        return json_encode(array("Deleted:" => $Cat_ID));
    }
    ;
}

function getCategoryList()
{
    $conn = connectToDB();
    $command = "SELECT * FROM Categories";
    $query = mysqli_query($conn, $command);
    $res = array();
    while ($row = mysqli_fetch_array($query)) {
        $row_array["Cat_ID"] = $row['Cat_ID'];
        $row_array["Cat_Name"] = $row['Cat_Name'];
        array_push($res, $row_array);
    }
    mysqli_close($conn);
    return json_encode($res);
}

function ProductsByCategory($Cat_ID)
{
    $conn = connectToDB();
    $command = "SELECT * FROM ProductCategoryBridge WHERE Cat_ID=$Cat_ID";
    $query = mysqli_query($conn, $command);
    $res = array();
    while ($row = mysqli_fetch_array($query)) {
        $row_array["Product_ID"] = $row['Product_ID'];
        array_push($res, $row_array);
    }

    $result = array();
    foreach ($res as $value) {
        $Pr_ID = $value["Product_ID"];
        $command = "SELECT * FROM Products WHERE Product_ID=$Pr_ID";
        $query = mysqli_query($conn, $command);
        $row = mysqli_fetch_array($query);
        $row_array["Product_ID"] = $row['Product_ID'];
        $row_array["Product_Name"] = $row['Product_Name'];
        array_push($result, $row_array);
    }
    mysqli_close($conn);
    return json_encode($result);
}

function InsertProduct($ProductName, $Cat_IDs)
{ //Insert into Products Table
    $conn = connectToDB();
    $command = "INSERT INTO Products (Product_Name) VALUES ('$ProductName')";
    mysqli_query($conn, $command);
// Get Product ID added last
    $command = "SELECT * FROM Products WHERE Product_Name='$ProductName'";
    $query = mysqli_query($conn, $command);
    $row = mysqli_fetch_array($query);
    $Product_ID = $row["Product_ID"];
//Insert Category ID-s into Bridge Table
    //$Cat_IDs -------> it is array
    $results = array();
    foreach ($Cat_IDs as $catid) {
        $command = "INSERT INTO ProductCategoryBridge (Product_ID, Cat_ID) VALUES ('$Product_ID', '$catid')";
        if (!$res = mysqli_query($conn, $command)) {
            $row_array["Result"] = "Not added:" . $catid;
        } else {
            $row_array["Result"] = "Added:" . $catid;
        }
        array_push($results, $row_array);
    }
    mysqli_close($conn);
    return json_encode($results);
}

function UpdateProduct($Product_ID, $ProductName, $Cat_IDs)
{ //Updating Products Table
    $conn = connectToDB();
    $command = "UPDATE Products SET Product_Name = '$ProductName' WHERE Product_ID = $Product_ID";
    mysqli_query($conn, $command);
//Deleting All Product_ID from Bridge table
    $command = "DELETE FROM ProductCategoryBridge WHERE Product_ID = $Product_ID";
    mysqli_query($conn, $command);

//Adding
    //$Cat_IDs -------> it is array
    $results = array();
    foreach ($Cat_IDs as $catid) {
        $command = "INSERT INTO ProductCategoryBridge (Product_ID, Cat_ID) VALUES ('$Product_ID', '$catid')";
        if (!$res = mysqli_query($conn, $command)) {
            $row_array["Result"] = "Not updated: " . $catid;
        } else {
            $row_array["Result"] = "Updated:" . $catid;
        }
        array_push($results, $row_array);
    }
    mysqli_close($conn);
    return json_encode($results);
}

function DeleteProduct($Product_ID)
{
    $conn = connectToDB();
    $command = "DELETE FROM Products WHERE Product_ID = $Product_ID";
    mysqli_query($conn, $command);
    mysqli_close($conn);
    return json_encode(array("Deleted:" => $Product_ID));
}
