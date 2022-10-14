<?php
if(count($_POST) > 0){
   require_once 'addNameProc.php';
   $addName = new AddNamesProc();
   $output = $addName->addClearNames();
} else {
   $output = "";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Garrett - Assignment 4</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<style>
* {
   font-family: 'Helvetica';
}
</style>
<body>
<div class="m-3">

<h1><b>Add Names</b></h1>
<form action="index.php" method="post">
<button type="submit" name="buttonPressed" value="add" class="btn btn-primary">Add Name</button>
<button type="submit" name="buttonPressed" value="reset" class="btn btn-primary">Clear Names</button>
<div class="form-group">
   <label for="fieldName">Enter Name</label>
   <input type="text" class="form-control" id="nameInput" name="nameInput" placeholder="Enter name here">
</div>
<label for="namesDisplay">List of Names</label>
<textarea style="height: 500px;" class="form-control"
id="namelist" name="namelist"><?php echo $output ?></textarea>

</div>
</form>
</div>
</body>
</html>
