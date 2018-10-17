<?php

$rate = 1; // can be changed to increase or decrease rate at which score changes

$win = 2;
$loss = -2;
$goaldif = $homegoals - $awaygoals;
if ($goaldif>5) $goaldif = 5;
if ($goaldif<-5) $goaldif = -5;

if ($homegoals > $awaygoals) {$change = $win + ($goaldif) * ($awayscore/$homescore);}
elseif ($homegoals < $awaygoals) {$change = $loss + ($goaldif) * ($homescore/$awayscore);}
else { // points earned for draws
  If ($homescore < $awayscore) {
    $change = (1 * $rate) * ($awayscore / $homescore);
  } Elseif ($homescore > $awayscore) {
    $change = -(1 * $rate) * ($homescore / $awayscore);
  } Else {
    $change = 0;
  };
}

$newhomescore = $homescore + $change;
$newawayscore = $awayscore - $change;

?>
