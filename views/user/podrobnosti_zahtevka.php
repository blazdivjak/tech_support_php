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
                <h3>Zahtevki za pomoč</h3>
                <p>
                    Spisek vaših zahtevkov za pomoč, ki so že bili rešeni, ali pa še čakajo na obdelavo.
                </p>
                <div id="searchbox" class="search">
                    <form action="zahtevki.html">
                        <p>
                            <label>Išči:</label>
                            <input type = "text" id="search" name="search" placeholder = "Iskalni parameter" />
                            <button class="btn" type ="submit">Potrdi</button>
                        </p>
                    </form>
                </div>
                <table class="tabela-zahtevkov">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Težava</th>
                        <th scope="col">Datum</th>
                        <th scope="col">Področje</th>
                        <th scope="col">Agent</th>
                        <th scope="col">Status</th>
                        <th scope="col">Akcije</th>
                    </tr>
                    </thead>
                    <tbody id="table_body">
                    <?php foreach($this->tickets as $row){
                        ?><tr>
                        <td><?php echo $row['ticketid'];?></td>
                        <td><?php echo $row['problem'];?></td>
                        <td><?php echo $row['date'];?></td>
                        <td><?php echo $row['type'];?></td>
                        <td><?php echo $this->admin_info[$row['adminid']];?></td>
                        <td>
                            <?php
                            if($row['state']=='1'){
                                echo "Čaka na odziv agenta";
                            }elseif($row['state']=='2'){
                                echo "V obdelavi";
                            }elseif($row['state']=='3'){
                                echo "Čaka na vaš odziv";
                            }elseif($row['state']=='4'){
                                echo "Zaključen";
                            }else{
                                echo "Neveljavno stanje";
                            }
                            //echo $row['state'];
                            ?>
                        </td>
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
                            <td><a href="#"><i class="fa fa-pencil-square-o"></i></a> <a href="#"><i class="fa fa-trash-o"></i></a></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Wireless router</td>
                            <td>13/10/2013</td>
                            <td>Internetna povezava</td>
                            <td>Rolando Wirelez</td>
                            <td>V obdelavi</td>
                            <td><a href="podrobnosti_zahtevka.php"><i class="fa fa-eye"></i></a> <a href="#"><i class="fa fa-trash-o"></i></a></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Spam</td>
                            <td>10/10/2013</td>
                            <td>Varnostni incident</td>
                            <td>Matjaž Pančur</td>
                            <td>Čaka na vaš odziv</td>
                            <td><a href="podrobnosti_zahtevka.php"><i class="fa fa-eye"></i></a> <a href="#"><i class="fa fa-trash-o"></i></a></td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Izgubljeno geslo</td>
                            <td>05/09/2013</td>
                            <td>Drugo</td>
                            <td>Alberto Komputador</td>
                            <td>Zaključeno</td>
                            <td><a href="podrobnosti_zahtevka.php"><i class="fa fa-eye"></i></a> <a href="#"><i class="fa fa-trash-o"></i></a></td>
                        </tr>-->
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7" rowspan="1"><a href="<?php echo STATIC_URL; ?>prijava_tezave">Dodaj zahtevek</a></td>
                        </tr>
                    </tfoot>
                </table>
            </section>

            <!--Ticket details -->
            <section class="ticket-details">
                <h3>Podrobnosti zahtevka</h3>
                <p>
                    <strong>ID:</strong> <?php echo $this->edit_ticket[0]['ticketid'];?>
                </p>
                <p>
                    <strong>Težava:</strong> <?php echo $this->edit_ticket[0]['problem'];?>
                </p>
                <p>
                    <strong>Datum:</strong> <?php echo $this->edit_ticket[0]['date'];?>
                </p>
                <p>
                    <strong>Področje težave:</strong> <?php echo $this->edit_ticket[0]['type'];?>
                </p>
                <p>
                    <strong>Opis težave:</strong> <?php echo $this->edit_ticket[0]['description'];?>
                </p>
                <p>
                    <strong>Status:</strong>
                    <?php
                    if($this->edit_ticket[0]['state']=='1'){
                        echo "Čaka na odziv agenta";
                    }elseif($this->edit_ticket[0]['state']=='2'){
                        echo "V obdelavi";
                    }elseif($this->edit_ticket[0]['state']=='3'){
                        echo "Čaka na vaš odziv";
                    }elseif($this->edit_ticket[0]['state']=='4'){
                        echo "Zaključen";
                    }else{
                        echo "Neveljavno stanje";
                    }
                    ?>
                </p>

                <!-- Different buttons based on ticket state -->
                <form method="post" action="<?php echo STATIC_URL; ?>zahtevki/posodobi/<?php  echo $this->edit_ticket[0]['ticketid'];?>">

                <?php
                    if($this->edit_ticket[0]['state']=="4"){
                        echo "<input type='hidden' name='state' value='1'>";
                        echo "<button class='btn large'>Ponovno odpri primer</button>";
                    }else{
                        echo "<input type='hidden' name='state' value='4'>";
                        echo "<button class='btn large'>Potrdi rešitev primera</button>";
                    }?>
                </form>
                <!--Odzivi -->
                <h3>Odziv agenta</h3>

                <?php foreach($this->messages as $message){

                    if($message['privilegelvl']=="1"){
                        echo "<div class='chat client pull-right'>";
                        echo  "<p>";
                        echo  "<b>";
                        echo $message['date']," ",  $message['user'];
                        echo "</b>";
                        echo  "</p>";
                        echo  "<p>";
                        echo $message['content'];
                        echo  "</p>";
                        echo "</div>";
                        echo "<div class='clear'></div>";
                    }else{
                        echo "<div class='chat agent pull-left'>";
                        echo  "<p>";
                        echo  "<b>";
                        echo $message['date']," ",  $message['user'];
                        echo "</b>";
                        echo  "</p>";
                        echo  "<p>";
                        echo $message['content'];
                        echo  "</p>";
                        echo "</div>";
                        echo "<div class='clear'></div>";
                    }
                }
                ?>
                <!--
                <div class="chat agent pull-left">
                    <p>
                        <b>10.10.2013 10:15 Matjaž Pančur</b>
                    </p>
                    <p>
                        Do težave je prišlo, ker ste imeli nameščen neposodobljen PHP, kar je omogočilo zlobnim kitajcem, da vam v Joomlo prešvercajo hrošče in črve.
                    </p>
                </div>
                <div class="clear"></div>
                <div class="chat client pull-right">
                    <p>
                        <b>10.10.2013 13:15 Janez Novak</b>
                    </p>
                    <p>
                        To ni res, jaz imam vse posodobljeno! Težava je na vaši strani....
                    </p>
                </div>
                <div class="clear"></div>
                <div class="chat agent pull-left">
                    <p>
                        <b>10.10.2013 13:16 Matjaž Pančur</b>
                    </p>
                    <p>
                        Čimprej posodobite na zadnjo verzijo PHP 5.6 in ponovno namestite Joomlo
                    </p>
                </div>
                <div class="clear"></div>
                <div class="chat agent pull-left">
                    <p>
                        <b>15.10.2013 08:00 Matjaž Pančur</b>
                    </p>
                    <p>
                        Opomnik, da čimprej posodobite. Začasno smo vam izključili strežnik apache.
                    </p>
                </div>
                <div class="clear"></div>
                <div class="chat agent pull-left">
                    <p>
                        <b>26.10.2013 10:15 Matjaž Pančur</b>
                    </p>
                    <p>
                        Če še vedno ne boste posodobili PHP-ja na strežniku vam ga bomo morali za vedno ugasniti. Sedaj imate na strežniku že za en živalski vrt črvov
                        hročov in podobne nesnage. Rok za ureditev imate do jutri. Predlagamo, da si preberete tudi FAQ, ki ga je pripravil borec proti zlobnim volkom Strašni Lev.
                    </p>
                </div>
                <div class="clear"></div>
                <div class="chat client pull-right">
                    <p>
                        <b>26.10.2013 11:00 Janez Novak</b>
                    </p>
                    <p>
                        Vse smo posodobili. Sedaj spet vse deluje. Z moje strani lahko primer zapremo.
                    </p>
                </div>
                <div class="clear"></div>-->
                <div class="nov-odgovor">
                    <form method="post" action="<?php echo STATIC_URL; ?>zahtevki/poslji/<?php  echo $this->edit_ticket[0]['ticketid'];?>">
                        <p>
                            <label>Novo sporočilo:</label>
                            <div class="clear"></div>
                            <textarea title="Vnesite sporočilo za naše strokovnjake. Odzvali se vam bodo najkasneje v 24urah." name="message" id="message" required placeholder="Sporočilo za tehnično pomoč"></textarea>
                            <br/><span id="message_error" class="error-report"></span>
                        </p>
                        <p>
                            <button class="btn" type="submit" id="submit">Pošlji</button>
                        </p>
                    </form>
                </div>
                <div class="clear"></div>
            </section>
            <!-- footer -->
            <?php
            include 'include/footer.php';
            ?>
        </div> <!--! end of #container -->
    </body>
</html>