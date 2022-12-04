<?php
function init() {

   $content =<<<HTML
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

   $notice = "";

   // if user pressed "Login"
   if (isset($_POST['buttonPressed']) && $_POST['buttonPressed'] === "submit") {

      // if user provided email, password
      if (!empty($_POST['inputEmail']) && !empty($_POST['inputPassword'])) {

         require_once 'classes/Pdo_methods.php';

         // if user does not have an account
         if (!hasAnAccount()) {
            return intoArray("User does not have an account", $content);
         }

         // if password is good
         if (isCorrectCredentials()) {

            // let's log in!
            // start a session
            session_start();
            // insert relevant session data
            $_SESSION['name'] = getUsersName();
            $_SESSION['status'] = getStatus();
            // redirect to welcome page
            header("Location: index.php?page=welcome");

         } else $notice = "Login failed: incorrect credentials.";

      }
      // if user omitted email/password
      else {
         $notice = "Please enter an email and password.";
      }

   }

   return intoArray($notice, $content);

}

function intoArray($notice, $content) {
   return ["notice"=>$notice, "content"=>$content];
}

function getStatus() {

   $pdo = new PdoMethods();

   $bindings = [
      [':email', $_POST['inputEmail'], 'str'],
   ];

   $queryResults = $pdo->selectBinded("SELECT status FROM admins WHERE email = :email", $bindings);

   $status = $queryResults[0]['status'];

   return $status;

}

function getUsersName() {

   $pdo = new PdoMethods();

   $bindings = [
      [':email', $_POST['inputEmail'], 'str'],
   ];

   $queryResults = $pdo->selectBinded("SELECT name FROM admins WHERE email = :email", $bindings);

   $name = $queryResults[0]['name'];

   return $name;

}

function hasAnAccount() {

   $pdo = new PdoMethods();

   $bindings = [
      [':email', $_POST['inputEmail'], 'str'],
   ];

   // if user does have an account
   if (!empty($pdo->selectBinded("SELECT id FROM admins WHERE email = :email", $bindings))) {
      return true;
   }
   return false;

}

function isCorrectCredentials() {

   $pdo = new PdoMethods();

   $bindings = [
      [':email', $_POST['inputEmail'], 'str'],
   ];

   $hashedPasswordOnFile = $pdo->selectBinded("SELECT password FROM admins WHERE email = :email", $bindings);

   if (password_verify($_POST['inputPassword'], $hashedPasswordOnFile[0]['password'])) {
      return true;
   }
   return 0;
}

?>
