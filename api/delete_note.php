<?php

include "Database.php";

$id = null;
if(isset($_GET['id']))
    $id = $_GET['id'];

if(is_null($id))
    die("error");
$db = connect();
$db->query("DELETE FROM notes WHERE contents = '$id'");
echo "ok";
