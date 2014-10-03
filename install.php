<?php
include_once $_SERVER['DOCUMENT_ROOT']."/attlestar/php/utils.php";
$data = loadJson($_SERVER['DOCUMENT_ROOT'].'/config.json');
$host=$data['host'];
$root=$data['root'];
$root_password=$data['password'];
$db=$data['db'];
try {
    print("-> creating database " . $db . "... <br />");
    $dbh = new PDO("mysql:host=$host", $root, $root_password);
    $dbh->exec("CREATE DATABASE `$db`") or die(print_r($dbh->errorInfo(), true));
    print("-> database " . $db . " created !<br /><br />");
    print("-> importing data..<br />");
    $req = file_get_contents ("./rush02db.sql");
    $dbh = new PDO("mysql:host=$host;dbname=" . $db, $root, $root_password);
    $dbh->exec($req);
    print("-> data imported !<br />");
} catch (PDOException $e) {
    die("DB ERROR: ". $e->getMessage());
}

?>