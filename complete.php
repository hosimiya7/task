<?php
require_once("Task.php");
require_once("Request.php");

$request = new Request;
$id = $request->getPostedValue('id');

$complete = new Task;
$complete->complete($id);

$is_done = $request->getPostedValue('is_done');
$category = $request->getPostedValue('category');
$order = $request->getPostedValue('order');

header("Location:index.php?is_done=$is_done&category=$category&order=$order");
