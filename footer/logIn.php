<?php session_start();
/*Session wird gestartet, um auf Daten wie Sessionvariablen der Superglobalen $_SESSION zugreifen zu können.*/ ?>
<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width">
      <title>Log In</title>
      <link rel="stylesheet" type="text/css" href="../stylesheets/stylesheet.css">
      <script src="https://kit.fontawesome.com/b4d54f0eb8.js" crossorigin="anonymous"></script>
      <link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Righteous&display=swap" rel="stylesheet">
      <?php include("../PhpStuff/connectDB.php"); 
      /*Skript für die Datenbankserververbindung einbinden, um SQL Befehle zu starten.*/?>
  </head>
  <body class="hotelfinder">
      <div class="logoHotelfinder">
        <a href="../index.php"><img src="../images/logo.png" style="height:70px"></a>
      </div>
      <div id="wrapper">
        <div class="shell">
          <div class="register">
            <div class="registerTopic" style="text-align: center">
              <?php if(isset($_SESSION["userEmail"])) { ?>
              <?php echo "<p>".$_SESSION["userEmail"]."</p>";?>
              <form method="post" action="../PhpStuff/inhaberLogout.php">
                <button type="submit" id="logoutButton"class="button1" name="logout-submit">Logout</button>
              </form>
              <?php }
              else { ?>
              <p4>Log-In</p4>
            </div>
            <form method="post" action="../PhpStuff/inhaberLogin.php">
            <!-- Aufteilung des Blocks in zwei Teile: Links|Rechts -->
              <div class="registerLeftRight">
                <div class="registerLeft">
                  <input type="text" class="here" name="emailLogin" placeholder="E-mail..." required>
                </div>
                <div class="registerRight">
                  <input type="password" name="pwd" placeholder="Passwort..." required>
                </div>
              </div>
              <!-- Bereich Für die Knöpfe -->
              <div class="buttonHolder" style="margin-top: 2%">
                <button type="submit" id="loginButton" class="button1" name="login-submit">Login</button>
              </div>
            </form>
            <?php
            if((isset($_GET["Success"]))||(isset($_GET["success"]))) {
              if($_GET["Success"]=="AccountGelöscht") {
                echo "Account von ".$_SESSION["deletedVorname"]." ".$_SESSION["deletedName"]." wurde gelöscht!";
              }
            } 
            /*Wenn in der URL "Success" steht und es mit "AccountGelöscht" verbunden wird, so wird die Erfolgsmeldung Account von Vorname Name wurde gelöscht!".*/
            ?>
            <p4>Sie haben noch kein Konto?</p4>
            <div class="buttonHolder" >
              <a href="register.php" ><button type="submit" name="login-submit" class="button1">Registrieren</button></a>
              <?php 
                if(isset($_GET["error"])) {
                  if($_GET["error"]=="emptyfields") {
                    echo "<p>Bitte alle Felder ausfüllen!</p>";
                  } elseif($_GET["error"]=="wrongpwd") {
                    echo "<p>Angegebenes Passwort ist falsch!</p>";
                  }
                  elseif($_GET["error"]=="nouser") {
                    echo "<p>Email nicht vorhanden!</p>";
                  }
                  elseif($_GET["error"]=="wrongEmailOrPwd") {
                    echo "<p>Falsche Email oder Passwort!</p>";
                  }
                }
                /*Fehlermeldungen werden mit Superglobalen $_GET in URL auf der Seite ausgegeben.*/
                if(@$_GET["login"]=="success") {
                  echo "<p>Erfolgreich eingeloggt!</p>";
                }
                /*Erfolgsmeldung für erfolgreiches Einloggen.*/
              ?>
            </div>
            <?php 
            }    
            ?>
          </div>
        </div>
        <footer style="margin-top: 0;">
          <a href="logIn.php">Anmeldung für Hotelbesiter</a><a href="agb.html" style="text-decoration: none;">Allgemeine Geschäftsbedingungen</a><a href="copyright.html" style="text-decoration: none;">Copyright</a>
          <p>Kontakt: <a href="info.hotelfinder@web.de">service@hotelfinder.com</a></p>
        </footer>
        </div>
      </body> 
</html>
