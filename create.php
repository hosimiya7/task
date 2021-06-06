<?php
require_once("Task.php");
require_once("Request.php");

$request = new Request;
$category = $request->getPostedValue('category');
$date = $request->getPostedValue('date');
$content = $request->getPostedValue('content');


$create = new Task;
$create->create($category, $date, $content);

$order = $request->getPostedValue('order');

header("Location:index.php?order=$order");
