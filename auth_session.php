<?php

// Set sessions
if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION["name"])) {
    header("Location: index.php");
    exit;
}
