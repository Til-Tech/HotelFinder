<?php session_start();
/*Session wird gestartet, um auf Daten wie Sessionvariablen der Superglobalen $_SESSION zugreifen zu können.*/ ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico">
    <title>Hoteldetails - HotelFinder</title>
    <link rel="stylesheet" type="text/css" href="../stylesheets/stylesheet.css">
    <script src="https://kit.fontawesome.com/b4d54f0eb8.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Righteous&display=swap" rel="stylesheet">
    <script>
      var slideIndex = 1;
      showDivs(slideIndex);
      function changePic(n) {
        showDivs(slideIndex += n);
      }
      function showDivs(n) {
        var i;
        var x = document.getElementsByClassName("slider");
        if (n > x.length) {slideIndex = 1}
        if (n < 1) {slideIndex = x.length}
        for (i = 0; i < x.length; i++) {
          x[i].style.display = "none";
        }
        x[slideIndex-1].style.display = "block";
        setTimeout(carousel, 2000);
      }
    </script>
    <style>
      #bilderslider{
        height:20%;
        margin:2%;
        padding: 2% 5% 2% 5%;
        width:auto;
        max-width:100%;
        height:20%;"
      }
      .slider {
        width:auto;
        height: 350px;
        display: none;
        position:relative;
        margin: 0 auto;
        border-radius: 0.8em;
      }
      .element{
        background-color: #CCCCCC;
        margin: 5%;
        margin-top: 2%;
        padding: 2% 5% 2% 5%;
        width:100%;
        height:100%;
      }
      #nameandprice{
        height:10%;
        margin:2%;
        padding: 2% 5% 2% 5%;
      }
      #hoteltitle{
        width:75%;
        float:left;
        background-color: #999999;
        text-align: center;
        border-radius: 25px;
      }
      #hoteltitle h1{
        font-size: 300%;
        color: white;
      }
      #hotelcontainer{
        float: left;
        margin-left: 10%;
        text-align: center;
        width: 60%
      }
      #starcontainer{
        width: 20%;
        float: right;
        margin-top: 7% ;
        margin-right: 10%;
        text-align: center;
        color: #FFD700;
      }
      #buchenbuttons{
        width:14%;
        float:right;
      }
      #buchencontainer{
        float: right;
        text-align: center;
      }
      #buchencontainer h1{
        font-size: 400%;
        color: #333333;
        margin: 5% 15% 5% 10%;
      }
      #beschreibung{
        height:auto;
        margin:5%;
        padding: 5% 2.5% 2% 2.5%;
      }
      #beschreibung_links{
        float: left;
        width: 45%;
        padding: 1% 2.5% 2% 2%;
      }
      #adressecontainer{
        background-color: #6BBF59;
        text-align: center;
        padding: 1%;
        margin-bottom: 10%;
        border-radius: 25px;
        border: #000000 1px solid;
      }
      #beschreibung_rechts{
        float: right;
        width: 45%;
        padding: 1% 2% 2% 2.5%;
      }
      #pricecontainer{
        width: 100%;
        height: 15%;
        float: right;
      }
      #price{
        float: right;
        padding:5% 10% 5% 10%;
        width:100%;
      }
      #price h1{
        background-color: #999999;
        text-align: center;
        color: white;
        width: 40%;
        float: right;
        border-radius: 25px;
      }
      #beschreibungtable{
        width: 100%;
        margin-bottom: 2%;
      }
      #nachbarschafttable{
        width: 100%;
        margin-bottom: 2%;
      }
      #backbutton{
        width: 100%;
        margin-top: 5%;
      }
      #containerbutton{
        float: right;
        padding: 2%;
        width:35%;
        border-radius: 25px;
        background-color: #333333;
      }
      .backbutton{
        text-align: center;
        color: white;
      }
      #wertecontainer{
      }
      #werte{
        width: 98%;
        align-items: center;
      }
      .wert{
        font-size: 50%;
      }
    </style>
  </head>
  <body class="hotelfinder">
    <!-- Logo -->
    <div class="logoHotelfinder">
      <a href="../index.php"><img src="../images/logo.png" style="height:70px"></a>
    </div>
    <!-- Div-Container, welcher außer dem Logo alles beinhaltet -->
    <div id="wrapper">
      <!-- klassische Php Abfrage - Zwei Abfragen, damit die Bilder gesondert angefordert werden-->
      <?php
        if(isset($_GET["ID"])) {
          /*Prüfen, ob ID in der URL existiert, welche verwendet wird um das richtige Hotel zu buchen.*/
          include("../PhpStuff/connectDB.php");
          /*Skript für die Datenbankserververbindung einbinden, um SQL Befehle zu starten.*/
          $sql = "Select * From Hotel where hid = ${_GET["ID"]}";
          /*Sql Statement wird als String in der $sql Variablen initialisiert. Die Abfrage ist dazu da, um das richitge Hotel auf das geklickt wurde 
            anzuzeigen.*/
          $bql = "Select * From Bilder where hid = ${_GET["ID"]} AND geloescht!= 1";
          $result = mysqli_query($conn,$sql);
          $besult = mysqli_query($conn,$bql);
          /*Führt die SQL Abfrage aus.*/
          if(mysqli_num_rows($result)>0) {
            while($row = mysqli_fetch_assoc($result)) { ?>
      <div class="main">
        <div class="element">
          <!-- Bildslider - Titelbild aus $SQL, Bilder aus Bildertabelle mit $BQL-->
          <div id="bilderslider">
            <img class="slider" src="../images/<?php echo $row["bild"];?>" style="display:block;">
            <?php
              if(mysqli_num_rows($besult)>0) {
                /*Wenn die Abfrage Ergebnisse liefert, dann wird der nachfolgende Code ausgeführt.*/
                while($bow = mysqli_fetch_assoc($besult)) { ?>
                  <img class="slider" src="../images/<?php echo $bow["bilderName"];?>">
            <?php }} ?>
            <button class="button display left" onclick="changePic(-1)" style="float:left;">&#10094;</button>
            <button class="button display right" onclick="changePic(1)" style="float:right;">&#10095;</button>
          </div>
          <div id="nameandprice">
            <!-- zweiter Container - enthält Name, Sterne und Preis -->
            <div id="hoteltitle" >
              <div id="hotelcontainer">
                <h1><?php echo $row["hotelname"]; ?></h1>
              </div>
              <div id="starcontainer">
                <?php for($i=0; $i<$row["sterne"]; $i++){ ?>
                  <i class="fas fa-star"></i>
                <?php } ?>
              </div>
            </div>
            <div id="buchenbutton">
              <div id="buchencontainer">
                <a href="buchen.php?ID=<?php echo $row["hid"]?>" style="color:black;"><h1>Buchen</h1></a>
              </div>
            </div>
          </div>
          <div id="beschreibung">
            <div id="beschreibung_links">
              <!-- Container für Beschreibugn links-->
              <div id=adressecontainer>
                <div id="adressetable">
                  <p3 style="color:#333333;">
                    <?php
                      echo $row["straße"]." ".$row["hausnummer"].", ".$row["plz"]." ".$row["ort"];
                    ?>
                  </p3>
                </div>
                <div id="telefontable">
                  <a href='tel:<?php echo $row["telefonnummer"]?>'><p3 style="color:#333333;"><?php echo $row["telefonnummer"]?></p3></a>
                </div>
                <div id="emailtable">
                  <a href="mailto:<?php echo $row["email"]?>"><p3 style="color:#333333;"><?php echo $row["email"]?></p3></a>
                </div>
              </div>
              <div id="wertecontainer">
                <div id="werte">
                  <?php
                    $divArray = ["<div class=\"wert\">Sterne</div>","<div class=\"wert\">Innenstadt</div>","<div class=\"wert\">AC</div>","<div class=\"wert\">Hotel</div>","<div class=\"wert\">Stornierung Kostenlos</div>","<div class=\"wert\">Meerblick</div>","<div class=\"wert\">All Inclusive</div>","<div class=\"wert\">Haustierfreundlich</div>","<div class=\"wert\">Küche</div>","<div class=\"wert\">Pool</div>","<div class=\"wert\">Casino</div>","<div class=\"wert\">Wlan</div>","<div class=\"wert\">Whirlpool</div>","<div class=\"wert\">Wellness</div>","<div class=\"wert\">Frühstück</div>","<div class=\"wert\">Barrierefrei</div>"];
                    $keys = array_keys($row);
                    for($i=14; $i<=29; $i++) {
                      $value[] = $row[$keys[$i]];
                    }
                    $divsAndBooleans = array_combine($divArray, $value);
                    $value = array();
                    foreach($divsAndBooleans as $schluessel => $values) {
                      if($values==1) {
                        $finalOutput[] = $schluessel;
                      }
                    }
                    echo implode($finalOutput);
                    $finalOutput = array();
                  ?>
                </div>
              </div>
            </div>
            <div id="beschreibung_rechts">
              <div id="pricecontainer">
                <div id="price">
                  <h1>Preis <?php echo$row["preis"];?>€<h1>
                </div>
              </div>
              <div id="beschreibungtable">
                <p>
                  <?php
                    echo $row["beschreibung"];
                  ?>
                  </br>
                </p>
              </div>
              <div id="nachbarschafttable">
                <p>
                  <?php
                    echo $row["nachbarschaft"];
                  ?>
                </p>
              </div>
              <div id="backbutton">
                <div id="containerbutton">
                  <a href="results.php" class="backbutton">Zurück zur Hotelauswahl</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer>
        <a href="../footer/logIn.php">Anmeldung für Hotelbesiter</a><a href="../footer/agb.html" style="text-decoration: none;">Allgemeine Geschäftsbedingungen</a><a href="../footer/copyright.html" style="text-decoration: none;">Copyright</a>
        <p>Kontakt: <a href="mailto:info.hotelfinder@web.de">service@hotelfinder.com</a></p>
      </footer>
      <?php }}}?>
    </div>
  </body>
</html>
<?php mysqli_close($conn);?>
