<!-- head -->
<head>
    <link rel="stylesheet" type="text/css" href="layouts/style.css">
    <title>FIFA Leaderboard</title>
</head>

<!-- body -->
<body style=color:white;font-family:FIFA16>

<!-- header div -->
<div class="header">
    <a href="./"><img class="hanzeLogo" src="layouts/images/headerlogo.png"></a>

    <!-- right div desktop -->
    <div class="headerRightDiv">
        <div class="button">
            <?php
            require_once 'core/init.php';

            $user = new User;
            if ($user->isLoggedIn()) {
                if ($user->hasPermission('admin')) {
                    $is_admin = true;
                    ?>
                        <a style="color: red" href=profile.php?user=<?php echo escape($user->data()->id).">".escape($user->data()->name); ?></a>
                        <a href="logout.php">Logout</a></div>
                    <?php
                } else {
                    $is_admin = false;
                    ?>
                        <a style="color: green" href=profile.php?user=<?php echo escape($user->data()->id).">".escape($user->data()->name); ?></a>
                        <a href="logout.php">Logout</a></div>
                    <?php
                }

            } else {
                $is_admin = false;
                echo '<a href="login.php">Login</a> or <a href="register.php">Register</a>';
            }
            ?>

            <!--            <a href="temp/sessiontest.php">-->
            <!--                --><?php
            //                include_once("fifadbconn.php");
            //                //session_start();
            //                //$_SESSION["is_admin"] = false;
            //                $is_admin = false;
            //
            //                if (isset($_SESSION['name'])) {
            //
            //                    // Check of user admin is
            //                    $query = "SELECT roles_id FROM users WHERE name= '" . $_SESSION['name'] . "'";
            //                    $query_result = mysqli_query($db, $query) or die("ERROR: Can't Connect to database");
            //                    $queryrow = mysqli_fetch_assoc($query_result);
            //                    mysqli_close($db);
            //
            //                    if ($queryrow[roles_id] == 2) {
            //                        $is_admin = true;
            //                        echo "<div style=\"color: red\">" . $_SESSION['name'] . "</div>";
            //
            //                    } else {
            //                        echo $_SESSION['name'];
            //                    }
            //
            //                } else {
            //                    echo "LOGIN";
            //                }
            //
            //                ?>
            <!--            </a>-->
        </div>
        <?php if (isset($_SESSION['id'])) {
            echo "<div class=button>";
            echo "<a href=profile.php?user=" . $_SESSION['id'] . ">MY PROFILE</a></div>";
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
    <?php if ($user->isLoggedIn()) {
      echo "<a href=profile.php?user=" .escape($user->data()->id). ">My Profile</a>
      <a href=addresultsform.php>Add Result</a>
      <a href=#idk>Award Card</a>";
    }
    if ($is_admin == false) {
        echo "<a href=contact.php>Contact</a>";
    } else {
        echo "<a href=contact_view.php>View Contact Forms</a>";
    }
    ?>
    <a href="about.php">About</a>
    <a href="login.php">Login</a>
</div>

<!-- ruimte tussen menu -->
<div class="blueBanner"><?php
    if (isset($title)) {
        echo $title;
    } else {
        echo "titel";
    }
    ?></div>

<!-- menu div -->

<div class="menuWrapper">
    <div class="button">
        <a href="leaderboard.php">LEADERBOARD</a>
        <?php if ($user->isLoggedIn()) echo "
          <a href=addresultsform.php>ADD RESULT</a>
          <a href=#idk>AWARD CARD</a>";
        if ($is_admin == false) {
            echo "<a href=contact.php>CONTACT</a>";
        } else {
            echo "<a href=contact_view.php>VIEW CONTACT FORMS</a>";
        }
        ?>
        <a href="about.php">ABOUT</a>
        <!--a href="#idk">Log Out</a-->
    </div>
</div>
<!-- einde header -->
</body>
