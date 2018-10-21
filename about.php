<title>Hanze FIFA Leaderboard - About</title>

<?php

session_start();

$title = "ABOUT";

include ('layouts/header.php');
?>
<head>
  <link rel="stylesheet" type="text/css" href="layouts/style.css">
</head>

<h1 class="text">Welcome to the Hanze FIFA Leaderboard!</h1><hr>

<p class="text"><font size=4><b>Philosophy blabla.</b></font></p><br>

<p class="text">How does the scoring algorithm work?
Every game, the winner takes 2 points plus 1 additional points for the goal difference. So, 1-0 adds 3 points to your Leaderboard Score, 2-0 adds 4, and 2-1 again adds 3. Of course these point will have to come from somewhere: the loser will lose Leaderboard Score at the same rate.</p><br><br><br>

<p class="text"><font size=5><b><i>...however!</i></b></font></br><p><br>

<p class="text">Not all players are equal. Beating up on players with a low Leaderboard Score will not help you, as the number of points you earn is further affected by the difference between your Scores. A player at 150 Score who beats a player at 75 Score will only receive half the usual number of points. Conversely, the number of points the player at 75 Score would take by beating the player at 150 Score is doubled! That means the only way to climb to the top is to find high-ranking players and defeat them!</p><br><br><hr>

<h1 style=color:red;padding-left:20px>FAQs</h1><hr>
<p class="text"><b>Q: Cool. How do I sign up?</b><br></p>
<p class="text">A: Register here. Not that to sign up, you must be a student of Hanze University and have access to your Hanze email account.</p>
<br><br>
<p class="text"><b>Q: I registered! How do I start playing?</b><br></p>
<p class="text">: You can play anytime, anywhere. Once you've played a match, select ADD RESULTS from the menu and make your result public. For results to become official, you will need to enter both your own and your opponent's password!</p>
<br><br>
<p class="text"><b>Q: My opponent is a sore loser and he doesn't want to enter his password.</b><br></p>
<p class="text">A: When players cheat, or cause other trouble, you can give them a Yellow Card! You can only do this once per player, but if a second player does the same, it'll be a Red Card! A player with a Red Card will be investigated by moderators, which means they risk being banned.</p>
<br><br>
<p class="text"><b>Q: I have more questions.</b><br></p>
<p class="text">A: The contact form is <a href=contactform.php style=color:orange>right here</a>! We'll be happy to answer any question you might still have. Suggestions are also welcome!</p><hr>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<img src="layouts/images/Dannis.bmp">

<?php // add something about seasons
include ('layouts/footer.html');
?>
