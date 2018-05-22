<?php
    ob_start();
?>
<header>
	<h2><?php echo htmlspecialchars($trip['Title']);?></h2>
	<p><?php echo htmlspecialchars($trip['Destination']);?></p>
</header>
<div class="row">
    <div class="12u">
        <!-- Text -->
        <section class="box">
            
            <!-- Controls-->
            <div class="row">
                <div class="9u 12u(mobilep)">
				    <ul class="actions">
                        <li><a class="button" href="index.php?action=change_Trip&id=<?php echo $trip['idTrip'];?>">Modifier l'intitulé</a></li>
                        <li><a class="button" href="#">Exporter PDF</a></li>
				    </ul>
                </div>
                <div class="3u 12u(mobilep)" align="right">
				    <ul class="actions">
                        <li><a class="button special"  href="index.php?action=delete_Trip&id=<?php echo $trip['idTrip'];?>">Supprimer le voyage</a></li>
                    </ul>
                </div>
            </div>
            
            <!-- Date-->
            <div class="row">
                <div class="6u 12u(mobilep)">
                    <h3>Début: <?php
                                    $date = date_create($trip['Date_Start']);
                                    echo date_format($date,"d-m-Y");
                            ?>
                    </h3>
                </div>
                <div class="6u 12u(mobilep)">
                    <h3>Fin: <?php
                                    $date = date_create($trip['Date_End']);
                                    echo date_format($date,"d-m-Y");
                            ?>
                </div>
            </div>
            
            <!--Lodging-->
            <div class="row">
                <div class="6u 6u(mobilep)">
                    <ul class="actions">
                        <li><h3>Hébergements</h3></a></li>
                        <li><a class="button alt" href="index.php?action=new_Lodging&id=<?php echo $trip['idTrip']; ?>">Ajouter</a></li>
				    </ul>
                </div>
            </div>
            <div class="row">
                <div class="12u">
                    <div class="table-wrapper">
				        <table id="long_Table">
				            <tbody>
                                <?php 
                                    foreach($lodgings as $lodging)
                                    {
                                        $day_Start = date_create($lodging['Day_Start']);
                                        $day_End = date_create($lodging['Day_End']);
                                        
                                        echo '<tr>';
                                
                                        //image
                                        if($lodging['Image'] == true)
                                        {
                                            echo "<td><img class='thumbnail' src='images/user".$_SESSION["id"]."/".$trip['idTrip']."/Lodging/".$lodging['idLodging'].".jpg'></td>";
                                        }
                                        else
                                        {
                                            echo '<td><img class="thumbnail" src="images/default_Lodging.png"></td>';     
                                        }
                               
                                        echo '<td class="text_Center">'.htmlspecialchars($lodging['Address']).'<br>Type: '.$lodging['Type'].'</td>';
                                        echo '<td class="text_Center">Du: '.date_format($day_Start,"d-m-Y").' <br> au :'.date_format($day_End,"d-m-Y").'</td>';
                                        
                                        if($lodging['Link']=="")
                                        {
                                            echo '<td class="text_Center">'.$lodging['Price'].' CHF<br></td>';
                                        }
                                        else
                                        {
                                            echo '<td class="text_Center">'.$lodging['Price'].' CHF<br><a href="'.htmlspecialchars($lodging['Link']).'">lien</a></td>';   
                                        }
                                        echo "<td><a class='no_Border' href='index.php?action=change_Lodging&id=".$lodging['idLodging']."'><img src='images/edit.png'></a></td><td><a class='no_Border' href='index.php?action=delete_Lodging&id=".$lodging['idLodging']."'><img src='images/delete.png'></a></td>";
                                        echo '</tr>';
                                        echo '<tr>';
                                        echo '<td class="text_Center" colspan="6">Code: '.htmlspecialchars($lodging['Code']).'<br> Remarque: '.htmlspecialchars($lodging['Note']).'</td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
			         </div>            
                </div>
            </div>
            
            <div class="center error">
                <?php
                    if (isset($error_Message) && !empty($error_Message)) {
                        echo $error_Message;
                    }
                ?>
            </div>
		</section>
    
        <!-- Transports -->
        <section class="box">
            <div class="row">
                <div class="6u 6u(mobilep)">
                    <ul class="actions">
                        <li><h3>Transports</h3></a></li>
                        <li><a class="button alt" href="index.php?action=new_Transport&id=<?php echo $trip['idTrip']; ?>">Ajouter</a></li>
				    </ul>
                </div>
            </div>
            <div class="row">
                <div class="12u">
                    <div class="table-wrapper">
				        <table id="long_Table">
				            <tbody>
                                <?php 
                                    foreach($transports as $transport)
                                    {
                                        if($transport['Time_Start'] != null)
                                        {
                                            $day_Start = date_create($transport['Day_Start'].$transport['Time_Start']);
                                            $format_Day_Start = date_format($day_Start,"d-m-Y H:i");
                                        }
                                        else
                                        {
                                            $day_Start = date_create($transport['Day_Start']);
                                            $format_Day_Start = date_format($day_Start,"d-m-Y");
                                        }
                                        
                                        if($transport['Time_End'] != null)
                                        {
                                            $day_End = date_create($transport['Day_End'].$transport['Time_End']);
                                            $format_Day_End = date_format($day_End,"d-m-Y H:i");
                                        }
                                        else
                                        {
                                            $day_End = date_create($transport['Day_End']);
                                            $format_Day_End = date_format($day_End,"d-m-Y");
                                        }
                                        
                                        echo '<tr>';
                                
                                        //image
                                        if($transport['Image'] == true)
                                        {
                                            echo "<td><img class='thumbnail' src='images/user".$_SESSION["id"]."/".$trip['idTrip']."/Transport/".$transport['idTransport'].".jpg'></td>";
                                        }
                                        else
                                        {
                                            echo '<td><img class="thumbnail" src="images/default_Transport.png"></td>';     
                                        }
                               
                                        echo '<td class="text_Center">Départ le: '.$format_Day_Start.' à '.htmlspecialchars($transport['Place_Start']).'<br> Arrivée le:'.date_format($day_End,"d-m-Y H:i").' à '.htmlspecialchars($transport['Place_End']).'</td>';
                                        
                                        if($transport['Link']=="")
                                        {
                                            echo '<td class="text_Center">'.$transport['Price'].' CHF<br></td>';
                                        }
                                        else
                                        {
                                            echo '<td class="text_Center">'.$transport['Price'].' CHF<br><a href="'.htmlspecialchars($transport['Link']).'">lien</a></td>';   
                                        }
                                        echo "<td><a class='no_Border' href='index.php?action=change_Transport&id=".$transport['idTransport']."'><img src='images/edit.png'></a></td><td><a class='no_Border' href='index.php?action=delete_Transport&id=".$transport['idTransport']."'><img src='images/delete.png'></a></td>";
                                        echo '</tr>';
                                        echo '<tr>';
                                        echo '<td class="text_Center" colspan="6">Type: '.$transport['Type'].' Code: '.htmlspecialchars($transport['Code']).'<br> Remarque: '.htmlspecialchars($transport['Note']).'</td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
			         </div>            
                </div>
            </div>
        </section>
	</div>
</div>
                    
<?php
$contenu = ob_get_clean();
require "view/template.php";