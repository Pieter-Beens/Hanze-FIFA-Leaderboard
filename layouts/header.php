<!-- head -->
<head>
    <link rel="stylesheet" type="text/css" href="layouts/style.css">
    <title>FIFA Leaderboard</title>
</head>

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



<!-- body -->
<body>

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
                        <a style="color: red" href=profile.php?user=<?php echo escape($user->data()->id).">". escape($user->data()->name); ?></a>
                        <a href="logout.php">Logout</a>
                    <?php
                  }

                else {
                    $is_admin = false;
                    ?>
                        <a style="color: green" href=profile.php?user=<?php echo escape($user->data()->id).">". escape($user->data()->name); ?></a>
                        <a href="logout.php">Logout</a>
                    <?php
                }

            }

            else {
                $is_admin = false;
                echo '<a href="login.php">Login</a><a href="register.php">Register</a>';
            }

            ?>
        </div>
        <?php if (isset($_SESSION['id'])) {
            echo "<div class=button>";
            echo "<a href=profile.php?user=" . $_SESSION['id'] . ">MY PROFILE</a></div>";
        } ?>
        <!-- right div mobile-->
        <div onclick="test();"><img class="dropdownButton" src="layouts/images/button_dropdown.jpg"></div>
    </div>
</div>

<!-- menu mobile -->
<div class="mobile-menu" id="mobile-menu">
    <a href="leaderboard.php">LEADERBOARD</a>
    <?php
    if ($user->isLoggedIn()) {
      ?>
      <a href=results_add.php>ADD RESULT</a>
      <a href=#idk>AWARD CARD</a>
      <?php
        if ($user->hasPermission('admin')) {
            ?>
                <a href=contact_view.php>VIEW CONTACT FORMS</a>
                <a style="color: red" href=profile.php?user=<?php echo escape($user->data()->id).">". escape($user->data()->name); ?></a>
                <a href="logout.php">Logout</a>
            <?php
          }

        else {
            ?>
                <a href=contact.php>CONTACT</a>
                <a style="color: green" href=profile.php?user=<?php echo escape($user->data()->id).">". escape($user->data()->name); ?></a>
                <a href="logout.php">LOGOUT</a>
            <?php
        }

    }

    else {
        echo '<a href="login.php">Login</a><a href="register.php">Register</a>';
    }
    ?>
        <a href="about.php">ABOUT</a>
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
        <?php if ($user->isLoggedIn())
        echo "<a href=results_add.php>ADD RESULT</a><a href=#idk>AWARD CARD</a>";
        if ($is_admin == false) {
            echo "<a href=contact.php>CONTACT</a>";
        } else {
            echo "<a href=contact_view.php>VIEW CONTACT FORMS</a>";
        }
        ?>
        <a href="about.php">ABOUT</a>
    </div>
</div>
<!-- einde header -->
</body>
