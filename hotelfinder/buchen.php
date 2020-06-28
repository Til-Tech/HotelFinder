<?php
    session_start();
/*Session wird gestartet, um auf Daten wie Sessionvariablen der Superglobalen $_SESSION zugreifen zu können.*/
    ?>

<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
        <title>Buchen</title>
        <link rel="stylesheet" type="text/css" href="../stylesheets/stylesheet.css">
        <script src="https://kit.fontawesome.com/b4d54f0eb8.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Righteous&display=swap" rel="stylesheet">
        <script type="text/javascript" src="../js/vanilla-calendar.js"></script>
        <link rel="stylesheet" type="text/css" href="../js/vanilla-calendar.css">
    </head>
    <body>
    <body class="hotelfinder">
        <div id="page-container">
            <div class="logoHotelfinder">
                <a href="../index.php"><img src="../images/logo.png" style="height:70px"></a>
            </div>
            <div id="wrapper">
                <!-- Die Ergebnissklasse hier in voller Breite -->
                    <ul class="results" style="width: 100%">
                    <?php
                    if(isset($_GET["ID"])) {
/*Prüfen, ob ID in der URL existiert, welche verwendet wird um das richtige Hotel zu buchen.*/
                        include("../PhpStuff/connectDB.php");
/*Skript für die Datenbankserververbindung einbinden, um SQL Befehle zu starten.*/
                        $sql = "Select * From Hotel where hid = ${_GET["ID"]}";
/*Sql Statement wird als String in der $sql Variablen initialisiert. Die Abfrage ist dazu da, um das richitge Hotel auf das geklickt wurde 
  anzuzeigen.*/
                        $result = mysqli_query($conn,$sql);
/*Führt die SQL Abfrage aus.*/
                        if(mysqli_num_rows($result)>0) {
/*Wenn die Abfrage Ergebnisse liefert, dann wird der nachfolgende Code ausgeführt.*/
                        while($row = mysqli_fetch_assoc($result)) { ?>
<!-- Die Ergebniszeilen der Sql Abfrage werden im assoziativen Array $row gespeichert. -->
                        <li class="element">
                            <div class="image" style="width: 270px; height: 270px;"><img class="element" src="../images/<?php echo $row["bild"];?>" style='height: 100%; width: 100%; border-radius: 0.8em'>
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
                                    <?php
                                        echo $row["beschreibung"];
                                    ?>
                                    <br><b>Nachbarschaft:</b> </br>
                                    <?php echo $row["nachbarschaft"]; ?>
                                </div>
                                <div class="werte">
                                    <div class="price">
                                        <?php echo"<p>Preis</p>"."<p>".$row["preis"]."€</p>";?>
                                    </div>
                                    <?php
                                    $divArray = ["<div class=\"wert\">Sterne</div>","<div class=\"wert\">Innenstadt</div>","<div class=\"wert\">AC</div>",
                                    "<div class=\"wert\">Hotel</div>","<div class=\"wert\">Stornierung Kostenlos</div>","<div class=\"wert\">Meerblick</div>",
                                    "<div class=\"wert\">All Inclusive</div>","<div class=\"wert\">Haustierfreundlich</div>","<div class=\"wert\">Küche</div>",
                                    "<div class=\"wert\">Pool</div>","<div class=\"wert\">Casino</div>","<div class=\"wert\">Wlan</div>","<div class=\"wert\">Whirpool</div>",
                                    "<div class=\"wert\">Welness</div>","<div class=\"wert\">Frühstück</div>","<div class=\"wert\">Barrierefrei</div>"];
                                /*$divArray wird erstellt, um die Fiterattribute für jedes Hotel ausgeben zulassen die für das Hotel zutreffen.*/
                                    $keys = array_keys($row);
                                /*Die Attributnamen der Ergebniszeile werden in $keys gespeichert.*/
                                    for($i=14; $i<=29; $i++) {
                                        $value[] = $row[$keys[$i]];
                                    }
                                /*Die Atribute für den Filter beginnen in der Datenbanktabelle Hotel an 14. Stelle bis zur 29. Stelle. Solange
                                  läuft die For-Schleife durch. Im value[] Array werden nun die Wert der Spalten gepeichert, der Attribute, die
                                  für den Filter gedacht sind und boolesche Werte besitzen.*/
                                    $divsAndBooleans = array_combine($divArray, $value);
                                /*Nun werden die beiden Arrays kombiniert.*/
                                    $value = array();
                                /*$value Array wird aufgelöst.*/
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
                                /*$finalOutput Array wird aufgelöst um beim nöchsten Ergebnishotel wieder frei zu sein*/ ?>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="register" style="width:95%; margin: 0.5%; margin-top:0; border-radius: 4px;">
                        <?php if(isset($_GET["success"])) {
                            echo "<p>Sie haben ".$row["hotelname"]." erfolgreich gebucht!</p>";
                            } else
                            { ?>
                    <!-- Prüfen ob "success" in URL steht um Erfolgsmeldung auszugeben. -->
                        <script>init()</script>
                        <div class="registerTopic" style="margin-bottom:2%">
                            <p4>Zum Buchen füllen Sie bitte ihre Daten aus und wählen Sie anschließend ihre Wunschdaten</p4>
                        </div>
                        <div class="registerLeftRight">
                            <div class="registerLeft">
                            <form method="post" action="../PhpStuff/gastBuchen.php?ID=<?php echo $_GET["ID"]; ?>">
                                <div>
                                    <p5>Name</p5>
                                    <input type="text" class="here" name="Name" placeholder="Name" required>
                                </div>
                                <div>
                                    <p5>Vorname</label>
                                    <input type="text" class="here" name="Vorname" placeholder="Vorname" required>
                                </div>
                                <div>
                                    <p5>Ort</p5>
                                    <input type="text" class="here" name="Ort" placeholder="Ort" required>
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
                                    <p5>PLZ</p5>
                                    <input type="number" name="PLZ" placeholder="Postleitzahl" required>
                                </div>
                                <div>
                                    <p5>Email</p5>
                                    <input type="text" class="here" name="Email" placeholder="Email" required>
                                </div>
                                <div>
                                    <p5>Telefonnummer</p5>
                                    <input type="number" name="Telefonnummer" placeholder="Telefonnummer" required>
                                </div>
                            </div>
                            <div class="registerRight">
                                <!-- Hintergrund für den Kalendar -->
                                <div style="background-color: #333333; padding:1%; border-radius:15px;">
                                    <!-- Knopfstyling und Anordnung -->
                                    <div class="area-buttons" id="eben">
                                        <button type="button" class="info" name="pastDates" >Vergangene Tage ausblenden</button>
                                        <button type="button" class="info" name="availableDates">Buchbare Tage einblenden</button>
                                        <button type="button" class="info" name="availableWeekDays">Generelle Öffnungstage einblenden</button>
                                    </div>
                                    <!-- Einbindung des Kalendars -->
                                    <div id="myCalendar" class="vanilla-calendar" style="margin-bottom: 20px">
                                    </div>
                                </div>
                            </div>
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
                        /*Prüfen ob "error" in URL steht um mit Superglobalen $_GET die Fehlermeldungen auszugeben.*/ 
                            }
                            if(@$_GET["success"]=="registrierungerfolgreich") {
                                echo "<p>Sie haben sich erfolgreich registriert!</p>";
                            }
                                }
                            }
                            }
                            }
                            ?>
                        <!-- Eben-Container zur gleichmäßigen Anordnung der Knöpfe -->
                        <div id="eben">
                            <a href="details.php?ID=<?php echo $_GET["ID"]; ?>" class="button2">Zurück</button></a>
                            <button type="submit" name="gastBuchen-submit" class="button2">Buchen</button>
                            </form>
                        </div>
                    <!-- Register-Container wird geschlossen -->
                    </div>
                    <footer>
                        <a href="../footer/logIn.php">Anmeldung für Hotelbesiter</a><a href="../footer/agb.html" style="text-decoration: none;">Allgemeine Geschäftsbedingungen</a><a href="../footer/copyright.html" style="text-decoration: none;">Copyright</a>
                        <p>Kontakt: <a href="mailto:info.hotelfinder@web.de">service@hotelfinder.com</a></p>
                    </footer>
                </div>
                <!-- Das folgende Script ist übernommen von
                Vanilla AutoComplete v0.1
                Copyright (c) 2019 Mauro Marssola (OpenSource+Free of charge)
                GitHub: https://github.com/marssola/vanilla-calendar
                License: http://www.opensource.org/licenses/mit-license.php -->
                <script>
                    let pastDates = true, availableDates = false, availableWeekDays = false

                    let calendar = new VanillaCalendar({
                        selector: "#myCalendar",
                        months: ["Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember"],
                        shortWeekday: ['So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa'],
                        onSelect: (data, elem) => {
                            console.log(data, elem)
                        }
                    })

                    let btnPastDates = document.querySelector('[name=pastDates]')
                    btnPastDates.addEventListener('click', () => {
                        pastDates = !pastDates
                        calendar.set({pastDates: pastDates})
                        btnPastDates.innerText = `Vergangene Tage ${(pastDates ? 'aus' : 'ein')}blenden`
                    })

                    let btnAvailableDates = document.querySelector('[name=availableDates]')
                    btnAvailableDates.addEventListener('click', () => {
                        availableDates = !availableDates
                        btnAvailableDates.innerText = `Buchbare Tage ${(availableDates ? 'aus' : 'ein')}blenden`
                        if (!availableDates) {
                            calendar.set({availableDates: [], datesFilter: false})
                            return
                        }
                        let dates = () => {
                            let result = []
                            for (let i = 1; i < 15; ++i) {
                                if (i % 2) continue
                                let date = new Date(new Date().getTime() + (60 * 60 * 24 * 1000) * i)
                                result.push({date: `${String(date.getFullYear())}-${String(date.getMonth() + 1).padStart(2, 0)}-${String(date.getDate()).padStart(2, 0)}`})
                            }
                            return result
                        }
                        calendar.set({availableDates: dates(), availableWeekDays: [], datesFilter: true})
                    })

                    let btnAvailableWeekDays = document.querySelector('[name=availableWeekDays]')
                    btnAvailableWeekDays.addEventListener('click', () => {
                        availableWeekDays = !availableWeekDays
                        btnAvailableWeekDays.innerText = `Generelle Öffnungstage ${(availableWeekDays ? 'aus' : 'ein')}blenden`
                        if (!availableWeekDays) {
                            calendar.set({availableWeekDays: [], datesFilter: false})
                            return
                        }
                        let days = [{
                            day: 'monday'
                        }, {
                            day: 'tuesday'
                        }, {
                            day: 'wednesday'
                        }, {
                            day: 'friday'
                        }]
                        calendar.set({availableWeekDays: days, availableDates: [], datesFilter: true})
                    })
        </script>
    </body>
</html>
<?php
  mysqli_close($conn);
?>
