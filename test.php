<?php

$now = new DateTime();
echo $now->format('d/m/Y g:i A');
echo "<br/>";
$now->setTimezone(new DateTimeZone('America/Managua'));
echo $now->format('Y-m-d H:i:s');

?>