<?php

$output = "";

if (isset($_POST['submitAndPrint']) and !empty($_POST['firstName'])) {
   $output = <<<HTML
   <p>Thanks for submitting the form,
   {$_POST['firstName']}!</p>
   HTML;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Garrett's Sandbox</title>
</head>
<style>
* {
   font-family: "Helvetica";
}
</style>
<body>
<h1>The form</h1>
<?php echo $output; // print_r($_POST['submitAndPrint']); ?>
<form action="index.php" method="post">
   <input type="text" name="firstName" id="firstName" placeholder="Enter your name here" />
   <br><br>
   <label> Show name 
      <input type="checkbox" name="submitAndPrint" id="submitAndPrint" value="submit" checked />
   </label>
   <br><br>
   <input type="submit" name="submitButton" id="submitButton" value="Submit form" />
</form>
<br>
<a href="index.php">Reset</a>
</body>
</html>
