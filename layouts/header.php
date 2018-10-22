<!-- head -->
<head>
  <link rel="stylesheet" type="text/css" href="layouts/style.css">
  <title>FIFA Leaderboard</title>
</head>

<!-- body -->
<body style=color:white;font-family:FIFA16>

<!-- header div -->
<div class="header">
	<a href="./"><img class="hanzeLogo" src="layouts/images/logo.png"></a>

	<!-- right div desktop -->
	<div class="headerRightDiv">
		<div class="button">
    		<a href="temp/sessiontest.php"><?php if (isset($_SESSION['name'])) {echo $_SESSION['name'];} else {echo "LOGIN";} ?></a>
    </div>
<?php if (isset($_SESSION['id'])) {
echo "<div class=button>";
echo "<a href=profile.php?user=".$_SESSION['id'].">MY PROFILE</a></div>";
} ?>
		<!-- right div mobile-->
		<div onclick="test();"><img class="dropdownButton" src="layouts/images/button_dropdown.jpg"></div>
	</div>
</div>

<script>
var dropdown = false;
function test() {
    if (dropdown == false) {
        document.getElementById("mobile-menu").style.display = "inline-block";
        dropdown = true;
    } else {
        document.getElementById("mobile-menu").style.display = "none";
        dropdown = false;
	}
}

window.onresize = dropdownCheck;

function dropdownCheck() {
    if (window.innerWidth > 800) {
        document.getElementById("mobile-menu").style.display = "none";
	} else if (dropdown == true) {
        document.getElementById("mobile-menu").style.display = "inline-block";
    }

}

</script>

<!-- menu mobile -->
<div class="mobile-menu" id="mobile-menu">
	<a href="leaderboard.php">Leaderboard</a>
	<a href="addresultsform.php">Add Result</a>
	<a href="#idk">Award Card</a>
	<a href="#idk">Contact</a>
	<a href="about.php">About</a>
	<a href="profile.php?user=<?php echo $_SESSION['id'] ?>">My Profile</a>
	<a href="temp/sessiontest.php">Login</a>
</div>

<!-- ruimte tussen menu -->
<div class="blueBanner"><?php
 if (isset($title)){
 	echo $title;
 } else {
 	echo "titel";
 }
?></div>

<!-- menu div -->

<div class="menuWrapper">
	<div class="button">
		<a href="leaderboard.php">LEADERBOARD</a>
		<a href="addresultsform.php">ADD RESULT</a>
		<a href="#idk">AWARD CARD</a>
		<a href="contact.php">CONTACT</a>
		<a href="about.php">ABOUT</a>
		<!--a href="#idk">Log Out</a-->
	</div>
</div>
<!-- einde header -->
</body>
