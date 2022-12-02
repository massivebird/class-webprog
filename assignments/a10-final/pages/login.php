<?php
function init() {

   $notice = "";

   // if user pressed "Login"
   if (isset($_POST['buttonPressed']) && $_POST['buttonPressed'] === "submit") {

      // if user provided email, password
      if (!empty($_POST['inputEmail']) && !empty($_POST['inputPassword'])) {

         // if password is good
         if (password_verify($_POST['inputPassword'], password_hash("password", PASSWORD_DEFAULT))) {
            $notice = "password ".$_POST['inputPassword']." is good!";
         } else $notice = "password ".$_POST['inputPassword']." bad";

      }
      // if user omitted email/password
      else {
         $notice = "Please enter an email and password.";
      }

   }

   $output =<<<HTML
      <div class="m-3">
         <h1><b>Login</b></h1>
         <form action="index.php?page=login" method="post">
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

   return ["notice"=>$notice, "content"=>$output];

}
?>
