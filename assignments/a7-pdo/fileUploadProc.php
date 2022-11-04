<?php

class fileUploadProc {

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
            return "it's good";
         }
      }
      return "";
   }
}

?>
