<?php

session_start();

if (!isset($_SESSION['user']) and !isset($_SESSION['rol'])) {
    header("Location: ../Fronted/login.php");
}

/*
session_destroy();
*/