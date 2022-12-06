<?php

// controls all routing, bringing in content
// of other pages

// suppress "session already started" notice
// (hopefully temporary)
error_reporting(E_ALL & ~E_NOTICE);
// inherit session data
session_start();

// redirect to login page if user is not logged in
if (empty($_SESSION) && $_GET['page'] != "login") {
   header("Location: index.php?page=login");
}

$path = "index.php?page=login";

$nav=<<<HTML
<nav>
<ul class="nav">
<li class="nav-item"><a class="nav-link" href="index.php?page=addContact">Add Contact(s)</a></li>
<li class="nav-item"><a class="nav-link" href="index.php?page=deleteContacts">Delete Contact(s)</a></li>
HTML;

if (isset($_SESSION['status']) && $_SESSION['status'] === "admin") {
   $nav.=<<<HTML
<li class="nav-item"><a class="nav-link" href="index.php?page=addAdmin">Add Admin(s)</a></li>
<li class="nav-item"><a class="nav-link" href="index.php?page=deleteAdmins">Delete Admin(s)</a></li>
HTML;
}

// terminating nav tags
$nav .= <<<HTML
<li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
</ul>
</nav>
HTML;

if (isset($_GET)) {

   if ($_GET['page'] === "addContact") {
      require_once('pages/addContact.php');
      $result = init();
      return;
   }

   elseif ($_GET['page'] === "deleteContacts") {
      require_once('pages/deleteContacts.php');
      $result = init();
      return;
   }

   elseif ($_GET['page'] === "welcome") {
      require_once('pages/welcome.php');
      $result = init();
      return;
   }

   elseif (isset($_SESSION['status']) && $_SESSION['status'] === "admin" && $_GET['page'] === "addAdmin") {
      require_once('pages/addAdmin.php');
      $result = init();
      return;
   }

   elseif (isset($_SESSION['status']) && $_SESSION['status'] === "admin" && $_GET['page'] === "deleteAdmins") {
      require_once('pages/deleteAdmins.php');
      $result = init();
      return;
   }

   elseif ($_GET['page'] === "login") {
      require_once('pages/login.php');
      // no nav
      $nav = "";
      // page:
      // login form
      $result = init();
      return;
   }

}

// if $_GET is not set, default to login page
require_once('pages/login.php');
header('location: '.$path);
return;

?>
