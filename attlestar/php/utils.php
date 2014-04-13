<?php

function genArray($lower1, $upper1, $lower2, $upper2) {
	return (array( 'x' => mt_rand($lower1, $upper1), 'y' =>  mt_rand($lower2, $upper2) ));
}

function loadJson($json) {
    if (preg_match("/^.*(\.json)$/", $json))
        return json_decode(file_get_contents($json), True);
    return null;
}

?>