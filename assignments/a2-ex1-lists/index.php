<?php
$ul_main = [1,2,3,4,5];
$ul_sub = [1,2,3,4,5];

$the_html = "<ul>";
for ($i = 0; $i < count($ul_main); $i++) {
  $the_html .= "<li>$ul_main[$i]<ul>";
  for ($j = 0; $j < count($ul_sub); $j++) {
    $the_html .= "<li>$ul_sub[$j]</li>";
  }
  $the_html .= "</ul></li>";
}
$the_html .= "</ul>";
?>
<!DOCTYPE html>
<head>
   <title>YES</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<html>
   <body>
      <?php echo $the_html; ?>
   </body>
</html>
