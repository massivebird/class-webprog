<?php

require_once("pages/routes.php");

session_start();
session_destroy();

header("Location: index.php");

?>
