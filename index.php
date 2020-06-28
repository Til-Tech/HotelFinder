<?php session_start();
/*Session wird gestartet, um auf Daten wie Sessionvariablen der Superglobalen $_SESSION zugreifen zu können.*/ ?>
<!DOCTYPE html>
<html>
  <head>
    <!-- <meta>-tag gibt dem Browser Anweisungen zum Steuern der Abmessungen und Skalierung der Seite.
    charset="utf-8" legt die Zeichenkodierung für das HTML-Dokument fest -->
    <meta charset="utf-8">
    <!-- width=device-width legt Breite der Seite fest, die Bildschirmbreite des Geräts folgt (je nach Gerät unterschiedlich).
    initial-scale=1.0 legt die anfängliche Zoomstufe fest, wenn die Seite zum ersten Mal vom Browser geladen wird --> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <!-- Favicon gibt das Weblogo an -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <title>Hotelfinder.com</title>
    <!-- Cache-Control regelt hier den Caching-Mechanismus, der sonst zB. evtl veraltete Stylesheets einlädt -->
    <meta HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
    <link rel="stylesheet" type="text/css" href="../stylesheets/stylesheet.css">
    <!-- JavaScript zum Einbinden von Sondersymbolen (hier Lupe) der Website fontawesome.com -->
    <script src="https://kit.fontawesome.com/b4d54f0eb8.js" crossorigin="anonymous"></script>
    <!-- Einbindung einer externen Schriftart mithilfe von fonts.googleapis.com -->
    <link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Righteous&display=swap" rel="stylesheet">
    <?php include("PhpStuff/connectDB.php"); ?>
    <script> // JavaScript zum Wechseln einer belibigen Anzahl an Bildern
      var myIndex = 0;
      function carousel() {
        var i;
        var x = document.getElementsByClassName("mySlides");
        for (i = 0; i < x.length; i++) {
          x[i].style.display = "none";
        }
        myIndex++;
        if (myIndex > x.length) {myIndex = 1}
        x[myIndex-1].style.display = "block";
        setTimeout(carousel, 2000); // Wechselt das Bild alle 2 Sekunden
      }
    </script>
  </head>
  <body id="eins">
  <!-- Container für die zudurchlaufenden Hintergrundbilder -->
  <div id="backgroundSlider"> 
      <img class="mySlides" src="../images/1.jpg" id="hintergrundBilder">
      <img class="mySlides" src="../images/2.jpg" id="hintergrundBilder">
      <img class="mySlides" src="../images/3.jpg" id="hintergrundBilder">
      <img class="mySlides" src="../images/5.jpg" id="hintergrundBilder">
      <img class="mySlides" src="../images/6.jpg" id="hintergrundBilder">
      <img class="mySlides" src="../images/7.png" id="hintergrundBilder">
      <img class="mySlides" src="../images/8.jpg" id="hintergrundBilder">
      <img class="mySlides" src="../images/9.jpg" id="hintergrundBilder">
      <script>//aufrufen der Funktion
        carousel();
      </script>
    </div>
    <!-- Logo-Container -->
    <div class="logo" id="zwei" style="opacity:1.0;">
      <a href="index.php"><img src="../images/logo.png" style="height:70px"></a>
    </div>
    <!-- Wrapper-Container der den restlichen Teil der Seite umschließt -->
    <div id="wrapper" id="drei">
      <!-- Shell-Container beschreibt hier den Bereich zwischen Anfang des Wrapper bis zum Anfang des Footers -->
      <div class="shell" id="zentriert" style="flex-wrap: wrap; margin-top:0%;">
        <!-- Container zum anordnen der Suchleiste -->
        <div id="zentriert" style="width: 100%; margin-top:0%; padding-left: 38%">
          <!-- Register-Container hier für den hintergrund der Suchleiste -->
          <div class="register" id="grey" style="width:36%;">
            <!-- registerTopic-Container zum zentrieren des Inputfeldes  -->
            <div class="registerTopic">
              <form method="post" autocomplete="off">
                <!-- searchBar zum finalen stylen der Suchleiste -->
                <div class="searchBar">
                  <input type="text" name="cityName" class="searchText" placeholder="Dein Wunschziel..." />
                  <a name="cityName" class="searchBtn"><i class="fas fa-search"></i></a>
                </div>
              </form>
            <?php
              include("PhpStuff/connectDB.php");
              /*Skript für die Datenbankserververbindung einbinden, um SQL Befehle zu starten.*/
              if(isset($_POST["cityName"])) {
              /*Prüfen, ob Superglobale $_POST gesetzt wurde(die Suche bestätigt wurde).*/
              $cityFound = false;
              }
              $sql = "Select ort FROM Hotel GROUP BY ort";
              /*Sql Statement wird als String in der $sql Variablen initialisiert. Die Abfrage ist dazu da, um den Ort der Ergebniszeilen
                weiterzuverarbeiten.*/
              $result = mysqli_query($conn, $sql);
              /*Führt die SQL Abfrage aus.*/
              $result_check = mysqli_num_rows($result);
              /*Ergebniszeilen werden gezählt und in $result_check gespeichert.*/
              if ($result_check>0) {
              /*Wenn es Ergebnisse gibt, dann wird der nachfolgende Code ausgeführt.*/
                while($cityNames = mysqli_fetch_assoc($result)) {
              /*Die Ergebniszeilen der Sql Abfrage werden im assoziativen Array $row gespeichert.*/
                  if((@substr_count(strtoupper($cityNames['ort']),strtoupper(@$_POST["cityName"])))&&(stristr(strtoupper($cityNames['ort']),$_POST["cityName"])==strtoupper($cityNames['ort']))) {
                    $cityFound = true;
                  }
              /*substr_count() sucht nach einem String in einem anderem String, das wird weiterhin mit anderen Kombinationen an Bedingungen
                mit strtoupper() und stristr() ausgeführt, um einen möglichst genauen Wortfilter zu gewährleisten.*/ 
                }
              }
            ?>
            </div>
          </div>
        </div>
        <?php
            if(isset($_POST["cityName"])) {
              if($cityFound) {
                $_SESSION["userCity"] = $_POST["cityName"];
            /*Die vom User eingegebene Stadt wird nochmal in einer Session Variablen gespeichert, um diese auf der Ergebnisseite
              wieder zuverwenden.*/
                unset($_POST["cityName"]);
                header('Location: hotelfinder/results.php');
                exit();
              }
              else {
                echo "<div id=\"fehlerMeldung\">Es wurden keine passenden Ergebnisse gefunden!</div>";
            /*Wenn es keine Ergebnisse gab, dann wird die Fehlermeldung ausgegeben.*/
              }
            }
            ?>
      </div>
      <?php if(!isset($_SESSION["userEmail"])) { ?>
      <!-- Footer-Klasse mit Hyperlinks zur Weiterleitung -->
      <footer>
          <a href="footer/logIn.php">Anmeldung für Hotelbesiter</a><a href="footer/agb.html" style="text-decoration: none;">Allgemeine Geschäftsbedingungen</a><a href="footer/copyright.html" style="text-decoration: none;">Copyright</a>
          <p>Kontakt: <a href="mailto:info.hotelfinder@web.de">service@hotelfinder.com</a></p> <!-- [mailto] leitet den User auf sein Mailprogramm weiter -->
      </footer> 
      <?php 
      }
      else { ?>
        <footer>
          <a href="inhaberfinder/myHotels.php">Anmeldung für Hotelbesiter</a><a href="footer/agb.html" style="text-decoration: none;">Allgemeine Geschäftsbedingungen</a><a href="footer/copyright.html" style="text-decoration: none;">Copyright</a>
          <p>Kontakt: <a href="info.hotelfinder@web.de">service@hotelfinder.com</a></p>
      </footer>
      <?php } ?>
    </div>
  </body>
</html>
