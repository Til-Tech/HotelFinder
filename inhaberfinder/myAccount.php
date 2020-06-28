<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content= "width=device-width, user-scalable=no">
    <title>Account bearbeiten</title>
    <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico">
    <link rel="stylesheet" type="text/css" href="../stylesheets/stylesheet.css">
    <script src="https://kit.fontawesome.com/b4d54f0eb8.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Righteous&display=swap" rel="stylesheet">
</head>

<body class="hotelcreator">
  <div class="logoHotelcreator">
    <a href="myHotels.php"><img src="../images/logoCreator.png"style="height:70px"></a>
  </div>
  <div id="wrapper">
    <div class="shell">
      <div class="register">
        <div class="registerTopic">
          <p4>Ändern Sie ihre Accountdaten</p4>
        </div>
        <div class="registerLeftRight">
          <div class="registerLeft">

        <?php
        include("../PhpStuff/connectDB.php");
        $sql = "Select * From Inhaber where Inhaber.wid = ${_GET["ID"]}";
        $result = mysqli_query($conn,$sql);

            if(mysqli_num_rows($result)>0) {

            while($row = mysqli_fetch_assoc($result)) {

        ?>
        <form method="post" action="../PhpStuff/accountBearbeiten.php?ID=<?php echo $row["wid"]; ?>">
        <!-- Vertikale ausrichtung der Schrift&Änderungsknopf im Verhältnis zur Textfeldeingabe-->
        <div id="upAndDown">
          <!-- Horizontale ausrichtung der Schrift&Änderungsknopf -->
          <div id="space">
            <p5>Name</p5>
            <button type="submit" name="changeName" class="button3"><i class="fas fa-check"></i></button></div><div>
            <input type="text" class="here" name="Name" value=<?php echo $row["name"]; ?> required>
            <?php if(isset($_GET["Success"])) {
                    if($_GET["Success"]=="NameChanged") {
                        echo "Name geändert!";
                    }
                    } 
          /*Wenn "Success" in der URL steht durch in php Skript beschriebene Fehlermeldungen, dann wird das von Superglobalen $_GET
            erkannt und die entsprechende Erfolgsmeldung wird ausgegeben.*/ ?>
        </div>
        </div>
        </form>
        <form method="post" action="../PhpStuff/accountBearbeiten.php?ID=<?php echo $row["wid"]; ?>">
        <div id="upAndDown">
          <div id="space">
            <p5>Vorname</p5>
            <button type="submit" name="changeVorname" class="button3"><i class="fas fa-check"></i></button></div><div>
            <input type="text" class="here" name="Vorname" value=<?php echo $row["vorname"]; ?> required>
            <?php if(isset($_GET["Success"])) {
                    if($_GET["Success"]=="VornameChanged") {
                        echo "Vorname geändert!";
                    }
                    } ?>
        </div>
        </div>
        </form>
        <form method="post" action="../PhpStuff/accountBearbeiten.php?ID=<?php echo $row["wid"]; ?>">
        <div id="upAndDown">
          <div id="space">
            <p5>Ort</p5>
            <button type="submit" name="changeOrt" class="button3"><i class="fas fa-check"></i></button></div><div>
            <input type="text" class="here" name="Ort" value=<?php echo $row["ort"]; ?> required>
            <?php if(isset($_GET["Success"])) {
                    if($_GET["Success"]=="OrtChanged") {
                        echo "Ort geändert!";
                    }
                    } ?>
        </div>
        </div>
        </form>

        <form method="post" action="../PhpStuff/accountBearbeiten.php?ID=<?php echo $row["wid"]; ?>">
        <div id="upAndDown">
          <div id="space">
            <p5>Straße</p5>
            <button type="submit" name="changeStraße" class="button3"><i class="fas fa-check"></i></button></div><div>
            <input type="text" class="here" name="Straße" value=<?php echo $row["straße"]; ?> required>
            <?php if(isset($_GET["Success"])) {
                    if($_GET["Success"]=="StraßeChanged") {
                        echo "Straße geändert!";
                    }
                    } ?>
        </div>
        </div>
        </form>
      </div>

        <div class="registerRight">

        <form method="post" action="../PhpStuff/accountBearbeiten.php?ID=<?php echo $row["wid"]; ?>">
        <div id="upAndDown">
          <div id="space">
            <p5>Hausnummer</p5>
            <button type="submit" name="changeHausnummer" class="button3"><i class="fas fa-check"></i></button></div><div>
            <input type="text" class="here" name="Hausnummer" value=<?php echo $row["hausnummer"]; ?> required>
            <?php if(isset($_GET["Success"])) {
                    if($_GET["Success"]=="HausnummerChanged") {
                        echo "Hausnummer geändert!";
                    }
                    } ?>
        </div>
        </div>
        </form>

        <form method="post" action="../PhpStuff/accountBearbeiten.php?ID=<?php echo $row["wid"]; ?>">
        <div id="upAndDown">
          <div id="space">
            <p5>PLZ</p5>
            <button type="submit" name="changePLZ" class="button3"><i class="fas fa-check"></i></button></div><div>
            <input type="text" class="here" name="PLZ" value=<?php echo $row["plz"]; ?> required>
            <?php if(isset($_GET["Success"])) {
                    if($_GET["Success"]=="PLZChanged") {
                        echo "PLZ geändert!";
                    }
                    } ?>
        </div>
        </div>
        </form>
        <form method="post" action="../PhpStuff/accountBearbeiten.php?ID=<?php echo $row["wid"]; ?>">
        <div id="upAndDown">
          <div id="space">
            <p5>Telefonnummer</p5>
            <button type="submit" name="changeTelefonnummer" class="button3"><i class="fas fa-check"></i></button></div><div>
            <input type="text" class="here" name="Telefonnummer" value=<?php echo $row["telefonnummer"]; ?> required>
            <?php if(isset($_GET["Success"])) {
                    if($_GET["Success"]=="TelefonnummerChanged") {
                        echo "Telefonnummer geändert!";
                    }
                    } ?>
        </div>
        </div>
        </form>
        <form method="post" action="../PhpStuff/accountBearbeiten.php?ID=<?php echo $row["wid"]; ?>">
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
        </div>
        </div>

        <div id="eben">
          <a href="myHotels.php"><div class="button2">Zurück zur Übersicht</div></a>
          <form method="post" action="../PhpStuff/accountBearbeiten.php?ID=<?php echo $row["wid"]; ?>">
                        <div>
                        <button type="submit" class="button2" name="accountLöschen" onClick="return confirm('Möchtest du deinen Account und alle Hotels wirklich löschen?')">Account Löschen</button>
                        </div>
          </form>
        </div>
        <?php
        if(isset($_GET["error"])) {

          if($_GET["error"]=="invalidEmail") {
            echo "<p>Unerlaubte Zeichen in Email benutzt!</p>";
        }
          elseif($_GET["error"]=="invalidName") {
          echo "<p>Unerlaubte Zeichen in Name benutzt!</p>";
      }
          elseif($_GET["error"]=="invalidVorname") {
          echo "<p>Unerlaubte Zeichen in Vorname benutzt!</p>";
      }
      elseif($_GET["error"]=="emailbereitsvergeben") {
        echo "<p>Email bereits vergeben!</p>";
    }
        }
        /*Fehlermeldungen die beim Bearbeiten des Accounts auftreten können, werden im Php-Skript näher beschrieben.*/
        }
        }

        ?>

    </div>
  </div>


<footer style="margin-top: 0;">
    <p>Account: <?php echo "<p6>".$_SESSION["userEmail"]."</p6>";?></p>
    <a href="../footer/agb.html" style="text-decoration: none;">Allgemeine Geschäftsbedingungen</a><a href="../footer/copyright.html" style="text-decoration: none;">Copyright</a>
    <p>Kontakt: <a href="mailto:someone@example.com">service@hotelfinder.com</a></p>
    <form method="post" action="../PhpStuff/inhaberLogout.php">
      <button type="submit" id="logoutButton"class="button2"name="logout-submit">Logout</button>
    </form>
 </footer>
</div>
</body>
</div>
</html>
<?php
  mysqli_close($conn);
?>
