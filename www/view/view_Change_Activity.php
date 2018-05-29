<?php
    ob_start();
?>
<header>
	<h2>Editer l'activité</h2>
	<p>Les champs marqués d'un * sont obligatoires</p>
</header>
<div class="row">
    <div class="12u">
        <!-- Text -->
        <section class="box">
			<form method="post" action="index.php?action=change_Activity&id=<?php echo $_GET['id'];?>" enctype="multipart/form-data">
				<div class="row uniform 50%">
					<div class="12u 12u(mobilep)">
						<input type="text" name="description" placeholder="Description*" value="<?php echo $activity['Description'];?>" maxlength="45" required/>
					</div>
				</div>
                <div class="row uniform 50%">
                    <div class="6u 12u(mobilep)">
                        <div>Prix*:</div>
						<input type="number" id="price" onchange="two_Decimal()" name="price" value="<?php echo $activity['Price'];?>" value="0" min="0" step="0.01" required/>
                        <span>CHF</span>
                    </div>
                    <div class="6u 12u(mobilep)">
						<div>Date de l'activité:</div>
						<input type="date" id="start" name="date_Activity" value="<?php echo $activity['Date'];?>" min="2018-01-01"/>
					</div>
                </div>
				<div class="row uniform 50%">
					<div class="12u 12u(mobilep)">
						<input type="text" name="link" placeholder="Lien" value="<?php echo $activity['Link'];?>" maxlength="255"/>
					</div>
				</div>
                <div class="row uniform 50%">
                    <div class="12u 12u(mobilep)">
						<input type="text" name="note" placeholder="Remarque" value="<?php echo $activity['Note'];?>" maxlength="280"/>
                    </div>
                </div>
				<div class="row uniform 50%">
					<div class="6u 12u(mobilep)">
						<input type="file" name="image"/>
						<label for="image">Image de l'activité</label>
					</div>
                    <div class="2u 12u(mobilep)">
				        <span>Image actuelle:</span>
					</div>
                    <div class="3u 12u(mobilep)">
				        <?php
                            //image
                            if($activity['Image'] == true)
                            {
                                 echo "<td><a class='no_Border' href='images/user".$_SESSION["id"]."/".$activity['fkTrip']."/Activity/".$activity['idActivity'].".jpg'><img class='thumbnail' src='images/user".$_SESSION["id"]."/".$activity['fkTrip']."/Activity/".$activity['idActivity'].".jpg'></a></td>";
                            }
                                 else
                            {
                                 echo '<td><img class="thumbnail" src="images/default_Activity.png"></td>';     
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
                            <li><a class="button" href="<?php echo "index.php?action=see_Trip&id=".$activity['fkTrip']?>/#activity">Annuler</a></li>	
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