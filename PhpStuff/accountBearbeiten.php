<?php

session_start();

/*Erzeugt neue Session um auf Session-Variablen zugreifen zu können.*/

    include("connectDB.php");

    /*Bindet Datei mit Datenbank Verbindung in das aktuelle Dokument ein, um eine Datenbankverbindung zu gewährleisten.*/ 

    if(isset($_POST["changeName"])) {
        
        /*Prüft, ob der "changeName"-Button auf der "EditHotels"-Seite btätigt wurde mithilfe der Superglobalen Variablen $_POST.*/

        if(!preg_match("/^[a-zA-Z0-9]*$/", $_POST["Name"])) {  
            header("Location: ../inhaberfinder/myAccount.php?ID=".$_GET["ID"]."&error=invalidName");
            exit();
        }
        /*Prüft, ob der Name der angegeben wurde vom User einem bestimmten Muster (mit "preg_match()"-Funktion) entspricht, wenn nicht dann wird der User zurück auf die "myAccount"-Seite 
          geleitet mit der entsprechenden ID des Users und eine "error"-Meldung wird in die URL gesendet, um diese auf der "myAccount"-Seite mit Hilfe der
          Superglobalen $_GET aus der URL zu holen und eine Fehlermeldung auszugeben.*/

        else {       
            $sql = "Update Inhaber Set name = ? where wid = ?";
            /*sql Statement wird als String mit der Variablen $sql initialisiert. Es werden Platzhalten in Form von Fragezeichen verwendet, um das SQL-Statement
              sicher an die Datenbank zu leiten. Das Statement ist dafür da, dass der User seine Daten, in diesem Fall sein Namen ändern kann , wenn er auf
              den Button "changeName" klickt, welcher auf der "myAccount"-Seite als Haken vorliegt. Die wid wird dafür verwendet, um den richtigen User,
              welcher die Änderung vornimmt zu identifizieren.*/
            $stmt = mysqli_stmt_init($conn);
            /*Initialisiert  ein neues Statement und referenziert auf die Datenbankverbindung, welche mit include früher eingebunden wurde. Es werden vorbereitete 
              SQL-Statements verwendet, damit User nicht in der Lage sind die Datenbank mit Code in der Inputzeile zu zerstören(SQL-Injection)*/
            mysqli_stmt_prepare($stmt, $sql);
            /*Bereitet das Statement vor und nimmt dabei die Variablen für die Datenbankverbindung und des SQL-Statements entgegen.*/
            mysqli_stmt_bind_param($stmt, "si", $_POST["Name"], $_GET["ID"]);
            /*Verbindet die Usereingabe des Namens und die ID des Users mit dem Statement, um die Informationen des Users an die Datenbank weiterzugeben. "si"
              steht für die Datentypen der Userinformationen s=String(für den Namen), i=int(für die ID). Danach folgen die Usereingaben als Parameter in Superglobalen
              $_POST*/
            mysqli_stmt_execute($stmt);
            /*Führt das Statement mit den Usereingaben in der Datenbank aus.*/
            header("Location: ../inhaberfinder/myAccount.php?ID=".$_GET["ID"]."&Success=NameChanged");
            /*Danach wird User zur "myAccount"-Seite zurückgeleitet mit ID und Erfolgsmeldung in der URL.*/
            }
                }

                elseif(isset($_POST["changeVorname"])) {
        
                    if(!preg_match("/^[a-zA-Z0-9]*$/", $_POST["Vorname"])) {  
                        header("Location: ../inhaberfinder/myAccount.php?ID=".$_GET["ID"]."&error=invalidVorname");
                        exit();
                    }
                   else {
                    $sql = "Update Inhaber Set vorname = ? where wid = ?";
                    $stmt = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($stmt, $sql);
                                        
                    mysqli_stmt_bind_param($stmt, "si", $_POST["Vorname"], $_GET["ID"]);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../inhaberfinder/myAccount.php?ID=".$_GET["ID"]."&Success=VornameChanged");
                   }           
                    }

    elseif(isset($_POST["changeStraße"])) {
        
                   
    $sql = "Update Inhaber Set straße = ? where wid = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
                        
    mysqli_stmt_bind_param($stmt, "si", $_POST["Straße"], $_GET["ID"]);
    mysqli_stmt_execute($stmt);
    header("Location: ../inhaberfinder/myAccount.php?ID=".$_GET["ID"]."&Success=StraßeChanged");
                    
    }
    elseif(isset($_POST["changeHausnummer"])) {
        
                   
        $sql = "Update Inhaber Set hausnummer = ? where wid = ?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
                            
        mysqli_stmt_bind_param($stmt, "si", $_POST["Hausnummer"], $_GET["ID"]);
        mysqli_stmt_execute($stmt);
        header("Location: ../inhaberfinder/myAccount.php?ID=".$_GET["ID"]."&Success=HausnummerChanged");
                        
        }
        elseif(isset($_POST["changeOrt"])) {
        
                   
            $sql = "Update Inhaber Set ort = ? where wid = ?";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt, $sql);
                                
            mysqli_stmt_bind_param($stmt, "si", $_POST["Ort"], $_GET["ID"]);
            mysqli_stmt_execute($stmt);
            header("Location: ../inhaberfinder/myAccount.php?ID=".$_GET["ID"]."&Success=OrtChanged");
                            
            }
            elseif(isset($_POST["changePLZ"])) {
        
                   
                $sql = "Update Inhaber Set plz = ? where wid = ?";
                $stmt = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($stmt, $sql);
                                    
                mysqli_stmt_bind_param($stmt, "si", $_POST["PLZ"], $_GET["ID"]);
                mysqli_stmt_execute($stmt);
                header("Location: ../inhaberfinder/myAccount.php?ID=".$_GET["ID"]."&Success=PLZChanged");
                                
                }
                elseif(isset($_POST["changeTelefonnummer"])) {
        
                   
                    $sql = "Update Inhaber Set telefonnummer = ? where wid = ?";
                    $stmt = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($stmt, $sql);
                                        
                    mysqli_stmt_bind_param($stmt, "si", $_POST["Telefonnummer"], $_GET["ID"]);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../inhaberfinder/myAccount.php?ID=".$_GET["ID"]."&Success=TelefonnummerChanged");
                                    
                    }
                    elseif(isset($_POST["changeEmail"])) {
                        
                        if(!filter_var($_POST["Email"], FILTER_VALIDATE_EMAIL)) {
                            header("Location: ../inhaberfinder/myAccount.php?ID=".$_GET["ID"]."&error=invalidEmail");
                            exit();
                        }
                /*Mit der Funktion "filter_var" wird die Eingabe des Users seiner Email gefiltert und geprüft, ob diese eine gültige Email ist. Der erste Parameter
                  ist die Emaileingabe des Users, welche durch Superglobale $_POST übergeben wurde. Es folgt ein schon vorbereiteter Parameter, welcher checkt, ob
                  die Email richtig angegeben wurde, man muss sich dafür kein Muster selbst überlegen wie beim Namen.*/
                        
                        $sqlEmailCheck = "Select email from Inhaber where email=? AND wid != ?";
                /*Hier wird ein neues SQL-Statement initialisiert, welches nur den Zweck hat zu suchen, ob  die Email, welche vom User angegeben wird bereits
                  vorhanden ist in der Datenbank*/ 
                        $stmt = mysqli_stmt_init($conn);

                        mysqli_stmt_prepare($stmt, $sqlEmailCheck);
                        mysqli_stmt_bind_param($stmt, "si", $_POST["Email"], $_GET["ID"]);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_store_result($stmt);
                        $resultCheck = mysqli_stmt_num_rows($stmt);
                /*Mit der Funktion "mysqli_stmt_num_rows()" und den dazugehörigen Parameter der Datenbankverbindung, werden nun die Ergebniszeilen des SQL
                  Statements in der Datenbank gezählt und in der Variablen $resultCheck gespeichert.*/ 
                        if($resultCheck > 0) {
                            header("Location: ../inhaberfinder/myAccount.php?ID=".$_GET["ID"]."&error=emailbereitsvergeben");
                            exit();
                        }
                /*Wenn es mehr als Null Ergebnisse in der Suche gab, dann wird nun der User auf die "myAccount"-Seite zurückgeleitet mit seiner ID und der 
                  Fehlermeldung "emailbereitsvergeben in der URL, welche später noch über Superglobale $_GET aus der URL genommen wird für Fehlermeldung
                  auf dem Bildschirm.*/
                        
                        else {
                /*Wenn es kein Ergebnis gab, dann wird ganz normal der Prozess zum ändern der Email wie beim Namen schon beschrieben fortgesetzt.*/
                   
                        $sql = "Update Inhaber Set email = ? where wid = ?";
                        $stmt = mysqli_stmt_init($conn);
                        mysqli_stmt_prepare($stmt, $sql);
                                            
                        mysqli_stmt_bind_param($stmt, "si", $_POST["Email"], $_GET["ID"]);
                        mysqli_stmt_execute($stmt);
                        header("Location: ../inhaberfinder/myAccount.php?ID=".$_GET["ID"]."&Success=EmailChanged");
                        }                
                        }

if(isset($_POST["accountLöschen"])) {
/*Wenn der Button zum Account löschen betätigt wurden, wird das mit Hilfe der isset()-Methode und der Superglobalen $_POST überprüft.*/
unset($_SESSION["userEmail"]);
unset($_SESSION["userID"]);
/*Zuerst werden die Session-Variablen "userEmail" und "userID" aufgelöst, welche durch die Superglobale $_SESSION in jedem Dokument mit einer Session vorhanden
sind, da sie beim einloggen in "inhaberLogin" initialisiert werden und der User beim Account löschen automatisch ausgeloggt werden soll.*/ 
$sqlName = "Select name, vorname from Inhaber where wid = ${_GET["ID"]}";
$result = mysqli_query($conn,$sqlName);
/*Um den Namen des Users später ausgeben zulassen in der Erfolgsmeldung, dass der Account gelöscht wurde , wird dieser mit dem Entsprechendem SQL-Statement
  gesucht und mit der passenden ID.*/
if(mysqli_num_rows($result)>0) {
/*Es wird geprüft mit der Methode "mysqli_num_rows()", ob es Ergebnisse bei der Suche gab.*/
while($row = mysqli_fetch_assoc($result)) {
/*Bei Ergebnissen werden nun die Ergebniszeilen mit der Methode mysqli_fetch_assoc() nach und nach als assoziatives Array in der Variablen $row gespeichert.*/
$_SESSION["deletedName"] = $row["name"];
$_SESSION["deletedVorname"] = $row["vorname"];

/*Über den Variablennamen $row und den Schlüssel "name" und "vorname" kann man nun auf den Wert in der Spalte zugreifen, welcher der eigentlich Name und Vorname 
 des Users ist. Diese werden dann in den Superglobalen $_SESSION gespeichert, um sie danach für die Erfolgsmeldung wieder zu verwenden.*/
                        
$sql = "Update Inhaber Set geloescht = 1 where wid = ${_GET["ID"]}";
/*Da die Daten nicht gelöscht werden dürfen, werden sie in der "geloescht" Spalte in der Datenbank mit einer "1" versehen und danach nicht mehr angezeigt.*/
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt, $sql);
                                                                                            
mysqli_stmt_execute($stmt);

$sql = "Update Hotel Set geloescht = 1 where wid = ${_GET["ID"]}";
/*Mit diesem SQL-Statement wird noch das "geloescht"-Attribut der Hotels des entsprechenden Inhabers mit einer 1 versehen, da auch alle seine Hotels
 nicht mehr angezeigt werden dürfen. Das wird über den Fremdschlüssel des Inhabers in der Hotel Tabelle erreicht und mit seiner ID, welche man aus der URL nimmt
 mit der Superglobalen $_GET.*/ 
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt, $sql);
                                                                                            
mysqli_stmt_execute($stmt);

header("Location: ../footer/logIn.php?ID=".$_GET["ID"]."&Success=AccountGelöscht");
    }
/*Danach wird der User auf die logIn-Seite geleitet mit der Erfolgsmeldung "AccountGelöscht" in der URL.*/
}
}