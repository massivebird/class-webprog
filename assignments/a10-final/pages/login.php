<?php
function init() {

$output =<<<HTML
   <div class="m-3">
<?php  ?>
      <h1><b>Login</b></h1>
      <form action="index.php" method="post" enctype="multipart/form-data">
         <div class="form-group mt-3">
            <label for="fieldName">Email</label>
      <input type="text" class="form-control" id="inputEmail" name="inputEmail" value="gadrake@admin.com">
         </div>
         <div class="form-group mt-3">
            <label for="fieldName">Password</label>
      <input type="password" class="form-control" id="inputPassword" name="inputPassword" value="password">
         </div>
         <button type="submit" name="buttonPressed" value="submit" class="mt-3 btn btn-primary">Login</button>
      </form>
   </div>
HTML;

   return ["notice"=>"", "content"=>$output];

}
?>
