<?php
if(count($_POST) > 0){
   require_once 'fileSysThinker.php';
   $fileCreator = new fileSysThinker();
   $output = $fileCreator->main();
} else {
   $output = "";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Garrett - Assignment 5</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<style>
* {
   font-family: 'Helvetica';
}
</style>
<body>
<div class="m-3">
<h1><b>File and Directory Assignment</b></h1>
<p>Enter a folder name and the contents of a file. Folder names should contain alpha numeric characters only</p>
<p><?php echo $output; ?></p>
<form action="index.php" method="post">
   <div class="form-group mb-3">
      <label for="fieldName">Folder Name</label>
      <input type="text" class="form-control" id="folderName" name="folderName">
   </div>
   <label for="namesDisplay">File Content</label>
   <textarea style="height: 150px;" class="form-control mb-3"
      id="fileContents" name="fileContents"></textarea>
   <button type="submit" name="buttonPressed" value="submit" class="btn btn-primary">Submit</button>
   </div>
</form>
</div>
</body>
</html>
