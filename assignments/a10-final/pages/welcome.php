<?php

function init(){

   // inherit session data
   session_start();

   $notice = "";

   $name = $_SESSION['name'];

   $content = "<h1><b>Welcome</b></h1><p>Welcome, ".$name."!</p>";

   return ["notice"=>$notice, "content"=>$content];
}

?>
