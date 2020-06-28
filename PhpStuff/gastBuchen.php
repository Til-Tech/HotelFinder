<?php

if(isset($_POST["gastBuchen-submit"])) {
/*Prüfen, ob User auf den "gastBuchen-submit"-Button geklickt hat, um Gastedaten in Datenbank aufnehmen Prozess zu starten.*/
       include("connectDB.php");
/*Skript zur Datenbankserververbindung wird eingebunden.*/
       
       $name = mysqli_real_escape_string($conn,$_POST["Name"]);
       $vorname = mysqli_real_escape_string($conn,$_POST["Vorname"]);
       $ort = mysqli_real_escape_string($conn,$_POST["Ort"]);
       $straße = mysqli_real_escape_string($conn,$_POST["Straße"]);
       $hausnummer = mysqli_real_escape_string($conn,$_POST["Hausnummer"]);
       $plz = mysqli_real_escape_string($conn,$_POST["PLZ"]);
       $email = mysqli_real_escape_string($conn,$_POST["Email"]);
       $telefonnummer = mysqli_real_escape_string($conn,$_POST["Telefonnummer"]);
/*Variablen werden mit Userinput initialisiert durch die Superglobale $_POST und allen Inputs die sich im Formular befinden. Mit "mysqli_real_escape_sting()"
  werden spezielle Zeichen aus dem String entzogen für die nachfolgenden SQL-STatements mit der Referenz auf die Verbindung zum Datenbankserver, um 
  einen zusätzlichen Schutz vor SQL-Injection zu gewährleisten.*/
   
       if(empty($name)||empty($vorname)||empty($straße)||empty($hausnummer)||empty($plz)||empty($ort)||empty($telefonnummer)||empty($email)) {
           header("Location: ../hotelfinder/buchen.php?ID=".$_GET["ID"]."&error=emptyfields&Name=".$name."&Vorname=".$vorname."&Mail=".$email."&Straße=".$straße."&Tlf=".$telefonnummer);
           exit();
       }
/*Prüfen, ob der User überhaupt etwas in das Formular geschrieben hat(also ob die Inputs leer sind) mit der Methode "empty()", welche prüft, ob die Variablen,
  welche als Parameter übergeben wurden Werte enthalten. Wenn einer der Variablen leer ist wird der User zur buchen.php Seite zurück geleitet mit der ID des
  Hotels und der Fehlermeldung "emptyfields"*/
       elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)&&!preg_match("/^[a-zA-Z0-9]*$/", $name)&&!preg_match("/^[a-zA-Z0-9]*$/", $vorname)) {
           header("Location: ../hotelfinder/buchen.php?ID=".$_GET["ID"]."&error=invalidEmailNameVorname");
           exit();
       }
/*Prüfen, ob der User eine gültige Email, Namen und Vornamen angegeben hat. Wenn er keinen davon gültig angegeben hat wird er zurück geleitet zur "buchen.php"
  und es wird die Fehlermeldung "invalidEmailNameVorname" an die URL weitergegeben.*/
       elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
           header("Location: ../hotelfinder/buchen.php?ID=".$_GET["ID"]."&error=invalidEmail&Name=".$name."&Vorname=".$vorname."&Straße=".$straße."&Tlf=".$telefonnummer);
           exit();
       }
/*Mit der Funktion "filter_var" wird die Eingabe des Users seiner Email gefiltert und geprüft, ob diese eine gültige Email ist. Der erste Parameter
  ist die Emaileingabe des Users, welche durch Superglobale $_POST übergeben wurde. Es folgt ein schon vorbereiteter Parameter, welcher checkt, ob
  die Email richtig angegeben wurde, man muss sich dafür kein Muster selbst überlegen wie beim Namen.*/
       elseif(!preg_match("/^[a-zA-Z0-9]*$/", $name)) {  //normal name dann auch für login
           header("Location: ../hotelfinder/buchen.php?ID=".$_GET["ID"]."&error=invalidName&Vorname=".$vorname."&Straße=".$straße."&Tlf=".$telefonnummer."&Email=".$email);
           exit();
       }
/*Prüft, ob der Name der angegeben wurde vom User einem bestimmten Muster (mit "preg_match()"-Funktion) entspricht, wenn nicht dann wird der User zurück auf die "myAccount"-Seite 
  geleitet mit der entsprechenden ID des Users und eine "error"-Meldung wird in die URL gesendet, um diese auf der "myAccount"-Seite mit Hilfe der
  Superglobalen $_GET aus der URL zu holen und eine Fehlermeldung auszugeben.*/
       elseif(!preg_match("/^[a-zA-Z0-9]*$/", $vorname)) {  //normal name dann auch für login
           header("Location: ../hotelfinder/buchen.php?ID=".$_GET["ID"]."&error=invalidVorname&Name=".$name."&Straße=".$straße."&Tlf=".$telefonnummer."&Email=".$email);
           exit();
       }
/*Prüft nach dem selben Schema den Vornameninput des USers auf Gültigkeit.*/
       
               else {
                   
                   $sql = "Insert Into Gast (name, vorname, ort, straße, hausnummer, plz, email, telefonnummer) values(?,?,?,?,?,?,?,?)"; 
/*Wenn keine Fehlermeldung zutrifft wird ein SQL Statement mit Platzhaltern vorbereitet, welche später Werte übertragen bekommen welche an die Datenbank
  gesendet werden. Schützt vor SQL-Injection.*/
                   $stmt = mysqli_stmt_init($conn);
/*Initialisiert  ein neues Statement und referenziert auf die Datenbankverbindung, welche mit include früher eingebunden wurde. Es werden vorbereitete 
  SQL-Statements verwendet, damit User nicht in der Lage sind die Datenbank mit Code in der Inputzeile zu zerstören(SQL-Injection)*/
                   if(!mysqli_stmt_prepare($stmt, $sql)) {
                       header("Location: ../hotelfinder/buchen.php?ID=".$_GET["ID"]."&error=sqlerror");
                        exit();
                   }
/*Wenn das Statement nicht vorbereitet werden kann, wenn zum Beispiel der SQL-BEfehl fehlerhaft ist, dann wird der User auf die "buchen.php" zurückgeführt
  mit der Hotel ID und der Fehlermeldung "sqlerror" in der URL.*/
                   else {
                       
                       mysqli_stmt_bind_param($stmt, "sssssssi",$name,$vorname,$ort,$straße,$hausnummer,$plz,$email,$telefonnummer);
                       mysqli_stmt_execute($stmt);
                       header("Location: ../hotelfinder/buchen.php?ID=".$_GET["ID"]."&success=buchenerfolgreich");
                        exit();
                       
                   }
/*Wenn das Statement erfolgreich vorbereitet wurde dann wird nun das SQL-Statement mit den Inputdaten des Users verbunden mit der Methode mysqli_stmt_bind_param
  mit dem ersten Parameter der Datenbank Verbindung, den zweiten Parameter, welche die Datentypen der Inputs des Users darstellen(s= string, i = int) und die
  folgenden Paraeter sind die Variablen die am Anfang mit dem Userinput initialisiert wurden. Danach wird das Statement mit "msqli_stmt_execute()" ausgeführt
  und die Daten des Users in die Datenbank aufgenommen. Danach wird der User zurück zu "buchen.php" geleitet mit der Erfolgsmeldung "buchenerfolgreich"
  in der URL.*/
               }
       
       mysqli_stmt_close($stmt);
/*Vorbereitetes Statement wird wieder geschlossen.*/
       mysqli_close($conn);
/*Schließt die Datenbankverbindung.*/
   }
   else {
       //header("Location: InhaberRegistrierung.php");
                   exit();
/*Skript wird verlassen.*/
   }