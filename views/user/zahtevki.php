<!DOCTYPE html>
<html>
    <head>
<!--Header Include -->
<?php
include 'include/header.php';
?>
    </head>
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
                <h3>Zahtevki za pomoč</h3>
                <?php echo $this->msg; ?>
                <p>
                    Spisek vaših zahtevkov za pomoč, ki so že bili rešeni, ali pa še čakajo na obdelavo.
                </p>
                <div id="searchbox" class="search">
                    <form action="zahtevki.html">
                        <p>
                            <label id="search_label">Išči:</label>
                            <input type = "text" id="search" name="search" placeholder = "Iskalni parameter" />
                            <button class="btn" type ="submit">Potrdi</button>
                        </p>
                    </form>
                </div>
                <table class="tabela-zahtevkov">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th id="problem"scope="col">Težava</th>
                        <th id="date" scope="col">Datum</th>
                        <th id="field" scope="col">Področje</th>
                        <th id="agent" scope="col">Agent</th>
                        <th id="status" scope="col">Status</th>
                        <th id="action" scope="col">Akcije</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($this->tickets as $row){
                    //echo $row['userid'];
                        ?><tr>
                            <td><?php echo $row['ticketid'];?></td>
                            <td><?php echo $row['problem'];?></td>
                            <td><?php echo $row['date'];?></td>
                            <td><?php echo $row['type'];?></td>
                            <td><?php echo $row['agent'];?></td>
                            <td><?php echo $row['state'];?></td>
                            <td><a href="<?php echo STATIC_URL; ?>zahtevki/uredi/<?php echo $row['ticketid'];?>"><i class="fa fa-pencil-square-o"></i></a> <a href="<?php echo STATIC_URL; ?>zahtevki/izbrisi/<?php echo $row['ticketid'];?>"><i class="fa fa-trash-o"></i></a></td>
                        </tr>
                    <?php }?>
                        <!--<tr>
                            <td>1</td>
                            <td>Problem z apache strežnikom</td>
                            <td>26/10/2013</td>
                            <td>Virtualni strežniki</td>
                            <td>/</td>
                            <td>Čaka na odziv agenta</td>
                            <td><a href="podrobnosti_zahtevka.html"><i class="fa fa-pencil-square-o"></i></a> <a href="#"><i class="fa fa-trash-o"></i></a></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Wireless router</td>
                            <td>13/10/2013</td>
                            <td>Internetna povezava</td>
                            <td>Rolando Wirelez</td>
                            <td>V obdelavi</td>
                            <td><a href="podrobnosti_zahtevka.html"><i class="fa fa-eye"></i></a> <a href="#"><i class="fa fa-trash-o"></i></a></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Spam</td>
                            <td>10/10/2013</td>
                            <td>Varnostni incident</td>
                            <td>Matjaž Pančur</td>
                            <td>Čaka na vaš odziv</td>
                            <td><a href="podrobnosti_zahtevka.html"><i class="fa fa-eye"></i></a> <a href="#"><i class="fa fa-trash-o"></i></a></td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Izgubljeno geslo</td>
                            <td>05/09/2013</td>
                            <td>Drugo</td>
                            <td>Alberto Komputador</td>
                            <td>Zaključeno</td>
                            <td><a href="podrobnosti_zahtevka.html"><i class="fa fa-eye"></i></a> <a href="#"><i class="fa fa-trash-o"></i></a></td>
                        </tr>-->
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7" rowspan="1"><a href="prijava_tezave.html">Dodaj zahtevek</a></td>
                        </tr>
                    </tfoot>
                </table>
            </section>
            <!-- footer -->
            <?php
            include 'include/footer.php';
            ?>
        </div> <!--! end of #container -->
    </body>
</html>