<?php
    ob_start();
?>
<header>
	<h2>Editer le transport</h2>
	<p>Les champs marqués d'un * sont obligatoires</p>
</header>
<div class="row">
    <div class="12u">
        <!-- Text -->
        <section class="box">
			<form method="post" action="index.php?action=change_Transport&id=<?php echo $_GET['id'];?>" enctype="multipart/form-data">
				<div class="row uniform 50%">
					<div class="6u 12u(mobilep)">
						<input type="text" name="place_Start" value="<?php echo htmlspecialchars($transport['Place_Start']);?>" placeholder="Lieu de départ*" maxlength="45" required/>
					</div>
                    <div class="6u 12u(mobilep)">
						<input type="text" name="place_End" value="<?php echo htmlspecialchars($transport['Place_End']);?>" placeholder="Lieu d'arrivée*" maxlength="45" required/>
					</div>
				</div>
                <div class="row uniform 50%">
					<div class="6u 12u(mobilep)">
						<label for="date_Start">Date du départ*:</label>
						<input type="date" id="start" name="date_Start" value="<?php echo $transport['Day_Start'];?>" onchange="set_Min_Date()" min="2018-01-01" required/>
					</div>
					<div class="6u 12u(mobilep)">
						<label for="date_End">Date d'arrivée*:</label>
						<input type="date" id="end"  name="date_End" value="<?php echo $transport['Day_End'];?>" onchange="set_Min_Date()" required/>
					</div>
				</div>
                <div class="row uniform 50%">
					<div class="6u 12u(mobilep)">
						<label for="date_Start">Heure du départ:</label>
						<input type="time" name="time_Start" value="<?php
                                                                        $time_Start = date_create("2000-01-01".$transport['Time_Start']);
                                                                        $format_Time_Start = date_format($time_Start,"H:i");
                                                                        echo $format_Time_Start;?>" />
					</div>
					<div class="6u 12u(mobilep)">
						<label for="date_End">Heure d'arrivée:</label>
						<input type="time"  name="time_End" value="<?php 
                                                                        $time_End = date_create("2000-01-01".$transport['Time_End']);
                                                                        $format_Time_End = date_format($time_End,"H:i");
                                                                        echo $format_Time_End;?>" />
					</div>
				</div>
                <div class="row uniform 50%">
                    <div class="6u 12u(mobilep)">
                        <div>Prix*:</div>
						<input type="number" id="price" onchange="two_Decimal()" value="<?php echo $transport['Price'];?>" name="price" value="0" min="0" step="0.01" required/>
                        <span>CHF</span>
                    </div>
                    <div class="6u">
						<div class="select-wrapper">
							<select name="type">
								<?php
                                    //First, set the selected one.
                                    foreach($transport_Types as $transport_Type)
                                    {
                                        if($transport_Type['idTransport_Type'] == $transport['fkTransport_Type'])
                                        {
                                            echo "<option value='".$transport_Type['idTransport_Type']."'>".$transport_Type['Type']."</option>";   
                                        }
                                    }
                                    foreach($transport_Types as $transport_Type)
                                    {
                                        if($transport_Type['idTransport_Type'] != $transport['fkTransport_Type'])
                                        {
                                            echo "<option value='".$transport_Type['idTransport_Type']."'>".$transport_Type['Type']."</option>";   
                                        }
                                    }
                                ?>
				            </select>
				        </div>
				    </div>
                </div>
				<div class="row uniform 50%">
					<div class="6u 12u(mobilep)">
						<input type="text" name="code" value="<?php echo htmlspecialchars($transport['Code']);?>" placeholder="Code de résertvation"/>
					</div>
					<div class="6u 12u(mobilep)">
						<input type="text" name="link" value="<?php echo htmlspecialchars($transport['Link']);?>" placeholder="Lien" maxlength="255"/>
					</div>
				</div>
                <div class="row uniform 50%">
                    <div class="12u 12u(mobilep)">
						<input type="text" name="note" value="<?php echo htmlspecialchars($transport['Note']);?>" placeholder="Remarque" maxlength="280"/>
                    </div>
                </div>
				<div class="row uniform 50%">
					<div class="6u 12u(mobilep)">
						<input type="file" name="image"/>
						<label for="image">Image du voyage</label>
					</div>
                    <div class="2u 12u(mobilep)">
				        <span>Image actuelle:</span>
					</div>
                    <div class="3u 12u(mobilep)">
				        <?php
                            //image
                            if($transport['Image'] == true)
                            {
                                 echo "<td><a class='no_Border' href='images/user".$_SESSION["id"]."/".$transport['fkTrip']."/Transport/".$transport['idTransport'].".jpg'><img class='thumbnail' src='images/user".$_SESSION["id"]."/".$transport['fkTrip']."/Transport/".$transport['idTransport'].".jpg'></a></td>";
                            }
                                 else
                            {
                                 echo '<td><img class="thumbnail" src="images/default_Transport.png"></td>';     
                            }
                        ?>
					</div>
				</div>
                <div class="center error">
                    <?php
                        if (isset($error_Message) && !empty($error_Message)) {
                            echo $error_Message;
                        }
                    ?>
                </div>
				<div class="row uniform 50%">
					<div class="12u" align="center">
						<ul class="actions">
					        <li><input type="submit" value="Modifier" /></li>
                            <li><a class="button" href="<?php echo "index.php?action=see_Trip&id=".$transport['fkTrip'];?>/#transport">Annuler</a></li>	
						</ul>
					</div>
				</div>
			</form>
		</section>
	</div>
</div>
                    
<?php
$contenu = ob_get_clean();
require "view/template.php";