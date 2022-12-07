<?php

/* HERE I REQUIRE AND USE THE STICKYFORM CLASS THAT DOES ALL THE VALIDATION AND CREATES THE STICKY FORM.  THE STICKY FORM CLASS USES THE VALIDATION CLASS TO DO THE VALIDATION WORK.*/
require_once('classes/StickyForm.php');
$stickyForm = new StickyForm();

/*THE INIT FUNCTION IS WRITTEN TO START EVERYTHING OFF IT IS CALLED FROM THE INDEX.PHP PAGE */
function init(){
   global $elementsArr, $stickyForm;

   /* IF THE FORM WAS SUBMITTED DO THE FOLLOWING  */

   if(isset($_POST['login'])) {

   $postArr = $stickyForm->validateForm($_POST, $elementsArr);

   /* print_r($postArr); */

   if($postArr['masterStatus']['status'] == "error"){
      echo "there are errors here";
      return getForm("", $postArr);
   }

      // if user provided email, password
      if (!empty($_POST['email']) && !empty($_POST['password'])) {

         echo "BOTH INPUTS";

         require_once 'classes/Pdo_methods.php';

         // if user does not have an account
         if (!hasAnAccount()) {

            echo "HAS ACCOUNT";

            return getForm("User does not have an account", $elementsArr);
         }

         if (isCorrectCredentials()) {

            /* echo "CORRECT CREDS"; */

            // let's log in!
            // start a session
            session_start();
            // insert relevant session data
            $_SESSION['name'] = getUsersName();
            $_SESSION['status'] = getStatus();
            // redirect to welcome page
            header("Location: index.php?page=welcome");

         } else getForm("Login failed: incorrect credentials.", $elementsArr);

      }
      /* THE ELEMENTS ARRAY HAS A MASTER STATUS AREA. IF THERE ARE ANY ERRORS FOUND THE STATUS IS CHANGED TO "ERRORS" FROM THE DEFAULT OF "NOERRORS".  DEPENDING ON WHAT IS RETURNED DEPENDS ON WHAT HAPPENS NEXT.  IN THIS CASE THE RETURN MESSAGE HAS "NO ERRORS" SO WE HAVE NO PROBLEMS WITH OUR VALIDATION AND WE CAN SUBMIT THE FORM */
      echo "MID";
      if($postArr['masterStatus']['status'] == "noerrors"){

         /*addData() IS THE METHOD TO CALL TO ADD THE FORM INFORMATION TO THE DATABASE (NOT WRITTEN IN THIS EXAMPLE) THEN WE CALL THE GETFORM METHOD WHICH RETURNS AND ACKNOWLEDGEMENT AND THE ORGINAL ARRAY (NOT MODIFIED). THE ACKNOWLEDGEMENT IS THE FIRST PARAMETER THE ELEMENTS ARRAY IS THE ELEMENTS ARRAY WE CREATE (AGAIN SEE BELOW) */
         return addData($_POST);

      }
      else{
         /* IF THERE WAS A PROBLEM WITH THE FORM VALIDATION THEN THE MODIFIED ARRAY ($postArr) WILL BE SENT AS THE SECOND PARAMETER.  THIS MODIFIED ARRAY IS THE SAME AS THE ELEMENTS ARRAY BUT ERROR MESSAGES AND VALUES HAVE BEEN ADDED TO DISPLAY ERRORS AND MAKE IT STICKY */
         return getForm("",$postArr);
      }

   }

   /* THIS CREATES THE FORM BASED ON THE ORIGINAL ARRAY THIS IS CALLED WHEN THE PAGE FIRST LOADS BEFORE A FORM HAS BEEN SUBMITTED */
   else {
      return getForm("", $elementsArr);
   } 
}

/* THIS IS THE DATA OF THE FORM.  IT IS A MULTI-DIMENTIONAL ASSOCIATIVE ARRAY THAT IS USED TO CONTAIN FORM DATA AND ERROR MESSAGES.   EACH SUB ARRAY IS NAMED BASED UPON WHAT FORM FIELD IT IS ATTACHED TO. FOR EXAMPLE, "NAME" GOES TO THE TEXT FIELDS WITH THE NAME ATTRIBUTE THAT HAS THE VALUE OF "NAME". NOTICE THE TYPE IS "TEXT" FOR TEXT FIELD.  DEPENDING ON WHAT HAPPENS THIS ASSOCIATE ARRAY IS UPDATED.*/

$elementsArr = [
   "masterStatus"=>[
      "status"=>"noerrors",
      "type"=>"masterStatus"
   ],
   "email"=>[
      "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Please enter a valid email address</span>",
      "errorOutput"=>"",
      "type"=>"text",
      "value"=>"gadrake@admin.com",
      "regex"=>"email"
   ],
   "password"=>[
      "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Please enter a password</span>",
      "errorOutput"=>"",
      "type"=>"password",
      "value"=>"password"
   ]
];

/*THIS FUNCTION CAN BE CALLED TO ADD DATA TO THE DATABASE */
function addData($post) {

   global $elementsArr;  
   /* IF EVERYTHING WORKS ADD THE DATA HERE TO THE DATABASE HERE USING THE $_POST SUPER GLOBAL ARRAY */
   /* print_r($_POST); */
   require_once('classes/Pdo_methods.php');

   /* print_r($elementsArr); */

   $pdo = new PdoMethods();

   $bindings = [
      [':email',$post['email'],'str'],
      [':password',$post['password'],'str'],
   ];

}


/*THIS IS THEGET FROM FUCTION WHICH WILL BUILD THE FORM BASED UPON UPON THE (UNMODIFIED OF MODIFIED) ELEMENTS ARRAY. */
function getForm($acknowledgement, $elementsArr){

   /* THIS IS A HEREDOC STRING WHICH CREATES THE FORM AND ADD THE APPROPRIATE VALUES AND ERROR MESSAGES */
   $form = <<<HTML
   <h1 class="mt-3"><b>Login</b></h1>
   <form method="post" action="index.php?page=login">

   <div class="form-group mt-3">
   <label for="email">Email address{$elementsArr['email']['errorOutput']}</label>
   <input type="text" class="form-control" id="email" name="email" value="{$elementsArr['email']['value']}" >
   </div>

   <div class="form-group mt-3">
   <label for="password">Password</label>
   <input type="password" class="form-control" id="password" name="password" value="password" >
   </div>

   <div>
   <button type="login" name="login" class="btn btn-primary mt-3">Login</button>
   </div>
   </form>

   HTML;

   /* HERE I RETURN AN ARRAY THAT CONTAINS AN ACKNOWLEDGEMENT AND THE FORM.  THIS IS DISPLAYED ON THE INDEX PAGE. */
   return ["notice"=>$acknowledgement, "content"=>$form];

}

function hasAnAccount() {

   $pdo = new PdoMethods();

   $bindings = [
      [':email', $_POST['email'], 'str'],
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
      [':email', $_POST['email'], 'str'],
   ];

   $hashedPasswordOnFile = $pdo->selectBinded("SELECT password FROM admins WHERE email = :email", $bindings);

   if (password_verify($_POST['password'], $hashedPasswordOnFile[0]['password'])) {
      return true;
   }
   return 0;
}

function getStatus() {

   $pdo = new PdoMethods();

   $bindings = [
      [':email', $_POST['email'], 'str'],
   ];

   $queryResults = $pdo->selectBinded("SELECT status FROM admins WHERE email = :email", $bindings);

   $status = $queryResults[0]['status'];

   return $status;

}

function intoArray($notice, $content) {
   return ["notice"=>$notice, "content"=>$content];
}

function getUsersName() {

   $pdo = new PdoMethods();

   $bindings = [
      [':email', $_POST['email'], 'str'],
   ];

   $queryResults = $pdo->selectBinded("SELECT name FROM admins WHERE email = :email", $bindings);

   $name = $queryResults[0]['name'];

   return $name;

}

?>
