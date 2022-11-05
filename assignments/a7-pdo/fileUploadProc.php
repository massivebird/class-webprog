<?php

class fileUploadProc {

   private function returnError($msg) {
      return "<p class=\"text-danger\">$msg</p>";
   }

   private function returnSuccess($msg) {
      return "<p class=\"text-primary\">$msg</p>";
   }

   public function uploadTheFile() {
      // if all are true:
      // (1) A file was uploaded
      // (2) Button was pressed
      if (isset($_FILES['fileInput'])
         and (strlen($_POST['nameInput']))
         and ($_POST['buttonPressed'] === "upload" )) {
         // file has been uploaded,
         // let's validate that:
         // (1) MIME type is PDF
         // (2) size is < 100000 bytes
         if (($_FILES['fileInput']['type'] === "application/pdf")
            and ($_FILES['fileInput']['size'] < 100000)) {

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
               return self::returnError("A file already exists with the name ".$_POST['nameInput'].".");
            }

            $result = $pdo->otherBinded($sql, $bindings);

            if ($result === 'error') {
               return self::returnError("There was an error adding the file");
            }

            move_uploaded_file($_FILES['fileInput']['tmp_name'], "./files/".$_POST['nameInput'].".pdf");
            return self::returnSuccess("File successfully added");
         }
      }
   }
}

?>
