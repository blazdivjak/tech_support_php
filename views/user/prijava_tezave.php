<!DOCTYPE html>
<html>
<!--Header Include -->
<?php
include 'include/header.php';
?>
    <body>
        <header>
            <div class="container">
                <h1>Spletna stran za tehnično pomoč</h1>
                <?php
                include 'include/menu_user.php';
                ?>
            </div>
        </header>
        <div class="container">
            <section class="main">
                <h3>Opis težave</h3>
                <p>
                    Vnesite potrebne podatke, ki jih bodo naši tehniki uporabili pri reševanju vaše težave. Pomembno je, da vnesete telefonsko številko, na katero vas lahko kontaktirajo za dodatne informacije.
                </p>
                <form id="prijava_tezave" method="post" action="<?php echo STATIC_URL; ?>prijava_tezave/dodaj">
                    <p>
                        <label>Težava:</label>
                        <input type="text" maxlength="50" required autofocus name="kratek_opis" value="<?php echo $this->values['kratek_opis']; ?>" id="kratek_opis" placeholder="Kratek opis težave"/> <span id="kratek_opis_error" class="error-report"><?php echo $this->errors['kratek_opis']; ?></span>
                    </p>

                    <!--Staro HTML5, nekateri brskalniki ne prikazujejo -->
                    <!--<p>
                        <label>Datum pričetka težave:</label>
                        <input type = "date" required name="date"/>
                    </p>-->
                    <p>
                        <label>Datum pričetka težave:</label>
                        <input type ="text" required id="datepicker" value="<?php echo $this->values['datum']; ?>" placeholder="dd/mm/llll" name="date"/> <span id="datepicker_error" class="error-report"><?php echo $this->errors['datum']; ?></span>
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
                        <input id="podrocje" value="<?php echo $this->values['podrocje']; ?>" name="podrocje" /> <span id="podrocje_error" class="error-report"><?php echo $this->errors['podrocje']; ?></span>
                    </p>
                    <p>
                        <label>Opis težave:</label>
                        <textarea name="opis" id="opis" value="<?php echo $this->values['opis']; ?>" required placeholder="Vnesite podroben opis težave"></textarea> <span id="opis_error" class="error-report"><?php echo $this->errors['opis']; ?></span>
                    </p>
                    <!--Staro HTML5, nekateri brskalniki ne prikazujejo -->
                    <!--<p>
                        <label>Telefonska številka:</label>
                            <input type = "tel" placeholder = "### ###-###" pattern = "\d{3} +\d{3}-\d{3}" required />
                    </p>-->
                    <p>
                        <label>Telefonska številka:</label>
                        <input type = "text" placeholder = "### ###-###" value="<?php echo $this->values['tel']; ?>" name="tel" id="tel"/> <span id="tel_error" class="error-report"><?php echo $this->errors['tel']; ?></span>
                    </p>
                    <p>
                        <button class="btn" id="submit" name="submit" type ="submit">Potrdi</button>
                        <button class="btn" id="reset" type ="reset">Prekliči</button>
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