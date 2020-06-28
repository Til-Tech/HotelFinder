<?php

$previous = $_SERVER["HTTP_REFERER"];
/*In $previous wird die URL der letzten Seite auf der sich der User befand gespeichert mit Hilfe der Superglobalen $_SERVER.*/
session_start();
session_unset();
session_destroy();
header("Location:../index.php");
/*Um den User auszuloggen wird zunächst die aktuelle Session mit session_start() fortgesetzt, dann werden mit session_unset() alle Session Variablen
  gelöscht (also userEmail und userID die beim login initialisiert werden) und danach werden nochmal alle mit der Session in Verbindung stehende Daten
  gelöscht mit session_destroy().*/
?>
