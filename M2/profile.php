<?php
require(__DIR__ . "/partials/nav.php");

echo "<h2>Profile</h2>";

if (is_logged_in()) {
    echo $_SESSION["user"]["email"];
} else {
    echo "You're not logged in";
}
?>