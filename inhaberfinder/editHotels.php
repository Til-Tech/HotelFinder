<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset= "utf-8">
    <meta name="viewport" content= "width=device-width, user-scalable=no">
    <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico">
    <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
    <link rel="stylesheet" type="text/css" href="../stylesheets/stylesheet.css">
    <script src="https://kit.fontawesome.com/b4d54f0eb8.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Righteous&display=swap" rel="stylesheet">
    <title>Hotel bearbeiten</title>
  </head>
  <body class="hotelcreator">
    <?php if((isset($_SESSION["userID"]))&&!(isset($_GET["ID"]))) { 
      /*Ansicht zum Erstellen eines Hotels.*/?>
    <div class="logoHotelcreator">
      <a href="myHotels.php"><img src="../images/logoCreator.png"style="height:70px"></a>
    </div>
    <div id="wrapper">
      <div class="shell">
        <div class="register">
          <div class="registerTopic">
            <p4>Erstellen Sie ihr Hotel</p4>
          </div>
          <form method="post" action="../PhpStuff/hotelEinstellen.php" enctype="multipart/form-data"> 
          <div class="registerLeftRight">
            <div class="registerLeft">
              <div>
                <p5>Hotelname</p5>
                <!-- Eingabefeld für einen Text 
                required bedeutet, dass dieses Feld ausgefüllt werden muss, damit die Funktion des submit Buttons ausgeführt werden kann -->
                <input type="text" class="here" name="Hotelname" placeholder="Hotelname" required>
              </div>
              <div>
                <p5>Straße</p5>
                <input type="text" class="here" name="Straße" placeholder="Straße" required>
              </div>
              <div>
                <p5>Hausnummer</p5>
                <input type="text" class="here" name="Hausnummer" placeholder="Hausnummer" required>
              </div>
              <div>
                <p5>Ort</p5>
                <input type="text" class="here" name="Ort" placeholder="Ort" required>
              </div>
              <div>
                <p5>PLZ</p5>
                <input type="text" class="here" name="PLZ" placeholder="Postleitzahl" required>
              </div>
              <div>
                <p5>Telefonnummer</p5>
                <!-- Eingabefeld für eine Zahl -->
                <input type="number" name="Telefonnummer" placeholder="Telefonnummer" required>
              </div>
              <div>
                <p5>Email</p5>
                <input type="text" class="here" name="Email" placeholder="Email" required>
              </div>
              <div>
                <p5>Steuernummer</p5>
                <input type="text" class="here" name="Steuernummer" placeholder="Steuernummer" required>
              </div>
            </div>
            <div class="registerRight">
              <div>
                <p5>Nachbarschaft</p5>
                <!-- Eingabefeld für einen längeren Text -->
                <textarea cols="40" rows="5" name="Nachbarschaft" placeholder="Schreiben Sie etwas zu ihrer Nachbarschaft..." required></textarea>
              </div>
              <div>
                <p5>Beschreibung</p5>
                <textarea cols="40" rows="5" name="Beschreibung" placeholder="Beschreiben Sie ihr Hotel näher..." required></textarea>
              </div>
              <div>
                <p5>Preis</p5>
                <input type="number" name="Preis" placeholder="Preis" required>
              </div>
              <div>
                <p5>Personenanzahl</p5>
                <input type="number" name="Personen" placeholder="Personenanzahl" required>
              </div>
              <div>
                <p5>Sternanzahl</p5>
                <input type="number" name="Sterne" placeholder="Sternanzahl" required>
              </div>
            </div>
          </div>
          <div class="container">
            <!-- Liste der Filterattribute zum auswählen -->
            <ul class="attribute">
              <li><input type="checkbox" id="checkboxTwo" name="checkbox2" value="Innenstadt">
              <label for="checkboxTwo">Innenstadt</label></li>
              <li><input type="checkbox" id="checkboxThree" name="checkbox3" value="AC">
              <label for="checkboxThree">AC</label></li>
              <li><input type="checkbox" id="checkboxFour" name="checkbox4" value="Hotel">
              <label for="checkboxFour">Hotel</label></li>
              <li><input type="checkbox" id="checkboxFive" name="checkbox5" value="Stornierung Kostenlos">
              <label for="checkboxFive">Stornierung Kostenlos</label></li>
              <li><input type="checkbox" id="checkboxSix" name="checkbox6" value="Meerblick">
              <label for="checkboxSix">Meerblick</label></li>
              <li><input type="checkbox" id="checkboxSeven" name="checkbox7" value="All Inclusive">
              <label for="checkboxSeven">All Inclusive</label></li>
              <li><input type="checkbox" id="checkboxEight" name="checkbox8" value="Haustierfreundlich">
              <label for="checkboxEight">Haustierfreundlich</label></li>
              <li><input type="checkbox" id="checkboxNine" name="checkbox9" value="Küche">
              <label for="checkboxNine">Küche</label></li>
              <li><input type="checkbox" id="checkboxTen" name="checkbox10" value="Pool">
              <label for="checkboxTen">Pool</label></li>
              <li><input type="checkbox" id="checkboxEleven" name="checkbox11" value="Casino">
              <label for="checkboxEleven">Casino</label></li>
              <li><input type="checkbox" id="checkboxTwelf" name="checkbox12" value="Wlan">
              <label for="checkboxTwelf">Wlan</label></li>
              <li><input type="checkbox" id="checkboxThirteen" name="checkbox13" value="Whirpool">
              <label for="checkboxThirteen">Whirlpool</label></li>
              <li><input type="checkbox" id="checkboxFourteen" name="checkbox14" value="Welness">
              <label for="checkboxFourteen">Wellness</label></li>
              <li><input type="checkbox" id="checkboxFifteen" name="checkbox15" value="Frühstück">
              <label for="checkboxFifteen">Frühstück</label></li>
              <li><input type="checkbox" id="checkboxSixteen" name="checkbox16" value="Barrierefrei">
              <label for="checkboxSixteen">Barrierefrei</label></li>
            </ul>
          </div>
          <div>
            <p5>Wählen Sie ein Bild für ihr Hotel</p5>
            <input type="file" name="file">
          </div>
          <div id="eben">
            <a href="myHotels.php"><div class="button2">Zurück zur Übersicht</div></a>
            <button type="submit" class="button2" name="erstelleHotel-submit" >Hotel erstellen</button>
          </div>
          </form>
            <?php 
            
            if(isset($_GET["success"])) {
              if($_GET["success"]=="hotelerfolgreichhinzugefügt") {
                  echo "Sie haben erfolgreich ein neues Hotel hinzugefügt!";
              }
              /*Wenn success in der URL steht und "hotelerfolgreichhinzugefügt" entspricht dann wird die Erfolgsmeldung zum Hinzufügen eines
              Hotels ausgegeben.*/
              }
            
            if(isset($_GET["error"])) {
              if ($_GET["error"]=="invalidEmail") {
                echo "Fehlerhafte Email angegeben!";
              }
              elseif ($_GET["error"]=="invalidName") {
                echo "Fehlerhaften Hotelnamen angegeben!";
              }
              elseif ($_GET["error"]=="invalidEmailHotelname") {
                echo "Fehlerhaften Hotelnamen oder Email angegeben!";
              }
              elseif ($_GET["error"]=="emailbereitsvergeben") {
                echo "Email bereits vergeben!";
              }
              elseif ($_GET["error"]=="falscheSterneAnzahl") {
                echo "Inkorrekte Sternanzahl, nur von 0-5!";
              }
              elseif ($_GET["error"]=="falschesformatNurJPGJPEGoderPNG") {
                echo "Falschen Bildformat, nur JPG, JPEG oder PNG!";
              }
              elseif ($_GET["error"]=="fehlerbeimhochladenderdatei") {
                echo "Fehler beim Hochladen der Datei!";
              }
              elseif ($_GET["error"]=="dateizugroß") {
                echo "Datei ist zu groß!";
              }
    }
    /*Wenn "error" in der URL steht, dann werden die entsprechenden Fehlermeldungen ausgegeben je nach dem welchen Fehler der User macht
      im reinen Php Skript werden die Fehlermeldungen genauer erläutert.*/
              }
              /*Ansicht um ein Hotel zu bearbeiten.*/
          else { 
            include("../PhpStuff/connectDB.php");
            $sql = "Select * From Hotel where Hotel.hid = ${_GET["ID"]}";
            $result = mysqli_query($conn,$sql);
    
                if(mysqli_num_rows($result)>0) {
                    
                while($row = mysqli_fetch_assoc($result)) { 
            
            ?>
      <div class="logoHotelcreator">
        <a href="myHotels.php"><img src="../images/logoCreator.png"style="height:70px"></a>
      </div>
      <div id="wrapper">
        <div class="shell">
          <div class="register">
            <div class="registerTopic">
              <p4>Bearbeiten Sie ihr Hotel</p4>
            </div>          
            <div class="registerLeftRight">
              <div class="registerLeft">
                <form method="post" action="../PhpStuff/hotelBearbeiten.php?ID=<?php echo $row["hid"]; ?>">
                <!-- Vertikale ausrichtung der Schrift&Änderungsknopf im Verhältnis zur Textfeldeingabe-->
                  <div id="upAndDown">
                  <!-- Horizontale ausrichtung der Schrift&Änderungsknopf -->
                  <div id="space">
                    <p5>Hotelname</p5>
                    <button type="submit" name="changeName" class="button3"><i class="fas fa-check"></i></button></div><div style="width 100%">
                    <p></p>
                    <input type="text"class="here" name="Hotelname" value="<?php echo $row["hotelname"];?>" required>
                    <p></p>
                    <?php if(isset($_GET["Success"])) {
                            if($_GET["Success"]=="NameChanged") {
                              echo "Name geändert!";
                            }
                          }
                      ?>
                  </div>
                  </div>
                </form>
                <form method="post" action="../PhpStuff/hotelBearbeiten.php?ID=<?php echo $row["hid"]; ?>">
                  <div id="upAndDown">
                  <div id="space">
                    <p5>Straße</p5>
                    <button type="submit" name="changeStraße" class="button3"><i class="fas fa-check"></i></button></div><div>
                    <input type="text"  class="here" name="Straße" value="<?php echo $row["straße"]; ?>" required>
                    <?php if(isset($_GET["Success"])) {
                    if($_GET["Success"]=="StraßeChanged") {
                        echo "Straße geändert!";
                    }
                    } ?>
                  </div>
                  </div>
                </form>
                <form method="post" action="../PhpStuff/hotelBearbeiten.php?ID=<?php echo $row["hid"]; ?>">
                  <div id="upAndDown">
                  <div id="space">
                    <p5>Hausnummer</p5>
                    <button type="submit" name="changeHausnummer" class="button3"><i class="fas fa-check"></i></button></div><div>
                    <input type="text" class="here" name="Hausnummer" value="<?php echo $row["hausnummer"]; ?>" required>
                    <?php if(isset($_GET["Success"])) {
                    if($_GET["Success"]=="HausnummerChanged") {
                        echo "Hausnummer geändert!";
                    }
                    } ?>
                  </div>
                  </div>
                </form>
                <form method="post" action="../PhpStuff/hotelBearbeiten.php?ID=<?php echo $row["hid"]; ?>">
                  <div id="upAndDown">
                  <div id="space">
                    <p5>Ort</p5>
                    <button type="submit" name="changeOrt" class="button3"><i class="fas fa-check"></i></button></div><div>
                    <input type="text" class="here" name="Ort" value="<?php echo $row["ort"]; ?>" required>
                    <?php if(isset($_GET["Success"])) {
                    if($_GET["Success"]=="OrtChanged") {
                        echo "Ort geändert!";
                    }
                    } ?>
                  </div>
                  </div>
                </form>
                <form method="post" action="../PhpStuff/hotelBearbeiten.php?ID=<?php echo $row["hid"]; ?>">
                  <div id="upAndDown">
                  <div id="space">
                    <p5>PLZ</p5>
                    <button type="submit" name="changePLZ" class="button3"><i class="fas fa-check"></i></button></div><div>
                    <input type="text" class="here" name="PLZ" value="<?php echo $row["plz"]; ?>" required>
                    <?php if(isset($_GET["Success"])) {
                      if($_GET["Success"]=="PLZChanged") {
                          echo "PLZ geändert!";
                      }
                      } ?>
                  </div>
                  </div>
                </form>
                <form method="post" action="../PhpStuff/hotelBearbeiten.php?ID=<?php echo $row["hid"]; ?>">
                  <div id="upAndDown">
                  <div id="space">
                    <p5>Telefonnummer</p5> 
                    <button type="submit" name="changeTelefonnummer" class="button3"><i class="fas fa-check"></i></button></div><div>
                    <input type="number" name="Telefonnummer" value=<?php echo $row["telefonnummer"]; ?> required>
                    <?php if(isset($_GET["Success"])) {
                      if($_GET["Success"]=="TelefonnummerChanged") {
                                echo "Telefonnummer geändert!";
                            }
                            } ?>
                    </div>
                    </div>
                </form>
                <form method="post" action="../PhpStuff/hotelBearbeiten.php?ID=<?php echo $row["hid"]; ?>">
                  <div id="upAndDown">
                  <div id="space">
                    <p5>Email</p5> 
                    <button type="submit" name="changeEmail" class="button3"><i class="fas fa-check"></i></button></div><div>
                    <input type="text" class="here" name="Email" value=<?php echo $row["email"]; ?> required>
                    <?php if(isset($_GET["Success"])) {
                      if($_GET["Success"]=="EmailChanged") {
                          echo "Email geändert!";
                      }
                      } ?>
                    </div>
                    </div>
                </form>
                <form method="post" action="../PhpStuff/hotelBearbeiten.php?ID=<?php echo $row["hid"]; ?>">
                  <div id="upAndDown">
                  <div id="space">
                    <p5>Steuernummer</p5> 
                    <button type="submit" name="changeSteuernummer" class="button3"><i class="fas fa-check"></i></button></div><div>
                    <input type="text" class="here" name="Steuernummer" value="<?php echo $row["steuernummer"]; ?>" required>
                    <?php if(isset($_GET["Success"])) {
                        if($_GET["Success"]=="SteuernummerChanged") {
                                echo "Steuernummer geändert!";
                            }
                            } ?>
                  </div>
                  </div>
                </form>
              </div>
              <div class="registerRight">
                <form method="post" action="../PhpStuff/hotelBearbeiten.php?ID=<?php echo $row["hid"]; ?>">
                  <div id="space">
                    <p5>Nachbarschaft</p5> 
                    <button type="submit" name="changeNachbarschaft" class="button3"><i class="fas fa-check"></i></button></div><div>
                    <textarea cols="40" rows="5" name="Nachbarschaft"><?php echo $row["nachbarschaft"]; ?></textarea>
                    <?php if(isset($_GET["Success"])) {
                            if($_GET["Success"]=="NachbarschaftChanged") {
                                echo "Nachbarschaft geändert!";
                            }
                            } ?>
                  </div>
                </form>
                <form method="post" action="../PhpStuff/hotelBearbeiten.php?ID=<?php echo $row["hid"]; ?>">
                  <div id="space">
                    <p5>Beschreibung</p5> 
                    <button type="submit" name="changeBeschreibung" class="button3"><i class="fas fa-check"></i></button></div><div>
                    <textarea cols="40" rows="5" name="Beschreibung"><?php echo $row["beschreibung"]; ?></textarea>
                    <?php if(isset($_GET["Success"])) {
                            if($_GET["Success"]=="BeschreibungChanged") {
                                echo "Beschreibung geändert!";
                            }
                            } ?>
                  </div>
                </form>
                <form method="post" action="../PhpStuff/hotelBearbeiten.php?ID=<?php echo $row["hid"]; ?>">
                  <div id="space">
                    <p5>Preis</p5> 
                    <button type="submit" name="changePreis" class="button3"><i class="fas fa-check"></i></button></div><div>
                    <input type="number" name="Preis" value=<?php echo $row["preis"]; ?> required>
                    <?php if(isset($_GET["Success"])) {
                            if($_GET["Success"]=="PreisChanged") {
                                echo "Preis geändert!";
                            }
                            } ?>
                  </div>
                </form>
                <form method="post" action="../PhpStuff/hotelBearbeiten.php?ID=<?php echo $row["hid"]; ?>">
                  <div id="space">
                    <p5>Personenanzahl</p5>
                    <button type="submit" name="changePersonen" class="button3"><i class="fas fa-check"></i></button></div><div>
                      <input type="number" name="Personen" value=<?php echo $row["zimmeranzahl"]; ?> required>
                      <?php if(isset($_GET["Success"])) {
                              if($_GET["Success"]=="PersonenanzahlChanged") {
                                  echo "Personenanzahl geändert!";
                              }
                              } ?>
                  </div>
                </form>
                <form method="post" action="../PhpStuff/hotelBearbeiten.php?ID=<?php echo $row["hid"]; ?>">
                  <div id="space">
                    <p5>Sternanzahl</p5>
                    <button type="submit" name="changeSterne" class="button3"><i class="fas fa-check"></i></button></div><div>
                    <input type="number" name="Sterne" value=<?php echo $row["sterne"]; ?> required>
                    <?php if(isset($_GET["Success"])) {
                      if($_GET["Success"]=="SterneChanged") {
                          echo "Sterne geändert!";
                      }
                      } ?>
                  </div>
                </form>
              </div>
            </div>
            <div class="container">
              <ul class="attribute">
                <form method="post" action="../PhpStuff/hotelBearbeiten.php?ID=<?php echo $row["hid"]; ?>">
                  <li><input type="checkbox" id="checkboxTwo" name="checkbox2" value="Innenstadt" <?php if($row["innenstadt"]==1) {?>checked <?php } ?>>
                  <label for="checkboxTwo">Innenstadt</label></li>
                  <li><input type="checkbox" id="checkboxThree" name="checkbox3" value="AC"<?php if($row["ac"]==1) {?>checked <?php } ?>>
                  <label for="checkboxThree">AC</label></li>
                  <li><input type="checkbox" id="checkboxFour" name="checkbox4" value="Hotel"<?php if($row["hotel"]==1) {?>checked <?php } ?>>
                  <label for="checkboxFour">Hotel</label></li>
                  <li><input type="checkbox" id="checkboxFive" name="checkbox5" value="Stornierung Kostenlos"<?php if($row["stonierung_kostenlos"]==1) {?>checked <?php } ?>>
                  <label for="checkboxFive">Stornierung Kostenlos</label></li>
                  <li><input type="checkbox" id="checkboxSix" name="checkbox6" value="Meerblick"<?php if($row["meerblick"]==1) {?>checked <?php } ?>>
                  <label for="checkboxSix">Meerblick</label></li>
                  <li><input type="checkbox" id="checkboxSeven" name="checkbox7" value="All Inclusive"<?php if($row["all_inclusive"]==1) {?>checked <?php } ?>>
                  <label for="checkboxSeven">All Inclusive</label></li>
                  <li><input type="checkbox" id="checkboxEight" name="checkbox8" value="Haustierfreundlich"<?php if($row["haustierfreundlich"]==1) {?>checked <?php } ?>>
                  <label for="checkboxEight">Haustierfreundlich</label></li>
                  <li><input type="checkbox" id="checkboxNine" name="checkbox9" value="Küche"<?php if($row["kueche"]==1) {?>checked <?php } ?>>
                  <label for="checkboxNine">Küche</label></li>
                  <li><input type="checkbox" id="checkboxTen" name="checkbox10" value="Pool"<?php if($row["pool"]==1) {?>checked <?php } ?>>
                  <label for="checkboxTen">Pool</label></li>
                  <li><input type="checkbox" id="checkboxEleven" name="checkbox11" value="Casino"<?php if($row["casino"]==1) {?>checked <?php } ?>>
                  <label for="checkboxEleven">Casino</label></li>
                  <li><input type="checkbox" id="checkboxTwelf" name="checkbox12" value="Wlan"<?php if($row["wlan"]==1) {?>checked <?php } ?>>
                  <label for="checkboxTwelf">Wlan</label></li>
                  <li><input type="checkbox" id="checkboxThirteen" name="checkbox13" value="Whirpool"<?php if($row["whirpool"]==1) {?>checked <?php } ?>>
                  <label for="checkboxThirteen">Whirlpool</label></li>
                  <li><input type="checkbox" id="checkboxFourteen" name="checkbox14" value="Welness"<?php if($row["welness"]==1) {?>checked <?php } ?>>
                  <label for="checkboxFourteen">Wellness</label></li>
                  <li><input type="checkbox" id="checkboxFifteen" name="checkbox15" value="Frühstück"<?php if($row["fruehstueck"]==1) {?>checked <?php } ?>>
                  <label for="checkboxFifteen">Frühstück</label></li>
                  <li><input type="checkbox" id="checkboxSixteen" name="checkbox16" value="Barrierefrei"<?php if($row["barrierefrei"]==1) {?>checked <?php } ?>>
                  <label for="checkboxSixteen">Barrierefrei</label></li>
                  <button type="submit" class="button3" name="changeFilterAttribute">Attribute Ändern <i class="fas fa-check"></i></button>
                  <?php if(isset($_GET["Success"])) {
                              if($_GET["Success"]=="FilterattributeChanged") {
                                  echo "Filterattribute geändert!";
                              }
                          } ?>
                </form>
              </ul>
            </div>
            <form method="post" action="../PhpStuff/hotelBearbeiten.php?ID=<?php echo $row["hid"]; ?>" enctype="multipart/form-data">
            <div style="background-color: grey; padding-left: 10%; border-top-left-radius: 15px">
              <p5>Titelbild</p5>
              <input type="file" name="file">
              <button type="submit" class="button4" name="titelbildÄndern">Titelbild Anpassen <i class="fas fa-check"></i></button>
              <?php if(isset($_GET["Success"])) {
                  if($_GET["Success"]=="TitelbildChanged") {
                      echo "Titelbild geändert!";
                  }
              } ?>
            </div>
            </form>
            <form method="post" action="../PhpStuff/hotelBearbeiten.php?ID=<?php echo $row["hid"]; ?>" enctype="multipart/form-data">
            <div id="eben" style="background-color: grey">  
              <div>
                <p5><i class="fas fa-plus-circle"></i> Bild</p5><!-- optionaler Bilderupload -->
                <input type="file" name="file2">
              </div>
              <div>
                <p5><i class="fas fa-plus-circle"></i> Bild</p5>
                <input type="file" name="file3">
              </div>
            </div>
            <div id="eben" style="background-color: grey; border-bottom-right-radius: 15px"> 
              <div>
                <p5><i class="fas fa-plus-circle"></i> Bild</p5>
                <input type="file" name="file4">
              </div>
              <div>
                <p5><i class="fas fa-plus-circle"></i> Bild</p5>
                <input type="file" name="file5">
              </div>
            </div>
            <div style="margin-left:40%">
              <button type="submit" class="button3" name="bilderHinzufügen" >Bilder Hinzufügen <i class="fas fa-check"></i></button>
                <?php if(isset($_GET["Success"])) {
                                if($_GET["Success"]=="BilderHinzugefügt") {
                                    echo "Bilder hinzugefügt!";
                                }
                            } ?>
            </form>
            </div>
            <form method="post" action="../PhpStuff/hotelBearbeiten.php?ID=<?php echo $row["hid"]; ?>">
            <div id="eben">
              <a href="myHotels.php"><div class="button2">Zurück zur Übersicht</div></a>
              <button type="submit"  class="button2" name="hotelLöschen">Hotel Löschen</button> 
              </div>
            </form>
            <?php
            if(isset($_GET["error"])) {
            if ($_GET["error"]=="emailbereitsvergeben") {
              echo "Email bereits vergeben!";
            }
            elseif ($_GET["error"]=="invalidEmail") {
              echo "Fehlerhafte Email angegeben!";
            }
            elseif ($_GET["error"]=="invalidEmailHotelname") {
              echo "Fehlerhaften Hotelnamen oder Email angegeben!";
            }
            elseif ($_GET["error"]=="falscheSterneAnzahl") {
              echo "Inkorrekte Sternanzahl, nur von 0-5!";
            } 
          }
          /*Fehlermeldungen die auftreten, wenn man Fehler beim Bearbeiten eines Hotels gemacht hat.*/        
        }
        }
        } ?>
        </div>
      </div>
      <footer>
      <p>Account: <?php echo "<p6>".$_SESSION["userEmail"]."</p6>";?></p>
       <a href="../footer/agb.html" style="text-decoration: none;">Allgemeine Geschäftsbedingungen</a><a href="../footer/copyright.html" style="text-decoration: none;">Copyright</a>
        <p>Kontakt: <a href="mailto:someone@example.com">service@hotelfinder.com</a></p>
        <form method="post" action="../PhpStuff/inhaberLogout.php">
          <button type="submit" id="logoutButton"class="button2"name="logout-submit">Logout</button>
        </form>
      </footer>
    </div>
  </body>
</html>
