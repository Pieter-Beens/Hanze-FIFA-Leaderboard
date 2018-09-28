<?php

function berekenopp (){
	$lengte = rand(0,30);
	$breedte = rand(0,20);
	$opp = $lengte * $breedte;
	
	Echo "de lengte was: $lengte, de breedte was: $breedte" . '<br/>';
	Echo "de oppervlakte is $opp" . '<br/>';
};
berekenopp();

?>