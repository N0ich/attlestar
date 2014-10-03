<?php
function connect() {
	include_once $_SERVER['DOCUMENT_ROOT']."/attlestar/php/utils.php";
	$data = loadJson($_SERVER['DOCUMENT_ROOT'].'/config.json');

    try {
        $db = new PDO('mysql:host=localhost;dbname=' . $data['db'], $data['root'], $data['password']);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
    return ($db);
}
?>
