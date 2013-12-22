<!DOCTYPE html>
<html>
<!--Header Include -->
<?php
include 'include/header.php';
?>
<body>
    <header>
        <div class="container">
            <h1 id="page_header">Spletna stran za tehnično pomoč</h1>
            <?php
            include 'include/menu_user.php';
            ?>
        </div>
    </header>
    <div class="container">
        <nav>
            <div class="row">
                <div class="prijava-tezave col-2">
                    <div id="problem" class="title">Imate težave pri uporabi naših storitev?</div>
                    <p>
                        <a href="<?php echo STATIC_URL; ?>prijava_tezave"><i class="fa fa-user-md fa-5x"></i></a>
                        <a id="prijava_tezave" href="<?php echo STATIC_URL; ?>prijava_tezave">Prijavi težavo našim strokovnjakom</a>
                    </p>
                </div>
                <div class="zahtevki col-2">
                    <div id="view_tickets" class="title">Pregled mojih zahtevkov</div>
                    <p>
                        <a href="<?php echo STATIC_URL; ?>zahtevki"><i class="fa fa-h-square fa-5x animate"></i></a>
                        <a id="moji_zahtevki" href="<?php echo STATIC_URL; ?>zahtevki">Moji zahtevki</a>
                    </p>
                </div>
            </div>
        </nav>
        <section class="main">
            <article>
                <h1 id="header">Prijava tehničnih napak na preprost način</h1>
                <p>
                    Dobrodošli na spletni strani našega IT podjetja. Na tej spletni strani lahko prijavite težavo, ki vam jo bomo poskusili pomagati rešiti. Prav tako lahko tudi
                    pogledate odzive naših tehnikov na vaše že prijavljene težave.
                </p>
                <h3>Recept za rešitev iz zagate:</h3>

                <ol class="orange">
                    <li>Prijavite težavo. To lahko storite preko <a href="<?php echo STATIC_URL; ?>prijava_tezave">spletnega obrazca</a> ali preko telefona, na T: 031-772-079.</li>
                    <li>Ekspresna rešitev težave s strani naših študentov in strokovnjakov.</li>
                    <li>Potrditev odprave težave z vaše strani in zaključek primera.</li>
                </ol>

            </article>
        </section>

        <!-- footer -->
        <?php
            include 'include/footer.php';
        ?>
    </div> <!--! end of #container -->
</body>
</html>