<?php
    ob_start();
?>
<header>
	<h2><?php echo htmlspecialchars($registred_Trip['Title']);?></h2>
	<p><?php echo htmlspecialchars($registred_Trip['Destination']);?></p>
</header>
<div class="row">
    <div class="12u"
    >
        
        <section class="box">
            <!-- Controls-->
            <div class="info">
                <?php
                    if (isset($info_Message) && !empty($info_Message)) {
                        echo $info_Message;
                    }
                ?>
            </div>
            <div class="error">
                <?php
                    if (isset($error_Message) && !empty($error_Message)) {
                        echo $error_Message;
                    }
                ?>
            </div>
            <div class="row">
                <div class="9u 12u(mobilep)">
				    <ul class="actions">
                        <?php 
                            if(isset($registred) && empty($registred))
                            {
                                echo "<li><a class='button' href='index.php?action=registration_Trip&id=". $registred_Trip['idTrip']."'>Participer</a></li>";
                            }
                        ?>
                        <li><a class="button" href="#">Exporter PDF</a></li>
				    </ul>
                </div>
            </div>
            
            <!-- SUMMARY -->
            <div class="row">
                <!-- Date start -->
                <div class="4u 12u(mobilep)">
                    <h3>Début: <?php
                                    $date = date_create($registred_Trip['Date_Start']);
                                    echo date_format($date,"d-m-Y");
                            ?>
                    </h3>
                </div>
                <!-- Date End -->                
                <div class="4u 12u(mobilep)">
                    <h3>Fin: <?php
                                    $date = date_create($registred_Trip['Date_End']);
                                    echo date_format($date,"d-m-Y");
                            ?>
                </div>
                <!-- Total cost -->
                <div class="4u 12u(mobilep)">
                    <h3>Prix total: <?php
                                    $total_Cost = 0;
                                    foreach($lodgings as $lodging)
                                    {  $total_Cost += $lodging['Price']; }
                                    foreach($activities as $activity)
                                    {  $total_Cost += $activity['Price']; }
                                    foreach($transports as $transport)
                                    {  $total_Cost += $transport['Price']; }
                                    echo $total_Cost." CHF";
                            ?>
                </div>
            </div>
            
            <!--Lodging-->
            <div class="row" id="lodging">
                <div class="6u 6u(mobilep)">
                    <ul class="actions">
                        <li><h3>Hébergements</h3></a></li>
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
                                            echo "<td><a class='no_Border' href='images/user".$registred_Trip['fkUser_Organizer']."/".$registred_Trip['idTrip']."/Lodging/".$lodging['idLodging'].".jpg'><img class='thumbnail' src='images/user".$registred_Trip['fkUser_Organizer']."/".$registred_Trip['idTrip']."/Lodging/".$lodging['idLodging'].".jpg'></a></td>";
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
		</section>
    
        <!--Transports-->
        <section class="box" id="transport">
            <div class="row">
                <div class="6u 6u(mobilep)">
                    <ul class="actions">
                        <li><h3>Transports</h3></a></li>
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
                                            echo "<td><a class='no_Border' href='images/user".$registred_Trip['fkUser_Organizer']."/".$registred_Trip['idTrip']."/Transport/".$transport['idTransport'].".jpg'><img class='thumbnail' src='images/user".$registred_Trip['fkUser_Organizer']."/".$registred_Trip['idTrip']."/Transport/".$transport['idTransport'].".jpg'></a></td>";
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


        <!-- Activites -->
        <section class="box" id="activity">
            <div class="row">
                <div class="6u 6u(mobilep)">
                    <ul class="actions">
                        <li><h3>Activités</h3></a></li>
				    </ul>
                </div>
            </div>
            <div class="row">
                <div class="12u">
                    <div class="table-wrapper">
				        <table id="long_Table">
				            <tbody>
                                <?php 
                                    foreach($activities as $activity)
                                    {
                                        $day = date_create($activity['Date']);
                                        
                                        echo '<tr>';
                                
                                        //image
                                        if($activity['Image'] == true)
                                        {
                                            echo "<td><a class='no_Border' href='images/user".$registred_Trip['fkUser_Organizer']."/".$registred_Trip['idTrip']."/Activity/".$activity['idActivity'].".jpg'><img class='thumbnail' src='images/user".$registred_Trip['fkUser_Organizer']."/".$registred_Trip['idTrip']."/Activity/".$activity['idActivity'].".jpg'></a></td>";
                                        }
                                        else
                                        {
                                            echo '<td><img class="thumbnail" src="images/default_Activity.png"></td>';     
                                        }
                               
                                        echo '<td class="text_Center">Description: '.htmlspecialchars($activity['Description']).'<br> Prix: '.$activity['Price'].' CHF</td>';
                                        
                                        if($activity['Link']=="")
                                        {
                                            if($activity['Date'] != null)
                                            {
                                                 echo '<td class="text_Center">Le: '.date_format($day,"d-m-Y").'<br><br> </td>';
                                            }
                                            else
                                            {
                                                echo '<td class="text_Center"><br><br> </td>';
                                            }
                                        }
                                        else
                                        {
                                            if($activity['Date'] != null)
                                            {
                                                 echo '<td class="text_Center">'.date_format($day,"d-m-Y").'<br><a href="'.htmlspecialchars($activity['Link']).'">lien</a></td>';     
                                            }
                                            else
                                            {
                                                echo '<td class="text_Center"><a href="'.htmlspecialchars($activity['Link']).'">lien</a><br><br></td>';
                                            }
                                        }
                                        echo '</tr>';
                                        echo '<tr>';
                                        echo '<td class="text_Center" colspan="6">Remarque: '.htmlspecialchars($activity['Note']).'</td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
			         </div>            
                </div>
            </div>
        </section>

        <!-- Prerequisites -->
        <section class="box" id="prerequisite">
            <div class="row">
                <div class="6u 6u(mobilep)">
                    <ul class="actions">
                        <li><h3>Prérequis</h3></a></li>
				    </ul>
                </div>
            </div>
            <div class="row">
                <div class="12u">
                    <div class="table-wrapper">
				        <table id="simple_Table">
				            <tbody>
                                <?php 
                                    foreach($prerequisites as $prerequisite)
                                    {   
                                        echo '<tr>';
                                        echo '<td>'.htmlspecialchars($prerequisite['Name']).'</td>';
                                        echo '<td> quantité:'.htmlspecialchars($prerequisite['Quantity']).'</td>';
                                        if($prerequisite['Ready'] == true)
                                        {
                                            echo '<td><input type="checkbox" id="'.$prerequisite['idPrerequisite'].'" name="'.$prerequisite['idPrerequisite'].'"onclick="return false;" checked/>
                                            <label for="'.$prerequisite['idPrerequisite'].'"></label></td>'; //Without the label, the input doesn't render   
                                        }
                                        else
                                        {
                                            echo '<td><input type="checkbox" id="'.$prerequisite['idPrerequisite'].'" name="'.$prerequisite['idPrerequisite'].'"onclick="return false;" />
                                            <label for="'.$prerequisite['idPrerequisite'].'"></label></td>'; //Without the label, the input doesn't render
                                        }
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
			         </div>            
                </div>
            </div>
        </section>


        <!-- Participants -->
        <section class="box" id="participant">
            <div class="row">
                <div class="6u 6u(mobilep)">
                    <ul class="actions">
                        <li><h3>Participants</h3></li>
				    </ul>
                </div>
            </div>
            <div class="row">
                <div class="12u">
                    <div class="table-wrapper">
				        <table id="simple_Table">
				            <tbody>
                                <?php 
                                    foreach($participants as $participant)
                                    {   
                                        echo '<tr>';
                                        echo '<td>'.htmlspecialchars($participant['Nickname']).'</td>';
                                        echo "<td align='right'></td>";
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