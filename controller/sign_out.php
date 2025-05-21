<?php
require_once("../functions/functions.php");
session_start();

session_unset();
header("Location:../index.php?id=".GetScreenIndex("home"));
?>