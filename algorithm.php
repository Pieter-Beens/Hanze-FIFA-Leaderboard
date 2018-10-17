<?php

$rate = 1; // can be changed to increase or decrease rate at which score changes

$win = 2;
$loss = -2;

If ($homegoals >= $awaygoals) { // did player win or lose?
  $winloss = $win;
} Else {
  $winloss = $loss;
};

If ($homegoals == $awaygoals) { // points earned for draws
  If ($homescore < $awayscore) {
    $change = (1 * $rate) * ($awayscore / $homescore);
  } Elseif ($homescore > $awayscore) {
    $change = -(1 * $rate) * ($homescore / $awayscore);
  } Else {
    $change = 0;
  };
} Else {
  $change = (($homegoals - $awaygoals) + $winloss) * ($awayscore / $homescore); // points earned = goal difference + win/loss
};

$newhomescore = $homescore + $change;
$newawayscore = $awayscore - $change;

?>
