<?php
//Lokal:
$db_server ="localhost";
$user = "root";
$pass ="";
$name = "hotelfinder";
//Server:
/*
$db_server ="localhost";
$user = "phpmyadmin";
$pass ="raspberry@01";
$name = "hotelfinder";
/*Um eine Verbindung zur Datenbank herstellen zu können, werden zunächst die Parameter, welche man dazu benötigt in Variablen definiert.*/

$conn = mysqli_connect($db_server, $user, $pass, $name);

/*Funktion "mysqli_connect()" öffnet eine neue Verbindung zu eine MySQL Datenbankserver. Als Parameter werden die Server Daten die zum Verbinden benötigt werden
  genutzt und es wird in der Variablen $conn gespeichert, um diese einfach später in anderen Dokumenten wieder zu verwenden um eine Verbindung zur Datenbank
  zu gewährleisten.*/

if(!$conn) {
    die("Verbindung konnte nicht hergestellt werden: ".mysqli_connect_error());
}
/*Wenn keine Verbindung hergestellt wurde, dann wird das Script beendet und es kommt die Meldung "Verbindung konnte nicht hergestellt werden"."mysqli_connect_error() liefert einen String des letzten Verbindungsfehler.*/

