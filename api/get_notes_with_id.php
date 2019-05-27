<?php

include "Database.php";

$id = null;
if(isset($_GET['id']))
    $id = $_GET['id'];

if(is_null($id))
    die("error");
$db = connect();
$res = $db->query("SELECT * FROM notes WHERE added = '$id'");
echo json_encode($res->fetch_all(MYSQLI_ASSOC));