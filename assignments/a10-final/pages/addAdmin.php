<?php

/* HERE I REQUIRE AND USE THE STICKYFORM CLASS THAT DOES ALL THE VALIDATION AND CREATES THE STICKY FORM.  THE STICKY FORM CLASS USES THE VALIDATION CLASS TO DO THE VALIDATION WORK.*/
require_once('classes/StickyForm.php');
$stickyForm = new StickyForm();

/*THE INIT FUNCTION IS WRITTEN TO START EVERYTHING OFF IT IS CALLED FROM THE INDEX.PHP PAGE */
function init(){
   global $elementsArr, $stickyForm;

   /* IF THE FORM WAS SUBMITTED DO THE FOLLOWING  */
   if(isset($_POST['submit'])){

      /*THIS METHODS TAKE THE POST ARRAY AND THE ELEMENTS ARRAY (SEE BELOW) AND PASSES THEM TO THE VALIDATION FORM METHOD OF THE STICKY FORM CLASS.  IT UPDATES THE ELEMENTS ARRAY AND RETURNS IT, THIS IS STORED IN THE $postArr VARIABLE */

      $postArr = $stickyForm->validateForm($_POST, $elementsArr);

      /* THE ELEMENTS ARRAY HAS A MASTER STATUS AREA. IF THERE ARE ANY ERRORS FOUND THE STATUS IS CHANGED TO "ERRORS" FROM THE DEFAULT OF "NOERRORS".  DEPENDING ON WHAT IS RETURNED DEPENDS ON WHAT HAPPENS NEXT.  IN THIS CASE THE RETURN MESSAGE HAS "NO ERRORS" SO WE HAVE NO PROBLEMS WITH OUR VALIDATION AND WE CAN SUBMIT THE FORM */

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
   "name"=>[
      "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Please enter a valid name</span>",
      "errorOutput"=>"",
      "type"=>"text",
      "value"=>"Garrett",
      "regex"=>"name"
   ],
   "status"=>[
      "type"=>"select",
      "options"=>["staff"=>"Staff","admin"=>"Admin"],
      "selected"=>"staff",
   ],
   "email"=>[
      "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Please enter a valid email</span>",
      "errorOutput"=>"",
      "type"=>"text",
      "value"=>"gadrake@admin.com",
      "regex"=>"email"
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

   $sql = "INSERT INTO admins (name, email, password, status) VALUES (:name, :email, :password, :status)";

   $bindings = [
      [':email',$post['email'],'str'],
      [':name',$post['name'],'str'],
      [':password',password_hash($post['password'], PASSWORD_DEFAULT),'str'],
      [':status',$post['status'],'str'],
   ];

   // error if a user already exists with inputted email
   if (!empty($pdo->selectBinded("SELECT id FROM admins WHERE email = :email", array($bindings[0])))) {
      return getForm("<p>A user already exists with that email.</p>", $elementsArr);
   }

   $result = $pdo->otherBinded($sql, $bindings);

   if($result == "error"){
      return getForm("<p>There was a problem processing your form</p>", $elementsArr);
   }
   else {
      return getForm("<p>Contact Information Added</p>", $elementsArr);
   }

}


/*THIS IS THEGET FROM FUCTION WHICH WILL BUILD THE FORM BASED UPON UPON THE (UNMODIFIED OF MODIFIED) ELEMENTS ARRAY. */
function getForm($acknowledgement, $elementsArr){

   global $stickyForm;
   $options = $stickyForm->createOptions($elementsArr['status']);

   /* THIS IS A HEREDOC STRING WHICH CREATES THE FORM AND ADD THE APPROPRIATE VALUES AND ERROR MESSAGES */
   $form = <<<HTML
   <h1><b>Add Admin(s)</b></h1>
   <form method="post" action="index.php?page=addAdmin">

   <div class="form-group">
   <label for="name">Name (letters only){$elementsArr['name']['errorOutput']}</label>
   <input type="text" class="form-control" id="name" name="name" value="{$elementsArr['name']['value']}" >
   </div>

   <div class="form-group mt-3">
   <label for="email">Email address{$elementsArr['email']['errorOutput']}</label>
   <input type="text" class="form-control" id="email" name="email" value="{$elementsArr['email']['value']}" >
   </div>

   <div class="form-group mt-3">
   <label for="password">Password</label>
   <input type="password" class="form-control" id="password" name="password" value="password" >
   </div>

   <div class="form-group mt-3">
   <label for="status">Status</label>
   <select class="form-control" id="status" name="status">
   $options
   </select>
   </div>

   <div>
   <button type="submit" name="submit" class="btn btn-primary mt-3">Submit</button>
   </div>
   </form>

   HTML;

   /* HERE I RETURN AN ARRAY THAT CONTAINS AN ACKNOWLEDGEMENT AND THE FORM.  THIS IS DISPLAYED ON THE INDEX PAGE. */
   return ["notice"=>$acknowledgement, "content"=>$form];

}

?>
