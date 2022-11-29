<?php
require_once('pages/routes.php');
require_once('classes/Validation.php');
$obj = new Validation();
$obj->checkFormat($_POST['inputEmail'], "email");
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Login - Garrett's Final</title>
      <meta charset="UTF-8">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
   </head>
   <style>
* {
   font-family: 'Helvetica';
}
</style>
   <body>
      <div class="m-3">
<?php  ?>
         <h1><b>Login</b></h1>
         <form action="index.php" method="post" enctype="multipart/form-data">
            <div class="form-group mt-3">
               <label for="fieldName">Email</label>
         <input type="text" class="form-control" id="inputEmail" name="inputEmail">
            </div>
            <div class="form-group mt-3">
               <label for="fieldName">Password</label>
         <input type="password" class="form-control" id="inputPassword" name="inputPassword">
            </div>
            <button type="submit" name="buttonPressed" value="submit" class="mt-3 btn btn-primary">Login</button>
         </form>
      </div>
   </body>
</html>
