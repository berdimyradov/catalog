<?php

//include "Functions.php";

// @todo:KerimJobs - class Product ayratyn faylda bolsun 
class Product
{

    public function Insert($jsonData)
    {
        $json_arr = json_decode($jsonData);
        // "Categories": "[1,2,3,4]"
        $cat = $json_arr->Categories;
        $cat = str_replace("[", "", $cat);
        $cat = str_replace("]", "", $cat);
        $categories = explode(",", $cat);
        echo InsertProduct($json_arr->ProductName, $categories);
    }

    public function Update($jsonData)
    {
        $json_arr = json_decode($jsonData);
        $cat = $json_arr->Categories;
        $cat = str_replace("[", "", $cat);
        $cat = str_replace("]", "", $cat);
        $categories = explode(",", $cat);
        echo UpdateProduct($json_arr->Product_ID, $json_arr->ProductName, $categories);
    }

    public function Delete($jsonData)
    {
        $json_arr = json_decode($jsonData);
        echo DeleteProduct($json_arr->Product_ID);
    }

    public function ListByCategory($jsonData)
    {
        $json_arr = json_decode($jsonData);
        echo ProductsByCategory($json_arr->Cat_ID);
    }
}

// @todo:KerimJobs - class Category ayratyn faylda bolsun 
class Category
{
    public function Insert($jsonData)
    {
        $json_arr = json_decode($jsonData);
        echo InsertCategory($json_arr->Category_Name);
    }

    public function Update($jsonData)
    {
        $json_arr = json_decode($jsonData);
        echo UpdateCategory($json_arr->Cat_ID, $json_arr->Category_Name);
    }

    public function Delete($jsonData)
    {
        $json_arr = json_decode($jsonData);
        echo DeleteCategory($json_arr->Cat_ID);
    }

    public function ListAll()
    {
        echo getCategoryList();
    }
}
