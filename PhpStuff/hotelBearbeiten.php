<?php

session_start();
/*Neue Session wird gestartet, um später auf Session Variablen zugreifen zukönnen.*/

    include("connectDB.php");
/*Datenbankverbindung wird geöffnet.*/
    if(isset($_POST["changeName"])) {
/*Prüfen, ob "changeName"-Button betätigt wurde.*/
                   
            $sql = "Update Hotel Set hotelname = ? where hid = ?";
/*sql Statement wird als String mit der Variablen $sql initialisiert. Es werden Platzhalter in Form von Fragezeichen verwendet, um das SQL-Statement
  sicher an die Datenbank zu leiten. Das Statement ist dafür da, dass der User seine Daten, in diesem Fall den Hotelnamen ändern kann , wenn er auf
  den Button "changeName" klickt, welcher auf der "editHotels"-Seite als Haken vorliegt. Die hid wird dafür verwendet, um das richtie Hotel,
  an welchem die Änderung vorgenommen wird zu identifizieren.*/
            $stmt = mysqli_stmt_init($conn);
/*Initialisiert  ein neues Statement und referenziert auf die Datenbankverbindung, welche mit include früher eingebunden wurde. Es werden vorbereitete 
  SQL-Statements verwendet, damit User nicht in der Lage sind die Datenbank mit Code in der Inputzeile zu zerstören(SQL-Injection)*/
            mysqli_stmt_prepare($stmt, $sql);
/*Bereitet das Statement vor und nimmt dabei die Variablen für die Datenbankverbindung und des SQL-Statements entgegen.*/
            mysqli_stmt_bind_param($stmt, "si", $_POST["Hotelname"], $_GET["ID"]);
/*Verbindet die Usereingabe des Hotelnamens und die ID des Hotels mit dem Statement, um die Informationen des Users an die Datenbank weiterzugeben. "si"
  steht für die Datentypen der Userinformationen s=String(für den Hotelnamen), i=int(für die ID). Danach folgen die Usereingaben als Parameter in Superglobalen
  $_POST*/
            mysqli_stmt_execute($stmt);
/*Führt das Statement mit den Usereingaben in der Datenbank aus.*/
            header("Location: ../inhaberfinder/editHotels.php?ID=".$_GET["ID"]."&Success=NameChanged");
/*Danach wird User zur "myAccount"-Seite zurückgeleitet mit ID und Erfolgsmeldung in der URL.*/
            
                }

    elseif(isset($_POST["changeStraße"])) {
        
                   
    $sql = "Update Hotel Set straße = ? where hid = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
                        
    mysqli_stmt_bind_param($stmt, "si", $_POST["Straße"], $_GET["ID"]);
    mysqli_stmt_execute($stmt);
    header("Location: ../inhaberfinder/editHotels.php?ID=".$_GET["ID"]."&Success=StraßeChanged");
                    
    }
    elseif(isset($_POST["changeHausnummer"])) {
        
                   
        $sql = "Update Hotel Set hausnummer = ? where hid = ?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
                            
        mysqli_stmt_bind_param($stmt, "si", $_POST["Hausnummer"], $_GET["ID"]);
        mysqli_stmt_execute($stmt);
        header("Location: ../inhaberfinder/editHotels.php?ID=".$_GET["ID"]."&Success=HausnummerChanged");
                        
        }
        elseif(isset($_POST["changeOrt"])) {
        
                   
            $sql = "Update Hotel Set ort = ? where hid = ?";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt, $sql);
                                
            mysqli_stmt_bind_param($stmt, "si", $_POST["Ort"], $_GET["ID"]);
            mysqli_stmt_execute($stmt);
            header("Location: ../inhaberfinder/editHotels.php?ID=".$_GET["ID"]."&Success=OrtChanged");
                            
            }
            elseif(isset($_POST["changePLZ"])) {
        
                   
                $sql = "Update Hotel Set plz = ? where hid = ?";
                $stmt = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($stmt, $sql);
                                    
                mysqli_stmt_bind_param($stmt, "si", $_POST["PLZ"], $_GET["ID"]);
                mysqli_stmt_execute($stmt);
                header("Location: ../inhaberfinder/editHotels.php?ID=".$_GET["ID"]."&Success=PLZChanged");
                                
                }
                elseif(isset($_POST["changeTelefonnummer"])) {
        
                   
                    $sql = "Update Hotel Set telefonnummer = ? where hid = ?";
                    $stmt = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($stmt, $sql);
                                        
                    mysqli_stmt_bind_param($stmt, "si", $_POST["Telefonnummer"], $_GET["ID"]);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../inhaberfinder/editHotels.php?ID=".$_GET["ID"]."&Success=TelefonnummerChanged");
                                    
                    }
                    elseif(isset($_POST["changeEmail"])) {

                        if(!filter_var($_POST["Email"], FILTER_VALIDATE_EMAIL)) {
                            header("Location: ../inhaberfinder/editHotels.php?ID=".$_GET["ID"]."&error=invalidEmail");
                            exit();
                        }
/*Mit der Funktion "filter_var" wird die Eingabe des Users seiner Email gefiltert und geprüft, ob diese eine gültige Email ist. Der erste Parameter
  ist die Emaileingabe des Users, welche durch Superglobale $_POST übergeben wurde. Es folgt ein schon vorbereiteter Parameter, welcher checkt, ob
  die Email richtig angegeben wurde, man muss sich dafür kein Muster selbst überlegen wie beim Namen.*/

                        $sqlEmailCheck = "Select email from Hotel where email=? AND hid != ?";
                        $stmt = mysqli_stmt_init($conn);
/*Hier wird ein neues SQL-Statement initialisiert, welches nur den Zweck hat zu suchen, ob  die Email, welche vom User angegeben wird bereits
  vorhanden ist in der Datenbank*/ 

                        mysqli_stmt_prepare($stmt, $sqlEmailCheck);
                        mysqli_stmt_bind_param($stmt, "si", $_POST["Email"], $_GET["ID"]);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_store_result($stmt);
                        $resultCheck = mysqli_stmt_num_rows($stmt);
/*Mit der Funktion "mysqli_stmt_num_rows()" und den dazugehörigen Parameter der Datenbankverbindung, werden nun die Ergebniszeilen des SQL
  Statements in der Datenbank gezählt und in der Variablen $resultCheck gespeichert.*/ 
                        if($resultCheck > 0) {
                            header("Location: ../inhaberfinder/editHotels.php?ID=".$_GET["ID"]."&error=emailbereitsvergeben");
                            exit();
                        }
/*Wenn es mehr als Null Ergebnisse in der Suche gab, dann wird nun der User auf die "editHotels"-Seite zurückgeleitet mit der Hotel ID und der 
  Fehlermeldung "emailbereitsvergeben in der URL, welche später noch über Superglobale $_GET aus der URL genommen wird für Fehlermeldung
  auf dem Bildschirm.*/
                        else {
/*Wenn es kein Ergebnis gab, dann wird ganz normal der Prozess zum ändern der Email wie beim Namen schon beschrieben fortgesetzt.*/
                        $sql = "Update Hotel Set email = ? where hid = ?";
                        $stmt = mysqli_stmt_init($conn);
                        mysqli_stmt_prepare($stmt, $sql);
                                            
                        mysqli_stmt_bind_param($stmt, "si", $_POST["Email"], $_GET["ID"]);
                        mysqli_stmt_execute($stmt);
                        header("Location: ../inhaberfinder/editHotels.php?ID=".$_GET["ID"]."&Success=EmailChanged");
                        }          
                        }
                        elseif(isset($_POST["changeSteuernummer"])) {
        
                   
                            $sql = "Update Hotel Set steuernummer = ? where hid = ?";
                            $stmt = mysqli_stmt_init($conn);
                            mysqli_stmt_prepare($stmt, $sql);
                                                
                            mysqli_stmt_bind_param($stmt, "si", $_POST["Steuernummer"], $_GET["ID"]);
                            mysqli_stmt_execute($stmt);
                            header("Location: ../inhaberfinder/editHotels.php?ID=".$_GET["ID"]."&Success=SteuernummerChanged");
                                            
                            }
                            elseif(isset($_POST["changeNachbarschaft"])) {
        
                   
                                $sql = "Update Hotel Set nachbarschaft = ? where hid = ?";
                                $stmt = mysqli_stmt_init($conn);
                                mysqli_stmt_prepare($stmt, $sql);
                                                    
                                mysqli_stmt_bind_param($stmt, "si", $_POST["Nachbarschaft"], $_GET["ID"]);
                                mysqli_stmt_execute($stmt);
                                header("Location: ../inhaberfinder/editHotels.php?ID=".$_GET["ID"]."&Success=NachbarschaftChanged");
                                                
                                }
                                elseif(isset($_POST["changeBeschreibung"])) {
        
                   
                                    $sql = "Update Hotel Set beschreibung = ? where hid = ?";
                                    $stmt = mysqli_stmt_init($conn);
                                    mysqli_stmt_prepare($stmt, $sql);
                                                        
                                    mysqli_stmt_bind_param($stmt, "si", $_POST["Beschreibung"], $_GET["ID"]);
                                    mysqli_stmt_execute($stmt);
                                    header("Location: ../inhaberfinder/editHotels.php?ID=".$_GET["ID"]."&Success=BeschreibungChanged");
                                                    
                                    }
                                    elseif(isset($_POST["changePreis"])) {
        
                   
                                        $sql = "Update Hotel Set preis = ? where hid = ?";
                                        $stmt = mysqli_stmt_init($conn);
                                        mysqli_stmt_prepare($stmt, $sql);
                                                            
                                        mysqli_stmt_bind_param($stmt, "si", $_POST["Preis"], $_GET["ID"]);
                                        mysqli_stmt_execute($stmt);
                                        header("Location: ../inhaberfinder/editHotels.php?ID=".$_GET["ID"]."&Success=PreisChanged");
                                                        
                                        }
                                        elseif(isset($_POST["changePersonen"])) {
        
                   
                                            $sql = "Update Hotel Set zimmeranzahl = ? where hid = ?";
                                            $stmt = mysqli_stmt_init($conn);
                                            mysqli_stmt_prepare($stmt, $sql);
                                                                
                                            mysqli_stmt_bind_param($stmt, "si", $_POST["Personen"], $_GET["ID"]);
                                            mysqli_stmt_execute($stmt);
                                            header("Location: ../inhaberfinder/editHotels.php?ID=".$_GET["ID"]."&Success=PersonenanzahlChanged");
                                                            
                                            }
                                            elseif(isset($_POST["changeSterne"])) {
        
                                                if(($_POST["Sterne"]>5)||($_POST["Sterne"]<0)) {
                                                    header("Location: ../inhaberfinder/editHotels.php?ID=".$_GET["ID"]."&error=falscheSterneAnzahl");
                                                    exit();
                                                }
/*Prüfen, ob der User eine Zahl von 0-5 für die Sternanzahl des Hotels angegeben hat. Wenn nicht, wird er zur "editHotels"-Seite zurück geleitet 
  mit der Hotel ID und der Fehlermeldung "falscheSterneAnzahl" in der URL.*/

                                                $sql = "Update Hotel Set sterne = ? where hid = ?";
                                                $stmt = mysqli_stmt_init($conn);
                                                mysqli_stmt_prepare($stmt, $sql);
                                                                    
                                                mysqli_stmt_bind_param($stmt, "si", $_POST["Sterne"], $_GET["ID"]);
                                                mysqli_stmt_execute($stmt);
                                                header("Location: ../inhaberfinder/editHotels.php?ID=".$_GET["ID"]."&Success=SterneChanged");
                                                                
                                                }
   
if(isset($_POST["changeFilterAttribute"])) {
/*Prüfen, ob "changeFilterAttribute"-Button betätigt wurde.*/

    $spalten = ["innenstadt", "ac", "hotel", "stonierung_kostenlos", "meerblick", "all_inclusive", "haustierfreundlich", "kueche", "pool", "casino", "wlan",
    "whirpool", "welness", "fruehstueck", "barrierefrei"];
/*Array mit Spaltennamen der Hoteltabelle in der Datenbank als Strings, welche einen Boolean darstellen und die Filterwerte des Hotels bestimmen.*/

    $postnames = ["checkbox2", "checkbox3", "checkbox4", "checkbox5", "checkbox6", "checkbox7", "checkbox8", "checkbox9", "checkbox10", "checkbox11", "checkbox12",
    "checkbox13", "checkbox14", "checkbox15", "checkbox16"];
/*Array mit den Namen der Checkboxen die man als Filter für das Hotel auswählen kann.*/ 

    for($i = 0; $i < count($spalten); $i++) {
        if(isset($_POST[$postnames[$i]])) {
/*Länge der vorher definierten Arrays werden durchlaufen(beide gleich lang) und es wird an jeder Stelle des Indexes $i die Checkbox an der i'ten Stelle gecheckt
  wurde vom User mit Hilfe der Superglobalen $_POST*/
            $sql = "Update Hotel Set ${spalten[$i]} = 1 where hid = ?";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt, $sql);
/*Da die Arrays dieselbe Länge haben, steht jedes Attribut in $spalten für jeweils eine bestimmte Checkbox in $postnames, z.B. steht innenstadt für checkbox2, also
  wenn checkbox2 ausgewählt wurde, dann wurde der Filter innenstadt aktiviert. Nun wird für jede Checkbox die ausgewählt wurde die entsprechende Spalte in der 
  Hotel Tabelle mit einer 1 versehen--> das passiert im sql-Befehl. Dieses Statement wird danach vorbereitet mit Platzhaltern, um vor SQL Injection zu schützen.*/                                                                    
            mysqli_stmt_bind_param($stmt, "i", $_GET["ID"]);
            mysqli_stmt_execute($stmt);
/*Danach werden die Parameter mit dem Statement verbunden und das Statement wird in der Datenbank ausgeführt.*/
                                                
        }
        elseif(!isset($_POST[$postnames[$i]])) {
/*Die Checkboxen, die nicht ausgeählt wurden.*/
            $sql = "Update Hotel Set ${spalten[$i]} = 0 where hid = ?";
/*Checkboxen, welche nicht ausgewählt wurden, dort werden in der Tabelle Hotel in den Spalten eine 0 gesetzt.*/
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt, $sql);
                                                                    
            mysqli_stmt_bind_param($stmt, "i", $_GET["ID"]);
            mysqli_stmt_execute($stmt);
/*Danach wird das neue Statement vorbereitet, zusammengesetzt und ausgeführt.*/
        }
    }
    header("Location: ../inhaberfinder/editHotels.php?ID=".$_GET["ID"]."&Success=FilterattributeChanged");
/*Danach wird der User auf die "editHotels"-Seite mit der Hotel ID und der Erfolgsmeldung "FilterattributeChanged".*/
            
}

if(isset($_POST["bilderHinzufügen"])) {
/*Prüfen, ob "bilderHinzufügen Button betätigt wurde.*/
    $sqlBilder = "Select geloescht from Bilder where hid = ${_GET["ID"]}";
    $result = mysqli_query($conn,$sqlBilder);
/*Zuerst wird gesucht, ob es schon Bilder gibt vom Hotel das zu bearbeiten ist mit dem entsprechenden SQL-Befehl.*/
    if(mysqli_num_rows($result)>0) {

        $sql = "Update Bilder Set geloescht = 1 where hid = ${_GET["ID"]}";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
                                                                        
        mysqli_stmt_execute($stmt);
/*Wenn es schon Bilder gibt , dann werden diese automatisch in der Spalte in der Tabelle Bilder in der Datenbank mit einer 1 versehen
  also gelten als geloescht. Das passiert, weil immer die neuesten Bilder die man hochlädt( maximal4 ) sehen soll. Nachdem das Sql Statement
  vorbereitet wurde, wird es ausgeführt.*/
    } 

for($bildCounter = 2; $bildCounter<=5; $bildCounter++) {
/*Im Formular "bilderHinzufügen" auf der "editHotels"-Seite gibt es 4 file inputs, welche die Namen file2-file5 haben. Durch die
  For-Schleife sollen alle Bilder gleichzeitig hinzugefügt werden, indem sie 4 Mal durchläuft. Der index $bildCounter startet bei 2, damit
  er als Variable benutzt werden kann, um die File-Namen file2-file5 in php darzustellen.*/
    $file2 = $_FILES["file".$bildCounter];

   $fileName2 = $_FILES["file".$bildCounter]["name"];
   $fileTmpName2 = $_FILES["file".$bildCounter]["tmp_name"];
   $fileSize2 = $_FILES["file".$bildCounter]["size"];
   $fileError2 = $_FILES["file".$bildCounter]["error"];
/*Durch "file".$bildCounter wird immer über die passende Superglobale Variable $_FILES die vom Userangegebene Datei ausgewählt.
  und die Namen, temporären Namen, Größe und Fehler werden in Variablen gespeichert.*/
   $fileExt2 = explode(".", $fileName2);
    $fileActualExt2 = strtolower(end($fileExt2));

    $allowed2 = array("jpg", "jpeg", "png");
/*Erlaubte Dateiformate als String in einem Array gespeichert.*/
    if(in_array($fileActualExt2, $allowed2)) {
        /*Prüfen, ob Datei das richtige Format besitzt.*/
        if($fileError2 === 0) {
            /*Prüfen, ob Datei Fehlerhaft ist.*/
            if($fileSize2 < 1000000000) {
                /*Maximale Größe der Datei.*/                                    
                    $fileNameNew2 = uniqid("", true).".".$fileActualExt2;
                    /*Bildernamen werden einzigartig gemacht, damit immer die richtigen Bilder angezeigt werden.*/
                    $fileDestination2 = "../images/".$fileNameNew2;
                    move_uploaded_file($fileTmpName2, $fileDestination2);
                    /*Ort wo Bild gespeichert wird, wird bestimmt und danach wird das Bild an den Ort gesendet mit 
                      move_uploaded_file.*/
                   


                $sqlBilder = "Insert Into Bilder (hid, bilderName, geloescht) values(?,?,0)";
                /*sql Statement um Namen des Bildes in die Datenbank einzufügen.*/
                $stmtBilder = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($stmtBilder, $sqlBilder); 

                    mysqli_stmt_bind_param($stmtBilder, "is",$_GET["ID"],$fileNameNew2);
                    mysqli_stmt_execute($stmtBilder);
                    header("Location: ../inhaberfinder/editHotels.php?ID=".$_GET["ID"]."&Success=BilderHinzugefügt");
                /*Statement wird vorbereitet, mit Userdatenverbunden und dann wird das Statement in der Datenbank ausgeführt.
                  Danach wird der User zu editHotels.php geleitet mit Erfolgsmeldung.*/
            }
            else {
                header("Location: ../inhaberfinder/editHotels.php?ID=".$_GET["ID"]."&error=dateizugroß");
                echo "Die Datei ist zu groß, nur bis zu 100mb!";
                exit();
            }
            /*Wenn Datei zu groß ist Fehlermeldung.*/       
        }
        
        else {
            header("Location: ../inhaberfinder/editHotels.php?ID=".$_GET["ID"]."&error=fehlerbeimhochladenderdatei");
            echo "Fehler beim hochladen der Datei!";
            $_SESSION["errorHandling"] = $_FILES["file".$bildCounter]["error"];
            exit();
        }
        /*Wenn Fehler beim Hochladen aufgetreten sind.*/
    }
    else {
        header("Location: ../inhaberfinder/editHotels.php?ID=".$_GET["ID"]."&error=falschesformatNurJPGJPEGoderPNG");
        echo "Nur Bilder in jpg, jpeg oder png erlaubt.";
        exit();
    }
    /*Wenn falsches Format gewählt wurde für Bild.*/
    
    }
}

if(isset($_POST["titelbildÄndern"])) {


    $file = $_FILES["file"];

    $fileName = $file["name"];
    $fileTmpName = $file["tmp_name"];
    $fileSize = $file["size"];
    $fileError = $file["error"];

    $fileExt = explode(".", $fileName);
     $fileActualExt = strtolower(end($fileExt));

     $allowed = array("jpg", "jpeg", "png");

     if(in_array($fileActualExt, $allowed)) {
         if($fileError === 0) {
             if($fileSize < 1000000000) {                                    
                     $fileNameNew = uniqid("", true).".".$fileActualExt;
                     $fileDestination = "../images/".$fileNameNew;
                     move_uploaded_file($fileTmpName, $fileDestination);

                     $sqlBilder = "Update Hotel Set bild = ? where hid = ?";
                $stmtBilder = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($stmtBilder, $sqlBilder); 

                    mysqli_stmt_bind_param($stmtBilder, "si", $fileNameNew, $_GET["ID"]);
                    mysqli_stmt_execute($stmtBilder);
                    header("Location: ../inhaberfinder/editHotels.php?ID=".$_GET["ID"]."&Success=TitelbildChanged");
                     
             }
             else {
                 header("Location: ../inhaberfinder/editHotels.php?ID=".$_GET["ID"]."&error=dateizugroß");
                 echo "Die Datei ist zu groß, nur bis zu 100mb!";
                 exit();
             }       
         }
         
         else {
             header("Location: ../inhaberfinder/editHotels.php?ID=".$_GET["ID"]."&error=fehlerbeimhochladenderdatei");
             echo "Fehler beim hochladen der Datei!";
             $_SESSION["errorHandling"] = $file["error"];
             exit();
         }
     }
     else {
         header("Location: ../inhaberfinder/editHotels.php?ID=".$_GET["ID"]."&error=falschesformatNurJPGJPEGoderPNG");
         echo "Nur Bilder in jpg, jpeg oder png erlaubt.";
         exit();
     }

}

if(isset($_POST["hotelLöschen"])) {
/*Prüfen, ob "hotelLöschen" Button geklickt wurde.*/
    $sqlName = "Select hotelname from Hotel where hid = ${_GET["ID"]}";
    $result = mysqli_query($conn,$sqlName);
/*SQL-Statement sucht nach Hotelname mit entsprechender ID um diesen in der Erfolgsmeldung später auszugeben.*/
    if(mysqli_num_rows($result)>0) {
        
    while($row = mysqli_fetch_assoc($result)) {
    $_SESSION["deletedName"] = $row["hotelname"];
/*Hotelname des zu löschenden Hotels wird in SESSION Variable gespeichert.*/
    $sql = "Update Hotel Set geloescht = 1 where hid = ${_GET["ID"]}";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
/*"geloescht"-Attribut in der Datenbank wird auf 1 gesetzt , statt das Hotel komplett zu löschen, da die Daten von uns nicht
  gelöscht werden dürfen.*/    
    mysqli_stmt_execute($stmt);
    header("Location: ../inhaberfinder/myHotels.php?ID=".$_GET["ID"]."&Success=HotelGelöscht");
    }
/*Danach wird der User auf die "myHotels"-Seite geleitet und sein Hotel wird nicht mehr angezeigt. Und er bekommt die Erfolgsmeldung 
  HotelGelöscht in die URL.*/
}
}

