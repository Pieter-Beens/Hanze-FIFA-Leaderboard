<?php

$score = $_POST["score"];
$opponentscore = $_POST["opponentscore"];

$for = $_POST["yourgoals"];
$against = $_POST["opponentgoals"];

echo "starting score: $score<br/>";
echo "score of opponent: $opponentscore<br/>";

$rate = 1; // can be changed to increase or decrease rate at which score changes

$win = 2;
$loss = -2;

If ($for >= $against) {
	$winloss = $win;
} Else {
	$winloss = $loss;
};

If ($for == $against) {
	If ($score < $opponentscore) {
		$change = (1 * $rate) * ($opponentscore / $score);
	} Elseif ($score > $opponentscore) {
		$change = -(1 * $rate) * ($score / $opponentscore);
	} Else {
		$change = 0;
	};
} Else {
	$change = (($for - $against) + $winloss) * ($opponentscore / $score);
};

$absscore = $score + $change;
echo "new score with absolute gains: $absscore<br/>";
$perscore = $score * ($change/100 + 1);
echo "new score with percentage gains: $perscore";

?>
