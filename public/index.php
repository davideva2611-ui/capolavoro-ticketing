<?php
require_once("../includes/auth.php");

if (utente_loggato() === true) {
    header("Location: dashboard.php");
    exit();
}

header("Location: login.php");
exit();
?>