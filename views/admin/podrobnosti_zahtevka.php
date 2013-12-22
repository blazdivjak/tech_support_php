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
                include 'include/menu_admin.php';
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
                    <form action="<?php echo STATIC_URL; ?>zahtevki_admin" method="post">
                        <p>
                            <label>Išči:</label>
                            <input type = "text" id="search" value="<?php echo $this->query;?>" name="search" placeholder = "Iskalni parameter" />
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
                    <tbody>
                    <?php foreach($this->tickets as $row){
                        //echo $row['userid'];
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
                                echo "Čaka na odziv uporabnika";
                            }elseif($row['state']=='4'){
                                echo "Zaključen";
                            }else{
                                echo "Neveljavno stanje";
                            }
                            //echo $row['state'];
                            ?>
                        </td>
                        <td>
                            <a href="<?php echo STATIC_URL; ?>zahtevki_admin/uredi/<?php echo $row['ticketid'];?>"><i class="
                            <?php if($row['adminid']==''){
                                echo 'fa fa-ambulance';
                                }else{
                                echo 'fa fa-eye';
                                }
                             ?>
                             "></i></a> <a href="<?php echo STATIC_URL; ?>zahtevki_admin/izbrisi/<?php echo $row['ticketid'];?>"><i class="fa fa-trash-o"></i></a></td>
                        </tr>
                    <?php }?>

                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7" rowspan="1"><a href="<?php echo STATIC_URL; ?>prijava_tezave_admin">Vnos težave klicatelja</a></td>
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
                        echo "Čaka na odziv uporabnika";
                    }elseif($this->edit_ticket[0]['state']=='4'){
                        echo "Zaključen";
                    }else{
                        echo "Neveljavno stanje";
                    }
                    ?>
                </p>
                <h3>Kontaktni podatki uporabnika</h3>
                <p>
                    <strong>Uporabniško ime:</strong> <?php echo $this->user_info[0]['username'];?>
                </p>
                <p>
                    <strong>Mail:</strong> <?php echo $this->user_info[0]['email'];?>
                </p>
                <p>
                    <strong>Telefon:</strong> <?php echo $this->edit_ticket[0]['phone'];?>
                </p>

                <!--<button class="btn large">Prevzemi primer</button> <button class="btn large">Eskaliraj</button>-->

                <!-- Different buttons based on ticket state -->
                <form method="post" action="<?php echo STATIC_URL; ?>zahtevki_admin/posodobi/<?php  echo $this->edit_ticket[0]['ticketid'];?>">

                <?php
                    if($this->edit_ticket[0]['state']!='4' && $this->adminid != $this->edit_ticket[0]['adminid']){
                        echo "<input type='hidden' name='state' value='2'>";
                        echo "<input type='hidden' name='owner' value='ownthisticket'>";
                        echo "<button class='btn large'>Prevzemi primer</button>";
                    }elseif($this->edit_ticket[0]['level']!=3){
                        echo "<input type='hidden' name='escalate' value='3'>";
                        echo "<button class='btn large'>Eskaliraj</button>";
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
                <div class="nov-odgovor">
                    <form method="post" action="<?php echo STATIC_URL; ?>zahtevki_admin/poslji/<?php  echo $this->edit_ticket[0]['ticketid'];?>">
                        <p>
                            <label>Novo sporočilo:</label>
                            <div class="clear"></div>
                            <textarea name="message" id="message" required placeholder="Sporočilo za stranko"></textarea>
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