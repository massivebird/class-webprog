<?php
if(count($_POST) > 0){
   require_once 'classes/noteHandler.php';
   $handler = new noteHandler();
   $output = $handler->listNotes();
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
         <h1><b>Display Notes</b></h1>
         <a href="index.php" class="link-primary">Add Note</a>
         <form action="index-list-notes.php" method="post" enctype="multipart/form-data">
            <div class="form-group mt-3">
               <label for="begDate">Beginning Date</label>
               <input type="date" class="mb-3 form-control" id="begDate" name="inputDateBeg">
               <label for="endDate">Ending Date</label>
               <input type="date" class="form-control" id="endDate" name="inputDateEnd">
            </div>
            <button type="submit" name="buttonPressed" value="submit" class="mt-3 mb-3 btn btn-primary">Get Notes</button>
         </form>
         <?php echo $output; ?>
      </div>
   </body>
</html>
