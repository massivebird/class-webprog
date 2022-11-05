<?php

class fileUploadProc {

   private function msgError($msg) {
      return "<p class=\"text-danger\">$msg</p>";
   }

   private function msgSuccess($msg) {
      return "<p class=\"text-primary\">$msg</p>";
   }

   public function uploadTheFile() {
      // validates:
      // (1) A file was uploaded
      // (2) Button was pressed
      if (isset($_FILES['fileInput'])
         and (!empty($_POST['nameInput']))
         and ($_POST['buttonPressed'] === "upload" )) {

         // validates MIME type is pdf
         if ($_FILES['fileInput']['type'] !== "application/pdf") {
            return self::msgError("Please upload a PDF file with a size of less than 100 KB.");
         }

         // validates file size is less than 100 KB
         if ($_FILES['fileInput']['size'] >= 100000) {
            return self::msgError("Your PDF file is not less than 100 KB in size.");
         }

         require_once 'Pdo_methods.php';

         $pdo = new PdoMethods();
         // sql statement

         $sql = "INSERT INTO a7pdo (name, path) VALUES (:name, :path)";
         // binding to variables

         $bindings = [
            [':name', $_POST['nameInput'], 'str'],
            [':path', "./files/".$_POST['nameInput'].".pdf", 'str']
         ];

         $sqlCheckName = "SELECT name FROM a7pdo WHERE name = :name";

         // error if filename already exists
         if (!empty($pdo->selectBinded($sqlCheckName, [$bindings[0]]))) {
            return self::msgError("A file already exists with the name ".$_POST['nameInput'].".");
         }

         $result = $pdo->otherBinded($sql, $bindings);

         if ($result === 'error') {
            return self::msgError("There was an error adding the file");
         }

         move_uploaded_file($_FILES['fileInput']['tmp_name'], "./files/".$_POST['nameInput'].".pdf");
         return self::msgSuccess("File successfully added");
      }
   }
}

?>
