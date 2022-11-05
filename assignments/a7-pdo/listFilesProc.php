<?php

class listFilesProc {

   private function listItem($text) {
      return "<li><a target='_blank' href='./files/$text'>$text</a></li>";
   }

   public function listTheFiles() {

      // start list
      $output = "<ul>";

      // list of files
      $files = scandir("./files/");

      // iterate through files
      // EXCEPT . and ..
      for ($i = 3; $i < count($files); $i++) {
         $output .= self::listItem($files[$i]);
      }

      // terminate list
      $output .= "</ul>";

      return $output;

   }

}

?>
