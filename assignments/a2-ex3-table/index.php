<?php
$rows = 15;
$cols = 5;

$the_html = '<table border="2px solid black">';
for ($i = 1; $i <= $rows; $i++) {
  $the_html .= "<tr>";
  for ($j = 1; $j <= $cols; $j++) {
    $the_html .= "<td>Row $i Cell $j</td>";
  }
  $the_html .= "</tr>";
}
$the_html .= "</table>";

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Garrett's Big Table</title>
</head>
<body>
  <?php echo $the_html; ?>
</body>
</html>
