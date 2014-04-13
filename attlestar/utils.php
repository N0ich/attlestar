<?php

function genArray($lower1, $upper1, $lower2, $upper2) {
    return (array( 'x' => mt_rand($lower1, $upper1), 'y' =>  mt_rand($lower2, $upper2) ));
}


?>
