<?php
  session_start();
  /*Session wird gestartet, um auf Daten wie Sessionvariablen der Superglobalen $_SESSION zugreifen zu können.*/
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico">
    <title>Ergebnisse</title>
    <link rel="stylesheet" type="text/css" href="../stylesheets/stylesheet.css">
    <script src="https://kit.fontawesome.com/b4d54f0eb8.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Righteous&display=swap" rel="stylesheet">
    <?php include("../PhpStuff/connectDB.php");
    /*Skript für die Datenbankserververbindung einbinden, um SQL Befehle zu starten.*/ ?>
  </head>
  <body class="hotelfinder">
    <div id="page-container">
      <div class="logoHotelfinder">
        <a href="../index.php"><img src="../images/logo.png" style="height:70px"></a>
      </div>
        <div id="wrapper">
          <div class="main">
            <!-- Filter-Container, welche alle Attribute, Sternenauswahl und die Suchleite enthält -->
            <div class="filter">
              <p3>Filter</p3>
              <div id="cover">
                <form method="post" autocomplete="off">
                  <!-- Methode um die Stadt in der Suchleiste anzuzeigen, bzw. den richhtigen Placeholder zu präsentieren -->
                  <input type="text" id="name" name="resultCity" class="searchText" value="<?php
                  $content=TRUE;
                  if(isset($_SESSION["userCity"])){
                    echo $_SESSION["userCity"];
                  }else if(isset( $_POST["resultCity"])){
                    echo $_POST["resultCity"];
                  }else{
                    echo "";
                    $content=FALSE;
                  } ?>" placeholder="<?php
                  if($content){
                    echo "";
                  }else{
                    echo"Ihr Wunschziel...";
                  } ?>" required>
                  <a class="searchBtn">
                    <i class="fas fa-search"></i>
                  </a>
                </div>
                <!-- beinhaltet den Bettenslider, welche die Pesonenanzahl bestimmt -->
                <div class="slidecontainer">
                  <div class="output">
                    <p id="demo" style="display:inline-block"></p>
                    <p id="bett" style="display:inline-block"></p>
                  </div>
                  <input type="range" min="1" max="5" value="1" class="slider" id="myRange">
                </div>
                <script>//Funktion zum slider
                  var slider = document.getElementById("myRange");
                  var output = document.getElementById("demo");
                  document.getElementById("bett").innerHTML = "Person";
                  output.innerHTML = slider.value;
                  slider.oninput = function() {
                    output.innerHTML = this.value;
                    if (output.innerHTML > 1) {
                      document.getElementById("bett").innerHTML = "Personen";
                    } else {
                      document.getElementById("bett").innerHTML = "Person";
                    }
                  }
                </script>
                <div class="container">
                  <!-- Attribute welche als checkbox angezeigt werden. Damit kann das Hotel gefiltert werden -->
                  <ul class="attribute">
                    <li><input type="checkbox" id="checkboxTwo" name="checkbox2" value="Innenstadt" <?php if((isset($_POST["resultCity"])&&(isset($_POST["checkbox2"])))) { ?> checked <?php } ?>>
                    <label for="checkboxTwo">Innenstadt</label></li>
                    <li><input type="checkbox" id="checkboxThree" name="checkbox3" value="AC" <?php if((isset($_POST["resultCity"])&&(isset($_POST["checkbox3"])))) { ?> checked <?php } ?>>
                    <label for="checkboxThree">AC</label></li>
                    <li><input type="checkbox" id="checkboxFour" name="checkbox4" value="Hotel" <?php if((isset($_POST["resultCity"])&&(isset($_POST["checkbox4"])))) { ?> checked <?php } ?>>
                    <label for="checkboxFour">Hotel</label></li>
                    <li><input type="checkbox" id="checkboxFive" name="checkbox5" value="Stornierung Kostenlos" <?php if((isset($_POST["resultCity"])&&(isset($_POST["checkbox5"])))) { ?> checked <?php } ?>>
                    <label for="checkboxFive">Stornierung Kostenlos</label></li>
                    <li><input type="checkbox" id="checkboxSix" name="checkbox6" value="Meerblick" <?php if((isset($_POST["resultCity"])&&(isset($_POST["checkbox6"])))) { ?> checked <?php } ?>>
                    <label for="checkboxSix">Meerblick</label></li>
                    <li><input type="checkbox" id="checkboxSeven" name="checkbox7" value="All Inclusive" <?php if((isset($_POST["resultCity"])&&(isset($_POST["checkbox7"])))) { ?> checked <?php } ?>>
                    <label for="checkboxSeven">All Inclusive</label></li>
                    <li><input type="checkbox" id="checkboxEight" name="checkbox8" value="Haustierfreundlich" <?php if((isset($_POST["resultCity"])&&(isset($_POST["checkbox8"])))) { ?> checked <?php } ?>>
                    <label for="checkboxEight">Haustierfreundlich</label></li>
                    <li><input type="checkbox" id="checkboxNine" name="checkbox9" value="Küche" <?php if((isset($_POST["resultCity"])&&(isset($_POST["checkbox9"])))) { ?> checked <?php } ?>>
                    <label for="checkboxNine">Küche</label></li>
                    <li><input type="checkbox" id="checkboxTen" name="checkbox10" value="Pool" <?php if((isset($_POST["resultCity"])&&(isset($_POST["checkbox10"])))) { ?> checked <?php } ?>>
                    <label for="checkboxTen">Pool</label></li>
                    <li><input type="checkbox" id="checkboxEleven" name="checkbox11" value="Casino" <?php if((isset($_POST["resultCity"])&&(isset($_POST["checkbox11"])))) { ?> checked <?php } ?>>
                    <label for="checkboxEleven">Casino</label></li>
                    <li><input type="checkbox" id="checkboxTwelf" name="checkbox12" value="Wlan" <?php if((isset($_POST["resultCity"])&&(isset($_POST["checkbox12"])))) { ?> checked <?php } ?>>
                    <label for="checkboxTwelf">Wlan</label></li>
                    <li><input type="checkbox" id="checkboxThirteen" name="checkbox13" value="Whirlpool" <?php if((isset($_POST["resultCity"])&&(isset($_POST["checkbox13"])))) { ?> checked <?php } ?>>
                    <label for="checkboxThirteen">Whirlpool</label></li>
                    <li><input type="checkbox" id="checkboxFourteen" name="checkbox14" value="Wellness" <?php if((isset($_POST["resultCity"])&&(isset($_POST["checkbox14"])))) { ?> checked <?php } ?>>
                    <label for="checkboxFourteen">Wellness</label></li>
                    <li><input type="checkbox" id="checkboxFifteen" name="checkbox15" value="Frühstück" <?php if((isset($_POST["resultCity"])&&(isset($_POST["checkbox15"])))) { ?> checked <?php } ?>>
                    <label for="checkboxFifteen">Frühstück</label></li>
                    <li><input type="checkbox" id="checkboxSixteen" name="checkbox16" value="Barrierefrei" <?php if((isset($_POST["resultCity"])&&(isset($_POST["checkbox16"])))) { ?> checked <?php } ?>>
                    <label for="checkboxSixteen">Barrierefrei</label></li>
                  </ul>
                  <!-- Sternenfilter, damit kann die gewünschte Sternenanzahl fürs Hotel gefiltert werden kann -->
                  <div class="output">
                    <?php
                      $starCheckbox = ["rating1","rating2","rating3","rating4","rating5"];
                      $starChecked = 0;
                      $starCounter = 0;
                      for($i = 0; $i <= 4; $i++) {
                        $starCounter++;
                        if(isset($_POST[$starCheckbox[$i]])) {
                          $starChecked = $starCounter;
                        }
                      }
                      /*$starChecked speichert die Anzahl bei der Sternenanzeige, wie viele Sterne man gecheckt hat in den Checkboxen nach dem Suchen.*/
                    ?>
                    <p id="rating" style="display:inline-block"><?php if($starChecked>0) { echo $starChecked; } else { echo ""; }?></p>
                    <p style="color:transparent; display:inline-block">_</p>
                    <p id="stern" style="display:inline-block"></p>
                  </div>
                  <fieldset class="rating">
                    <input type="checkbox" id="star5" name="rating5" value="5" <?php if((isset($_POST["resultCity"])&&(isset($_POST["rating5"])))) { ?> checked <?php } ?>/><label class = "full" for="star5" title="5 stars"><i class="fas fa-star"></i></label>
                    <input type="checkbox" id="star4" name="rating4" value="4" <?php if((isset($_POST["resultCity"])&&(isset($_POST["rating4"])))) { ?> checked <?php } ?>/><label class = "full" for="star4" title="4 stars"><i class="fas fa-star"></i></label>
                    <input type="checkbox" id="star3" name="rating3" value="3" <?php if((isset($_POST["resultCity"])&&(isset($_POST["rating3"])))) { ?> checked <?php } ?>/><label class = "full" for="star3" title="3 stars"><i class="fas fa-star"></i></label>
                    <input type="checkbox" id="star2" name="rating2" value="2"  <?php if((isset($_POST["resultCity"])&&(isset($_POST["rating2"])))) { ?> checked <?php } ?>/><label class = "full" for="star2" title="2 stars"><i class="fas fa-star"></i></label>
                    <input type="checkbox" id="star1" name="rating1" value="1"  <?php if((isset($_POST["resultCity"])&&(isset($_POST["rating1"])))) { ?> checked <?php } ?>/><label class = "full" for="star1" title="1 star"> <i class="fas fa-star"></i></label>
                  </fieldset>
                </div>
                <script>//Funktion für die Sternenanzeige
                  var zahl = document.getElementById("rating");
                  document.getElementById("stern").innerHTML = "Sterne";
                  zeit.innerHTML = rating.value;
                  rating.oninput = function() {
                    zahl.innerHTML = this.value;
                    if (output.innerHTML > 1) {
                      document.getElementById("stern").innerHTML = "Sterne";
                    } else {
                      document.getElementById("stern").innerHTML = "Stern";
                    }
                  }
                </script>
                </form>
              </div>
              <!-- Quelltext für die gefunden Hotels -->
              <ul class="results">
                <!-- PHP Abfrage, um die Hotel aus der DB in das HTML zu übertragen -->
                <?php
                  if(isset($_POST["resultCity"])||isset($_SESSION["userCity"])) {
                    if(isset($_SESSION["userCity"])) {
                      $_POST["resultCity"] = $_SESSION["userCity"];
                      unset($_SESSION["userCity"]);
                    }
                    $sql = "Select * From Hotel";
                    $result = mysqli_query($conn,$sql);
                    if(mysqli_num_rows($result)>0) {
                      $resultCounter = 0;
                      $attributCounter = 0;
                      $checkboxCounter = 0;
                      $filter = false;
                      while($row = mysqli_fetch_assoc($result)) {
                        $divArray = ["<div class=\"wert\">Innenstadt</div>","<div class=\"wert\">AC</div>","<div class=\"wert\">Hotel</div>","<div class=\"wert\">Stornierung Kostenlos</div>","<div class=\"wert\">Meerblick</div>","<div class=\"wert\">All Inclusive</div>","<div class=\"wert\">Haustierfreundlich</div>","<div class=\"wert\">Küche</div>","<div class=\"wert\">Pool</div>","<div class=\"wert\">Casino</div>","<div class=\"wert\">Wlan</div>","<div class=\"wert\">Whirlpool</div>","<div class=\"wert\">Wellness</div>","<div class=\"wert\">Frühstück</div>","<div class=\"wert\">Barrierefrei</div>"];
                        $spalten = ["innenstadt", "ac", "hotel", "stonierung_kostenlos", "meerblick", "all_inclusive", "haustierfreundlich", "kueche", "pool", "casino", "wlan","whirpool", "welness", "fruehstueck", "barrierefrei"];
                        $postnames = ["checkbox2", "checkbox3", "checkbox4", "checkbox5", "checkbox6", "checkbox7", "checkbox8", "checkbox9", "checkbox10", "checkbox11", "checkbox12","checkbox13", "checkbox14", "checkbox15", "checkbox16"];
                        if((@substr_count(strtoupper($row['ort']),strtoupper(@$_POST["resultCity"])))&&(stristr(strtoupper($row['ort']),$_POST["resultCity"])==strtoupper($row['ort']))&&($row["geloescht"]==0)&&((($row["sterne"]==1)&&(isset($_POST["rating1"])))||(($row["sterne"]==2)&&(isset($_POST["rating2"])))||(($row["sterne"]==3)&&(isset($_POST["rating3"])))||(($row["sterne"]==4)&&(isset($_POST["rating4"])))||(($row["sterne"]==5)&&(isset($_POST["rating5"])))||(((!isset($_POST["rating1"]))&&(!isset($_POST["rating2"]))&&(!isset($_POST["rating3"]))&&(!isset($_POST["rating4"]))&&(!isset($_POST["rating5"])))))) {
                          /*substr_count() sucht nach einem String in einem anderem String, das wird weiterhin mit anderen Kombinationen an Bedingungen
                            mit strtoupper() und stristr() ausgeführt, um einen möglichst genauen Wortfilter zu gewährleisten. Außerdem werden die Sternenanzahl mitgefiltert.*/
                          $keys = array_keys($row);
                          /*Die Attributnamen der Ergebniszeile werden in $keys gespeichert.*/
                          for($i=15; $i<=29; $i++) {
                            $value[] = $row[$keys[$i]];
                          }
                          /*Die Atribute für den Filter beginnen in der Datenbanktabelle Hotel an 14. Stelle bis zur 29. Stelle. Solange
                                  läuft die For-Schleife durch. Im value[] Array werden nun die Wert der Spalten gepeichert, der Attribute, die
                                  für den Filter gedacht sind und boolesche Werte besitzen.*/
                          $divsAndBooleans = array_combine($divArray, $value);
                          /*Nun werden die beiden Arrays kombiniert.*/
                          $value = array();
                          /*$value Array wird aufgelöst.*/
                          for($i = 0; $i<15; $i++) {
                            if(($row[$spalten[$i]]==1)&&(isset($_POST[$postnames[$i]]))) {
                              $attributCounter++;
                            }
                          }
                          for($i = 0; $i<15; $i++) {
                            if(isset($_POST[$postnames[$i]])) {
                              $checkboxCounter++;
                            }
                          }
                          if($attributCounter==$checkboxCounter) {
                            $filter = true;
                          }
                          $attributCounter = 0;
                          $checkboxCounter = 0;
                      /*Aufbau des Filters: Es wird gezählt in welchen Spalten in der Tabelle eine 1 steht, also der Filter zutrifft
                        und ob an der equivalenten Stelle die checkboxen ausgwählt wurden. Das Ergebnis wird in $attributCounter gespeichert.
                        Als nächstes wird nur die Anzahl der checkboxen gezählt die ausgewählt wurden. Wenn die beiden Zahlen, dieselben 
                        sind, dann wird die variable $filter auf true gesetzt und man bekommt die richtigen Ergebnisse.*/
                          if($filter == true) {
                            $resultCounter++;
                ?>
                <!-- li-Elment sthet für Instanz eines einzelnes Hotel -->
                <li class="element">
                  <div class="image">
                    <!-- Titelbild des Hotels -->
                    <img class="element" src="../images/<?php echo $row["bild"];?>" style='height: 100%; width: 100%; border-radius: 0.8em'>
                  </div>
                  <!-- Name und Beschreibung, sowie Attribute des Hotels -->
                  <div class="beschreibung">
                    <div class="title">
                      <?php
                      echo"<p3>".$row["hotelname"]."</p3>";
                      ?>
                    </div>
                    <div class="sterne">
                      <?php
                        for($i=0; $i<$row["sterne"]; $i++) {
                      ?>
                      <i class="fas fa-star"></i>
                      <?php } ?>
                    </div>
                    <div class="info">
                      <?php
                        echo $row["beschreibung"];
                      ?>
                    </div>
                    <div class="werte">
                      <!-- Preis des Hotels pro Nacht -->
                      <div class="price">
                        <?php
                          echo"<p>Preis</p>"."<p>".$row["preis"]."€</p>";
                        ?>
                      </div>
                      <?php
                        foreach($divsAndBooleans as $schluessel => $values) {
                          if($values==1) {
                            $finalOutput[] = $schluessel;
                          }
                        }
                        /*Das $divsAndBooleans Array wird durchlaufen und zu einem Assoziativen Array gemacht. Wenn die Werte nun 1 sind
                          dann werden die Namen der div-Container aus dem divArray im $finalOutput[] Array gespeichert. Also nur alle die
                          für das entsprechende Hotel zutreffen.*/
                        echo implode($finalOutput);
                        /*Nun werden die div-Container ausgegeben und das Hotel hat nun die Werte als Attribute zustehen in welchen sie eine 1 haben.*/
                        $finalOutput = array();
                        /*$finalOutput Array wird aufgelöst um beim nöchsten Ergebnishotel wieder frei zu sein*/
                      ?>
                      <!-- Weiterleitung auf die Detailseite des einzelnen Bildes -->
                      <a href="details.php?ID=<?php echo $row["hid"]?>" style="color:black;">Details</a>
                    </div>
                  </li>
                  <?php
                    $filter = false;
                    }}
                  ?>
                  <?php
                    }
                    // Falls keine Ergebnisse gefunden werden, wird dieser alternative Text angezeigt.
                    if($resultCounter==0) {
                      echo "Es wurden keine passenden Ergebnisse gefunden!";
                    }
                    }} ?>
              </ul>
            </div>
            <footer>
              <a href="../footer/logIn.php">Anmeldung für Hotelbesiter</a><a href="../footer/agb.html" style="text-decoration: none;">Allgemeine Geschäftsbedingungen</a><a href="../footer/copyright.html" style="text-decoration: none;">Copyright</a>
              <p>Kontakt: <a href="mailto:someone@example.com">service@hotelfinder.com</a></p>
            </footer>
      </div>
    </div>
  </body>
</html>
