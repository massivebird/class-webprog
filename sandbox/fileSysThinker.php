<?php

class fileSysThinker {

   private function text_error($dir_path) {
      return "<p class=\"text-warning\">A directory already exists with that name: <code class=\"text-warning\">./$dir_path</code></p>";
   }

   private function text_success($dir_path) {
      return "<p>File and directory were created</p>\n<a class=\"text-primary\">$dir_path</a>";
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
         // if directory already exists
         if (file_exists($_POST['folderName'])) {
            // inform user
            return self::text_error($_POST['folderName']);
         }
         // if mkdir fails
         mkdir("/home/g/a/gadrake/test", 0755, true);
      }
      return;
   }
}

?>
