<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width">
      <title>Meine Hotels</title>
      <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico">
      <link rel="stylesheet" type="text/css" href="../stylesheets/stylesheet.css">
      <script src="https://kit.fontawesome.com/b4d54f0eb8.js" crossorigin="anonymous"></script>
      <link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Righteous&display=swap" rel="stylesheet">
      <?php include("../PhpStuff/connectDB.php");
        $sql = "Select * From Hotel";
        $result = mysqli_query($conn, $sql);
        $num=mysqli_num_rows($result);
        ?>
  </head>
  <body class="hotelcreator">
    <div id="page-container">
      <div class="logoHotelcreator">
        <a href="myHotels.php"><img src="../images/logoCreator.png" style="height:70px"></a>
      </div>
      <div id="wrapper">
        <div class="main">
          <div class="filter">
            <!-- Menü - Wechsel zu mein Account, Hotel hinzufügen und logout -->
            <p3>Mein Account</p3>
            <?php
              if(isset($_SESSION["userEmail"])) {
                $id = $_SESSION['userEmail'];
                /*Session Variable userEmail wird beim Einloggen initialisiert, wenn diese vorhanden ist dann kann der User seine Hoteleinträge sehen.*/
            ?>
            <div id="zentriert">
              <?php
                echo "Herzlich Willkommen<br> $id"; ?>
            </div>
            <div class="selfContainer">
              <ul class="attribute">
                <form action="editHotels.php?">
                  <button type="submit" class="button2">Hotel erstellen</button>
                </form>
                <form method="post" action="myAccount.php?ID=<?php echo $_SESSION["userID"];?>">
                  <button type="submit" class="button2">Mein Account</button>
                </form>
                <form method="post" action="../PhpStuff/inhaberLogout.php">
                  <button type="submit" id="logoutButton" name="logout-submit" class="button2">Logout</button>
                </form>
              </ul>
            </div>
          </div>
          <!-- Mitteilung, wenn ein Hotel gelöscht wurde -->
          <?php
            if(isset($_GET["Success"])) {
              if($_GET["Success"]=="HotelGelöscht") {
                echo $_SESSION["deletedName"]." wurde gelöscht!";
              }
            }
            /*Wenn in der URL "Success" steht und es mit "HotelGelöscht" verbunden wird, so wird die Erfolgsmeldung Account von Hotelname wurde gelöscht!".*/
          ?>
          <!-- eigene Hotels werden aufgelistet -->
          <ul class="results">
            <?php
              if(mysqli_num_rows($result)>0) {
                while($row = mysqli_fetch_assoc($result)){
                  if($row["wid"]==$_SESSION["userID"]) {
                    if($row["geloescht"]==0) {
            ?>
            <li class="element">
              <div class="image">
                <img class="element" src="../images/<?php echo $row["bild"];?>" style='height: 100%; width: 100%; border-radius: 0.8em'>
              </div>
              <div class="beschreibung">
                <div class="title">
                  <?php
                    echo"<p3>".$row["hotelname"]."</p3>";
                  ?>
                </div>
                <div class="sterne">
                  <?php
                    for($i=0; $i<$row["sterne"]; $i++) { ?>
                      <i class="fas fa-star"></i>
                  <?php } ?>
                </div>
                <div class="info">
                  <?php
                    echo $row["beschreibung"];
                  ?>
                </div>
                <div class="werte">
                  <div class="price">
                    <?php
                      echo"<p>Preis</p>"."<p>".$row["preis"]."€</p>";
                    ?>
                  </div>
                  <?php
                    $divArray = ["<div class=\"wert\">Sterne</div>","<div class=\"wert\">Innenstadt</div>","<div class=\"wert\">AC</div>","<div class=\"wert\">Hotel</div>","<div class=\"wert\">Stornierung Kostenlos</div>","<div class=\"wert\">Meerblick</div>","<div class=\"wert\">All Inclusive</div>","<div class=\"wert\">Haustierfreundlich</div>","<div class=\"wert\">Küche</div>","<div class=\"wert\">Pool</div>","<div class=\"wert\">Casino</div>","<div class=\"wert\">Wlan</div>","<div class=\"wert\">Whirpool</div>","<div class=\"wert\">Welness</div>","<div class=\"wert\">Frühstück</div>","<div class=\"wert\">Barrierefrei</div>"];
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
                    $finalOutput = array(); ?>
                </div>
                <a href="editHotels.php?ID=<?php echo $row["hid"]?>" style="color:black;">Bearbeiten</a>
              </div>
            </li>
            <?php }}}}
              }else {
                header("Location: ../footer/logIn.php");
                exit();
                if(isset($_GET["Success"])) {
                  if($_GET["Success"]=="AccountGelöscht") {
                    echo "Account von ".$_SESSION["deletedVorname"]." ".$_SESSION["deletedName"]." wurde gelöscht!";
                  }
                }
            ?>
            <!-- Mitteilung, wenn man auf myHotels ist, ohne sich angemeldet zu haben -->
            <div class="container">
              <p>Sie müssen sich mit ihrem Inhaber Account einloggen bevor Sie ihre Hotels einsehen können.</p>
              <form method="post" action="../PhpStuff/inhaberLogin.php">
                <input type="text" class="here" name="emailLogin" placeholder="E-mail...">
                <input type="password" class="here" name="pwd" placeholder="Passwort...">
                <div class="buttonHolder" style="margin-top: 2%">
                  <button type="submit" id="loginButton" class="button2" name="login-submit">Login</button>
                </div>
                <p style="margin-top:5%; margin-bottom:5%">Sie haben noch kein Konto?</p2>
                  <div class="buttonHolder">
                    <a href="../footer/register.php" ><div class="button2">Registrieren</div></a>
                  </div>
              </form>
            </div>
          </div>
          <p7>
            <!-- falls der inhaber keine Hotels besitzt, dann wird die folgende Fehlermeldung angezeigt -->
            <?php
              echo "Bisher gibt es keine Hotels. Bitte gehen sie zu (Hotel hinzufügen) und fügen sie ihr Hotel zu.";
              /*Wenn der Inhaber noch keine Hotels hat wird diese Meldung ausgegeben.*/} ?>
          </p7>
        </ul>
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
    </div>
  </body>
</html>
<?php
  mysqli_close($conn);
?>
