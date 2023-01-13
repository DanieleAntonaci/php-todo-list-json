<?php

header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: application/json');

$taskStatus = $_GET['taskStatus'];
$position = $_GET['position'];
$element = $_GET['element'];

if($taskStatus == 'false'){
    $boolaenValue = false;
}
else{
    $boolaenValue = true;
}

$jsonTodoList = file_get_contents("todo.json", true);
$todoList = json_decode($jsonTodoList);

$todoList[$position] = [
    "text" => $element,
    "completed" => $boolaenValue
];

$jsonTodoList = json_encode($todoList);
file_put_contents('todo.json', $jsonTodoList);