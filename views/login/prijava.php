<!DOCTYPE html>
<html>
<!--Header Include -->
<?php
include 'include/header.php';
?>
<body>
        <section class="login">
            <div class="container-login">
                <h3 id="header">Prijava</h3>

                <!--Display error message -->
                <?php
                    echo $this->msg;
                ?>

                <p id="login_text">
                    Vnesite uporabniško ime in geslo
                </p>
                <form method="post" action="<?php echo STATIC_URL; ?>prijava/prijavime">
                    <p>
                        <label id="username_text">Uporabniško ime:</label>
                        <input type="text" maxlength="50" required autofocus name="username" id="username" placeholder="Uporabniško ime"/>
                        <br/><span id="username_error" class="error-report"></span>
                    </p>
                    <p>
                        <label id="password_text">Geslo:</label>
                        <input type="password" id="password" name="password" name="opis" required placeholder="Geslo"/>
                        <br/><span id="password_error" class="error-report"></span>
                    </p>
                    <p>
                        <label for = "remember">Zapomni si me</label>
                        <input type="checkbox" id="remember" name="remember" value="yes"/>
                    </p>
                    <p>
                        <button class="btn" type ="submit" id="submit">Prijava</button>
                    </p>
                </form>
            </div>
        </section>
        <!-- footer -->
    <div class="container-login">
       <footer>
           Vse pravice pridržane (c) 2013 <a href="http://www.divjak.si">divjak.si</a>
           <!--Lang Change -->
           <div id="lang_change">
               <a href="" id="english">Angleščina</a> | <a href="" id="slovenian">Slovenščina</a>
           </div>
           <script src="js/change_language.js" type="application/javascript"></script>
           <!--Website Javscript files -->
           <script src="js/login_validation.js" type="application/javascript"></script>
       </footer>
    </div> <!--! end of #container -->
</body>
</html>