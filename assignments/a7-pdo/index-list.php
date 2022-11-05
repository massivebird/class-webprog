<?php
require_once 'listFilesProc.php';
$listThis = new listFilesProc();
$output = $listThis->listTheFiles();
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Garrett - Assignment 7</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
   </head>
   <style>
* {
   font-family: 'Helvetica';
}
</style>
   <body>
      <div class="m-3">
         <h1><b>List Files</b></h1>
         <a href="index.php" class="link-primary mb-3">Add File</a>
<br>
         <?php echo $output; ?>
      </div>
   </body>
</html>
