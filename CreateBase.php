<?php

include "Const.php";
include "Functions.php";

CreateDB($Host, $Username, $Password, $DB_Name); // Functions.php -> Line:15

$connection = new mysqli($Host, $Username, $Password, $DB_Name);

if ($connection->connect_errno > 0) {
    die("<b>MySQL Connection Failed!:</b> " . $connection->connect_error);
}

//Creating "Users" Table

$command = "CREATE TABLE IF NOT EXISTS Users (
`User_ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
`Name` VARCHAR(50) NOT NULL ,
`Password` VARCHAR(20) NOT NULL)";

$query = $connection->query($command);

if ($connection->errno > 0) {
    die("<b>MySQL query error:</b> " . $connection->error);
}

// Creating "Products" Table.

$command = "CREATE TABLE IF NOT EXISTS Products (
`Product_ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
`Product_Name` VARCHAR(50) NOT NULL ,
INDEX `prid` (`Product_ID`)) ENGINE = InnoDB";

$query = $connection->query($command);

if ($connection->errno > 0) {
    die("<b>MySQL query error:</b> " . $connection->error);
}

// Creating "Categories" Table.

$command = "CREATE TABLE IF NOT EXISTS Categories (
`Cat_ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
`Cat_Name` VARCHAR(30) NOT NULL ,
INDEX `katid` (`Cat_ID`)) ENGINE = InnoDB";

$query = $connection->query($command);

if ($connection->errno > 0) {
    die("<b>MySQL query error:</b> " . $connection->error);
}

// Creating "Bridge" Table.

$command = "CREATE TABLE IF NOT EXISTS ProductCategoryBridge (
    `ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `Product_ID` INT NOT NULL,
    `Cat_ID` INT NOT NULL,
    INDEX `katid` (`Cat_ID`), INDEX `pid` (`Product_ID`),
    CONSTRAINT `ProductCategoryBridge_Product_fk`
        FOREIGN KEY `ProductID_fk` (`Product_ID`) REFERENCES `Products` (`Product_ID`)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `ProductCategoryBridge_Category_fk`
        FOREIGN KEY `CategoryID_fk` (`Cat_ID`) REFERENCES `Categories` (`Cat_ID`)
        ON DELETE CASCADE ON UPDATE CASCADE
        ) ENGINE = InnoDB";

$query = $connection->query($command);

if ($connection->errno > 0) {
    die("<b>MySQL query error:</b> " . $connection->error);
}

$connection->close();
