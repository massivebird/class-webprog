<?php
if(count($_POST) > 0){
   require_once 'fileUploadProc.php';
   $uploadThis = new fileUploadProc();
   $output = $uploadThis->uploadTheFile();
} else {
   $output = "";
}
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
         <h1><b>File Upload</b></h1>
<?php echo $output; ?>
         <a href="index-list.php" class="link-primary">Show File List</a>
         <form action="index.php" method="post" enctype="multipart/form-data">
            <div class="form-group mt-3">
               <label for="fieldName">File Name</label>
               <input type="text" class="form-control mb-3" id="nameInput" name="nameInput" placeholder="Enter file name here">
            </div>
            <input type="file" name="fileInput" >
            <br>
            <button type="submit" name="buttonPressed" value="upload" class="btn btn-primary mt-3">Upload File</button>
         </form>
      </div>
   </body>
</html>
