<?php
require_once('pages/routes.php');
/* echo session_status(); */
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Garrett's Final</title>
      <meta charset="UTF-8">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
   </head>
   <style>
* {
   font-family: 'Helvetica';
}
.nav-link {
   padding-left: 0;
}
</style>
   <body class="container">
      <?php
      echo $nav;
      echo $result["notice"];
      echo $result["content"];
      ?>
   </body>
</html>
