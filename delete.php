<?php
require_once("Task.php");
require_once("Request.php");

$request = new Request;
$id = $request->getPostedValue('id');

$delete = new Task;
$delete->delete($id);

$order = $request->getPostedValue('order');

header("Location:index.php?order=$order");
