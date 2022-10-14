<?php

class AddNamesProc {

   // "First Last" -> "Last, First"
   private function nameFormatter($name_original) {
      // if no spaces are found...
      if (substr_count($name_original, " ") == 0) {
         // ... return original string
         return $name_original;
      }

      // "Jesse McCartney II" -> ["Jesse", "McCartney", "II"]
      $name_array = explode(" ", $name_original);

      $name_formatted = "";
      // concats all names BUT first name in order
      for ($i = 1; $i < count($name_array); $i++) {
         $name_formatted .= $name_array[$i]." ";
      }

      // replaces trailing space with first name
      $name_formatted = preg_replace("/\ $/", ", ".$name_array[0], $name_formatted);

      return $name_formatted;
   }

   public function addClearNames() {

      // if all are true:
      //    1. A new name is being entered
      //    2. A button was pressed
      //    3. That button was "Add Name"
      if (isset($_POST['nameInput']) and
         (isset($_POST['buttonPressed'])) and
         ($_POST['buttonPressed'] === "add" )) {
         // separate all names into array as individual elements
         $names_arr = explode("\n", $_POST['namelist']);
         // format new name to be inserted
         $name_new = self::nameFormatter($_POST['nameInput']);
         // insert new name into array of names
         array_push($names_arr, $name_new);
         // sort array of names (case insensitive)
         natcasesort($names_arr);
         // return all names separated by a newline
         return implode("\n", $names_arr);
      }

   }
}

?>
