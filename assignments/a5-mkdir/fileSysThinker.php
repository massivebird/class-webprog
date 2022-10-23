<?php

class fileSysThinker {

   private function errorAlreadyExists($path) {
      return "<p class=\"text-warning\">A directory already exists with that name: <code class=\"text-warning\">$path</code></p>";
   }

   private function errorEmptyField() {
      return "<p class=\"text-warning\">Please enter data in both fields.</p>";
   }

   private function successCreated($path) {
      return "<p>File and directory were created</p>\n<a href=\"$path\" class=\"text-primary\">$path</a>";
   }

   // text-primary is blue

   public function main() {
      // if all are true:
      //    1. A folder name was inputted
      //    2. File contents were inputted
      //    3. Submit button was pressed
      if (isset($_POST['folderName']) and
         (isset($_POST['fileContents'])) and
         ($_POST['buttonPressed'] === "submit" )) {
         // if one of fields is empty
         if (!strlen($_POST['folderName']) or
            (!strlen($_POST['fileContents']))) {
            // throw error
            return self::errorEmptyField();
         }
         $folderName = "./".$_POST['folderName']."/";
         $fileName = "README.txt";
         $fileContents = $_POST['fileContents'];
         $fullPath = $folderName.$fileName;
         // if directory already exists
         if (file_exists($folderName)) {
            // inform user
            return self::errorAlreadyExists($folderName);
         }
         mkdir($_POST['folderName'], 0755, true);
         touch($fullPath);
         file_put_contents($fullPath, $fileContents."\n");
         return self::successCreated($fullPath);
      }
      return;
   }
}

?>
