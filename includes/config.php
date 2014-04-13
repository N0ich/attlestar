<?php
	function	connect() {
		try {
			$db = new PDO('mysql:host=localhost;dbname=rush2', "root", "qwertyus");
		} catch (PDOException $e) {
			print "Erreur !: " . $e->getMessage() . "<br/>";
			die();
		}
		return ($db);
	}
?>
