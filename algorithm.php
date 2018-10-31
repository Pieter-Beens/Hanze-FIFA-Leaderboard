<?php

$rate = 1; // can be changed to increase or decrease rate at which score changes

$win = 2;
$loss = -2;
$goaldif = $homegoals - $awaygoals;

if ($homegoals > $awaygoals) {$change = $win + (sqrt($goaldif)) * ($awayscore/$homescore);}
elseif ($homegoals < $awaygoals) {$change = $loss + (sqrt($goaldif)) * ($homescore/$awayscore);}
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

if ($newhomescore<25) $newhomescore = 25; // prevents player from going below 25 score, as very low and negative scores allow for exploits
if ($newawayscore<25) $newawayscore = 25;

?>
