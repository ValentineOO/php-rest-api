<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$category = new Category($db);

// Category read query
$result = $category->read();

//Get row count
$num = $result->rowCount();

//Check if any categories
if ($num > 0) {
    //Category array
    $cat_arr = array();
    $cat_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $cat_item = array(
            'id' => $title,
            'name' => $name,
        );

        //Push to 'data'
        array_push($cat_arr['data'], $cat_item);
    }
    echo json_encode($cat_arr);
} else {
    //No No Category
    echo json_encode(
        array('message' => 'no Categories found')
    );
}
