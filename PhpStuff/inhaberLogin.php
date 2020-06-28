<?php

if(isset($_POST["login-submit"])) {
/*Prüfen, ob auf "logIn" oder "myHotels"-Seite der "login-submit"-Button betätigt wurde.*/

    include("connectDB.php");
/*Bindet Datei mit Datenbank Verbindung in das aktuelle Dokument ein, um eine Datenbankverbindung zu gewährleisten.*/
    $uri = $_SERVER["HTTP_REFERER"]; 
/*URL der letzten geöffneten Seite wird in der Variablen $uri gespeichert.*/

    $mail = $_POST["emailLogin"];
    $password = $_POST["pwd"];
/*Usereingaben werden mit Hilfe der Superglobalen $_POST in den entsprechenden Variablen gespeichert, um diese später im Skript
  für vorbereitete SQL Statements zu verwenden.*/

    if(empty($mail)|| empty($password)) {
        $uri = "../footer/logIn.php";
        header("Location:".$uri."?error=emptyfields");
        exit();
    }
 /*Prüfen, ob der User überhaupt etwas in das Formular geschrieben hat(also ob die Inputs leer sind) mit der Methode "empty()", welche prüft, ob die Variablen,
   welche als Parameter übergeben wurden Werte enthalten. Wenn einer der Variablen leer ist wird der User zur logIn.php Seite zurück geleitet mit 
   der Fehlermeldung "emptyfields"*/
    else {
        $sqlEmailLogin = "select * from Inhaber where email=?";
/*SQL Statement für die Suche nach der Email die bei der Registrierung angegeben wurde, um sich erfolgreich damit einzuloggen. Man loggt
  sich mit Email und Passwort ein.*/
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sqlEmailLogin)) {
            
            header("Location: ../footer/register.php?error=sqlerror");
            exit();
        }
        else {

            mysqli_stmt_bind_param($stmt, "s", $mail);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)) {
                $pwdCheck = password_verify($password, $row["password"]);
/*Beim Registrieren eines Users wird sein Passwort gehasht wird, damit es nicht in der Datenbank sichtbar ist, überprüft die Methode
  password_verify(), ob das Passwort, welches von User im logIn eingegeben wurde in der Variablen $password wird dem gehashten Passwort
  aus der Datenbank($row["password"]) übereinstimmt.*/
                if($pwdCheck== false) {

                    if($row["geloescht"]==0) {

                    $uri = "../footer/logIn.php";
                    header("Location:".$uri."?error=wrongpwd");
                    exit();
                    }
                    else {
                        $uri = "../footer/logIn.php";
                            header("Location:".$uri."?error=wrongEmailOrPwd");
                            exit();
                    }
/*Wenn die Passwörter nicht übereinstimmen, wird erstmal überprüft, ob der Account bereits gelöscht wurde, das ist der Fall, wenn in der Spalte
  "geloescht" der Tabelle Inhaber eine 1 steht. Wenn der Account noch nicht gelöscht wurde wird der User zur logIn-Seite zurück geleitet und
  die Fehlermeldung "wrongpwd" wird in der URL zurück gegeben. Wenn der Account bereits gelöscht wurde bekommt er die Fehlermeldung 
  "wrongEmailOrPwd".*/
                }
                elseif($pwdCheck== true) {

        
                        if($row["geloescht"]==0) {

                    session_start();
                    $_SESSION["userID"] = $row["wid"];
                    $_SESSION["userEmail"] = $row["email"];
/*Wenn die Passwörter übereinstimmen, wird erstmal wieder geprüft, ob der Account bereits gelöscht wurde. Danach wird ein neue Session gestartet,
  um auf die Session Variablen userID und userEmail zu erstellen und damit der User auf seine persönlichen Daten zugreifen kann, wie z.B. auf
  "myHotels.php" seine eigenen eingestellten Hotels einzusehen.*/

                    header("Location:../inhaberfinder/myHotels.php?login=success");
                    exit();
                        }
                        else {
                            $uri = "../footer/logIn.php";
                            header("Location:".$uri."?error=wrongEmailOrPwd");
                            exit();
                        }
                }
/*Wenn der Account bereits gelöscht wurde, dann wird der User auf logIn.php zurück geleitet mit der Fehlermeldung "wrongEmailOrPwd" in der URL.*/
                else {

                    if($row["geloescht"]==0) {

                    $uri = "../footer/logIn.php";
                    header("Location:".$uri."?error=wrongpwd");
                    exit();
                    }
                    else {
                        $uri = "../footer/logIn.php";
                            header("Location:".$uri."?error=wrongEmailOrPwd");
                            exit();
                    }
                }
            }
            else {
                $uri = "../footer/logIn.php";
                header("Location:".$uri."?error=nouser");
                exit();
            }
/*Wenn in der Datenbank durch das SQL-Statement kein User mit der eigegebenen Email gefunden wurde, dann wird der User auf logIn.php geleitet
  mit der Fehlermeldung in der URL "nouser".*/
        }
    }

}
else {
    //header("Location: register.php");
    exit();
}
?>
