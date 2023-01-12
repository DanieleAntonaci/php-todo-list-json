<?php
	
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Headers: X-Requested-With");

echo file_get_contents("todo.json", true);