<?php
    header("Content-type: text/css; charset: UTF-8");
    header("Cache-Control: must-revalidate");
    $days_to_cache = 10;
	header('Expires: '.gmdate('D, d M Y H:i:s',time() + (60 * 60 * 24 * $days_to_cache)).' GMT');
    $bodyColor = "red";
?>

body {
  background-color: <?php echo $bodyColor; ?>!important;
}
