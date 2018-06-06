<?php
    ob_start();
?>
<header>
	<h2>Editer l'hébergement</h2>
	<p>Les champs marqués d'un * sont obligatoires</p>
</header>

<div class="row">
    <div class="12u">
        <section class="box">
			<form method="post" action="index.php?action=change_Lodging&id=<?php echo $_GET['id'];?>" enctype="multipart/form-data">
				<div class="row uniform 50%">
					<div class="12u 12u(mobilep)">
						<input type="text" name="address" value="<?php echo htmlspecialchars($lodging['Address']);?>" placeholder="Adresse*" maxlength="45" required/>
					</div>
				</div>
                <div class="row uniform 50%">
					<div class="6u 12u(mobilep)">
						<label for="date_Start">Date de début*:</label>
						<input type="date" id="start" name="date_Start" value="<?php echo $lodging['Day_Start'];?>" onchange="set_Min_Date()" min="2018-01-01" required/>
					</div>
					<div class="6u 12u(mobilep)">
						<label for="date_End">Date de fin*:</label>
						<input type="date" id="end"  name="date_End" value="<?php echo $lodging['Day_End'];?>" onblur="check_Date()" min="<?php echo $lodging['Day_Start'];?>" required/>
					</div>
				</div>
                <div class="row uniform 50%">
                    <div class="6u 12u(mobilep)">
                        <div>Prix*:</div>
						<input type="number" id="price" onchange="two_Decimal()" name="price" value="<?php echo $lodging['Price'];?>" min="0" max="900000" step="0.01" required/>
                        <span>CHF</span>
                    </div>
                    <div class="6u">
						<div class="select-wrapper">
							<select name="type">
								<?php
                                    //First, set the selected one.
                                    foreach($lodging_Types as $lodging_Type)
                                    {
                                        if($lodging_Type['idLodging_Type'] == $lodging[fkLodging_Type])
                                        {
                                            echo "<option value='".$lodging_Type['idLodging_Type']."'>".$lodging_Type['Type']."</option>";   
                                        }
                                    }
                                    foreach($lodging_Types as $lodging_Type)
                                    {
                                        if($lodging_Type['idLodging_Type'] != $lodging[fkLodging_Type])
                                        {
                                            echo "<option value='".$lodging_Type['idLodging_Type']."'>".$lodging_Type['Type']."</option>";   
                                        }
                                    }
                                ?>
				            </select>
				        </div>
				    </div>
                </div>
				<div class="row uniform 50%">
					<div class="6u 12u(mobilep)">
						<input type="text" name="code" value="<?php echo htmlspecialchars($lodging['Code']);?>" placeholder="Code de réservation*" maxlength="45"/>
					</div>
					<div class="6u 12u(mobilep)">
						<input type="text" name="link" value="<?php echo htmlspecialchars($lodging['Link']);?>" placeholder="Lien*" maxlength="255"/>
					</div>
				</div>
                <div class="row uniform 50%">
                    <div class="12u 12u(mobilep)">
						<textarea  name="note"  maxlength="280" placeholder="Remarque"><?php echo htmlspecialchars($lodging['Note']);?></textarea>
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
                            //current image preview
                            if($lodging['Image'] == true)
                            {
                                 echo "<td><a class='no_Border' href='images/user".$_SESSION["id"]."/".$lodging['fkTrip']."/Lodging/".$lodging['idLodging'].".jpg'><img class='thumbnail' src='images/user".$_SESSION["id"]."/".$lodging['fkTrip']."/Lodging/".$lodging['idLodging'].".jpg'></a></td>";
                            }
                                 else
                            {
                                 echo '<td><img class="thumbnail" src="images/default_Lodging.png"></td>';     
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
                            <li><a class="button" href="<?php echo "index.php?action=see_Trip&id=".$lodging['fkTrip']?>/#lodging">Annuler</a></li>	
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