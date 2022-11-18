<?php

class noteHandler {

   private function msgError($msg) {
      return "<p class=\"text-danger\">$msg</p>";
   }

   private function msgSuccess($msg) {
      return "<p class=\"text-primary\">$msg</p>";
   }

   public function addNote() {
      // validates:
      // (1) Date/time was inputted
      // (2) Note was inputted
      // (3) Button was pressed
      if (!empty($_POST['inputDateTime'])
         and (!empty($_POST['inputNote']))
         and ($_POST['buttonPressed'] === "submit" )) {

         require_once 'Pdo_methods.php';
         $pdo = new PdoMethods();

         $bindings = [
            [':timestamp', $_POST['inputDateTime'], 'str'],
            [':note', $_POST['inputNote'], 'str'],
         ];

         // error if already exists a note with the same timestamp
         /* print_r( $pdo->selectBinded("SELECT timestamp FROM a9sesh WHERE timestamp = :timestamp", [$bindings[0]])); */
         if (!empty($pdo->selectBinded("SELECT timestamp FROM a9sesh WHERE timestamp = :timestamp", [$bindings[0]]))) {
            return self::msgError("A note already exists with that timestamp.");
         }

         $pdo->otherBinded("INSERT INTO a9sesh (timestamp, note) VALUES (:timestamp, :note)", $bindings);

         return self::msgSuccess("Note inputted!");

      }

      return self::msgError("Please enter a date/time and note.");

   }

   public function listNotes() {
      // validates:
      // (1) Beginning date was inputted
      // (2) Ending date was inputted
      // (3) Button was pressed
      if (!empty($_POST['inputDateBeg'])
         and (!empty($_POST['inputDateEnd']))
         and ($_POST['buttonPressed'] === "submit" )) {

         require_once 'Pdo_methods.php';
         $pdo = new PdoMethods();

         $bindings = [
            [':dateBeg', $_POST['inputDateBeg'], 'str'],
            [':dateEnd', $_POST['inputDateEnd'], 'str'],
         ];

         $records = $pdo->selectBinded("SELECT timestamp, note FROM a9sesh WHERE timestamp BETWEEN :dateBeg AND :dateEnd ORDER BY timestamp DESC", $bindings);

         // error if there are no records to display
         if (empty($records)) {
            return self::msgError("No records exist in that date range.");
         }

         $output = '<table class="table table-bordered rounded table-striped"><thead><tr><th scope="col">Date and Time</th><th scope="col">Note</th></tr></thead>';

         foreach ($records as $record) {
            $output .= "<tr><td>" . date_format(date_create($record['timestamp']), "m/d/Y h:i a") . "</td><td>" . $record['note'] . "</td></tr>";
         }

         $output .= "</table>";

         return $output;

      }
   }

}

?>
