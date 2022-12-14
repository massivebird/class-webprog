<?php
if(count($_POST) > 0){
   require_once 'classes/noteHandler.php';
   $handler = new noteHandler();
   $output = $handler->addNote();
} else {
   $output = "";
}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Garrett - Assignment 9</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
   </head>
   <style>
* {
   font-family: 'Helvetica';
}
</style>
   <body>
      <div class="m-3">
         <h1><b>Add Note</b></h1>
   <?php echo $output; ?>
         <a href="index-list-notes.php" class="link-primary">Display Notes</a>
         <form action="index.php" method="post" enctype="multipart/form-data">
            <div class="form-group mt-3">
               <label for="fieldName">Date and Time</label>
         <input type="datetime-local" class="form-control" id="inputDateTime" name="inputDateTime">
            </div>
            <div class="form-group mt-3">
               <label for="noteInput">Note</label>
               <textarea style="height: 300px" id="inputNote" class="form-control" name="inputNote"></textarea>
            </div>
            <button type="submit" name="buttonPressed" value="submit" class="mt-3 btn btn-primary">Add Note</button>
         </form>
      </div>
   </body>
</html>
