<?php

// controls all routing, bringing in content
// of other pages

$path = "index.php?page=login";

$nav=<<<HTML
<nav>
<ul class="nav">
<li class="nav-item"><a class="nav-link" href="index.php?page=welcome">Welcome</a></li>
<li class="nav-item"><a class="nav-link" href="index.php?page=addContact">Add Contact Information</a></li>
<li class="nav-item"><a class="nav-link" href="index.php?page=deleteContacts">Delete contact(s)</a></li>
<li class="nav-item"><a class="nav-link" href="index.php?page=login">Logout</a></li>
</ul>
</nav>
HTML;

function type() {
   echo "<h1>YES</h1>";
}

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
