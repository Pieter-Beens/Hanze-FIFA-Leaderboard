<title>Hanze FIFA Leaderboard - About</title>

<?php
$title = "ABOUT";
include('layouts/header.php');

/* session al ergens anders opgestart
session_start();   */
?>
<head>
  <link rel="stylesheet" type="text/css" href="layouts/style.css">
</head>

<body style=font-family:arial>

<h1 class="text">Welcome to the Hanze FIFA Leaderboard!</h1><hr>

<p class="text">Made by students for students, the Hanze FIFA Leaderboard allows Hanze students to find other FIFA players and see how they stack up!</p>
<p class="text">The process is simple: <a style=color:orange href="register.php">REGISTER</a> using your @st.hanze.nl account, and your chosen name will be added to the Leaderboard. Get a friend to sign up too, and you can start playing right away! After a game is done, one of you simply clicks <a style=color:orange href="results_add.php">ADD RESULT</a> and enters the match details. That match will be added to both of your profiles, and your Leaderboard Score will be updated automatically!</p>

<hr><h1 class="text">How does Leaderboard Score work?</h1><hr>
<p class="text">You gain a base Leaderboard Score of 2 for every victory. The more humiliating the victory, the more Score you will gain: 10-0 is worth significantly more points than 1-0.</p>
<p class="text">The number of points you gain is also affected by the opponent's Leaderboard Score! When it is lower than yours, your gains will be lower. If they have significantly more score than you, however, that's your chance to rack up some serious Leaderboard Score! Even drawing a stronger opponent can net you some points...</p>

<hr>

<h1 class="text">House Rules:</h1><hr>
<p class="text">> Be gracious in victory, humble in defeat.</p>
<p class="text">> Please do not post pornography, it will distract our code monkey Dannis from constantly repairing the header. Also, it will get you banned.</p>
<p class="text">> ???</p>
<p class="text">> PROFIT!!!</p>
<hr>

<h1 style=color:red;padding-left:20px>FAQs</h1><hr>
<p class="text" style=background-color:#ed3e00>Q: Cool. How do I sign up?<br></p>
<p class="text">A: Register <a style=color:orange href="register.php">HERE</a>. Note that to sign up, you must be a student of Hanze University and have access to your Hanze email account.</p>
<p class="text" style=background-color:#ed3e00>Q: Is it safe for me to use the same password I use for my Hanze account?<br></p>
<p class="text">A: Your password is not actually saved anywhere in our database, so, sort of. Anyone with minimal knowledge of IT security would tell you not to, but it's nice not to think too hard. We get it. You have our blessing.</p>
<p class="text" style=background-color:#ed3e00>Q: I registered! How do I start playing?<br></p>
<p class="text">A: You can play anytime, anywhere. Once you've played a match, select ADD RESULT from the menu and make your result public. For results to become official, you will need to enter both your own and your opponent's password!</p>
<p class="text" style=background-color:#ed3e00>Q: My opponent is a sore loser and he doesn't want to enter his password.<br></p>
<p class="text">A: When players cheat, or cause other trouble, you can give them a Yellow Card! You can only do this once per player, but if a second player does the same, it'll be a Red Card! A player with a Red Card will be investigated by moderators, which means they risk being banned.</p>
<p class="text" style=background-color:#ed3e00>Q: What version of the game am I supposed to play?<br></p>
<p class="text">A: That's up to you and your opponent! For all we care you play FIFA '94 on the Super Nintendo and enter those scores. It's just that it might be hard to find other players willing to play you in that particular game...</p>
<p class="text" style=background-color:#ed3e00>Q: I have more questions.<br></p>
<p class="text">A: The contact form is <a href=contact.php style=color:orange>RIGHT HERE</a>! We'll be happy to answer any question you might still have. Suggestions are also welcome!</p><hr>
<a href="layouts/images/Dannis.bmp">o</a>

<?php
include('layouts/footer.html');
?>
