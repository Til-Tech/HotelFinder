<?php
    session_start();
    ?>
<!DOCTYPE html>
<html>

<head>
        <meta charset= "utf-8">
        <meta name="viewport" content= "width=device-width, user-scalable=no">
        <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
        <link rel="stylesheet" type="text/css" href="../stylesheets/stylesheet.css">
        <script src="https://kit.fontawesome.com/b4d54f0eb8.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Righteous&display=swap" rel="stylesheet">
        <title>Registrierung</title>
        </head>
    <body class="hotelfinder">
        <div class="logoHotelfinder">
            <a href="../index.php"><img src="../images/logo.png" style="height:70px"></a>
        </div>
        <div id="wrapper">
            <div class="shell">
                <div class="register">
                    <form method="post" action="../PhpStuff/inhaberRegistrieren.php">  
                    <div class="registerTopic">
                        <p4>Registrieren</p4>
                    </div>
                <div class="registerLeftRight">
                    <div class="registerLeft">
                        <div>
                            <p5>Name:</p5>
                            <!-- Eingabefenster vom Typ Text -->
                            <input type="text" name="Name" placeholder="Name" class="here" required>
                        </div>
                        <div>
                            <p5>Vorname:</p5>
                            <input type="text" name="Vorname" placeholder="Vorname" class="here" required>
                        </div>
                        <div>
                            <p5>Passwort:</p5>
                            <!-- Eingabefenster vom Typ Passwort -->
                            <input type="password" name="Passwort" placeholder="Passwort" required>
                        </div>
                        <div>
                            <p5>Passwort Wiederholen:</p5>
                            <input type="password" name="PasswortWdh" placeholder="Passwort Wiederholen" required>
                        </div>
                        <div>
                            <p5>Email:</p5>
                            <input type="text" name="Email" placeholder="Email" class="here" inputmode="email" required>
                        </div>
                    </div>
                    <div class="registerRight">
                        <div>
                            <p5>Straße:</label>
                            <input type="text" name="Straße" placeholder="Straße" class="here" required>
                        </div>
                        <div>
                            <p5>Hausnummer:</p5>
                            <input type="text" name="Hausnummer" placeholder="Hausnummer" class="here" required>
                        </div>
                        <div>
                            <p5>Postleitzahl:</p5>
                            <input type="text" name="PLZ" placeholder="Postleitzahl" class="here" required>
                        </div>
                        <div>
                            <p5>Ort:</p5>
                            <input type="text" name="Ort" placeholder="Ort" class="here" required>
                        </div>
                        <div>
                            <p5>Telefonnummer:</p5>
                            <!-- Eingabefenster vom Typ Nummer -->
                            <input type="number" name="Telefonnummer" placeholder="Telefonnummer" inputmode="tel" required>
                        </div>
                    </div>
                </div>
                <div class="buttonHolder">
                    <button type="submit" name="register-submit"class="button1"  style="margin-top: 20px"><b>Registrieren</b></button>
                    </form>
                </div>

                <?php
                    if(isset($_GET["error"])) {
                        if($_GET["error"]=="invalidEmailNameVorname") {
                            echo "<p>Unerlaubte Zeichen in Email, Name oder Vorname benutzt!</p>";
                        }
                        elseif($_GET["error"]=="invalidEmail") {
                            echo "<p>Unerlaubte Zeichen in Email benutzt!</p>";
                        }
                        elseif($_GET["error"]=="invalidName") {
                            echo "<p>Unerlaubte Zeichen in Name benutzt!</p>";
                        }
                        elseif($_GET["error"]=="invalidVorname") {
                            echo "<p>Unerlaubte Zeichen in Vorname benutzt!</p>";
                        }
                        elseif($_GET["error"]=="passwortCheck") {
                            echo "<p>Passwörter stimmen nicht überein!</p>";
                        }
                        elseif($_GET["error"]=="emailbereitsvergeben") {
                            echo "<p>Email bereits vergeben!</p>";
                        }
                        }
                        elseif(@$_GET["success"]=="registrierungerfolgreich") {
                            echo "<p>Sie haben sich erfolgreich registriert!</p>";
                        }
        /*Wenn Error und die entsprechenden Fehlermeldungen in URL stehen durch Fehler die der User bei der Erstellung seines Accounts
          gemacht hat. Wenn success und registrierungerfolgreich in der URL steht dann wird entsprechend über Superglobale $_GET 
          eine Erfolgsmeldung ausgegeben.*/
                ?>

                <p4>Sie haben bereits ein Konto?</p4>
                <div class="buttonHolder">
                    <a href="logIn.php"><button type="submit" name="login-submit"class="button1"><b>Login</b></button></a>
                </div>
                </div>
        </div>
            <footer style="margin-top: 0;">
                <a href="logIn.php">Anmeldung für Hotelbesiter</a><a href="agb.html" style="text-decoration: none;">Allgemeine Geschäftsbedingungen</a><a href="copyright.html" style="text-decoration: none;">Copyright</a>
                <p>Kontakt: <a href="info.hotelfinder@web.de">service@hotelfinder.com</a></p>
            </footer>
        </div>
    </body>
</html>
