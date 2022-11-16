<?php

class Date_time {

   private function msgError($msg) {
      return "<p class=\"text-danger\">$msg</p>";
   }

   private function msgSuccess($msg) {
      return "<p class=\"text-primary\">$msg</p>";
   }

   public function checkSubmit() {
      // validates:
      // (1) A file was uploaded
      // (2) Button was pressed
      if (isset($_FILES['fileInput'])
         and (!empty($_POST['nameInput']))
         and ($_POST['buttonPressed'] === "upload" )) {

      }
   }
}

?>
