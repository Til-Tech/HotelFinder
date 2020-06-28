<?php

if(isset($_POST["register-submit"])) {
/*Prüfen, ob auf register.php der register-Button getätigt wurde.*/
       include("connectDB.php");
/*Bindet Datei mit Datenbank Verbindung in das aktuelle Dokument ein, um eine Datenbankverbindung zu gewährleisten.*/
       $passwort = mysqli_real_escape_string($conn,$_POST["Passwort"]);
       $passwortwdh = $_POST["PasswortWdh"];
       $name = mysqli_real_escape_string($conn,$_POST["Name"]);
       $vorname = mysqli_real_escape_string($conn,$_POST["Vorname"]);
       $straße = mysqli_real_escape_string($conn,$_POST["Straße"]);
       $hausnummer = mysqli_real_escape_string($conn,$_POST["Hausnummer"]);
       $plz = mysqli_real_escape_string($conn,$_POST["PLZ"]);
       $ort = mysqli_real_escape_string($conn,$_POST["Ort"]);
       $telefonnummer = mysqli_real_escape_string($conn,$_POST["Telefonnummer"]);
       $email = mysqli_real_escape_string($conn,$_POST["Email"]);
/*Variablen werden mit Userinput initialisiert durch die Superglobale $_POST und allen Inputs die sich im Formular befinden. Mit "mysqli_real_escape_sting()"
  werden spezielle Zeichen aus dem String entzogen für die nachfolgenden SQL-STatements mit der Referenz auf die Verbindung zum Datenbankserver, um 
  einen zusätzlichen Schutz vor SQL-Injection zu gewährleisten.*/
       if(empty($name)||empty($vorname)||empty($straße)||empty($hausnummer)||empty($plz)||empty($ort)||empty($telefonnummer)||empty($email)||empty($passwort)||empty($passwortwdh)) {
           header("Location: ../footer/register.php?error=emptyfields&Name=".$name."&Vorname=".$vorname."&Mail=".$email."&Straße=".$straße."&Tlf=".$telefonnummer);
           exit();
       }
/*Prüfen, ob der User überhaupt etwas in das Formular geschrieben hat(also ob die Inputs leer sind) mit der Methode "empty()", welche prüft, ob die Variablen,
  welche als Parameter übergeben wurden Werte enthalten. Wenn einer der Variablen leer ist wird der User zur register.php Seite zurück geleitet mit der ID des
  Hotels und der Fehlermeldung "emptyfields"*/
       elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)&&!preg_match("/^[a-zA-Z0-9]*$/", $name)&&!preg_match("/^[a-zA-Z0-9]*$/", $vorname)) {
           header("Location: ../footer/register.php?error=invalidEmailNameVorname");
           exit();
       }
/*Prüfen, ob der User eine gültige Email, Namen und Vornamen angegeben hat. Wenn er keinen davon gültig angegeben hat wird er zurück geleitet zur "register.php"
  und es wird die Fehlermeldung "invalidEmailNameVorname" an die URL weitergegeben.*/
       elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
           header("Location: ../footer/register.php?error=invalidEmail&Name=".$name."&Vorname=".$vorname."&Straße=".$straße."&Tlf=".$telefonnummer);
           exit();
       }
/*Mit der Funktion "filter_var" wird die Eingabe des Users seiner Email gefiltert und geprüft, ob diese eine gültige Email ist. Der erste Parameter
  ist die Emaileingabe des Users, welche durch Superglobale $_POST übergeben wurde. Es folgt ein schon vorbereiteter Parameter, welcher checkt, ob
  die Email richtig angegeben wurde, man muss sich dafür kein Muster selbst überlegen wie beim Namen.*/
       elseif(!preg_match("/^[a-zA-Z0-9]*$/", $name)) {  
           header("Location: ../footer/register.php?error=invalidName&Vorname=".$vorname."&Straße=".$straße."&Tlf=".$telefonnummer."&Email=".$email);
           exit();
       }
/*Prüft, ob der Name der angegeben wurde vom User einem bestimmten Muster (mit "preg_match()"-Funktion) entspricht, wenn nicht dann wird der User zurück auf die "myAccount"-Seite 
  geleitet mit der entsprechenden ID des Users und eine "error"-Meldung wird in die URL gesendet, um diese auf der "register"-Seite mit Hilfe der
  Superglobalen $_GET aus der URL zu holen und eine Fehlermeldung auszugeben.*/
       elseif(!preg_match("/^[a-zA-Z0-9]*$/", $vorname)) {  
           header("Location: ../footer/register.php?error=invalidVorname&Name=".$name."&Straße=".$straße."&Tlf=".$telefonnummer."&Email=".$email);
           exit();
       }
/*Prüft nach dem selben Schema den Vornameninput des USers auf Gültigkeit.*/
       elseif($passwort !== $passwortwdh) {
           header("Location: ../footer/register.php?error=passwortCheck&Name=".$name."&Straße=".$straße."&Tlf=".$telefonnummer."&Email=".$email);
           exit();
       }
/*Prüfen, ob das der erste Passwort Input mit dem Passwort Wiederholen Input des Users übereinstimmt. Wenn das nicht der Fall ist,
  dann wird der User auf die register.php Seite zurück geleitet mit der Fehlermeldung "passwortCheck" in der URL.*/
       else {
           $sqlEmailCheck = "Select email from Inhaber where email=?";
/*Hier wird ein neues SQL-Statement initialisiert, welches nur den Zweck hat zu suchen, ob  die Email, welche vom User angegeben wird bereits
  vorhanden ist in der Datenbank*/ 
           $stmt = mysqli_stmt_init($conn);
/*Initialisiert  ein neues Statement und referenziert auf die Datenbankverbindung, welche mit include früher eingebunden wurde. Es werden vorbereitete 
  SQL-Statements verwendet, damit User nicht in der Lage sind die Datenbank mit Code in der Inputzeile zu zerstören(SQL-Injection)*/
           if(!mysqli_stmt_prepare($stmt, $sqlEmailCheck)) {
/*Bereitet das Statement vor und nimmt dabei die Variablen für die Datenbankverbindung und des SQL-Statements entgegen.*/
               header("Location: ../footer/register.php?error=sqlerrorbra");
           exit();
           }
/*Wenn das SQL-Statement nicht verarbeitet werden kann, so wird der User zurück geleitet mit der Fehlermeldung "sqlerrorbra" in der URL.*/
           else {
               mysqli_stmt_bind_param($stmt, "s", $email);
               mysqli_stmt_execute($stmt);
               mysqli_stmt_store_result($stmt);
               $resultCheck = mysqli_stmt_num_rows($stmt);
/*Mit der Funktion "mysqli_stmt_num_rows()" und den dazugehörigen Parameter der Datenbankverbindung, werden nun die Ergebniszeilen des SQL
  Statements in der Datenbank gezählt und in der Variablen $resultCheck gespeichert.*/
               if($resultCheck > 0) {
                   header("Location: ../footer/register.php?error=emailbereitsvergeben");
                   exit();
               }
/*Wenn es Ergebnisse zur SQL-Abfrage gibt, dann wird der User auf register.php geleitet mit der Fehlermeldung "emailbereitsvergeben"
  in der URL.*/
               else {
                   
                   $sql = "Insert Into Inhaber (password, name, vorname, ort, straße, hausnummer, plz, telefonnummer, email) values(?,?,?,?,?,?,?,?,?)";
                   $stmt = mysqli_stmt_init($conn);
                   if(!mysqli_stmt_prepare($stmt, $sql)) {
                       header("Location: ../footer/register.php?error=sqlerror");
                   exit();
                   }
                   else {
                       $hashedPwd = password_hash($passwort, PASSWORD_DEFAULT);
   
                       mysqli_stmt_bind_param($stmt, "sssssiiis",$hashedPwd,$name,$vorname,$ort,$straße,$hausnummer,$plz,$telefonnummer,$email);
/*Verbindet die Usereingaben, welche in den entsprechenden Variablen gespeichert, welche die Inhaberattribute sind wie z.B. Namen, Vorname, Email usw... mit dem Statement, um die Informationen des Users an die Datenbank weiterzugeben. "s" oder "i" z.B.
  steht für die Datentypen der Userinformationen s=String(für den Namen), i=int(für die Telefonnummer z.B.). Danach folgen die Usereingaben als Parameter in 
  Variablen.*/
                       mysqli_stmt_execute($stmt);
                       header("Location: ../footer/register.php?success=registrierungerfolgreich");
                   exit();
                       
                   }
/*Wenn das Statement erfolgreich vorbereitet wurde dann wird nun das SQL-Statement mit den Inputdaten des Users verbunden mit der Methode mysqli_stmt_bind_param()
  mit dem ersten Parameter der Datenbank Verbindung, den zweiten Parameter, welche die Datentypen der Inputs des Users darstellen(s= string, i = int) und die
  folgenden Paraeter sind die Variablen die am Anfang mit dem Userinput initialisiert wurden. Danach wird das Statement mit "msqli_stmt_execute()" ausgeführt
  und die Daten des Users in die Datenbank aufgenommen. Danach wird der User zurück zu "register.php" geleitet mit der Erfolgsmeldung "registrierungerfolgreich"
  in der URL.*/
                
            
               }
           }
       }
       mysqli_stmt_close($stmt);
/*Vorbereitetes Statement wird wieder geschlossen.*/
       mysqli_close($conn);
/*Schließt die Datenbankverbindung.*/
    
   }
   else {
       
                   exit();
/*Skript wird verlassen.*/
   }