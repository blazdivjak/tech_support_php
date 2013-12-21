<!DOCTYPE html>
<html>
<?php
include 'include/header.php';
?>
<body>
    <header>
        <div class="container">
            <h1>Spletna stran za tehnično pomoč</h1>
            <?php
            include 'include/menu_admin.php';
            ?>
        </div>
    </header>
    <div class="container">
        <section class="main">
            <h3>Vnos težave prijavljene preko telefona</h3>
            <p>
                Vnesite podatke o klicatelju in njegovi težavi, da jo bo mogoče voditi tudi preko spletnega sistema.
            </p>
            <form method="post" action="zahtevki.html">
                <p>
                    <label for="username">Uporabnik:</label>
                    <input id="username" maxlength="50" required autofocus name="username" placeholder="Uporabniško ime klicatelja"/> <span id="username_error" class="error-report"></span>
                </p>
                </p>
                <p>
                    <label>Težava:</label>
                    <input type="text" maxlength="50" required autofocus name="kratek_opis" id="kratek_opis" placeholder="Kratek opis težave"/> <span id="kratek_opis_error" class="error-report"></span>
                </p>

                <!--Staro HTML5, nekateri brskalniki ne prikazujejo -->
                <!--<p>
                    <label>Datum pričetka težave:</label>
                    <input type = "date" required name="date"/>
                </p>-->
                <p>
                    <label>Datum pričetka težave:</label>
                    <input type ="text" required id="datepicker" placeholder="dd/mm/llll" name="date"/> <span id="datepicker_error" class="error-report"></span>
                </p>
                <!--Staro HTML5, nekateri brskalniki ne prikazujejo -->
                <!--
                <p>
                    <label for = "podrocje">Področje težave:</label>
                    <input type = "text" required name="podrocje" id = "podrocje" placeholder = "Izberite področje, na katerem imate težave" list = "tezave" />
                    <datalist id = "tezave">
                        <option value = "Virtualni strežniki">
                        <option value = "Internetna povezava">
                        <option value = "E-Pošta">
                        <option value = "Varnostni incident">
                        <option value = "Drugo">
                    </datalist>
                </p>-->
                <p>
                    <label for = "podrocje">Področje težave:</label>
                    <input id="podrocje" /> <span id="podrocje_error" class="error-report"></span>
                </p>
                <p>
                    <label>Opis težave:</label>
                    <textarea name="opis" id="opis" required placeholder="Vnesite podroben opis težave"></textarea> <span id="opis_error" class="error-report"></span>
                </p>
                <!--Staro HTML5, nekateri brskalniki ne prikazujejo -->
                <!--<p>
                    <label>Telefonska številka:</label>
                        <input type = "tel" placeholder = "### ###-###" pattern = "\d{3} +\d{3}-\d{3}" required />
                </p>-->
                <p>
                    <label>Telefonska številka:</label>
                    <input type = "text" placeholder = "### ###-###" name="tel" id="tel"/> <span id="tel_error" class="error-report"></span>
                </p>
                <p>
                    <label for = "closed">Težava odpravljena</label>
                    <input type="checkbox" id="closed" name="closed" value="Da"/>
                </p>
                <p>
                    <label for="expert">Posreduj strokovnjakom</label>
                    <input type="checkbox" id="expert" name="expert" value="Da"/>
                </p>
                <p>
                    <button class="btn" type ="submit" id="submit">Potrdi</button>
                    <button class="btn" type ="reset">Prekliči</button>
                </p>
            </form>
        </section>
        <!-- footer -->
        <?php
        include 'include/footer.php';
        ?>
    </div> <!--! end of #container -->
</body>
</html>