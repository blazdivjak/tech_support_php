<!DOCTYPE html>
<nav class="horizontal-menu">
    <ul>
        <!--<li><a id="home" href="<?php echo STATIC_URL; ?>">Domov</a></li>-->
        <li><a id="problem_report" href="<?php echo STATIC_URL; ?>prijava_tezave_admin">VNOS TEŽAVE KLICATELJA</a></li>
        <li><a id="tickets" href="<?php echo STATIC_URL; ?>zahtevki_admin">ZAHTEVKI ZA POMOČ</a></li>
        <li><a class="pull-right" href="<?php echo STATIC_URL; ?>prijava"><i class="fa fa-user fa-2x"></i><span id="login"> <?php echo $this->name ?></span></a></li>
    </ul>
</nav>