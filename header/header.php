<?php

function display_header() {
	echo "
	<!-- head -->
<head>
  <link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\">
  <title>FIFA Leaderboard</title>
</head>

<!-- body -->
<body>

<!-- header div -->
<div class=\"header\">
	<a href=\"/\"><img class=\"hanzeLogo\" src=\"logo.png\"></a>
	
	<!-- right div desktop -->
	<div class=\"headerRightDiv\">
		<div class=\"button\">
		<a href=\"#idk\">Nederlands</a></div>

		<!-- Oude code: style=\"float:right;margin-right:10px;position:relative;top:auto;\"-->
		<div class=\"button\">
		<a href=\"#idk\">My Profile</a></div>
	
		<!-- right div mobile-->
		<a href=\"/\"><img class=\"dropdownButton\" src=\"images/button_dropdown.jpg\"></a>
	</div>
</div>
<!-- ruimte tussen menu -->

<div class=\"blueBanner\">Fifa Leaderboard!</div>

<!-- menu div -->

<div class=\"menuWrapper\">
	<div class=\"button\">
		<a href=\"#idk\">Leaderboard</a>
		<a href=\"#idk\">Add Match</a>
		<a href=\"#idk\">Award Card</a>
		<a href=\"#idk\">Contact</a>
		<a href=\"#idk\">About</a>
		<!--a href=\"#idk\">Log Out</a-->
	</div>
</div>
<!-- einde header -->


<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<!-- footer -->

<script>
// Mobile check
if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {

    }
</script>

<!--footer>
<img style=\"height:auto; width: 100%; float:left;\" src=\"logo_hanze.png\">
  Pieter Beens 347070 Dani&#235;l Windstra 312072, Djurre Aikema 349740, Dennis Smid 384910, Hayo Riem 390552 <br>&copy; Copyright 2018, Hanze Hogeschool
</footer-->
</body>
";
}

?>