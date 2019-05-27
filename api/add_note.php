<?php

include "Database.php";

$note = null;
$addr = null;
if(isset($_GET['addr']))
    $addr = $_GET['addr'];
if(isset($_GET['note']))
    $note = $_GET['note'];

if(is_null($note) || is_null($addr))
    die("error");
$db = connect();
$db->query("INSERT INTO notes(added, title, contents, done) VALUES ('{$addr}', 'null', '{$note}', 0)");
echo "ok";