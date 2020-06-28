<?php
session_start();
/*Neue Session wird gestartet, um Session Variablen im Skript nutzen zu können.*/
if(isset($_POST["erstelleHotel-submit"])) {
/*Prüfen, ob auf der "EditHotels"-Seite der "erstelleHotel-submit"-Button gedrückt wurde.*/
       include("connectDB.php");

       if(isset($_POST["checkbox2"])) {
           $innenstadt = 1;
       }
       else {
           $innenstadt = 0;
       }
/*Die Checkboxen stellen die Filterattribute dar, die der User auswählen kann, welche sein Hotel besitzt. Wenn der User ein Attribut auswählt wird
  dies durch isset() geprüft und das entsprechende Attribut wird auf 1 gesetzt und in der entsprechenden Variablen gespeichert. Wenn die
  Checkbox nicht ausgewählt wird, so wird die Variable auf 0 gesetzt.
  Diese Variable wird später verwendet um ein SQL Statement vorzubereiten, welches den User Input an die Datenbank sendet.*/
       if(isset($_POST["checkbox3"])) {
        $ac = 1;
    }
    else {
        $ac = 0;
    }
    if(isset($_POST["checkbox4"])) {
        $hotel = 1;
    }
    else {
        $hotel = 0;
    }
    if(isset($_POST["checkbox5"])) {
        $stornierung = 1;
    }
    else {
        $stornierung = 0;
    }
    if(isset($_POST["checkbox6"])) {
        $meerblick = 1;
    }
    else {
        $meerblick = 0;
    }
    if(isset($_POST["checkbox7"])) {
        $allInclusive = 1;
    }
    else {
        $allInclusive = 0;
    }
    if(isset($_POST["checkbox8"])) {
        $haustierfreundlich = 1;
    }
    else {
        $haustierfreundlich = 0;
    }
    if(isset($_POST["checkbox9"])) {
        $kueche = 1;
    }
    else {
        $kueche = 0;
    }
    if(isset($_POST["checkbox10"])) {
        $pool = 1;
    }
    else {
        $pool = 0;
    }
    if(isset($_POST["checkbox11"])) {
        $casino = 1;
    }
    else {
        $casino = 0;
    }
    if(isset($_POST["checkbox12"])) {
        $wlan = 1;
    }
    else {
        $wlan = 0;
    }
    if(isset($_POST["checkbox13"])) {
        $whirlpool = 1;
    }
    else {
        $whirlpool = 0;
    }
    if(isset($_POST["checkbox14"])) {
        $wellness = 1;
    }
    else {
        $wellness = 0;
    }
    if(isset($_POST["checkbox15"])) {
        $fruehstueck = 1;
    }
    else {
        $fruehstueck = 0;
    }
    if(isset($_POST["checkbox16"])) {
        $barrierefrei = 1;
    }
    else {
        $barrierefrei = 0;
    }
       
       
       $hName = mysqli_real_escape_string($conn,$_POST["Hotelname"]);
       $straße = mysqli_real_escape_string($conn,$_POST["Straße"]);
       $hausnummer = mysqli_real_escape_string($conn,$_POST["Hausnummer"]);
       $plz = mysqli_real_escape_string($conn,$_POST["PLZ"]);
       $ort = mysqli_real_escape_string($conn,$_POST["Ort"]);
       $telefonnummer = mysqli_real_escape_string($conn,$_POST["Telefonnummer"]);
       $email = mysqli_real_escape_string($conn,$_POST["Email"]);
       $steuernummer = mysqli_real_escape_string($conn,$_POST["Steuernummer"]);
       $nachbarschaft = mysqli_real_escape_string($conn,$_POST["Nachbarschaft"]);
       $beschreibung = mysqli_real_escape_string($conn,$_POST["Beschreibung"]);
       $preis = mysqli_real_escape_string($conn,$_POST["Preis"]);
       $personen = mysqli_real_escape_string($conn,$_POST["Personen"]);
       $sterne = mysqli_real_escape_string($conn,$_POST["Sterne"]);
       $inhaber = $_SESSION["userID"];

/*Variablen, welche später im Skript verwendet werden, um das SQL-Statement zum senden der Hoteldaten des Users an die Datenbank zu übergeben,
  werden hier initialisiert mit der Superglobalen $_POST, welche den Userinput speichert sobald dieser auf der "EditHotels"-Seite
  den Hotelerstellen Button betätigt. Um zusätzlichen Schutz vor SQL-Injection zu gewährleisten, wird der Userinput mit der Methode 
  mysqli_real_escape_string() initialiesiert, welche bestimmte Zeichen aus einem String entzieht.*/

       $file = $_FILES["file"];

       $fileName = $file["name"];
       $fileTmpName = $file["tmp_name"];
       $fileSize = $file["size"];
       $fileError = $file["error"];
/*Durch "file"-submit Formular wird immer über die passende Superglobale Variable $_FILES die vom User übergebene Datei ausgewählt.
  und die Namen, temporären Namen, Größe und Fehler werden in Variablen gespeichert.*/
       $fileExt = explode(".", $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array("jpg", "jpeg", "png");
/*Erlaubte Dateiformate als String in einem Array gespeichert.*/
        if(in_array($fileActualExt, $allowed)) {
            /*Prüfen, ob Datei das richtige Format besitzt.*/
            if($fileError === 0) {
                /*Prüfen, ob Datei Fehlerhaft ist.*/
                if($fileSize < 1000000000) { 
                    /*Maximale Größe der Datei.*/                                  
                        $fileNameNew = uniqid("", true).".".$fileActualExt;
                        /*Bildernamen werden einzigartig gemacht, damit immer die richtigen Bilder angezeigt werden.*/
                        $fileDestination = "../images/".$fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);
                        /*Ort wo Bild gespeichert wird, wird bestimmt und danach wird das Bild an den Ort gesendet mit 
                          move_uploaded_file.*/
                        
                }
                else {
                    header("Location: ../inhaberfinder/editHotels.php?error=dateizugroß");
                    echo "Die Datei ist zu groß, nur bis zu 100mb!";
                    exit();
                } 
                 /*Wenn Datei zu groß ist Fehlermeldung.*/       
            }
            
            else {
                header("Location: ../inhaberfinder/editHotels.php?error=fehlerbeimhochladenderdatei");
                echo "Fehler beim hochladen der Datei!";
                $_SESSION["errorHandling"] = $file["error"];
                exit();
            }
            /*Wenn Fehler beim Hochladen aufgetreten sind.*/
        }
        else {
            header("Location: ../inhaberfinder/editHotels.php?error=falschesformatNurJPGJPEGoderPNG");
            echo "Nur Bilder in jpg, jpeg oder png erlaubt.";
            exit();
        }
        /*Wenn falsches Format gewählt wurde für Bild.*/


       if(empty($hName)||empty($straße)||empty($hausnummer)||empty($plz)||empty($ort)||empty($telefonnummer)||empty($email)||empty($steuernummer)||empty($nachbarschaft)||empty($beschreibung)||empty($preis)||empty($personen)) {
        header("Location: ../inhaberfinder/editHotels.php?error=emptyfields&Hotelname=".$hName."&Mail=".$email."&Straße=".$straße."&Tlf=".$telefonnummer."&Steuernummer=".$steuernummer);
        exit();
    }
/*Prüfen, ob der User überhaupt etwas in das Formular geschrieben hat(also ob die Inputs leer sind) mit der Methode "empty()", welche prüft, ob die Variablen,
  welche als Parameter übergeben wurden Werte enthalten. Wenn einer der Variablen leer ist wird der User zur editHotels.php Seite zurück geleitet mit der ID des
  Hotels und der Fehlermeldung "emptyfields"*/
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)&&!preg_match("/^[a-zA-Z0-9]*$/", $hName)) {
        header("Location: ../inhaberfinder/editHotels.php?error=invalidEmailHotelname");
        exit();
    }
/*Prüfen, ob der User eine gültige Email und Hotelnamen angegeben hat. Wenn er keinen davon gültig angegeben hat, wird er zurück geleitet zur "editHotels.php"
  und es wird die Fehlermeldung "invalidEmailNameVorname" an die URL weitergegeben.*/
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../inhaberfinder/editHotels.php?error=invalidEmail&Name=".$hName."&Straße=".$straße."&Tlf=".$telefonnummer."&Steuernummer=".$steuernummer);
        exit();
    }
/*Mit der Funktion "filter_var" wird die Eingabe des Users seiner Email gefiltert und geprüft, ob diese eine gültige Email ist. Der erste Parameter
  ist die Emaileingabe des Users, welche durch Superglobale $_POST übergeben wurde. Es folgt ein schon vorbereiteter Parameter, welcher checkt, ob
  die Email richtig angegeben wurde, man muss sich dafür kein Muster selbst überlegen wie beim Namen.*/

    elseif(($sterne>5)||($sterne<0)) {
        header("Location: ../inhaberfinder/editHotels.php?error=falscheSterneAnzahl");
        exit();
    }
/*Prüfen, ob der User eine Zahl von 0-5 für die Sternanzahl des Hotels angegeben hat. Wenn nicht, wird er zur "editHotels"-Seite zurück geleitet 
  mit der Hotel ID und der Fehlermeldung "falscheSterneAnzahl" in der URL.*/
    
    else {
        $sqlEmailCheck = "Select email from Hotel where email=?";
/*Hier wird ein neues SQL-Statement initialisiert, welches nur den Zweck hat zu suchen, ob  die Email, welche vom User angegeben wird bereits
  vorhanden ist in der Datenbank*/
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sqlEmailCheck)) {
            header("Location: ../inhaberfinder/editHotels.php?error=sqlerrorbra");
        exit();
/*Wenn das SQL Statement nicht verarbeitet werden kann, wird der User zur editHotels-Seite geleitet mit der sqlerrorbra Fehlermeldung in der URL
  zurückgegeben.*/
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
/*Mit der Funktion "mysqli_stmt_num_rows()" und den dazugehörigen Parameter der Datenbankverbindung, werden nun die Ergebniszeilen des SQL
  Statements in der Datenbank gezählt und in der Variablen $resultCheck gespeichert.*/
            if($resultCheck > 0) {
                header("Location: ../inhaberfinder/editHotels.php?error=emailbereitsvergeben");
                exit();
            }
/*Wenn es mehr als Null Ergebnisse in der Suche gab, dann wird nun der User auf die "myAccount"-Seite zurückgeleitet mit seiner ID und der 
  Fehlermeldung "emailbereitsvergeben in der URL, welche später noch über Superglobale $_GET aus der URL genommen wird für Fehlermeldung
  auf dem Bildschirm.*/

            else {
                   
                $sql = "Insert Into Hotel (hotelname,straße,hausnummer,ort,plz,telefonnummer,email,verifiziert,steuernummer,nachbarschaft,beschreibung,preis,zimmeranzahl,sterne,innenstadt,ac,hotel,stonierung_kostenlos,meerblick,all_inclusive,haustierfreundlich,kueche,pool,casino,wlan,whirpool,welness,fruehstueck,barrierefrei,wid,bild) values(?,?,?,?,?,?,?,1,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $stmt = mysqli_stmt_init($conn);
/*Initialisiert  ein neues Statement und referenziert auf die Datenbankverbindung, welche mit include früher eingebunden wurde. Es werden vorbereitete 
  SQL-Statements verwendet, damit User nicht in der Lage sind die Datenbank mit Code in der Inputzeile zu zerstören(SQL-Injection)*/
                if(!mysqli_stmt_prepare($stmt, $sql)) {
/*Bereitet das Statement vor und nimmt dabei die Variablen für die Datenbankverbindung und des SQL-Statements entgegen.*/
                    header("Location: ../inhaberfinder/editHotels.php?error=sqlerror");
                exit();
                }
                else {
                    

                    mysqli_stmt_bind_param($stmt, "sssssissssdiiiiiiiiiiiiiiiiiis",$hName,$straße,$hausnummer,$ort,$plz,$telefonnummer,$email,$steuernummer,$nachbarschaft,$beschreibung,$preis,$personen,$sterne,$innenstadt,$ac,
                    $hotel,$stornierung,$meerblick,$allInclusive,$haustierfreundlich,$kueche,$pool,$casino,$wlan,$whirlpool,$wellness,$fruehstueck,$barrierefrei,$inhaber,$fileNameNew);
/*Verbindet die Usereingaben, welche in den entsprechenden Variablen gespeichert, welche die Hotelattribute sind wie z.B. Namen, Filterattribute, Bild usw... mit dem Statement, um die Informationen des Users an die Datenbank weiterzugeben. "si" z.B.
  steht für die Datentypen der Userinformationen s=String(für den Hotelnamen), i=int(für die Telefonnummer z.B.). Danach folgen die Usereingaben als Parameter in 
  Variablen.*/
                    mysqli_stmt_execute($stmt);
/*Führt das Statement mit den Usereingaben in der Datenbank aus.*/
                    header("Location: ../inhaberfinder/editHotels.php?success=hotelerfolgreichhinzugefügt");
                exit();
                    
                }
/*Der User wird zur editHotels-Seite geleitet mit der Erfolgsmeldung "hotelerfolgreichhinzugefügt" in der URL.*/
             
         
            }
        }
    }
    mysqli_stmt_close($stmt);
       mysqli_close($conn);
/*SQL-Statement und Datenbankverbindung werden geschlossen.*/
    

}
else {
    //header("Location: edithotels.php");
    exit();
/*Verlässt Skript.*/

} 