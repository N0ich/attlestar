<?php
	function	connect() {
		try {
			$db = new PDO('mysql:host=localhost;dbname=rush02', "root", "eeghu9lu");
		} catch (PDOException $e) {
			print "Erreur !: " . $e->getMessage() . "<br/>";
			die();
		}
		return ($db);
	}
?>
